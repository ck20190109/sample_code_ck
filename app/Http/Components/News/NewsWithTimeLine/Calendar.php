<?php
namespace App\Http\Components\News\NewsWithTimeLine;

use App\Http\Helpers\RouteHelper;
use App\WriteLog;
use Exception;

class Calendar {
    
    public function render($m,$y,$data=array()) {

        $lg = RouteHelper::getLanguage();
        $lg = RouteHelper::getNewsLang($lg);

        $days = cal_days_in_month(CAL_GREGORIAN, $m, $y);
        $sd = (int)date('N',strtotime($y."/".$m."/1"))-1;
        $lm = $m-1; $lm = $lm==0 ? 12 : $lm;
        $nm = $m+1; $nm = $nm==13 ? 1 : $nm;
        $html = "";
        
        $html = $html ."<table id=\"wp-calendar\">";
        $html = $html ."<caption>". strtoupper(date("F", mktime(0, 0, 0, $m, 10))) ." ". $y ."</caption>";
        $html = $html ."<thead>";
        $html = $html ."<tr>";
        $html = $html ."<th scope=\"col\" title=\"Monday\">M</th>";
        $html = $html ."<th scope=\"col\" title=\"Tuesday\">T</th>";
        $html = $html ."<th scope=\"col\" title=\"Wednesday\">W</th>";
        $html = $html ."<th scope=\"col\" title=\"Thursday\">T</th>";
        $html = $html ."<th scope=\"col\" title=\"Friday\">F</th>";
        $html = $html ."<th scope=\"col\" title=\"Saturday\">S</th>";
        $html = $html ."<th scope=\"col\" title=\"Sunday\">S</th>";
        $html = $html ."</tr>";
        $html = $html ."</thead>";
        
        $html = $html ."<tfoot>";
        $html = $html ."<tr>";
        $html = $html ."<td colspan=\"3\" id=\"prev\"><a href=\"".url('/')."/".$lg."News/NewsWithTimeLine/".$y."/".sprintf("%02s",$lm)."/"."\">&laquo; ". strtoupper(date("M", mktime(0, 0, 0, $lm, 10))) ."</a></td>";
        $html = $html ."<td class=\"pad\">&nbsp;</td>";
        $html = $html ."<td colspan=\"3\" id=\"next\"><a href=\"".url('/')."/".$lg."News/NewsWithTimeLine/".$y."/".sprintf("%02s",$nm)."/"."\">". strtoupper(date("M", mktime(0, 0, 0, $nm, 10))) ." &raquo;</a></td>";
        $html = $html ."</tr>";
        $html = $html ."</tfoot>";
        
        $html = $html ."<tbody>";
        $html = $html ."<tr>";
        if ($sd>0)
            $html = $html ."<td colspan=\"".$sd."\" class=\"pad\">&nbsp;</td>";

        $j=$sd+1;
        for ($i=1; $i<=$days; $i++) {
            
            if (($j-1)%7==0)
                $html = $html ."<tr>";

            try {
                $html = $html . "<td>". (isset($data[$i]) ? "<a href=\"" . url('/') . "/".$lg."News/NewsWithTimeLine/" . $y . "/" . $m . "/" . $i . "/" . "\" aria-label=\"Posts published on " . date("F", mktime(0, 0, 0, $m, 10)) . " " . $i . ", " . $y . "\">" . $i . "</a>" : $i) ."</td>";
            }
            catch (Exception $e) {
                $html = $html . "<td>". $i ."</td>";
            }

            if ($j%7==0)
                $html = $html ."</tr>";
                    
            $j++;
        }
        
        $ed = 7-($j-1)%7;
        if ($ed>0 && $ed<7)
            $html = $html ."<td colspan=\"".$ed."\" class=\"pad\">&nbsp;</td>";
                
        $html = $html ."</tbody>";
        $html = $html ."</table>";
        
        return $html;
    }
}
