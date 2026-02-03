<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin_list()
    {
        $admins = User::where('role','admin')->get();
        return view('admin.admin_list.index',compact('admins'));
    }
}
