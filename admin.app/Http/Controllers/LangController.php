<?php
namespace App\Http\Controllers;

use App\WriteLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LangController extends Controller {
    
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

        $posts = DB::table($this->__table)->select()->where($filters)
                                                     ->where('post_content_filtered','=','home_page')
                                                     ->where(function($qb){$qb->where('post_status','=','publish')
                                                                               ->orWhere('post_status','=','draft')
                                                                               ->orWhere('post_status','=','auto-draft');})
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
		}

        $posts = $this->query($vals);

        $hdr = view('post_header',['ID'=>$data[0]->ID]);
        $ftr = view('post_footer');

        echo view('lang', ['lang'=>$lg, 'posts'=>$posts, 'ID'=>$data[0]->ID,
                                                'post_header'=>$hdr,
                                                'post_footer'=>$ftr,
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
                                                'page'=>$this->__page]);
    }

    private function getGMT($t) {
        return gmdate("Y-m-d H:i:s",strtotime($t));
    }

    public function save(Request $vals) {
        $data = $vals->all();

        $data['post_date_gmt'] = $this->getGMT($data['post_date']);
        $data['post_modified_gmt'] = $this->getGMT($data['post_modified']);

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
																			 'post_mime_type'=>"text/html",
                                                                             'post_content_filtered'=>'home_page'
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
																  'post_mime_type'=>"text/html",
                                                                  'post_content_filtered'=>'home_page'
																 ]);

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

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

        echo view( 'lang', ['lang'=>$lg, 'posts'=>$posts, 'ID'=>$data[0]->ID,
                              'post_header'=>$hdr,
                              'post_footer'=>$ftr,
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
                              'page'=>$this->__page]);
    }

    public function delete($id, Request $vals) {
        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;
        $data = DB::table($this->__table)->select()->where('ID','=', $id)->get()->all();
        if (count($data)>0) {
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
		}

        $posts = $this->query($vals);

        $hdr = view('post_header',['ID'=>$data[0]->ID]);
        $ftr = view('post_footer');

        echo view('lang', ['lang'=>$lg, 'posts'=>$posts, 'ID'=>$data[0]->ID,
                                                'post_header'=>$hdr,
                                                'post_footer'=>$ftr,
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
                                                'page'=>$this->__page]);
    }

    public function realAll(Request $vals) {

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $posts = $this->query($vals);

        echo view('lang', ['lang'=>$lg, 'posts'=>$posts, 'ID'=>"",
                                                'post_header'=>"",
                                                'post_footer'=>"",
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
                                                'page'=>$this->__page]);
    }
}