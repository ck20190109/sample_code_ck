<?php
class AchieveCalendar {
    
    public function render($m,$y,$data=null) {
        
        $days = cal_days_in_month(CAL_GREGORIAN, $m, $y);
        $sd = (int)date('N',strtotime($y."/".$m."/1"))-1;
        $lm = $m-1; $lm = $lm==0 ? 12 : $lm;
        $nm = $m+1; $nm = $nm==13 ? 1 : $nm;
        $html = "";
        
        $html = $html ."<table id=\"wp-calendar\">";
        $html = $html ."<caption>". date("F", mktime(0, 0, 0, $m, 10)) ." ". $y ."</caption>";
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
        $html = $html ."<td colspan=\"3\" id=\"prev\"><a href=\"".url('/')."/".$y."/".sprintf("%02s",$lm)."/"."\">&laquo; ". date("F", mktime(0, 0, 0, $lm, 10)) ."</a></td>";
        $html = $html ."<td class=\"pad\">&nbsp;</td>";
        $html = $html ."<td colspan=\"3\" id=\"next\"><a href=\"".url('/')."/".$y."/".sprintf("%02s",$nm)."/"."\">". date("F", mktime(0, 0, 0, $nm, 10)) ." &raquo;</a></td>";
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
                
            $html = $html ."<td>".$i."</td>";
            
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

class Share {
    public function render($d,$n,$t) {
        $html = "";
        $html = $html ."<!-- Digg -->";
        
        $html = $html ."<li class=\"digg\"><a href=\"http://www.digg.com/submit?url=".url('/').'/'.$d.'/'.$n."/\" target=\"_blank\">";
        $html = $html ."<i class=\"fa fa-digg\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        
        $html = $html ."<!-- Facebook -->";
        
        $html = $html ."<li class=\"facebook\"><a href=\"http://www.facebook.com/sharer.php?u=".url('/').'/'.$d.'/'.$n."/\" target=\"_blank\">";
        $html = $html ."<i class=\"fa fa-facebook-square\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        
        $html = $html ."<!-- Google+ -->";
        
        $html = $html ."<li class=\"google\"><a href=\"https://plus.google.com/share?url=".url('/').'/'.$d.'/'.$n."/\" target=\"_blank\">";
        $html = $html ."<i class=\"fa fa-google-plus-square\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        
        $html = $html ."<!-- LinkedIn -->";
        
        $html = $html ."<li class=\"linkedin\"><a href=\"http://www.linkedin.com/shareArticle?mini=true&amp;url=".url('/').'/'.$d.'/'.$n."/\" target=\"_blank\">";
        $html = $html ."<i class=\"fa fa-linkedin-square\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        
        $html = $html ."<!-- Pinterest -->";
        
        $html = $html ."<li class=\"pinterest\"><a href=\"javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());\">";
        $html = $html ."<i class=\"fa fa-pinterest-square\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        
        $html = $html ."<!-- Reddit -->";
        
        $html = $html ."<li class=\"reddit\"><a href=\"http://reddit.com/submit?url=".url('/').'/'.$d.'/'.$n."/&amp;title=".$t."\" target=\"_blank\">";
        $html = $html ."<i class=\"fa fa-reddit-square\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        
        $html = $html ."<!-- StumbleUpon-->";
        
        $html = $html ."<li class=\"StumbleUpon\"><a href=\"http://www.stumbleupon.com/submit?url=".url('/').'/'.$d.'/'.$n."/&amp;title=".$t."\" target=\"_blank\">";
        $html = $html ."<i class=\"fa fa-stumbleupon-circle\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        
        $html = $html ."<!-- Tumblr-->";
        
        $html = $html ."<li class=\"tumbler\"><a href=\".'http://www.tumblr.com/share/link?url=".url('/').'/'.$d.'/'.$n."/&amp;title=".$t."\" target=\"_blank\">";
        $html = $html ."<i class=\"fa fa-tumblr-square\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        
        $html = $html ."<!-- Twitter -->";
        
        $html = $html ."<li class=\"twitter\"><a href=\"https://twitter.com/share?url=".url('/').'/'.$d.'/'.$n."/&amp;title=".$t."\" target=\"_blank\">";
        $html = $html ."<i class=\"fa fa-twitter-square\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        
        $html = $html ."<!-- VK -->";
        
        $html = $html ."<li class=\"vk\"><a href=\"http://vkontakte.ru/share.php?url=".url('/').'/'.$d.'/'.$n."/\" target=\"_blank\">";
        $html = $html ."<i class=\"fa fa-vk\" aria-hidden=\"true\"></i>";
        $html = $html ."</a></li>";
        
        return $html;
    }
}
