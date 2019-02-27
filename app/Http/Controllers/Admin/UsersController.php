<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {

        if($request->wantsJson()){
            $source = User::query();

            return DataTables::of($source)->make(true);
        }

        return view('admin.users.index');
    }
}
