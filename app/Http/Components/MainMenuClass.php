<?php
namespace App\Http\Components;

use App\Http\Helpers\RouteHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\WriteLog;

class MainMenuClass
{
    public function render() {

        $menu = "";

        $_top = $this->buildTopMenuData();

        for ($i=0;$i<count($_top);$i++) {

            $_2nd = $this->buildSubMenuData($_top[$i]->ID);

            if (0<count($_2nd))
                $menu = $menu. '<li id="menu-item-'.$_top[$i]->ID.'" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-'.$_top[$i]->ID.'">';
            else
                $menu = $menu. '<li id="menu-item-'.$_top[$i]->ID.'" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-'.$_top[$i]->ID.'">';

            $url = $_top[$i]->post_content_filtered=='link'? trim($_top[$i]->post_content) : ($_top[$i]->post_type=='page'?url('/').'/'.$_top[$i]->post_name.'/':'#');
            $menu = $menu. '<a href="'.$url.'"><span>'.$_top[$i]->post_title.'</span></a>';

            if (0<count($_2nd)) {

                $menu = $menu. '<ul class="sub-menu">';

                for ($j=0;$j<count($_2nd);$j++) {

                    $_3nd = $this->buildSubMenuData($_2nd[$j]->ID);

                    if (0<count($_3nd))
                        $menu = $menu. '<li id="menu-item-'.$_2nd[$j]->ID.'" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-'.$_2nd[$j]->ID.'">';
                    else
                        $menu = $menu. '<li id="menu-item-'.$_2nd[$j]->ID.'" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-'.$_2nd[$j]->ID.'">';

                    $url = $_2nd[$j]->post_content_filtered=='link'? trim($_2nd[$j]->post_content) : ($_2nd[$j]->post_type=='page'?url('/').'/'.$_2nd[$j]->post_name.'/':'#');
                    $menu = $menu. '<a href="'.$url.'"><span>'.$_2nd[$j]->post_title.'</span></a>';

                    if (0<count($_3nd)) {

                        $menu = $menu. '<ul class="sub-menu">';

                        for ($k = 0;$k<count($_3nd);$k++) {
                            $menu = $menu. '<li id="menu-item-'.$_3nd[$k]->ID.'" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-'.$_3nd[$k]->ID.'">';
                            $url = $_3nd[$k]->post_content_filtered=='link'? trim($_3nd[$k]->post_content) : ($_3nd[$k]->post_type=='page'?url('/').'/'.$_3nd[$k]->post_name.'/':'#');
                            $menu = $menu. '<a href="'.$url.'"><span>'.$_3nd[$k]->post_title.'</span></a>';
                            $menu = $menu. '</li>';
                        }
                        $menu = $menu. '</ul>';
                    }
                    $menu = $menu. '</li>';
                }
                $menu = $menu. '</ul>';
            }
            $menu = $menu. '</li>';
        }

        return $menu;
    }

    public function buildTopMenuData() {
        $data = null;

        $lg = RouteHelper::getLanguage();

        // SELECT * FROM wwc2017_team_football_1001_posts WHERE post_status='publish' AND post_type LIKE '%menu%' AND post_title<>'' AND post_content_filtered='menu'
        $data = DB::select("SELECT * FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_status='publish' AND post_parent=0 AND (post_type='page' OR post_type='nav_menu_item') AND ((post_content_filtered<>'home_page' AND post_content_filtered<>'404') OR post_content_filtered IS NULL) ".(($lg==false||$lg=="")?"AND SUBSTR(post_name,3,2)<>'~~' ":"AND SUBSTR(post_name,1,4)='".$lg."' ")."ORDER BY menu_order");

        return $data;
    }

    public function buildSubMenuData($params) {
        $data = null;

        // select * from wwc2017_team_football_1001_posts where post_status='publish' and post_type='page' and post_author=1 and post_parent in(2847,2849,2851,2853,2855,2857,2859,2861,0) order by post_parent, menu_order
        $data = DB::select("SELECT * FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_status='publish' AND post_parent=".$params." ORDER BY post_parent, menu_order");

        return $data;
    }

    public function buildAllMenuData() {

        $_top = $this->buildTopMenuData();
        $_sub = $this->buildAllSubMenuData();

        return array_merge($_top,$_sub);
    }

    public function buildAllSubMenuData() {
        $data = null;

        $lg = RouteHelper::getLanguage();

        // select * from wwc2017_team_football_1001_posts where post_status='publish' and post_type='page' and post_author=1 and post_parent in(2847,2849,2851,2853,2855,2857,2859,2861,0) order by post_parent, menu_order
        $data = DB::select("SELECT * FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_status='publish' AND (post_type='page' OR post_type='nav_menu_item') AND (post_content_filtered='home_page' OR post_content_filtered='404' OR (post_parent<>0 ".($lg==false||$lg==""?"AND SUBSTR(post_name,3,2)<>'~~')) ":"AND SUBSTR(post_name,1,4)='".$lg."')) ")."ORDER BY post_parent, menu_order");

        return $data;
    }

    public function route() {

        Route::get('/', 'AutoController\Controller@show');

        $menus = $this->buildAllMenuData();
        for ($i=0;$i<count($menus);$i++) {
            $auto_route = $menus[$i]->post_name;
            RouteHelper::auto_route($auto_route);
        }

        RouteHelper::add_routes();
    }
}