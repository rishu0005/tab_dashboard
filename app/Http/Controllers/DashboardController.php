<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
       // 1. Get random word
        $fetchWord = Http::get('https://random-word-api.herokuapp.com/word');
        $wordArray = $fetchWord->json();

        $word = $wordArray[0] ?? 'Unavailable';

        // 2. Get meaning
        $part_of_speech = 'Not Found';
        $definition = 'Not Available';
        $example = 'Not Available';

        $fetchMeaning = Http::get('https://api.dictionaryapi.dev/api/v2/entries/en/' . $word);

        if ($fetchMeaning->successful()) {
            $data = $fetchMeaning->json();

            if (!empty($data[0]['meanings'])) {
                $part_of_speech = $data[0]['meanings'][0]['partOfSpeech'] ?? 'Not Found';
                $definition = $data[0]['meanings'][0]['definitions'][0]['definition'] ?? 'Not Available';
                $example = $data[0]['meanings'][0]['definitions'][0]['example'] ?? 'Not Available';
            }
        }

        $time = Carbon::now('Asia/Kolkata');

        return view('test', compact(
            'word',
            'part_of_speech',
            'definition',
            'example',
            'time'
        ));
    }

    public function updateWallpaper(Request $request)
    {
       dd('Updating Wallpaper...');
    }
   
}
