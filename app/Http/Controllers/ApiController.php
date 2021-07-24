<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    public function alldata()
    {
        $response = Http::get('http://apicovid19indonesia-v2.vercel.app/api/indonesia');
        $hasil = $response->json();
        return response()->json($hasil);
    }
    public function vaksin()
    {
        $response = Http::get('http://vaksincovid19-api.vercel.app/api/vaksin');
        $hasil = $response->json();
        return response()->json($hasil);
    }
}
