<?php

namespace App\Http\Controllers;

use App\Events\UserRemoved;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with(['UserType'])->get();

        $data = compact('users');

        return view('admin.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userTypes = UserType::all();

        $data = compact('userTypes');

        return view('admin.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->storeRules());
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

        return view('admin.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userTypes = UserType::all();
        $user = User::find($id);

        $data = compact('userTypes', 'user');

        return view('admin.users.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->updateRules());

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->back()->with(['status' => 'success', 'message' => 'User has been updated.']);
    }

    public function destroy($id, Request $request)
    {
        $user = User::findOrfail($id);
        $user->delete();

        event(new UserRemoved($user, $request->get('reason')));

        return response()->json(['status' => 'Success']);
    }

    private function storeRules(): array
    {
        $usersTable = (new User)->getTable();
        $userTypes = (new UserType())->getTable();

        return [
            'type_id' => "required|exists:{$userTypes},id",
            'name' => 'required',
            'email' => "required|unique:{$usersTable}|email",
            'password' => 'required|min:6|max:32|confirmed',
        ];
    }

    private function updateRules(): array
    {
        $userTypes = (new UserType())->getTable();

        return [
            'type_id' => "required|exists:{$userTypes},id",
            'name' => 'required',
        ];
    }
}
