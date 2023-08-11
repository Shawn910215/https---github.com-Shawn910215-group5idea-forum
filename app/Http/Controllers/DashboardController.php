<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $apiKey = '2eb3f333fa4e67ce8768cbbe985f34ef';
        $city = 'Ottawa';
        $response = Http::get("http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey");

        if ($response->successful()) {
            $weatherData = $response->json();
            return view('dashboard', ['weatherData' => $weatherData]);
        } else {
            // Handle API error
            return view('dashboard'); // Fallback view without weather data
        }
    }
}
