<?php

namespace App\Support;

use App\Models\About;
use App\Models\Car;
use App\Models\Company;
use App\Models\Make;

class StorefrontShell
{
    /**
     * Load the company, about blurb, and footer makes once per request.
     */
    public static function load(): void
    {
        $makeIds = Car::query()
            ->where('del', 'no')
            ->whereNotNull('make_id')
            ->orderByDesc('id')
            ->pluck('make_id')
            ->unique()
            ->take(5)
            ->values();

        session([
            'company' => Company::find(1),
            'about' => About::find(1),
            'avail' => Make::query()
                ->whereIn('id', $makeIds)
                ->orderBy('model_name')
                ->get(),
            'car_color' => Car::query()
                ->select('color')
                ->where('del', 'no')
                ->whereNotNull('color')
                ->where('color', '!=', '')
                ->distinct()
                ->orderBy('color')
                ->get(),
        ]);
    }
}
