<?php

namespace App\Http\Controllers\PublicImport;

use App\Http\Controllers\Controller;

class PublicImportController extends Controller
{
    public function importWorldData()
    {
        $file = file_get_contents(public_path('regions.json'));
        $data = json_decode($file);

        foreach ($data as $region) {
            \App\Models\Region::updateOrCreate([
                'name' => $region->name,
                'code' => $region->wikiDataId,
                'file_id' => $region->id,
                'created_by_id' => 1,
            ]);
        }

        $file = file_get_contents(public_path('subregions.json'));
        $data = json_decode($file);

        foreach ($data as $region) {
            \App\Models\SubRegion::updateOrCreate([
                'name' => $region->name,
                'code' => $region->wikiDataId,
                'region_id' => $region->region_id,
                'file_id' => $region->id,
                'created_by_id' => 1,
            ]);
        }

        $file = file_get_contents(public_path('data.json'));
        $file = json_decode($file);
        $count = 0;
        foreach ($file as $countries) {
            if ($countries->name == 'Pakistan' || $countries->name == 'United Kingdom' || $countries->name == 'India' || $countries->name == 'United States') {

            $findCountry = \App\Models\Country::where('file_id', $countries->id)->first();
            if ($findCountry) {
                $country = $findCountry;
            } else {
                $country = new \App\Models\Country();
            }

            $country->file_id = $countries->id;
            $country->name = $countries->name;
            $country->iso3 = $countries->iso3;
            $country->phone_code = $countries->phone_code;
            $country->code = 'CO-' . $countries->id;
            $country->region_id = $countries->region_id;
            $country->sub_region_id = $countries->subregion_id;
            $country->iso2 = $countries->iso2;
            $country->currency = $countries->currency;
            $country->currency_symbol = $countries->currency_symbol;
            $country->numeric_code = $countries->numeric_code;
            $country->capital = $countries->capital;
            $country->nationality = $countries->nationality;
            $country->created_by_id = 1;
            $country->save();

            foreach ($countries->states as $i) {
                $findState = \App\Models\State::where('file_id', $i->id)->first();
                if ($findState) {
                    $state = $findState;
                } else {
                    $state = new \App\Models\State();
                }

                $state->file_id = $i->id;
                $state->country_id = $country->id;
                $state->name = $i->name;
                $state->code = 'S-' . $country->id . '-' . $i->id;
                $state->latitude = $i->latitude;
                $state->longitude = $i->longitude;
                $state->created_by_id = 1;
                $state->save();
                foreach ($i->cities as $j) {

                    $findCity = \App\Models\City::where('file_id', $j->id)->first();
                    if ($findCity) {
                        $city = $findCity;
                    } else {
                        $city = new \App\Models\City();
                    }

                    $city->file_id = $j->id;
                    $city->country_id = $country->id;
                    $city->state_id = $state->id;
                    $city->name = $j->name;
                    $city->code = 'C-' . $state->id . '-' . $country->id . '-' . $j->id;
                    $city->latitude = $j->latitude;
                    $city->longitude = $j->longitude;
                    $city->created_by_id = 1;
                    $city->save();
                }
            }
            $count++;
            // if ($count == 10) {
            //     break;
            // }
        }

    }

        return 'Data seeded successfully!';
    }
}
