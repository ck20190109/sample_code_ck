<?php
namespace App\Http\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\WriteLog;

class RouteHelper
{
    public static function getLanguage() {
        $path = url()->current();
        $p = strpos($path,'?');
        $p = ($p===false) ? strlen($path):$p;
        $l = strlen(url('/'));
        $lg = substr($path,$l,$p-$l);
        switch($lg) {
            case '': $_lg = ''; $locale='en'; break;
            case '/': $_lg = ''; $locale='en'; break;
            case '/home': $_lg = ''; $locale='en'; break;
            case '/chinese': $_lg = 'zh~~'; $locale='zh'; break;
            case '/french': $_lg = 'fr~~'; $locale='fr'; break;
            case '/german': $_lg = 'de~~'; $locale='de'; break;
            case '/spanish': $_lg = 'es~~'; $locale='es'; break;
            case '/japanese': $_lg = 'ja~~'; $locale='ja'; break;
            default: $_lg = false; break;
        }
        if ($_lg===false) {
            if (strpos($lg, '/zh~~') !== false) {
                $_lg = 'zh~~';
                $locale = 'zh';
            }
            else if (strpos($lg, '/de~~') !== false) {
                $_lg = 'de~~';
                $locale = 'de';
            }
            else if (strpos($lg, '/fr~~') !== false) {
                $_lg = 'fr~~';
                $locale = 'fr';
            }
            else if (strpos($lg, '/es~~') !== false) {
                $_lg = 'es~~';
                $locale = 'es';
            }
            else if (strpos($lg, '/ja~~') !== false) {
                $_lg = 'ja~~';
                $locale = 'ja';
            }
        }
        if ($_lg===false) {
            if (strpos($lg, '/zh/') !== false) {
                $_lg = 'zh~~';
                $locale = 'zh';
            }
            else if (strpos($lg, '/de/') !== false) {
                $_lg = 'de~~';
                $locale = 'de';
            }
            else if (strpos($lg, '/fr/') !== false) {
                $_lg = 'fr~~';
                $locale = 'fr';
            }
            else if (strpos($lg, '/es/') !== false) {
                $_lg = 'es~~';
                $locale = 'es';
            }
            else if (strpos($lg, '/ja/') !== false) {
                $_lg = 'ja~~';
                $locale = 'ja';
            }
        }
        if ($_lg===false) {
            $_lg = '';
            $locale = 'en';
        }
        App::setLocale($locale);
        return $_lg;
    }

    public static function getNewsLang($lg) {
        switch($lg) {
            case 'zh~~': return 'zh/';
            case 'de~~': return 'de/';
            case 'fr~~': return 'fr/';
            case 'es~~': return 'es/';
            case 'ja~~': return 'ja/';
            default: return '';
        }
    }

    public static function getLocation($lg) {
        switch($lg) {
            case 'zh~~': return 'chinese';
            case 'de~~': return 'german';
            case 'fr~~': return 'french';
            case 'es~~': return 'spanish';
            case 'ja~~': return 'japanese';
            default: return '';
        }
    }

    public static function avail_lang() {
        return ['','zh~~','de~~','fr~~','es~~','ja~~'];
    }

    public static function parse_route($auto_route) {
        $lg = substr($auto_route,0,4);
        $avl_lg = self::avail_lang();
        if (in_array($lg,$avl_lg)) $auto_route = substr($auto_route,4);
        return $auto_route;
    }

    public static function auto_route($auto_route) {
        $spec_route = self::spec_route();
        $key = self::parse_route($auto_route);
        if (array_key_exists($key,$spec_route)) {
            Route::get($auto_route,$spec_route[$key]);
        }
        else {
            Route::get($auto_route,'AutoController\Controller@show');
        }
    }

    private static function spec_route() {
        return ['news'=>'News\NewsWithTimeLine\Controller@show',
                'banquet-ticket'=>'TicketInformation\BanquetTicket\Controller@show',
        ];
    }

