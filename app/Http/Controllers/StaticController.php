<?php

namespace App\Http\Controllers;

use App\Models\Joke;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function home()
    {
        $joke = Joke::inRandomOrder()->first();
        return view('static.home', ['joke' => $joke]);
    }

    public function about()
    {
        return view('static.about');
    }

    public function contact()
    {
        return view('static.contact');
    }

}
