<?php

namespace App\Enums;

use Illuminate\Support\Facades\Storage;

final class Utility
{

    public function saveImageTournament($input)
    {
        if ($input) {
            $status = Storage::disk('public-image-tour')->put($input['image']->getClientOriginalName(), $input['image']->get());
            return $status;
        }
    }

    public function saveImageTeam($input)
    {
        if ($input) {
            $status = Storage::disk('public-image-team')->put($input['image']->getClientOriginalName(), $input['image']->get());
            return $status;
        }
    }

    public function saveImagePlayer($input)
    {
        if ($input) {
            $status = Storage::disk('public-image-player')->put($input['image']->getClientOriginalName(), $input['image']->get());
            return $status;
        }
    }

}
