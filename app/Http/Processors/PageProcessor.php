<?php 
namespace App\Http\Processors;

use App\Http\Helpers\RouteHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Processors\MetaProcessor;
use Exception;
use App\WriteLog;
use App\Http\Helpers\DateHelper;
use Illuminate\Http\Request;

class PageProcessor extends MetaProcessor
{
    protected $data = array();

    protected $_POST_NAME = '';

    protected $r = null;

    public function __construct(Request $r) {
        try {
            $this->r = $r;

            $this->data['news_title'] = $this->buildTitleData($this->_POST_NAME);
            $this->data['news_description'] = $this->buildDescriptionData($this->_POST_NAME);
            $this->data['news_keywords'] = $this->buildKeywordsData($this->_POST_NAME);
            $this->data['news_post'] = $this->buildPostData($this->_POST_NAME);

            if (count($this->data['news_title'])==0) {
                $this->data['news_title'] = array();
                $this->data['news_title'][0] = new \stdClass();
                $this->data['news_title'][0]->meta_value = strtoupper($this->_POST_NAME);
            }
            if (count($this->data['news_description'])==0) {
                $this->data['news_description'] = array();
                $this->data['news_description'][0] = new \stdClass();
                $this->data['news_description'][0]->meta_value = $this->_POST_NAME;
            }
            if (count($this->data['news_keywords'])==0) {
                $this->data['news_keywords'] = array();
                $this->data['news_keywords'][0] = new \stdClass();
                $this->data['news_keywords'][0]->meta_value = $this->_POST_NAME;
            }
            if (count($this->data['news_post'])==0) {
                $this->data['news_post'] = array();
                $this->data['news_post'][0] = new \stdClass();
                $this->data['news_post'][0]->post_name = $this->_POST_NAME;
                $this->data['news_post'][0]->post_title = $this->_POST_NAME;
                $this->data['news_post'][0]->ID = 0;
                $this->data['news_post'][0]->post_content_filtered=$this->_POST_NAME;
            }

            $this->data['news_options'] = $this->buildOptionsData('theme_mods_team');
            $this->data['news_sponsors'] = $this->buildSponsorsData('sponsor_logos_for_nav');
            $this->data['news_languages'] = $this->buildLocalizationData();
            $this->data['news_languages'][0]->post_title = 'English';
            $this->data['news_languages'][0]->post_name = 'home';

            $this->data['s'] = $this->r->query('s');

            $lg = RouteHelper::getLanguage();
            $this->data['news_lang'] = RouteHelper::getNewsLang($lg);
            $this->data['country'] = RouteHelper::getLocation($lg);
            $this->data['lang'] = $lg;

            if ($this->data['news_post'][0]->post_content_filtered=='home_page')
                $this->data['body_style'] = 'home';
            else if ($this->data['news_post'][0]->post_content_filtered=='404')
                $this->data['body_style'] = '404';
            else
                $this->data['body_style'] = 'general';

            $this->data['main_menu'] = $this->buildMainMenu();
            $this->data['top_menu'] = $this->buildTopMenu();

            $lg = $lg==false ? "":$lg;
            $this->data['News'] = DB::table('team_football_1001_posts')->select()->where([['post_type','=','post'],['post_status','=','publish']])
                                                                                       ->where(function($qr) use($lg) {
                                                                                           $qr->where(function($q) use($lg) {
                                                                                                    $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,3,2)'),'<>','~~');
                                                                                                })
                                                                                              ->orWhere(function($q) use($lg) {
                                                                                                    $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                                                                                                });
                                                                                       })
                                                                                       ->orderBy('post_date','desc')->limit(3)->get();
            for($i=0;$i<count($this->data['News']);$i++) {
                $this->data['News'][$i]->date_route = DateHelper::transDateToRoute($this->data['News'][$i]->post_date);
                $this->data['News'][$i]->format_date = DateHelper::transDateFormat($this->data['News'][$i]->post_date);
            }
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());
        }
    }

    public function buildData() {

        try {
            $this->data['data_list'] = DB::select("SELECT DISTINCT * FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_name='".$this->_POST_NAME."' AND post_status='publish' AND (post_type='page' OR post_type='post')");

            if (count($this->data['data_list'])==0) {
                $lg = RouteHelper::getLanguage();
                $lg = RouteHelper::getLocation($lg);
                $lg = $lg=='' ?  'home' : $lg;
                $this->data['data_list'] = DB::select("SELECT DISTINCT * FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_name='".$lg."' AND post_status='publish' AND (post_type='page' OR post_type='post')");
            }
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());
        }

        return $this->data;
    }
}
