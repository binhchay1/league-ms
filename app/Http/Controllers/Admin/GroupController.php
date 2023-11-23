<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use App\Repositories\GroupRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use Illuminate\Support\Str;
use App\Enums\Group;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    protected $groupRepository;
    protected $utility;

    public function __construct(
        GroupRepository $groupRepository,
        Utility $ultity
    ) {
        $this->groupRepository = $groupRepository;
        $this->utility = $ultity;
    }

    public function index()
    {
        $listGroup = $this->groupRepository->getGroup();
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

        $input['activity_time'] = $input['activity_time_start'];
        if ($input['activity_time_end'] != null) {
            $input['activity_time'] .= ' - ' . $input['activity_time_end'];
        }
        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/upload/group/' . $input['images']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->groupRepository->create($input);

        return redirect()->route('group.index');
    }

    public function edit($id)
    {
        $dataGroup = $this->groupRepository->getById($id);

        return view('admin.group.edit', compact('dataGroup'));
    }


    public function update(GroupRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/upload/group/' . $input['image']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->groupRepository->updateById($id, $input);
        return redirect()->route('group.index');
    }
}
