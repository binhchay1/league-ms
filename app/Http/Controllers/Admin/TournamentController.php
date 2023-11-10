<?php

namespace App\Http\Controllers\Admin;
use App\Enums\Role;
use App\Http\Requests\TournamentReuqest;
use App\Repositories\TournamentRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\Utility;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    protected $tournamentRepository;
    protected $utility;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(
        TournamentRepository $tournamentRepository,
        Utility $ultity
    ) {
        $this->tournamentRepository = $tournamentRepository;
        $this->utility = $ultity;
    }
    public function index()
    {
        $listTournament = $this->tournamentRepository->index();
        return view ('admin.tournament.index', [
            'listTournament' => $listTournament,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_tour = config('tournament.type');
        $format_tour = config('tournament.format');
        if(Auth::user()->role == Role::ADMIN) {
            return view ('admin.tournament.create',[
                'formatTour' => $format_tour,
                'type_tour' => $type_tour,
            ]);
        }
        return view ('page.tournament.create',[
            'formatTour' => $format_tour,
            'type_tour' => $type_tour,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentReuqest $request)
    {
        $input = $request->except(['_token']);

        if (isset($input['image'])) {
            $img = $this->utility->saveImageLogo($input);
            if ($img) {
                $path = '/images/tournament/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $this->tournamentRepository->store($input);
        if(Auth::user()->role == Role::ADMIN) {
            return redirect()->to('list-tournament');
        }
        return redirect()->to('list-tournaments');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataTournament = $this->tournamentRepository->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type_tour = config('tournament.type');
        $format_tour = config('tournament.format');
        $dataTournament = $this->tournamentRepository->show($id);
        return view('admin.tournament.edit',
            ['dataTournament' => $dataTournament,
            'formatTour' => $format_tour,
            'type_tour' => $type_tour,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TournamentReuqest $request, $id)
    {
        $input = $request->except(['_token']);
        if (isset($input['image'])) {
            $img = $this->utility->saveImageLogo($input);
            if ($img) {
                $path = '/images/tournament/' . $input['image']->getClientOriginalName();
                $input['image'] = $path;
            }
        }

        $dataTour = $this->tournamentRepository->updateTour($input, $id);
        return redirect('list-tournament');
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
