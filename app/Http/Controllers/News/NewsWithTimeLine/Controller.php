<?php 
namespace App\Http\Controllers\News\NewsWithTimeLine;

use App\Http\Controllers\PageController;
use App\Http\Processors\News\NewsWithTimeLine\Processor;
use App\WriteLog;
use Illuminate\Http\Request;

class Controller extends PageController
{
    /*
    |--------------------------------------------------------------------------
    | News With Time Line Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling News With Time Line
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $r)
    {
        parent::__construct($r);

        $this->p = "News/NewsWithTimeLine/view";

        $this->processor = new Processor($this->r);
    }

    public function show()
    {
        $data = $this->processor->buildDataForAllNews();

        echo view($this->p, $data);
    }

    public function showOneNews($y,$m,$d,$n)
    {
        $params = array($y,$m,$d,$n);

        $data = $this->processor->buildDataForOneNews($params);

        echo view('News/NewsWithTimeLine/news',$data);
    }

    public function showDayNews($y,$m,$d)
    {
        $params = array($y,$m,$d);

        $data = $this->processor->buildDataForDayNews($params);

        echo view('News/NewsWithTimeLine/day_news',$data);
    }

    public function showAchieves($y,$m)
    {
        $params = array($y,$m);

        $data = $this->processor->buildDataForAchieves($params);
        
        echo view('News/NewsWithTimeLine/achieves',$data);
    }

    public function search($params)
    {
        $params = $this->r->query("s");
        $vals = $this->r->all();
        if (isset($vals['s']))
            $params = (!isset($params)) ? $vals['s'] : $params;
        else
            $params = (!isset($params)) ? "" : $params;

        $data = $this->processor->buildDataForSearch($params);

        echo view('News/NewsWithTimeLine/search',$data);
    }
}
