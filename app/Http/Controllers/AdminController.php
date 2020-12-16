<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;

class AdminController extends Controller
{
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function dashboard()
    {
        $users = $this->user->list();
        return view('admin.dashboard.index', compact('users'));
    }
}
