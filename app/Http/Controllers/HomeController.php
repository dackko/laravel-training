<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $users = ['dragi', 'dimitar'];
        $types = ['admin', 'developer'];

        $data = compact('users', 'types');

        return view('test-view', $data);
    }
}