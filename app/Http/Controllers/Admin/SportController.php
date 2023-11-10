<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Utility;
use App\Http\Controllers\Controller;
use App\Http\Requests\SportRequest;
use App\Repositories\SportRepository;
use Illuminate\Support\Str;

class SportController extends Controller
{

    protected $sportRepository;
    protected $utility;

    public function __construct(
        SportRepository $sportRepository,
        Utility $utility
    )
    {
        $this->sportRepository = $sportRepository;
        $this->utility = $utility;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listSport = $this->sportRepository->index();
        return view('admin.sport.index',['listSport'=>$listSport]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SportRequest $request)
    {

        $input = $request->except(['_token']);
        $input['link'] = Str::slug($request->link);


        if (isset($input['image'])) {
            $img = $this->utility->saveImageLogo($input);
            if ($img) {
                $path = '/images/sport/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }
        $this->sportRepository->store($input);
        return redirect('list-sport');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataSport = $this->sportRepository->showData($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataSport = $this->sportRepository->showData($id);
        return view('admin.sport.update', ['dataSport'=>$dataSport]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SportRequest $request, $id)
    {
        $input = $request->except(['_token']);
        $input['link'] = Str::slug($request->link);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageLogo($input);
            if ($img) {
                $path = '/images/sport/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $dataTeam = $this->sportRepository->updateData($input, $id);
        return redirect('list-sport');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
