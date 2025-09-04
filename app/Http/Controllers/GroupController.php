<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Group::orderBy('id', 'desc');
        if ($request->filled('filter')) {
            $filter = $request->input('filter');

            $query->where(function ($q) use ($filter) {
                $q->where('name', 'like', "%{$filter}%");
            });
        }
        $list = $query->paginate(10);
        return view('admin.groups.list', ['lists' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:groups,name',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }
        $group = new Group;
        $group->name = strtolower(trim($request->name));
        $group->status = (int)$request->status;
        $group->save();
        return response()->json(['response' => true, 'message' => 'Group created.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        return $group;
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
        $group = Group::find($id);

        if (!$group) {
            return response()->json([
                'response' => false,
                'message' => 'Group not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:groups,name,' . $group->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $group->name = strtolower(trim($request->name));
        $group->status = (int)$request->status;
        $group->save();

        return response()->json([
            'response' => true,
            'message' => 'Group updated.'
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
        $group = Group::find($id);

        if (!$group) {
            return response()->json([
                'response' => false,
                'message' => 'Group not found.'
            ], 404);
        }
        $group->delete();

        return response()->json([
            'response' => true,
            'message' => 'Group deleted.'
        ], 200);
    }
}
