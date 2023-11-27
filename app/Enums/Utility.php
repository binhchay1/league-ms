<?php

namespace App\Enums;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

final class Utility
{
    public function saveImageLeague($input)
    {
        if ($input) {
            $status = Storage::disk('public-image-league')->put($input['images']->getClientOriginalName(), $input['images']->get());
            return $status;
        }
    }

    public function saveImageTeam($input)
    {
        if ($input) {
            $status = Storage::disk('public-image-team')->put($input['images']->getClientOriginalName(), $input['images']->get());
            return $status;
        }
    }

    public function saveImageGroup($input)
    {
        if ($input) {
            $status = Storage::disk('public-image-group')->put($input['images']->getClientOriginalName(), $input['images']->get());
            return $status;
        }
    }

    public function saveImageUser($input)
    {
        if ($input) {
            $status = Storage::disk('public-image-user')->put($input['profile_photo_path']->getClientOriginalName(), $input['profile_photo_path']->get());
            return $status;
        }
    }

    public function paginate($items, $perPage = 15, $path = null, $pageName = 'page', $page = null, $options = [])
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $options = ['path' => $path];

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function rndRGBColorCode()
    {
        return 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')';
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function createSlug($str, $delimiter = '-')
    {
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;
    }
}
