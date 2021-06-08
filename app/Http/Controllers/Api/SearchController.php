<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchAutocompleteRequest;
use App\Http\Requests\SearchGetStupenkiRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Stupenka;
use App\Traits\ApiResponser;

class SearchController extends Controller
{
    use ApiResponser;

    protected function searchAutocomplete($search, $model)
    {
        return $model::where('name', 'like', $search)->get();
    }

    public function searchAllAutocomplete(SearchAutocompleteRequest $request): \Illuminate\Http\JsonResponse
    {
        $search = '%'. $request->input('search') .'%';

        return $this->success([
            [
                'type' => 'Города',
                'values' => $this->searchAutocomplete($search, City::class),
            ],
            [
                'type' => 'Страны',
                'values' => $this->searchAutocomplete($search, Country::class),
            ],
        ]);
    }

    public function searchCityAutocomplete(SearchAutocompleteRequest $request): \Illuminate\Http\JsonResponse
    {
        $search = '%'. $request->input('search') .'%';
        return $this->success($this->searchAutocomplete($search, City::class));
    }

    public function searchCountryAutocomplete(SearchAutocompleteRequest $request): \Illuminate\Http\JsonResponse
    {
        $search = '%'. $request->input('search') .'%';
        return $this->success($this->searchAutocomplete($search, Country::class));
    }

    public function getStupenkiToSearchString(SearchGetStupenkiRequest $request): \Illuminate\Http\JsonResponse
    {
        $type = $request->input('type');
        $id = $request->input('value');

        $result = Stupenka::where(function ($query) use ($type, $id) {
            $type === 'city'
                ? $query->where('city_id', $id)
                : $query->where('country_id', $id);
        })->get();
        return $this->success($result);
    }
}
