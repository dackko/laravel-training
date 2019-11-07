<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class UsersTypeController extends Controller
{
    public function index()
    {
        $userTypes = UserType::all();

        $data = compact('userTypes');

        return view('admin.users.types', $data);
    }

}
