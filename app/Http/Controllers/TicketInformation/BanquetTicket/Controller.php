<?php
namespace App\Http\Controllers\TicketInformation\BanquetTicket;

use App\Http\Controllers\PageController;
use App\Http\Processors\TicketInformation\BanquetTicket\Processor;
use Illuminate\Http\Request;

class Controller extends PageController
{
    /*
    |--------------------------------------------------------------------------
    | Banquet Ticket Reserve Spot Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling Banquet Ticket Reserve Spot 
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

        $this->p = "TicketInformation/BanquetTicket/view";

        $this->processor = new Processor($this->r);
    }

    /**
     * @param Request $request
     */
    public function reserveSpot()
    {
        $this->validate($this->r, [
            'captcha' => 'required|captcha'
        ]);

        $response = $this->processor->reserveSpot();

        echo $response;
    }
}
