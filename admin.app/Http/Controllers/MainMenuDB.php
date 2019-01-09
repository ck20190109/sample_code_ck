<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\WriteLog;

class MainMenuDB
{
    public function buildIN($mn) {
        $in="";
        for ($i=0;$i<count($mn);$i++) {
            if ($i>0) $in = $in. ',';
            $in = $in. $mn[$i]->ID;
        }
        return $in;
    }

    public function buildAllMenuData() {

        $_top = $this->buildTopMenuData();

        $_2nd = array();
        $in = $this->buildIN($_top);
        if($in != "")
            $_2nd = $this->buildSubMenuData($in);

        $_3rd = array();
        $in = $this->buildIN($_2nd);
        if($in != "")
            $_3rd = $this->buildSubMenuData($in);

        return array_merge($_top,$_2nd,$_3rd) ;
    }

    public function buildTopMenuData() {
        $data = null;

        $lg = self::getLanguage();
        // SELECT * FROM wwc2017_team_football_1001_posts WHERE post_status='publish' AND post_type LIKE '%menu%' AND post_title<>'' AND post_content_filtered='menu'
        $data = DB::select("SELECT *,'Top Menu' as parent_title FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_status='publish' AND (post_type='nav_menu_item' OR post_type='page') AND post_parent=0 AND ((post_content_filtered<>'home_page' AND post_content_filtered<>'404') OR post_content_filtered IS NULL) ".(($lg==false||$lg=="")?"AND SUBSTR(post_name,3,2)<>'~~' ":"AND SUBSTR(post_name,1,4)='".$lg."' ")."ORDER BY menu_order");

        return $data;
    }

    public function buildSubMenuData($params) {
        $data = null;

        // select * from wwc2017_team_football_1001_posts where post_status='publish' and post_type='page' and post_author=1 and post_parent in(2847,2849,2851,2853,2855,2857,2859,2861,0) order by post_parent, menu_order
        $data = DB::select("SELECT pg.*,mn.post_title AS parent_title FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts AS pg LEFT JOIN ".config('database.connections.mysql.prefix')."team_football_1001_posts AS mn ON(pg.post_parent=mn.ID) WHERE pg.post_status='publish' AND (pg.post_type='page' OR pg.post_type='nav_menu_item') AND pg.post_parent IN(".$params.") ORDER BY pg.post_parent, pg.menu_order");

        return $data;
    }

    public static function getLanguage() {
        return session('LANGUAGE');
    }
}