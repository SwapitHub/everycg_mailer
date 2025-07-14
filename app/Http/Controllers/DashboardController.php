<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Contact;
use App\Models\SmtpConfig;

class DashboardController extends Controller
{
    protected $groups;
    protected $contacts;
    // protected $smtpConfig;
    public function __construct()
    {
        $this->groups = Group::count();
        $this->contacts = Contact::count();
    }


    public function index()
    {
        $groupCount  =  $this->groups;
        $contactCount  =  $this->contacts;
        return view('dashboard', compact('groupCount', 'contactCount'));
    }
}