    public static function add_routes()
    {
        Route::post('TicketInformation/BanquetTicket', 'TicketInformation\BanquetTicket\Controller@reserveSpot');
        Route::post('zh/TicketInformation/BanquetTicket', 'TicketInformation\BanquetTicket\Controller@reserveSpot');
        Route::post('de/TicketInformation/BanquetTicket', 'TicketInformation\BanquetTicket\Controller@reserveSpot');
        Route::post('es/TicketInformation/BanquetTicket', 'TicketInformation\BanquetTicket\Controller@reserveSpot');
        Route::post('ja/TicketInformation/BanquetTicket', 'TicketInformation\BanquetTicket\Controller@reserveSpot');
        Route::post('fr/TicketInformation/BanquetTicket', 'TicketInformation\BanquetTicket\Controller@reserveSpot');

        Route::get('News/NewsWithTimeLine', 'News\NewsWithTimeLine\Controller@show');
        Route::get('News/NewsWithTimeLine/{y}/{m}/{d}/{n}', 'News\NewsWithTimeLine\Controller@showOneNews');
        Route::get('News/NewsWithTimeLine/{y}/{m}/{d}', 'News\NewsWithTimeLine\Controller@showDayNews');
        Route::get('News/NewsWithTimeLine/{y}/{m}', 'News\NewsWithTimeLine\Controller@showAchieves');
        Route::get('News/NewsWithTimeLine/{s}', 'News\NewsWithTimeLine\Controller@search');

        Route::get('zh/News/NewsWithTimeLine', 'News\NewsWithTimeLine\Controller@show');
        Route::get('zh/News/NewsWithTimeLine/{y}/{m}/{d}/{n}', 'News\NewsWithTimeLine\Controller@showOneNews');
        Route::get('zh/News/NewsWithTimeLine/{y}/{m}/{d}', 'News\NewsWithTimeLine\Controller@showDayNews');
        Route::get('zh/News/NewsWithTimeLine/{y}/{m}', 'News\NewsWithTimeLine\Controller@showAchieves');
        Route::get('zh/News/NewsWithTimeLine/{s}', 'News\NewsWithTimeLine\Controller@search');

        Route::get('de/News/NewsWithTimeLine', 'News\NewsWithTimeLine\Controller@show');
        Route::get('de/News/NewsWithTimeLine/{y}/{m}/{d}/{n}', 'News\NewsWithTimeLine\Controller@showOneNews');
        Route::get('de/News/NewsWithTimeLine/{y}/{m}/{d}', 'News\NewsWithTimeLine\Controller@showDayNews');
        Route::get('de/News/NewsWithTimeLine/{y}/{m}', 'News\NewsWithTimeLine\Controller@showAchieves');
        Route::get('de/News/NewsWithTimeLine/{s}', 'News\NewsWithTimeLine\Controller@search');

        Route::get('es/News/NewsWithTimeLine', 'News\NewsWithTimeLine\Controller@show');
        Route::get('es/News/NewsWithTimeLine/{y}/{m}/{d}/{n}', 'News\NewsWithTimeLine\Controller@showOneNews');
        Route::get('es/News/NewsWithTimeLine/{y}/{m}/{d}', 'News\NewsWithTimeLine\Controller@showDayNews');
        Route::get('es/News/NewsWithTimeLine/{y}/{m}', 'News\NewsWithTimeLine\Controller@showAchieves');
        Route::get('es/News/NewsWithTimeLine/{s}', 'News\NewsWithTimeLine\Controller@search');

        Route::get('ja/News/NewsWithTimeLine', 'News\NewsWithTimeLine\Controller@show');
        Route::get('ja/News/NewsWithTimeLine/{y}/{m}/{d}/{n}', 'News\NewsWithTimeLine\Controller@showOneNews');
        Route::get('ja/News/NewsWithTimeLine/{y}/{m}/{d}', 'News\NewsWithTimeLine\Controller@showDayNews');
        Route::get('ja/News/NewsWithTimeLine/{y}/{m}', 'News\NewsWithTimeLine\Controller@showAchieves');
        Route::get('ja/News/NewsWithTimeLine/{s}', 'News\NewsWithTimeLine\Controller@search');

        Route::get('fr/News/NewsWithTimeLine', 'News\NewsWithTimeLine\Controller@show');
        Route::get('fr/News/NewsWithTimeLine/{y}/{m}/{d}/{n}', 'News\NewsWithTimeLine\Controller@showOneNews');
        Route::get('fr/News/NewsWithTimeLine/{y}/{m}/{d}', 'News\NewsWithTimeLine\Controller@showDayNews');
        Route::get('fr/News/NewsWithTimeLine/{y}/{m}', 'News\NewsWithTimeLine\Controller@showAchieves');
        Route::get('fr/News/NewsWithTimeLine/{s}', 'News\NewsWithTimeLine\Controller@search');
    }
}
