<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
