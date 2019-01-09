<?php

namespace App\Http\Controllers;

use App\WriteLog;
use Illuminate\Http\Request;

class CurrentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function currentLang(Request $r)
    {
        $data = $r->all();

        switch($data['current_lang']) {
            case '': $_lg = ''; break;
            case 'home': $_lg = ''; break;
            case 'chinese': $_lg = 'zh~~'; break;
            case 'french' : $_lg = 'fr~~'; break;
            case 'german' : $_lg = 'de~~'; break;
            case 'spanish' : $_lg = 'es~~'; break;
            case 'japanese' : $_lg = 'ja~~'; break;
            default: $_lg = ''; break;
        }
        session(['LANGUAGE'=>$_lg]);

        switch($data['current_lang']) {
            case '': $_lg = ''; break;
            case 'home': $_lg = ''; break;
            case 'chinese': $_lg = 'zh/'; break;
            case 'french' : $_lg = 'fr/'; break;
            case 'german' : $_lg = 'de/'; break;
            case 'spanish' : $_lg = 'es/'; break;
            case 'japanese' : $_lg = 'ja/'; break;
            default: $_lg = ''; break;
        }
        session(['NEWS_LANG'=>$_lg]);

        session(['CURRENT'=>$data['current_lang']]);

        return view('home');
    }
}
