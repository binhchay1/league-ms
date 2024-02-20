<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Enums\Title;

class UserController extends Controller
{
    protected $userRepository;
    protected $title;

    public function __construct(
        Title $title,
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
        $this->title = $title;
    }

    public function index()
    {
        $dataUser = $this->userRepository->index();
        return view('admin.user.index', compact('dataUser'));
    }

    public function destroy($id)
    {
        $this->userRepository->destroy($id);

        return redirect()->route('user.index')->with('success', __('Delete User successfully!'));
    }

    public function setTitle($id)
    {
        $user = $this->userRepository->getById($id);
        $userTitle = explode(',', $user->title);
        $listTitle = $this->title::LIST_TITLE;

        return view('admin.user.title', compact('user', 'listTitle', 'userTitle'));
    }

    public function saveTitle($id, Request $request)
    {
        $getList = $request->except('_token');
        $listTitle = array_keys($getList);
        $userTitle = implode(",", $listTitle);
        $dataUpdate = [
            'title' => $userTitle,
        ];
        $this->userRepository->updateTitle($id, $dataUpdate);

        return redirect()->route('user.index')->with('success', __('Change title successfully!'));
    }
}
