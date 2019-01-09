<?php 
namespace App\Http\Processors\News\NewsWithTimeLine;

use App\Http\Helpers\RouteHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Processors\MetaProcessor;
use Exception;
use App\WriteLog;
use App\Http\Helpers\DateHelper;
use App\Http\Components\News\NewsWithTimeLine\Calendar;
use App\Http\Components\News\NewsWithTimeLine\Share;
use Illuminate\Http\Request;

class Processor extends MetaProcessor
{
    protected $data = array();

    private $__pagesize = 10;

    const _MAX_TIMELINE = 12;

    protected $r = null;

    public function __construct(Request $r) {
        try {
            $this->r = $r;

            $__post_name = 'news';
            $this->data['news_description'] = $this->buildDescriptionData($__post_name);
            $this->data['news_keywords'] = $this->buildKeywordsData($__post_name);

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

            $this->data['main_menu'] = $this->buildMainMenu();
            $this->data['top_menu'] = $this->buildTopMenu();
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());
        }
    }

    private function getImg($id,$poat_name) {
        $f_img = null;
        switch ($id) {
            case 7061:  $f_img = '20170726_143716-01.jpeg-1024x576.jpg';    break;
            case 6797:  $f_img = '2017-07-gala-128-1024x680-1-1024x680.jpg';    break;
            case 5551:  $f_img = 'homepage_header2-1024x460.jpg';    break;
            case 5121:  $f_img = 'banquet_bg-1024x272.jpg';  break;
            case 2228:  $f_img = 'pop_10_07_17-1024x576.jpg';    break;
            case 3695:  $f_img = 'ITTF-0624-346-1024x578.jpg';   break;
            case 4157:  $f_img = 'revenuegeneration.jpg';    break;
            case 4173:  $f_img = '22.jpg';   break;
            default: $f_img = $poat_name.'.jpg';   break;
        }
        return $f_img;
    }

    protected function buildImgMeta($__like) {

        if ($__like=='') return array();

        // SELECT * FROM wwc2017_team_football_1001_postmeta where meta_value LIKE '%\"banquet_bg-1024x272%' AND meta_key='_wp_attachment_metadata'
        $data = DB::select("SELECT DISTINCT meta_value FROM ".config('database.connections.mysql.prefix')."team_football_1001_postmeta WHERE meta_value LIKE '%\\\"".$__like."%' AND meta_key='_wp_attachment_metadata'");

        try {
            $data = unserialize($data[0]->meta_value);
        }
        catch (Exception $e) {
            $data = array();
        }

        return $data;
    }

    private function getPage() {
        $__page = (int)$this->r->query('page');
        $vals = $this->r->all();
        if (isset($vals['page']))
            $__page = $__page==0 ? (int)$vals['page'] : $__page;
        else
            $__page = $__page==0 ? 1 : $__page;

        $this->data['page'] = $__page;

        return $__page;
    }

    public function buildData($params=null) {
        try {
            $__post_name = 'news';
            $this->data['news_title'] = $this->buildTitleData($__post_name);
            $this->data['news_post'] = $this->buildPostData($__post_name);

            $this->data['TimeLine'] = $this->buildTimeLine();
            for($i=0;$i<count($this->data['TimeLine']);$i++) {
                $this->data['TimeLine'][$i]->format_month = DateHelper::transMonthFormat($this->data['TimeLine'][$i]->post_date,'M');
            }
            $this->data['News'] = $this->buildNews();
            if ($params==null) {
                $m = (int)date('n');
                $y = (int)date('Y');
            }
            else {
                $m = (int)$params[1];
                $y = (int)$params[0];
            }
            $clndr = new Calendar();
            $data = array();
            for($i=0;$i<count($this->data['News']);$i++) {
                $this->data['News'][$i]->date_route = DateHelper::transDateToRoute($this->data['News'][$i]->post_date);
                $this->data['News'][$i]->format_date = DateHelper::transDateFormat($this->data['News'][$i]->post_date);

                $a_dt = explode('-',substr($this->data['News'][$i]->post_date,0,10));
                if ($y == (int)$a_dt[0] && $m == (int)$a_dt[1]) {
                    $dt = (int)($a_dt[2]);
                    $data[$dt] = true;
                }

                $lg = RouteHelper::getLanguage();
                $img_post_name = $lg==false||$lg==""?$this->data['News'][$i]->post_name:substr($this->data['News'][$i]->post_name,4);
                $f_img = $this->getImg($this->data['News'][$i]->ID,$img_post_name);

                $img = $this->buildImgMeta($f_img);
                if (count($img)>0) {
                    $this->data['News'][$i]->img = substr($img['file'],0,8).$img['sizes']['large']['file'];
                    $this->data['News'][$i]->m_img = substr($img['file'],0,8).$img['sizes']['medium']['file'];
                }
                else {
                    $s = substr($this->data['News'][$i]->post_modified,0,8);
                    $s = str_replace('-','/',$s);
                    $this->data['News'][$i]->img = $s .$f_img;
                    switch ($this->data['News'][$i]->ID) {
                        case 4157:  $f_img = 'revenuegeneration-300x160.jpg';    break;
                        case 4173:  $f_img = '22-300x169.jpg';   break;
                        default: $f_img = $img_post_name.'-300.jpg';   break;
                    }
                    $this->data['News'][$i]->m_img = $s .$f_img;
                }
            }

            $this->data['News_Achieves'] = $clndr->render($m,$y,$data);
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());
        }

        return $this->data;
     }

    protected function buildNews() {
        $data = null;

        $lg = RouteHelper::getLanguage();
        $lg = $lg==false ? "":$lg;
        // SELECT * FROM wwc2017.wwc2017_team_football_1001_posts WHERE post_type='post' AND post_status='publish' ORDER BY post_date desc
        $data = DB::table('team_football_1001_posts')->select()->where([['post_type','=','post'],['post_status','=','publish']])
                                                                   ->where(function($qr) use($lg) {
                                                                       $qr->where(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,3,2)'),'<>','~~');
                                                                           })
                                                                          ->orWhere(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                                                                           });
                                                                   })
                                                                   ->orderBy('post_date','desc')->get();
        return $data;
    }

    protected function buildTimeLine() {
        $data = null;

        $lg = RouteHelper::getLanguage();
        $lg = $lg==false ? "":$lg;
        // SELECT * FROM wwc2017.wwc2017_team_football_1001_posts WHERE post_type='timeline_post' ORDER BY post_date desc
        $data = DB::table('team_football_1001_posts')->select()->where([['post_type','=','timeline_post'],['post_status','=','publish']])
                                                                   ->where(function($qr) use($lg) {
                                                                           $qr->where(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,3,2)'),'<>','~~');
                                                                           })
                                                                           ->orWhere(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                                                                           });
                                                                   })
                                                                   ->orderBy('post_date','desc')->limit(self::_MAX_TIMELINE)->get();
        return $data;
    }

    private function setImgInfo($news) {

        $news->date_route = DateHelper::transDateToRoute($news->post_date);
        $news->format_date = DateHelper::transDateFormat($news->post_date);

        if ($news->post_type!='post')
            $news->img = "";
        else {
            $lg = RouteHelper::getLanguage();
            $img_post_name = $lg==false||$lg==""?$news->post_name:substr($news->post_name,4);
            $f_img = $this->getImg($news->ID,$img_post_name);

            $img = $this->buildImgMeta($f_img);
            if (count($img)>0) {
                $news->img = substr($img['file'],0,8).$img['sizes']['large']['file'];
            }
            else {
                $s = substr($news->post_modified,0,8);
                $s = str_replace('-','/',$s);
                $news->img = $s .$f_img;
            }
        }
    }

    public function buildDataForAllNews() {
        try {
            $this->buildData();

            $this->data['body_style'] = 'news';

            $this->data['AllNews'] = $this->buildAllNews();

            for($i=0;$i<count($this->data['AllNews']);$i++) {
                $this->setImgInfo($this->data['AllNews'][$i]);
            }
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());
        }

        return $this->data;
    }

    protected function buildAllNews() {
        $data = null;

        $lg = RouteHelper::getLanguage();
        $lg = $lg==false ? "":$lg;
        // SELECT * FROM wwc2017.wwc2017_team_football_1001_posts WHERE post_type='post' AND post_status='publish' ORDER BY post_date desc
        $data = DB::table('team_football_1001_posts')->select()->where([['post_type','=','post'],['post_status','=','publish']])
                                                                   ->where(function($qr) use($lg) {
                                                                           $qr->where(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,3,2)'),'<>','~~');
                                                                           })
                                                                           ->orWhere(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                                                                           });
                                                                   })
                                                                   ->orderBy('post_date','desc')
                                                                   ->paginate($this->__pagesize,array('*'),'page',$this->getPage());
        return $data;
    }

    public function buildDataForOneNews($params) {
        try {
            $this->buildData($params);

            $this->data['body_style'] = '1 news';

            $this->data['news_post'] = $this->buildPostData($params[3]);

            $this->data['news_title'] = array();
            $this->data['news_title'][0] = new \stdClass();
            $this->data['news_title'][0]->meta_value = $this->data['news_post'][0]->post_title;

            $this->data['OneNews'] = $this->buildOneNews($params[3]);

            $this->setImgInfo($this->data['OneNews'][0]);

            $this->data['Share'] = $this->buildShare($params[0].'/'.sprintf("%02s",$params[1]).'/'.sprintf("%02s",$params[2]),$params[3],htmlentities($this->data['news_title'][0]->meta_value));
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());
        }

        return $this->data;
    }

    protected function buildOneNews($post_name) {
        $data = null;

        // 2017/07/21/the-upcoming-signing-ceremony-2017-wwc-official-website-publish/
        // SELECT * FROM wwc2017.wwc2017_team_football_1001_posts WHERE post_name='the-upcoming-signing-ceremony-2017-wwc-official-website-publish'
        $data = DB::table('team_football_1001_posts')->select()->where([['post_type','=','post'],['post_status','=','publish'],['post_name','=',$post_name]])->get();

        return $data;
    }

    protected function buildShare($d,$n,$t) {
        $data = null;

        $shr = new Share();
        $data = $shr->render($d,$n,$t);

        return $data;
    }

    public function buildDataForDayNews($params) {
        try {
            $this->buildData($params);

            $this->data['body_style'] = 'N news';

            $y_m_d = $params[0].'-'.sprintf("%02s",$params[1]).'-'.sprintf("%02s",$params[2]);
            
            $this->data['news_title'] = array();
            $this->data['news_title'][0] = new \stdClass();
            $this->data['news_title'][0]->meta_value = DateHelper::transDateFormat($y_m_d);
            $this->data['news_post'] = array();
            $this->data['news_post'][0] = new \stdClass();
            $this->data['news_post'][0]->post_name = $params[0].'/'.sprintf("%02s",$params[1]).'/'.sprintf("%02s",$params[2]);
            $this->data['news_post'][0]->post_title = $this->data['news_post'][0]->post_name;
            $this->data['news_post'][0]->ID = '';

            $this->data['day_news'] = $this->buildDayNews($y_m_d);

            for($i=0;$i<count($this->data['day_news']);$i++) {
                $this->setImgInfo($this->data['day_news'][$i]);
            }
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());
        }

        return $this->data;
    }

    protected function buildDayNews($params) {
        $data = null;

        $lg = RouteHelper::getLanguage();
        $lg = $lg==false ? "":$lg;
        // SELECT * FROM wwc2017.wwc2017_team_football_1001_posts WHERE post_type='post' AND post_status='publish' ORDER BY post_date desc
        $data = DB::table('team_football_1001_posts')->select()->where([['post_type','=','post'],['post_status','=','publish']])
                                                                   ->where(function($qr) use($lg) {
                                                                           $qr->where(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,3,2)'),'<>','~~');
                                                                           })
                                                                           ->orWhere(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                                                                           });
                                                                   })
                                                                   ->whereDate('post_date','=',$params)
                                                                   ->orderBy('post_date','desc')
                                                                   ->paginate($this->__pagesize,array('*'),'page',$this->getPage());
        return $data;
    }

    public function buildDataForAchieves($params) {
        try {
            $this->buildData($params);

            $this->data['body_style'] = 'N news';

            $y_m = $params[0].'-'.sprintf("%02s",$params[1]);
            
            $this->data['news_title'] = array();
            $this->data['news_title'][0] = new \stdClass();
            $this->data['news_title'][0]->meta_value = DateHelper::transMonthFormat($y_m.'-'.sprintf("%02s",1),'F').' '.$params[0];
            $this->data['news_post'] = array();
            $this->data['news_post'][0] = new \stdClass();
            $this->data['news_post'][0]->post_name = $params[0].'/'.sprintf("%02s",$params[1]);
            $this->data['news_post'][0]->post_title = $this->data['news_post'][0]->post_name;
            $this->data['news_post'][0]->ID = '';

            $this->data['month_news'] = $this->buildMonthNews($y_m);
            
            for($i=0;$i<count($this->data['month_news']);$i++) {
                $this->setImgInfo($this->data['month_news'][$i]);
            }
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());
        }
        
        return $this->data;
    }

    protected function buildMonthNews($params) {
        $data = null;

        $lg = RouteHelper::getLanguage();
        $lg = $lg==false ? "":$lg;
        // SELECT * FROM wwc2017.wwc2017_team_football_1001_posts WHERE post_type='post' AND post_status='publish' ORDER BY post_date desc
        $data = DB::table('team_football_1001_posts')->select()->where([['post_type','=','post'],['post_status','=','publish']])
                                                                   ->where(function($qr) use($lg) {
                                                                           $qr->where(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,3,2)'),'<>','~~');
                                                                           })
                                                                           ->orWhere(function($q) use($lg) {
                                                                               $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                                                                           });
                                                                   })
                                                                   ->whereMonth('post_date','=',substr($params,5,2))
                                                                   ->whereYear('post_date','=',substr($params,0,4))
                                                                   ->orderBy('post_date','desc')
                                                                   ->paginate($this->__pagesize,array('*'),'page',$this->getPage());
        return $data;
    }

    public function buildDataForSearch($params) {
        try {
            $this->buildData();

            $this->data['body_style'] = 'S news';

            $this->data['news_title'] = array();
            $this->data['news_title'][0] = new \stdClass();
            $this->data['news_title'][0]->meta_value = ucfirst($params);
            $this->data['news_post'] = array();
            $this->data['news_post'][0] = new \stdClass();
            $this->data['news_post'][0]->post_name = ucfirst($params);
            $this->data['news_post'][0]->post_title = $this->data['news_post'][0]->post_name;
            $this->data['news_post'][0]->ID = '';

            $this->data['page'] = $this->getPage();
            $this->data['s'] = $params;

            $this->data['Search'] = $this->buildSearchNews($params);

            for($i=0;$i<count($this->data['Search']);$i++) {

                $this->setImgInfo($this->data['Search'][$i]);

                $this->data['Search'][$i]->read_more = $this->buildReadMore($this->data['Search'][$i]->post_content);
            }
        }
        catch(Exception $e) {
            WriteLog::write($e->getMessage());
        }

        return $this->data;
    }

    protected function buildReadMore($cnt) {
        $data = "";

        $from = '>'; $to = '<';
        $str = $cnt;
        while(true) {
            $_p = strpos($str,$to)+1;
            $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
            $data = $data . substr($sub,0,strpos($sub,$to));
            $str = substr($str,$_p);
            if (!$str) break;
        }

        return substr($data,0,320);
    }

    protected function buildSearchNews($params) {
        $data = null;

        $lg = RouteHelper::getLanguage();
        $lg = $lg==false ? "":$lg;
        // SELECT * FROM wwc2017_team_football_1001_posts WHERE (post_title LIKE '%2017%' OR post_excerpt LIKE '%2017%' OR post_name LIKE '%2017%' OR post_content LIKE '%2017%') AND (post_type='post' OR (post_post_author='1' AND post_type='page')) AND post_status='publish'
        $data = DB::table('team_football_1001_posts')->select()->where('post_status','=','publish')
                                                                   ->where(function($qr) use($lg) {
                                                                           $qr->where(function($q) use($lg) {
                                                                                   $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,3,2)'),'<>','~~');
                                                                               })
                                                                              ->orWhere(function($q) use($lg) {
                                                                                   $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                                                                               })
                                                                              ->orWhere('post_content_filtered','=','home_page');
                                                                   })
                                                                   ->where(function($qb) {
                                                                           $qb->where  ('post_type','=','post')
                                                                              ->orWhere(function($qb) {
                                                                                            $qb->where(function($q) {
                                                                                                   $q->where('post_content_filtered','<>','404')->orWhereNull('post_content_filtered');
                                                                                                })
                                                                                               ->where('post_type','=','page');
                                                                                        });
                                                                           })
                                                                   ->where(function($qb) use($params) {
                                                                           $qb->where  ('post_title','like','%'.$params.'%')
                                                                              ->orWhere('post_excerpt','like','%'.$params.'%')
                                                                              ->orWhere('post_name','like','%'.$params.'%')
                                                                              ->orWhere('post_content','like','%'.$params.'%');
                                                                           })
                                                         ->paginate($this->__pagesize,array('*'),'page',$this->data['page']);
        return $data;
    }
}