<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mailgateway;
use App\Models\Smsgateway;
use Illuminate\Http\Request;

class ApiIntegrationController extends Controller
{
    public function sms_gateway()
    {
        $edit_data = Smsgateway::first();
        return view('admin.api_integration.sms_gateway', compact('edit_data'));
    }
    public function sms_gateway_update(Request $request)
    {
        $smsgateway = Smsgateway::first();
        $smsgateway->url = $request->url;
        $smsgateway->api_key = $request->api_key;
        $smsgateway->senderid = $request->senderid;
        $smsgateway->status = $request->status;
        $smsgateway->save();

        return redirect()->back()->with('success','Sms Gateway Updated!');
    }
    public function mail_gateway()
    {
        $edit_data = Mailgateway::first();
        return view('admin.api_integration.mail_gateway', compact('edit_data'));
    }
    public function mail_gateway_update(Request $request)
    {
        $mailgateway = Mailgateway::first();
        $mailgateway->mail_mailer = $request->mail_mailer;
        $mailgateway->mail_host = $request->mail_host;
        $mailgateway->mail_port = $request->mail_port;
        $mailgateway->mail_username = $request->mail_username;
        $mailgateway->mail_password = $request->mail_password;
        $mailgateway->mail_encryption = $request->mail_encryption;
        $mailgateway->status = $request->status;
        $mailgateway->save();

        return redirect()->back()->with('success','Mail Gateway Updated!');
    }
}
