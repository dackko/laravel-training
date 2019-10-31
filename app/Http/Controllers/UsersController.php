<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with(['UserType'])->get();

        $data = compact('users');

        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userTypes = UserType::all();

        $data = compact('userTypes');

        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->storeRules());

//        $params = $request->all();
//        $params['password'] = bcrypt($params['password']);
//        User::create($params);
        User::create($request->all());
        return redirect()->back()->with(['status' => 'success', 'message' => 'User has been added.']);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $data = compact('user');

        return view('users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function storeRules(): array
    {
        $usersTable = (new User)->getTable();

        return [
            'type_id' => 'required',
            'name' => 'required',
            'email' => "required|unique:{$usersTable}|email",
            'password' => 'required|min:6|max:32|confirmed',
        ];
    }
}
