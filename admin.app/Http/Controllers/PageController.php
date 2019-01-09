<?php
namespace App\Http\Controllers;

use App\Http\Controllers\MainMenuDB;
use App\WriteLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller {
    
    protected $__table = null;
    protected $__page = 1;
    protected $__pagesize = 8;

    public function __construct() {
        $this->__table = 'team_football_1001_posts';
    }
    
    protected function query(Request $vals) {

        $this->__page = (int)$vals->query('page');
        
        $filters = array();
        
        if (strtolower($vals->getMethod())=='post') {
            $vals = $vals->all();
            $this->__page = $this->__page==0 ? (int)$vals['page'] : $this->__page;
            $i=0;
            foreach($vals as $key => $val) {
                if (substr($key,0,7)=='filter_') {
                    $filters[$i][0] = 'pg.'.substr($key,7);
                    $filters[$i][1] = '=';
                    $filters[$i][2] = $val;
                    $i++;
                }
            }
        }

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;
        $posts = DB::table(DB::raw(config('database.connections.mysql.prefix').$this->__table.' AS pg'))
                    ->select(DB::raw('pg.*, mn.post_title AS parent_title'))
                    ->leftJoin(DB::raw(config('database.connections.mysql.prefix').$this->__table.' AS mn'),DB::Raw('pg.post_parent'),'=',DB::Raw('mn.ID'))
                    ->where($filters)
                    ->where(function($qr) use($lg) {
                        $qr->where(function($q) use($lg) {
                            $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(pg.post_name,3,2)'),'<>','~~');
                        })
                        ->orWhere(function($q) use($lg) {
                            $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(pg.post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                        });
                    })
                    ->where(function($qr) { $qr->where(DB::Raw('pg.post_status'),'=','publish')->orWhere(DB::Raw('pg.post_status'),'=','draft'); })
                    ->where(function($qr) {
                        $qr->where(function($q) {
                            $q->where(DB::Raw('pg.post_type'), '=', 'page')
                              ->where(function($qq) {
                                  $qq->where(DB::Raw('pg.post_content_filtered'), '<>', 'home_page')->orWhereNull(DB::Raw('pg.post_content_filtered'));
                              });
                        })
                        ->orWhere(DB::Raw('pg.post_type'),'=','nav_menu_item');
                    })
                    ->orderBy(DB::Raw('pg.post_status'),'desc')
                    ->orderBy(DB::Raw('pg.post_parent'))
                    ->orderBy(DB::Raw('pg.post_type'))
                    ->orderBy(DB::Raw('pg.menu_order'))
                    ->orderBy(DB::Raw('pg.ID'))
                    ->paginate($this->__pagesize,array('*'),'page',$this->__page);

        return $posts;
    }

    public function read($id, Request $vals) {
        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;
        $data = DB::table($this->__table)->select()->where('ID','=', $id)->get()->all();
        if (count($data)==0) {
			$data = array();
			$data[0] = new \stdClass();
			$data[0]->ID = "";
			$data[0]->post_date = "";
			$data[0]->post_date_gmt = "";
			$data[0]->post_content = "";
			$data[0]->post_title = "";
			$data[0]->post_excerpt = "";
			$data[0]->post_status = "";
			$data[0]->post_name = "";
			$data[0]->post_modified = "";
			$data[0]->post_modified_gmt = "";
			$data[0]->post_type = "page";
			$data[0]->post_mime_type = "text/html";
			$data[0]->post_parent = "";
            $data[0]->menu_order = "";
            $data[0]->menu_only = "";
            $data[0]->post_content_filtered = "";
        }
        else {
            $data[0]->post_name = $lg==""? $data[0]->post_name: substr($data[0]->post_name,4);
            $data[0]->menu_only = $data[0]->post_type=='nav_menu_item' ? "menu_only" :"";
        }

        $mn_db = new MainMenuDB();
        $avail_menu = $mn_db->buildAllMenuData();
        
        $posts = $this->query($vals);

        $hdr = view('post_header',['ID'=>$data[0]->ID]);
        $ftr = view('post_footer');

        echo view('page', ['lang'=>$lg, 'posts'=>$posts, 'post_header'=>$hdr,
                                            'post_footer'=>$ftr,
                                            'ID'=>$data[0]->ID,
                                            'post_date'=>$data[0]->post_date,
                                            'post_date_gmt'=>$data[0]->post_date_gmt,
                                            'post_content'=>$data[0]->post_content,
                                            'post_title'=>$data[0]->post_title,
                                            'post_excerpt'=>$data[0]->post_excerpt,
                                            'post_status'=>$data[0]->post_status,
                                            'post_name'=>$data[0]->post_name,
                                            'post_modified'=>$data[0]->post_modified,
                                            'post_modified_gmt'=>$data[0]->post_modified_gmt,
                                            'post_type'=>$data[0]->post_type,
                                            'post_mime_type'=>$data[0]->post_mime_type,
                                            'post_parent'=>$data[0]->post_parent,
                                            'menu_order'=>$data[0]->menu_order,
                                            'menu_only'=>$data[0]->menu_only,
                                            'post_content_filtered'=>$data[0]->post_content_filtered,
                                            'avail_menu'=>$avail_menu,
                                            'page'=>$this->__page                    
                                            ]);
    }

    private function getGMT($t) {
        return gmdate("Y-m-d H:i:s",strtotime($t));
    }

    public function save(Request $vals) {
        $data = $vals->all();

        $data['post_date_gmt'] = $this->getGMT($data['post_date']);
        $data['post_modified_gmt'] = $this->getGMT($data['post_modified']);

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $data['post_name'] = $lg==""? $data['post_name']: $lg. $data['post_name'];

        if (!isset($data['menu_only'])) $data['menu_only'] = "";
        if (!isset($data['link'])) $data['link'] = "";

        if ($data['menu_only'] == "menu_only") {
            $data['post_type'] = "nav_menu_item";
            if ($data['post_content'] == "")
                $data['post_content'] = "<p></p>";
        }
        else {
            $data['post_type'] = "page";
        }

        if ($data['link'] == "link" && $data['post_content_filtered']!='404') {
            $data['post_content_filtered'] = 'link';
        }
        else if ($data['post_content_filtered']=='404') {
            $data['post_parent'] = 0;
            $data['menu_order'] = 0;
        }
        else {
            $data['post_content_filtered'] = ' ';
        }

        $o_data = array();
        if ($data['ID']>0)
            $o_data = DB::table($this->__table)->select('ID')->where('ID','=', $data['ID'])->get()->all();
        if (count($o_data)>0)
            DB::table($this->__table)->where('ID','=', $data['ID'])->update(['post_date'=>$data['post_date'], 
																			 'post_date_gmt'=>$data['post_date_gmt'], 
																			 'post_content'=>$data['post_content'],
																			 'post_title'=>$data['post_title'], 
																			 'post_excerpt'=>$data['post_excerpt'],
																			 'post_status'=>$data['post_status'], 
																			 'post_name'=>$data['post_name'],
																			 'post_modified'=>$data['post_modified'], 
																			 'post_modified_gmt'=>$data['post_modified_gmt'],
                                                                             'post_type'=>$data['post_type'],
                                                                             'post_content_filtered'=>$data['post_content_filtered'],
																			 'post_mime_type'=>"text/html",
                                                                             'post_parent'=>$data['post_parent'],
                                                                             'menu_order'=>$data['menu_order']
                                                                            ]);
        else 
            $data['ID'] = DB::table($this->__table)->insertGetId(['post_date'=>$data['post_date'], 
																  'post_date_gmt'=>$data['post_date_gmt'], 
																  'post_content'=>$data['post_content'],
																  'post_title'=>$data['post_title'], 
																  'post_excerpt'=>$data['post_excerpt'],
																  'post_status'=>$data['post_status'], 
																  'post_name'=>$data['post_name'],
																  'post_modified'=>$data['post_modified'], 
																  'post_modified_gmt'=>$data['post_modified_gmt'],
																  'post_type'=>$data['post_type'],
                                                                  'post_content_filtered'=>$data['post_content_filtered'],
                                                                  'post_mime_type'=>"text/html",
                                                                  'post_parent'=>$data['post_parent'],
                                                                  'menu_order'=>$data['menu_order']
																 ]);
            
        $mn_db = new MainMenuDB();
        $avail_menu = $mn_db->buildAllMenuData();
            
        $posts = $this->query($vals);

        $hdr = "";
        $ftr = "";
        $data = array();
        $data[0] = new \stdClass();
        $data[0]->ID = "";
        $data[0]->post_date = "";
        $data[0]->post_date_gmt = "";
        $data[0]->post_content = "";
        $data[0]->post_title = "";
        $data[0]->post_excerpt = "";
        $data[0]->post_status = "";
        $data[0]->post_name = "";
        $data[0]->post_modified = "";
        $data[0]->post_modified_gmt = "";
        $data[0]->post_type = "page";
        $data[0]->post_mime_type = "text/html";
        $data[0]->post_parent = "";
        $data[0]->menu_order = "";
        $data[0]->menu_only = "";
        $data[0]->post_content_filtered = "";

        echo view('page', ['lang'=>$lg, 'posts'=>$posts, 'post_header'=>$hdr,
                                            'post_footer'=>$ftr,
                                            'ID'=>$data[0]->ID,
                                            'post_date'=>$data[0]->post_date,
                                            'post_date_gmt'=>$data[0]->post_date_gmt,
                                            'post_content'=>$data[0]->post_content,
                                            'post_title'=>$data[0]->post_title,
                                            'post_excerpt'=>$data[0]->post_excerpt,
                                            'post_status'=>$data[0]->post_status,
                                            'post_name'=>$data[0]->post_name,
                                            'post_modified'=>$data[0]->post_modified,
                                            'post_modified_gmt'=>$data[0]->post_modified_gmt,
                                            'post_type'=>$data[0]->post_type,
                                            'post_mime_type'=>$data[0]->post_mime_type,
                                            'post_parent'=>$data[0]->post_parent,
                                            'menu_order'=>$data[0]->menu_order,
                                            'menu_only'=>$data[0]->menu_only,
                                            'post_content_filtered'=>$data[0]->post_content_filtered,
                                            'avail_menu'=>$avail_menu,
                                            'page'=>$this->__page            
                                            ]);
    }

    public function delete($id, Request $vals) {
        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;
        $data = DB::table($this->__table)->select()->where('ID','=', $id)->get()->all();
        if (count($data)>0) {
            $data[0]->post_name = $lg==""? $data[0]->post_name: substr($data[0]->post_name,4);
            DB::table($this->__table)->where('ID','=', $id)->delete();
		}
        else {
            $data = array();
            $data[0] = new \stdClass();
            $data[0]->ID = "";
            $data[0]->post_date = "";
            $data[0]->post_date_gmt = "";
            $data[0]->post_content = "";
            $data[0]->post_title = "";
            $data[0]->post_excerpt = "";
            $data[0]->post_status = "";
            $data[0]->post_name = "";
            $data[0]->post_modified = "";
            $data[0]->post_modified_gmt = "";
            $data[0]->post_type = "page";
            $data[0]->post_mime_type = "text/html";
            $data[0]->post_parent = "";
            $data[0]->menu_order = "";
            $data[0]->menu_only = "";
            $data[0]->post_content_filtered = "";
        }
        
        $m_db = new MainMenuDB();
        $avail_menu = $m_db->buildAllMenuData();
        
        $posts = $this->query($vals);

        $hdr = view('post_header',['ID'=>$data[0]->ID]);
        $ftr = view('post_footer');

        echo view('page', ['lang'=>$lg, 'posts'=>$posts, 'post_header'=>$hdr,
                                            'post_footer'=>$ftr,
                                            'ID'=>$data[0]->ID,
                                            'post_date'=>$data[0]->post_date,
                                            'post_date_gmt'=>$data[0]->post_date_gmt,
                                            'post_content'=>$data[0]->post_content,
                                            'post_title'=>$data[0]->post_title,
                                            'post_excerpt'=>$data[0]->post_excerpt,
                                            'post_status'=>$data[0]->post_status,
                                            'post_name'=>$data[0]->post_name,
                                            'post_modified'=>$data[0]->post_modified,
                                            'post_modified_gmt'=>$data[0]->post_modified_gmt,
                                            'post_type'=>$data[0]->post_type,
                                            'post_mime_type'=>$data[0]->post_mime_type,
                                            'post_parent'=>$data[0]->post_parent,
                                            'menu_order'=>$data[0]->menu_order,
                                            'menu_only'=>$data[0]->menu_order,
                                            'post_content_filtered'=>$data[0]->post_content_filtered,
                                            'avail_menu'=>$avail_menu,
                                            'page'=>$this->__page,
                                            ]);
    }

    public function realAll(Request $vals) {

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $mn_db = new MainMenuDB();
        $avail_menu = $mn_db->buildAllMenuData();
        
        $posts = $this->query($vals);

        echo view('page', ['lang'=>$lg, 'posts'=>$posts, 'post_header'=>"",
                                            'post_footer'=>"",
                                            'ID'=>"",
                                            'post_date'=>"",
                                            'post_date_gmt'=>"",
                                            'post_content'=>"",
                                            'post_title'=>"",
                                            'post_excerpt'=>"",
                                            'post_status'=>"",
                                            'post_name'=>"",
                                            'post_modified'=>"",
                                            'post_modified_gmt'=>"",
                                            'post_type'=>"page",
                                            'post_mime_type'=>"text/html",
                                            'post_parent'=>"",
                                            'menu_order'=>"",
                                            'menu_only'=>"",
                                            'post_content_filtered'=>"",
                                            'avail_menu'=>$avail_menu,
                                            'page'=>$this->__page
                                            ]);
    }
}