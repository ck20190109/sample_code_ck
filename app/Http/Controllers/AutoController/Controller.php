<?php 
namespace App\Http\Controllers\AutoController;

use App\Http\Controllers\PageController;
use App\Http\Processors\AutoProcessor\Processor;
use App\Http\Helpers\RequestHelper;
use Illuminate\Http\Request;
use App\WriteLog;

class Controller extends PageController
{
    /*
    |--------------------------------------------------------------------------
    | Gallery Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling Gallery
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

        $this->p = "AutoPage/view";

        $this->processor = new Processor($this->r);
    }
}
