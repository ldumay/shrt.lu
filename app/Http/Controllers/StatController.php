<?php

namespace App\Http\Controllers;

use App\Stat;
use Illuminate\Http\Request;

use App\Http\Requests;

class StatController extends Controller
{
    // Display total click for the link
    public function view($slug){
        // Count access to link
        $count = Stat::where('slug', '=', $slug)->count();

        // Prepare $data for wien
        $data = [
            'slug' => $slug,
            'count' => $count
        ];

        // Passing result to view
        return view('stats')->with('data', $data);
    }
}
