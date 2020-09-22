<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use App\Http\Requests\User\Update;

class UserController extends Controller
{
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function show($user_id)
    {
        $user = $this->user->find($user_id);
        return view('users.show', compact('user'));
    }

    public function update(Update $request, $user_id)
    {
        $inputs = $request->validated();
        $this->user->update($user_id, $inputs);
        return redirect()->back()->with('alert-success', __('User Updated successfully.'));
    }
}
