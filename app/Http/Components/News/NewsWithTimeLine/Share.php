<?php
namespace App\Http\Components\News\NewsWithTimeLine;

use App\WriteLog;

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
