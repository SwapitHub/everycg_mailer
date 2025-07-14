<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmtpConfig;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

class SmtpController extends Controller
{
    public function index()
    {
        $list = SmtpConfig::first();
        return view('admin.smtp.show', compact('list'));
    }

    public function store(Request $request)
    {
        $smtp = new SmtpConfig;
        $smtp->mail_mailer = $request->mail_mailer;
        $smtp->mail_host = $request->mail_host;
        $smtp->mail_port = $request->mail_port;
        $smtp->mail_username = $request->mail_username;
        $smtp->mail_from_address = $request->mail_from_address;
        $smtp->mail_from_name = $request->mail_from_name;
        $smtp->mail_encryption = $request->mail_encryption;
        $smtp->active = $request->active;
        $smtp->mail_password = Hash::make($request->mail_password);
        $smtp->save();
        return true;
    }

    public function edit($id)
    {
        $config = SmtpConfig::find($id);
        return $config;
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $smtp = SmtpConfig::find($id);

        $validator = Validator::make($request->all(), [
            'mail_username' => 'required',
            'mail_mailer' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_password' => 'required',
            'mail_from_address' => 'required',
            'mail_from_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'response' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        if (!$smtp) {
            $response = $this->store($request);
            if ($response) {
                return response()->json([
                    'response' => true,
                    'message' => "SMTP added."
                ], 200);
            }
        }

        // try {
        $smtp->mail_mailer = $request->mail_mailer;
        $smtp->mail_host = $request->mail_host;
        $smtp->mail_port = $request->mail_port;
        $smtp->mail_username = $request->mail_username;
        $smtp->mail_from_address = $request->mail_from_address;
        $smtp->mail_from_name = $request->mail_from_name;
        $smtp->mail_encryption = $request->mail_encryption;
        $smtp->active = $request->active;
        $smtp->mail_password = Hash::make($request->mail_password);
        $smtp->save();
        return response()->json([
            'response' => true,
            'message' => "SMTP updated."
        ], 200);
        // } catch (\Exception $e) {
        //     if ($validator->fails()) {
        //         return response()->json([
        //             'response' => false,
        //             'message' => $e->getMessage(),
        //         ], 500);
        //     }
        // }
    }
}
