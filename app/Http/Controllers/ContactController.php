<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Group;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactImport;
use Illuminate\Support\Facades\Validator;
use Exception;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Contact::with('group')->orderBy('id', 'desc');

        if ($request->filled('filter')) {
            $filter = $request->input('filter');

            $query->where(function ($q) use ($filter) {
                $q->where('name', 'like', "%{$filter}%")
                    ->orWhere('email', 'like', "%{$filter}%")
                    ->orWhereHas('group', function ($q2) use ($filter) {
                        $q2->where('name', 'like', "%{$filter}%");
                    });
            });
        }

        $lists = $query->paginate(10);
        $groups = Group::orderBy('id', 'desc')->get();

        return view('admin.contacts.list', compact('lists', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:contacts,email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        $contact = new Contact;
        $contact->group_id = trim($request->group_id);
        $contact->name = strtolower(trim($request->name));
        $contact->email = trim($request->email);
        $contact->save();
        return response()->json(['response' => true, 'message' => 'Contact created.'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'response' => false,
                'message' => 'Contact not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'name' => 'required|string|max:255',
            'group_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $contact->name = strtolower(trim($request->name));
        $contact->email = trim($request->email);
        $contact->group_id = trim($request->group_id);
        $contact->save();

        return response()->json([
            'response' => true,
            'message' => 'Contact updated.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'response' => false,
                'message' => 'Contact not found.'
            ], 404);
        }
        $contact->delete();

        return response()->json([
            'response' => true,
            'message' => 'Contact deleted.'
        ], 200);
    }

    public function importContacts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact-file' => 'required|file|mimes:xls,xlsx,csv|max:100000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }
        try {
            Excel::import(new ContactImport, $request->file('contact-file'));
            return response()->json([
                'response' => true,
                'message' => 'Contact imported successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'response' => false,
                'message' => 'Failed to import contacts: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getContactsByGroup($groupId)
    {
        $group = Group::with('contacts')->find($groupId);

        if (!$group) {
            $group = Group::with('contacts')->get();
            return response()->json([
                'contacts' => $group->contacts->map(function ($contact) {
                    return [
                        'name' => $contact->name,
                        'email' => $contact->email
                    ];
                })
            ]);
        }

        return response()->json([
            'contacts' => $group->contacts->map(function ($contact) {
                return [
                    'name' => $contact->name,
                    'email' => $contact->email
                ];
            })
        ]);
    }
}
