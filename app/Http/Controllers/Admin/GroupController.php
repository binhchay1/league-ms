<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LeagueRequest;
use App\Repositories\GroupRepository;
use App\Http\Controllers\Controller;
use App\Enums\Utility;
use Illuminate\Support\Str;

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
        $listGroup = $this->groupRepository->index();
        return view('admin.group.index', compact('listGroup'));
    }

    public function create()
    {
        return view('admin.group.create');
    }

    public function store(LeagueRequest $request)
    {
        $input = $request->except(['_token']);

        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/group/' . $input['image']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->groupRepository->store($input);

        return redirect()->route('group.index');
    }

    public function show($id)
    {
        $this->groupRepository->show($id);
    }

    public function edit($id)
    {
        $dataLeague = $this->groupRepository->show($id);
        return view('admin.group.edit', compact('dataLeague', 'format_tours', 'type_tours'));
    }


    public function update(LeagueRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['slug'] = Str::slug($request->slug);
        if (isset($input['images'])) {
            $img = $this->utility->saveImageGroup($input);
            if ($img) {
                $path = '/images/group/' . $input['image']->getClientOriginalName();
                $input['images'] = $path;
            }
        }

        $this->groupRepository->updateLeague($input, $id);
        return redirect()->route('group.index');
    }
}
