<?php 
namespace App\Http\Processors\AutoProcessor;

use App\Http\Processors\PageProcessor;
use App\WriteLog;
use Illuminate\Http\Request;

class Processor extends PageProcessor
{
    public function __construct(Request $r) {

        $auto_route = url()->current();

        $auto_route =substr($auto_route,strlen(url('/').'/'));

        $auto_route = $auto_route==""? 'home': $auto_route;

        $this->_POST_NAME = $auto_route;

        parent::__construct($r);
    }
}
