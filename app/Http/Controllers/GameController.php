<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    public function score(Request $request) {

        $word = strtolower($request->input('word'));
        if(!$this->dictionary($word)) {
            return response()->json(['error' => 'Word not found in dictionary']);
        }

        $score =  count(array_unique(str_split($word)));
        if($this->isPalindrome($word)) {
            $score += 3;
        } elseif($this->isAlmostPalindrome($word)) {
            $score += 2;
        }

        return response()->json(['score' => $score]);

    }

    public function dictionary($word) {
        $response = Http::get("https://api.dictionaryapi.dev/api/v2/entries/en/$word");
        return $response->ok();
    }

    public function isPalindrome($word) {
        return $word === strrev($word);
    }

    public function isAlmostPalindrome($word) {
        $length = strlen($word);

        for($i = 0; $i < $length/2; $i++) {
            if($word[$i] !== $word[$length - 1 - $i]) {
                $withoutChar = substr($word, 0, $i) . substr($word, $i + 1);
                if($this->isPalindrome($withoutChar)) {
                    return true;
                }
                return false; 
            }
        }
        return true;
    }

}
