<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Gallery Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling Gallery
    |
    */

    protected $r = null;
    protected $p = "";

    protected $processor = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $r)
    {
        $this->middleware('guest');

        $this->r = $r;
    }
    
    public function show()
    {
        $data = $this->processor->buildData();

        echo view($this->p, $data);
    }
}
