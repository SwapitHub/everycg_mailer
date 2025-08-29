<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Contact;
use App\Models\Email;
use App\Models\SmtpConfig;

class DashboardController extends Controller
{
    protected $groups;
    protected $drafts;
    protected $contacts;
    // protected $smtpConfig;
    public function __construct()
    {
        $this->groups = Group::count();
        $this->contacts = Contact::count();
        $this->drafts = Email::where('is_draft', 1)->count();
    }


    public function index()
    {
        $groupCount  =  $this->groups;
        $contactCount  =  $this->contacts;
        $draftCount = $this->drafts;
        return view('dashboard', compact('groupCount', 'contactCount', 'draftCount'));
    }
}
