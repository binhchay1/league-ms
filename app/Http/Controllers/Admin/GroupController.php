<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use App\Repositories\GroupRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Enums\Group;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupTrainingRepository;

class GroupController extends Controller
{
    protected $groupRepository;
    protected $utility;
    protected $groupTraining;


    public function __construct(
        GroupRepository $groupRepository,
        Utility $ultity,
        GroupTrainingRepository $groupTraining
    ) {
        $this->groupRepository = $groupRepository;
        $this->utility = $ultity;
        $this->groupTraining = $groupTraining;

    }

    public function index()
    {
        $listGroup = $this->groupRepository->get();
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

    public function show($id)
    {
        $dataGroup = $this->groupRepository->getById($id);
        return view("admin.group.show", compact('dataGroup'));
    }

    public function groupTraining(Request $request)
    {
        $input = $request->except(['_token']);
        $input['activity_time'] = $input['activity_time_start'];
        if ($input['activity_time_end'] != null) {
            $input['activity_time'] .= ' - ' . $input['activity_time_end'];
        }
        $this->groupTraining->create($input);

        return redirect()->route('list.groupTraining');
    }

    public function listGroupTraining()
    {
        $listGroupTraining = $this->groupTraining->get();
        return view('admin.group.list-group-training', compact('listGroupTraining'));
    }
}
