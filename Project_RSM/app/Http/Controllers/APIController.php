<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class APIController extends Controller
{
    public function getProvinces()
    {
        $client = new Client([
            'base_uri' => 'https://provinces.open-api.vn/api/',
        ]);

        $response = $client->request('GET', 'p');
        $provinces = json_decode($response->getBody(), true);
        return $provinces;
    }

    public function getDistricts($province_id)
    {
        $client = new Client([
            'base_uri' => 'https://provinces.open-api.vn/api/',
        ]);

        $response = $client->request('GET', "p/{$province_id}");
        $districts = json_decode($response->getBody(), true);

        return $districts;
    }

    public function getWards($district_id)
    {
        $client = new Client([
            'base_uri' => 'https://provinces.open-api.vn/api/',
        ]);

        $response = $client->request('GET', "d/{$district_id}/w");
        $wards = json_decode($response->getBody(), true);

        return $wards;
    }
}
