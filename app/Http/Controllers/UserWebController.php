<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserWebController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);

        $this->userService->createUser($data);
        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            abort(404);
        }
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            abort(404);
        }
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user = $this->userService->updateUser($id, $data);
        if (!$user) {
            abort(404);
        }
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $deleted = $this->userService->deleteUser($id);
        if (!$deleted) {
            abort(404);
        }
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}