<?php
namespace App\Http\Processors;

use App\Http\Processors\Processor;
use Illuminate\Support\Facades\DB;
use App\Http\Components\MainMenuClass;
use App\WriteLog;

class MetaProcessor extends Processor
{
    protected function buildTitleData($__post_name) {
        $data = null;

        // SELECT distinct * FROM wwc2017.team_football_1001_postmeta as pm INNER JOIN wwc2017.team_football_1001_posts as p ON (pm.post_id=p.id AND p.post_status='publish' and p.post_type='page') where meta_key='_aioseop_title' and post_title='News'
        $data = DB::select("SELECT DISTINCT pm.meta_key,pm.meta_value FROM ".config('database.connections.mysql.prefix')."team_football_1001_postmeta AS pm INNER JOIN ".config('database.connections.mysql.prefix')."team_football_1001_posts AS p ON (pm.post_id=p.id) WHERE pm.meta_key='_aioseop_title' AND p.post_status='publish' AND p.post_type='page' AND p.post_name='".$__post_name."'");

        return $data;
    }

    protected function buildDescriptionData($__post_name) {
        $data = null;

        // SELECT distinct * FROM wwc2017.team_football_1001_postmeta as pm INNER JOIN wwc2017.team_football_1001_posts as p ON (pm.post_id=p.id AND p.post_status='publish' and p.post_type='page') where meta_key='_aioseop_description' and post_title='News'
        $data = DB::select("SELECT DISTINCT pm.meta_key,pm.meta_value FROM ".config('database.connections.mysql.prefix')."team_football_1001_postmeta AS pm INNER JOIN ".config('database.connections.mysql.prefix')."team_football_1001_posts AS p ON (pm.post_id=p.id) WHERE pm.meta_key='_aioseop_description' AND p.post_status='publish' AND p.post_type='page' AND p.post_name='".$__post_name."'");

        return $data;
    }

    protected function buildKeywordsData($__post_name) {
        $data = null;

        // SELECT distinct * FROM wwc2017.team_football_1001_postmeta as pm INNER JOIN wwc2017.team_football_1001_posts as p ON (pm.post_id=p.id AND p.post_status='publish' and p.post_type='page') where meta_key='_aioseop_keywords' and post_title='News'
        $data = DB::select("SELECT DISTINCT pm.meta_key,pm.meta_value FROM ".config('database.connections.mysql.prefix')."team_football_1001_postmeta AS pm INNER JOIN ".config('database.connections.mysql.prefix')."team_football_1001_posts AS p ON (pm.post_id=p.id) WHERE pm.meta_key='_aioseop_keywords' AND p.post_status='publish' AND p.post_type='page' AND p.post_name='".$__post_name."'");

        return $data;
    }

    protected function buildPostData($__post_name) {
        $data = null;

        $__post_name = addslashes($__post_name);
        // SELECT distinct post_title,post_name FROM wwc2017_team_football_1001_posts WHERE post_status='publish' and post_type='page' and post_name='news'
        $data = DB::select("SELECT ID,post_title,post_name,post_type,post_content_filtered FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_name='".$__post_name."' AND post_status='publish' AND (post_type='page' OR post_type='post' OR post_type='nav_menu_item')");

        return $data;
    }

    public function buildTopMenu() {
        $data = null;

        $mn = new MainMenuClass();
        $data = $mn->buildTopMenuData();

        return $data;
    }

    public function buildMainMenu() {
        $data = null;

        $mn = new MainMenuClass();
        $data = $mn->render();

        return $data;
    }

    public function buildOptionsData($__option_name) {
        $data = null;

        // SELECT * FROM wwc2017.wwc2017_team_football_1001_options where option_name='theme_mods_team'
        $data = DB::select("SELECT option_value FROM ".config('database.connections.mysql.prefix')."team_football_1001_options WHERE option_name='".$__option_name."'");
        $data = unserialize($data[0]->option_value);

        return $data;
    }

    public function buildSponsorsData($__option_name) {
        $data = null;

        // SELECT * FROM wwc2017.wwc2017_team_football_1001_options where option_name='theme_mods_team'
        $data = DB::select("SELECT option_value FROM ".config('database.connections.mysql.prefix')."team_football_1001_options WHERE option_name='".$__option_name."'");
        $data = explode("\r\n",$data[0]->option_value);

        return $data;
    }

    public function buildLocalizationData() {
        $data = null;

        // SELECT * FROM wwc2017.wwc2017_team_football_1001_posts WHERE post_status='publish' AND post_type='page' AND post_author='25'
        $data = DB::select("SELECT post_title,post_name FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_status='publish' AND post_type='page' AND post_content_filtered='home_page'");

        return $data;
    }
}
