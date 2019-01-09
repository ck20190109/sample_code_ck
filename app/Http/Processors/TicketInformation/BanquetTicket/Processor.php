<?php 
namespace App\Http\Processors\TicketInformation\BanquetTicket;

use App\Http\Processors\PageProcessor;
use App\Http\Controllers\Client;
use Exception;
use App\WriteLog;
use Illuminate\Http\Request;

class Processor extends PageProcessor
{
    const _POST_NAME = 'banquet-ticket';

    public function __construct(Request $r) {

        $this->_POST_NAME = self::_POST_NAME;

        parent::__construct($r);
    }

    public function reserveSpot() {
        $data = null;

        try {
            $client = new Client(config('app.RESTful.service-location').'TicketInformation/BanquetTicket');

            $data = $client->execute($this->r->all());
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());

            $data = array('error',$e->getMessage());
            $data = json_encode($data);
        }

        return $data;
    }
}
