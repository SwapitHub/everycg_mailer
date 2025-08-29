<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SmtpController extends Controller
{
    public function index()
    {
        try {
            $smtpKeys = [
                'MAIL_MAILER',
                'MAIL_HOST',
                'MAIL_PORT',
                'MAIL_USERNAME',
                'MAIL_PASSWORD',
                'MAIL_ENCRYPTION',
                'MAIL_FROM_ADDRESS',
                'MAIL_FROM_NAME',
                'SMTP_STATUS',
            ];

            $settings = Setting::whereIn('key', $smtpKeys)
                ->pluck('value', 'key') // returns key => value
                ->toArray();

            return view('admin.smtp.show', compact('settings'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch SMTP settings: ' . $e->getMessage());
            return back()->with('error', 'Failed to load SMTP settings.');
        }
    }




    public function update(Request $request)
    {
        $smtpData = $request->input('settings', []);

        try {
            DB::beginTransaction();

            foreach ($smtpData as $key => $value) {
                Setting::updateOrInsert(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
            $envData = $smtpData;
            unset($envData['SMTP_STATUS']);
            setEnvValue($envData);

            DB::commit();

            return back()->with('success', 'SMTP settings updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update SMTP settings. Please try again.');
        }
    }
}
