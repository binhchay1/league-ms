<?php

namespace App\Http\Controllers\User;

use App\Enums\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{

    protected $userRepository;
    protected $utility;

    public function __construct(
        UserRepository $userRepository,
        Utility $utility
    ) {
        $this->userRepository = $userRepository;
        $this->utility = $utility;
    }

    public function show($id)
    {
        $dataUser = $this->userRepository->showInfo($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $idUser = Auth::user()->id;
        $dataUser = $this->userRepository->showInfo($idUser);
        return view('page.user.profile', ['dataUser' => $dataUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $userIdHash)
    {
        if (empty($userIdHash)) {
            abort(404);
        }

        $input = $request->except(['_token']);
        if (isset($input['profile_photo_path'])) {
            $img = $this->utility->saveImageUser($input);
            if ($img) {
                $path = 'images/upload/user/' . $input['profile_photo_path']->getClientOriginalName();
                $input['profile_photo_path'] = $path;
            }
        }
        $this->userRepository->update($input, $userIdHash);
        return back()->with('success', __('Information has been updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('page.user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", __("Old passwords do not match!"));
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", __("Password successfully changed!"));
    }

    public function deleteAccount()
    {
        if (Auth::user()->apple == null) {
            abort(403);
        }

        $getUser = $this->userRepository->getUserByAppleID(Auth::user()->apple_id);

        if (!$getUser) {
            abort(404);
        } else {
            Session::flush();
            $this->userRepository->deleteById($getUser->id);
            Auth::guard('web')->logout();
        }

        return redirect()->route('login');
    }

    public function viewMyGroup()
    {
        $idUser = Auth::user()->id;
        $dataUser = $this->userRepository->showInfo($idUser);

        $getGroup = $dataUser->groups;
        $listGroup = $this->utility->paginate($getGroup, 30, '/my-group');

        return view('page.user.my-group', compact('listGroup'));
    }

    public function viewMyLeague()
    {
        $idUser = Auth::user()->id;
        $dataUser = $this->userRepository->showInfo($idUser);

        $getLeague = $dataUser->league;
        $listLeague = $this->utility->paginate($getLeague, 10, '/my-league');

        return view('page.user.my-league', compact('listLeague'));
    }
}
