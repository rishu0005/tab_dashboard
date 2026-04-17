<?php

namespace App\Http\Controllers;

use App\Models\BackgroudImage;
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
        if(! $fetchWord){
            return "not found";
        }
        $wordArray = $fetchWord->json();

        $word = $wordArray[0] ?? 'Unavailable';

        // 2. Get meaning
        $part_of_speech = 'Not Found';
        $definition = 'Not Available';
        $example = 'Not Available';
        // $word = 'Aspera';
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
        $bg_image = BackgroudImage::latest()->first();
        $image = $bg_image->image_url;

        if($bg_image){
            return view('test', compact(
            'image',
            'word',
            'part_of_speech',
            'definition',
            'example',
            'time'
        ));
        }


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
        try{

            if($request->hasfile('file')){
                    $file = $request->file('file');
                    $filename = time() . '_' . $file->getClientOriginalName();
    
                    $path  = $file->storeAs('wallpapers', $filename, 'public');
                    
                    $bg_image = new BackgroudImage();
                    $bg_image->image_url = $path;
                    $bg_image->user_id = 1; // Assuming you want to associate it with a user, replace with actual user ID
                    $bg_image->save();
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Background image updated successfully',
                        'image_path' => url('/') . "/git ststorage/" . $path,
                    ]);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
   
}
