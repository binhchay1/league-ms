<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Enums\Title;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function changePassword($id)
    {
        $user = $this->userRepository->getById($id);

        return view('admin.user.update-password', compact('user'));
    }

    public function updatePassword($id, Request $request)
    {
        $user = User::findOrFail($id);

        // Validate dữ liệu nhập vào
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.index')->with('success', __('Change password successfully!'));
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
