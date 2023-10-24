<?php

namespace App\Enums;

use Illuminate\Support\Facades\Storage;

final class Utility
{

    public function saveImageLogo($input)
    {
        if ($input) {
            $status = Storage::disk('public-logo')->put($input['image']->getClientOriginalName(), $input['image']->get());
            return $status;
        }
    }

}
