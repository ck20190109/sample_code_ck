<?php
namespace App\Http\Controllers;

use App\WriteLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller {
    
    protected $__table = null;
    protected $__page = 1;
    protected $__pagesize = 10;

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
                    $filters[$i][0] = substr($key,7);
                    $filters[$i][1] = '=';
                    $filters[$i][2] = $val;
                    $i++;
                }
            }
        }

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;
        $posts = DB::table($this->__table)->select()->where($filters)
                                                     ->where(function($qr) use($lg) {
                                                         $qr->where(function($q) use($lg) {
                                                             $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,3,2)'),'<>','~~');
                                                         })
                                                         ->orWhere(function($q) use($lg) {
                                                             $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                                                         });
                                                     })
                                                     ->where([['post_type','=','nav_menu_item'],['post_parent','=',0]])
                                                     ->where(function($qb){$qb->where('post_status','=','publish')->orWhere('post_status','=','draft');})
                                                     ->orderBy('menu_order')
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
            $data[0]->menu_order = "";
			$data[0]->post_type = "nav_menu_item";
			$data[0]->post_mime_type = "text/html";
		}
		else {
            $data[0]->post_name = $lg==""? $data[0]->post_name: substr($data[0]->post_name,4);
        }

        $posts = $this->query($vals);

        echo view('tops', ['lang'=>$lg, 'posts'=>$posts, 'ID'=>$data[0]->ID,
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
                                                'menu_order'=>$data[0]->menu_order,
                                                'page'=>$this->__page]);
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

        $o_data = array();
        if ($data['ID']>0)
            $o_data = DB::table($this->__table)->select('ID')->where('ID','=', $data['ID'])->get()->all();
        if (count($o_data)>0)
            DB::table($this->__table)->where('ID','=', $data['ID'])->update(['post_date'=>$data['post_date'], 
                                                                                 'post_date_gmt'=>$data['post_date_gmt'],
                                                                                 'post_content'=>$data['post_title'],
                                                                                 'post_title'=>$data['post_title'],
                                                                                 'post_excerpt'=>$data['post_title'],
                                                                                 'post_status'=>$data['post_status'],
                                                                                 'post_name'=>$data['post_name'],
                                                                                 'post_modified'=>$data['post_modified'],
                                                                                 'post_modified_gmt'=>$data['post_modified_gmt'],
                                                                                 'post_type'=>$data['post_type'],
                                                                                 'post_mime_type'=>"text/html",
                                                                                 'menu_order'=>$data['menu_order'],
                                                                                 'post_content_filtered'=>" ",
                                                                                 'post_parent'=>0
                                                                                ]);
        else 
            $data['ID'] = DB::table($this->__table)->insertGetId([  'post_date'=>$data['post_date'],
                                                                      'post_date_gmt'=>$data['post_date_gmt'],
                                                                      'post_content'=>$data['post_title'],
                                                                      'post_title'=>$data['post_title'],
                                                                      'post_excerpt'=>$data['post_title'],
                                                                      'post_status'=>$data['post_status'],
                                                                      'post_name'=>$data['post_name'],
                                                                      'post_modified'=>$data['post_modified'],
                                                                      'post_modified_gmt'=>$data['post_modified_gmt'],
                                                                      'post_type'=>$data['post_type'],
                                                                      'post_mime_type'=>"text/html",
                                                                      'menu_order'=>$data['menu_order'],
                                                                      'post_content_filtered'=>" ",
                                                                      'post_parent'=>0
                                                                     ]);

        $posts = $this->query($vals);

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
        $data[0]->menu_order = "";
        $data[0]->post_type = "nav_menu_item";
        $data[0]->post_mime_type = "text/html";

        echo view( 'tops', ['lang'=>$lg, 'posts'=>$posts, 'ID'=>$data[0]->ID,
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
                                              'menu_order'=>$data[0]->menu_order,
                                              'page'=>$this->__page]);
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
			$data[0]->post_type = "nav_menu_item";
			$data[0]->post_mime_type = "text/html";
            $data[0]->menu_order = "";
		}

        $posts = $this->query($vals);

        echo view('tops', ['lang'=>$lg, 'posts'=>$posts, 'ID'=>$data[0]->ID,
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
                                                'menu_order'=>$data[0]->menu_order,
                                                'page'=>$this->__page]);
    }

    public function realAll(Request $vals) {

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $posts = $this->query($vals);

        echo view('tops', ['lang'=>$lg, 'posts'=>$posts, 'ID'=>"",
                                                'post_date'=>"",
                                                'post_date_gmt'=>"",
                                                'post_content'=>"",
                                                'post_title'=>"",
                                                'post_excerpt'=>"",
                                                'post_status'=>"",
                                                'post_name'=>"",
                                                'post_modified'=>"",
                                                'post_modified_gmt'=>"",
                                                'post_type'=>"nav_menu_item",
                                                'post_mime_type'=>"text/html",
                                                'menu_order'=>"",
                                                'page'=>$this->__page]);
    }
}