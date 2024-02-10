<?php


namespace App\Services;


use App\Models\Type;
use Illuminate\Support\Facades\Cache;

class TypeService
{

    public function index() {

        return Cache::remember('types', 24 * 60, function () {

            return Type::get();
        });
    }
}
