<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Models\GroupUser;
use App\Repositories\GroupRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use App\Repositories\GroupUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Enums\Group;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupTrainingRepository;
use App\Http\Requests\GroupTrainingRequest;

class GroupController extends Controller
{
    protected $groupRepository;
    protected $utility;
    protected $groupTraining;
    protected $groupUserRepository;

    public function __construct(
        GroupRepository $groupRepository,
        GroupUserRepository $groupUserRepository,
        Utility $ultity,
        GroupTrainingRepository $groupTraining
    ) {
        $this->groupRepository = $groupRepository;
        $this->groupUserRepository = $groupUserRepository;
        $this->utility = $ultity;
        $this->groupTraining = $groupTraining;

    }

    public function index()
    {
        $user = Auth::user()->id;
        $listGroup = $this->groupRepository->index($user);
        return view('admin.group.index', compact('listGroup'));
    }

    public function create()
    {
        return view('admin.group.create');
    }

    public function store(GroupRequest $request)
    {
        $input = $request->except(['_token']);
        $input['group_owner'] = Auth::user()->id;
        $input['rate'] = Group::RATE_NEWLY_ESTABLISHED;
        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/upload/group/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }
        $this->groupRepository->create($input);
        return redirect()->route('group.index')->with('success','Group successfully created.');
    }

    public function edit($id)
    {
        $dataGroup = $this->groupRepository->getById($id);

        return view('admin.group.edit', compact('dataGroup'));
    }

    public function update(GroupUpdateRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/upload/group/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->groupRepository->updateById($id, $input);
        return redirect()->route('group.index')->with('success','Group successfully updated.');
    }

    public function destroy($id)
    {
        $this->groupRepository->deleteGroup($id);

        return redirect()->route('group.index')->with('success', __('Delete Group successfully!'));
    }

    public function activeGroup($id)
    {
        $group = \App\Models\Group::find($id);
        if ($group->active) {
            $group->active = 0;
        } else {
            $group->active = 1;
        }
        $group->save();

        return back();
    }

    public function show($id)
    {
        $dataGroup = $this->groupRepository->getById($id);
        return view("admin.group.show", compact('dataGroup'));
    }

    public function groupTraining(GroupTrainingRequest $request)
    {
        $input = $request->except(['_token']);
        $input['owner_user'] = Auth::user()->id;
        $this->groupTraining->create($input);

        return redirect()->route('list.groupTraining')->with('success','Group Training successfully created.');
    }

    public function listGroupTraining()
    {
        $user = Auth::user()->id;
        $listGroupTraining = $this->groupTraining->index($user);
        return view('admin.group.list-group-training', compact('listGroupTraining'));
    }

    public function editGroupTraining($id)
    {
        $dataGroupTraining = $this->groupTraining->editGroupTraining($id);
        return view('admin.group.edit-group-training', compact('dataGroupTraining'));

    }

    public function updateGroupTraining(GroupTrainingRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $update_GroupTraining = $this->groupTraining->update($input, $id);

        return redirect()->route('list.groupTraining')->with('success','Group Training successfully created.');

    }

    public function deleteGroupTraining($id)
    {
        $this->groupTraining->destroy($id);

        return back()->with('success', __('Delete League successfully!'));
    }

    public function dataGroup($id)
    {
        $group = $this->groupRepository->getGroupById($id);
        return view('admin.group.user-register-group', compact('group'));
    }

    public function activeUserJoin(Request $request)
    {
        $input = $request->except(['_token']);
        // Retrieve the user IDs and the new status from the request
        $userIds = $request->input('user_ids');
        $activeStatus = $request->input('status_request');
        // Update the 'active' status for all specified users
        if(empty($userIds))
        {
            return back()->with('success', __('No users to action!'));
        }

        GroupUser::whereIn('id', $userIds)->update(['status_request' => $activeStatus]);

        return back()->with('success', __('Users has been update successfully!'));
    }

    public function destroyUser($id)
    {
        $this->groupUserRepository->destroy($id);
        return back()->with('success', 'User successfully deleted.');
    }


    public function createGroup()
    {
        return view('page.group.create');
    }

    public function storeGroup(GroupRequest $request)
    {
        $input = $request->except(['_token']);
        $input['group_owner'] = Auth::user()->id;
        $input['rate'] = Group::RATE_NEWLY_ESTABLISHED;
        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/upload/group/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }
        $data = $this->groupRepository->create($input);

        $dataGroupUser['group_id'] = $data->id;
        $dataGroupUser['user_id'] = $data->group_owner;
        $dataGroupUser['status_request'] = Group::STATUS_ACCEPTED;

        $this->groupUserRepository->create($dataGroupUser);

        return redirect()->route('my.group')->with('success','Group successfully created.');
    }
}
