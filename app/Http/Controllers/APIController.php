<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
     public function fetchRandomWords(){
        return 'This is the API endpoint for fetching random words.';
    }
}
