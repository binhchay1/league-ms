<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository= $userRepository;
    }

    public function index()
    {
        $dataUser = $this->userRepository->index();
        return view('admin.user.index', compact('dataUser'));
    }

    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return back()->with('success', 'Delete User successfully!');
    }
}
