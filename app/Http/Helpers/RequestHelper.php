<?php
namespace App\Http\Helpers;

use App\Exceptions\Helpers\RequestAndVOCountDifferentException;
use App\Exceptions\Helpers\RequestItemNotExistsException;
use App\WriteLog;

class RequestHelper
{
    /*
     |--------------------------------------------------------------------------
     | Helper
     |--------------------------------------------------------------------------
     |
     | This Helper is responsible for handling get VO From Request.
     |
     */
    
    protected $request = null;
    protected $fromNames = null;
    protected $toNames = null;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($request,$fromNames,$toNames)
    {
        $this->request      = $request;
        $this->fromNames    = $fromNames;
        $this->toNames      = $toNames;
    }
    
    public function getVOFromRequest()
    {
        $VO = array();
        
        $r_count = count($this->fromNames);
        $f_count = count($this->toNames);
        
        if ($r_count != $f_count)
            throw new RequestAndVOCountDifferentException(__('lang._EX_COUNT_REQ_FORM',['r_count'=>$r_count,'f_count'=>$f_count]));
            
        for($i=0; $i<$r_count; $i++) {
            
            $r_name = $this->fromNames[$i];
            
            if (!$this->request->exists($r_name))
                throw new RequestItemNotExistsException(__('lang._EX_NO_REQ_INPUT',['r_name'=>$r_name]));
                
                $VO[$this->toNames[$i]] = $this->request->input($r_name);
        }
        
        return $VO;
    }
}
