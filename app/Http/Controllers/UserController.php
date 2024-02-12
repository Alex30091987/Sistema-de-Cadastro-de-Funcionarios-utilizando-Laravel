<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:level')->only('edit');
    }

    public function index()
    {
        $users = User::orderBy('name')->paginate(5);

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            // Add your validation rules here based on your User model
        ]);

        User::findOrFail($id)->update($validatedData);

        return redirect()->route('user.index');
    }
}
