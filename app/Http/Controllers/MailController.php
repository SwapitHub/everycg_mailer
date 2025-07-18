<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Email;
use App\Models\Contact;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Exception;

class MailController extends Controller
{

    protected $draftCount;
    public function __construct()
    {
        $this->draftCount = Email::where('is_draft', 1)->count();
    }

    public function index()
    {
        $draftCount =  $this->draftCount;
        return view('admin.mail.inbox', compact('draftCount'));
    }

    public function compose()
    {
        $groups = Group::where('status', 1)->get();
        $contacts = Contact::where('status', 1)->get();
        $draftCount =  $this->draftCount;
        return view('admin.mail.compose', compact('groups', 'contacts', 'draftCount'));
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to_email' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        if ($request->action == 'send') {
            try {
                $emailData = $request->all();
                Mail::to($emailData['to_email'])->send(new SendEmail($emailData));
                $returnMsg = 'Email sent!';
                $status = 'Email sent!';
            } catch (\Exception $e) {
                $returnMsg = $e->getMessage();
                $status = $e->getMessage();
            }
            $draft = 0;
        } else {
            $returnMsg = 'Email saved in draft!';
            $draft = 1;
            $status = 'Saved in Draft.';
        }

        $email = new Email;
        $email->group_id = $request->group_id;
        $email->from_email = env('MAIL_FROM_ADDRESS');
        $email->to_email = trim($request->to_email);
        $email->cc_email = $request->cc_email;
        $email->subject = $request->subject;
        $email->body = $request->body;
        $email->is_draft = $draft;
        $email->status = $status;
        $email->save();

        return response()->json([
            'response' => true,
            'message' => $returnMsg
        ], 200);
    }

    public function drafts()
    {
        $draftCount =  $this->draftCount;
        $groups = Group::OrderBy('id','desc')->where('status',1)->get();
        $drafts = Email::orderBy('id', 'desc')->where('is_draft', 1)->get();
        return view('admin.mail.drafts', compact('drafts', 'draftCount','groups'));
    }

    public function edit($id)
    {
        $email = Email::with('groups')->find($id);
        return $email;
    }


    public function sent()
    {
        $draftCount =  $this->draftCount;
        $lists = Email::orderBy('id', 'desc')->where('is_draft', 0)->get();
        return view('admin.mail.sent', compact('lists', 'draftCount'));
    }

    public function removeEmail($id)
    {
        $email = Email::find($id);
        $email->delete();
        return response()->json([
            'response' => true,
            'message' => 'Email deleted.'
        ], 200);
    }
}
