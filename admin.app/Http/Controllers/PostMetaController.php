<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WriteLog;

class PostMetaController extends Controller {
    
    protected $__table = null;
    protected $__page = 1;
    protected $__pagesize = 9;
    
    public function __construct() {
        $this->__table = 'team_football_1001_postmeta';
    }
    
    protected function availPost() {
        $data = null;

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;
        // select * from team_football_1001_posts where post_status='publish' and post_type='page' and post_author=1 and not exists(select meta_id from team_football_1001_postmeta inner join team_football_1001_posts on(post_id=id) where meta_key like '_aioseop_%')
        $data = DB::select("SELECT * FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_status='publish' AND ((post_type='page' OR post_type='post') ".(($lg==false||$lg=="")?"AND SUBSTR(post_name,3,2)<>'~~')":"AND SUBSTR(post_name,1,4)='".$lg."') OR post_content_filtered='home_page'"));

        return $data;
    }
    
    protected function getPostTitle($p_id) {
        
        $data = DB::table('team_football_1001_posts')->select()->where('ID','=', $p_id)->get()->all();
        
        return (count($data)>0) ? $data[0] : null;
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
        $postmetas = DB::table($this->__table)
                        ->join('team_football_1001_posts', 'post_id', '=', 'id')
                        ->select()->where($filters)
                                  ->where(function($qr) use($lg) {
                                      $qr->where(function($q) use($lg) {
                                          $q->where(DB::raw("'".$lg."'"),'=',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,3,2)'),'<>','~~');
                                      })
                                      ->orWhere(function($q) use($lg) {
                                          $q->where(DB::raw("'".$lg."'"),'<>',DB::raw("''"))->where(DB::raw('SUBSTR(post_name,1,4)'),'=',DB::raw("'".$lg."'"));
                                      });
                                  })
                                  ->where('post_status', '=', 'publish')
                                  ->where('post_type', '=', 'page')
                                  ->where(function($qb) use($lg) {
                                      $qb->where('meta_key','=',$lg.'_aioseop_title')
                                         ->orWhere('meta_key','=',$lg.'_aioseop_description')
                                         ->orWhere('meta_key','=',$lg.'_aioseop_keywords');
                                  })
                                  ->orderBy('post_id','desc')
                                  ->orderBy('meta_key','asc')
                                  ->paginate($this->__pagesize,array('*'),'page',$this->__page);

        return $postmetas;
    }
    
    public function read($id, Request $vals) {
        $data = DB::table($this->__table)->select()->where('meta_id','=', $id)->get()->all();
        if (count($data)==0) {
			$data = array();
			$data[0] = new \stdClass();
			$data[0]->meta_id = "";
			$data[0]->post_id = "";
			$data[0]->meta_key = "";
			$data[0]->meta_value = "";
		}

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $post_title = count($data)>0 ? $this->getPostTitle($data[0]->post_id) : "";
	    
	    $avail_posts = $this->availPost();
		
        $postmetas = $this->query($vals);
        
        echo view('postmeta', ['lang'=>$lg, 'postmetas'=>$postmetas, 'avail_posts'=>$avail_posts, 'post_title'=>$post_title, 'meta_id'=>$data[0]->meta_id, 'post_id'=>$data[0]->post_id, 'meta_key'=>$data[0]->meta_key, 'meta_value'=>$data[0]->meta_value, 'page'=>$this->__page]);
    }

    public function save(Request $vals) {
        $data = $vals->all();
        $o_data = array();
        if ($data['meta_id']>0)
            $o_data = DB::table($this->__table)->select('meta_id')->where('meta_id','=', $data['meta_id'])->get()->all();
        if (count($o_data)>0)
            DB::table($this->__table)->where('meta_id','=', $data['meta_id'])->update(['post_id'=>$data['post_id'], 'meta_key'=>$data['meta_key'], 'meta_value'=>$data['meta_value']]);
        else 
            $data['meta_id'] = DB::table($this->__table)->insertGetId(['post_id'=>$data['post_id'], 'meta_key'=>$data['meta_key'], 'meta_value'=>$data['meta_value']]);

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $avail_posts = $this->availPost();
            
        $postmetas = $this->query($vals);
        
        echo view('postmeta', ['lang'=>$lg, 'postmetas'=>$postmetas, 'avail_posts'=>$avail_posts, 'post_title'=>null, 'meta_id'=>"", 'post_id'=>"", 'meta_key'=>"", 'meta_value'=>"", 'page'=>$this->__page]);
    }

    public function delete($id, Request $vals) {
        $data = DB::table($this->__table)->select()->where('meta_id','=', $id)->get()->all();
        if (count($data)>0)
            DB::table($this->__table)->where('meta_id','=', $id)->delete();
            
        $post_title = count($data)>0 ? $this->getPostTitle($data[0]->post_id) : "";

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $avail_posts = $this->availPost();
            
        $postmetas = $this->query($vals);
        
        echo view('postmeta', ['lang'=>$lg, 'postmetas'=>$postmetas, 'avail_posts'=>$avail_posts, 'post_title'=>$post_title, 'meta_id'=>$data[0]->meta_id, 'post_id'=>$data[0]->post_id, 'meta_key'=>$data[0]->meta_key, 'meta_value'=>$data[0]->meta_value, 'page'=>$this->__page]);
    }

    public function realAll(Request $vals) {

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $avail_posts = $this->availPost();
        
        $postmetas = $this->query($vals);

        echo view('postmeta', ['lang'=>$lg, 'postmetas'=>$postmetas, 'avail_posts'=>$avail_posts, 'post_title'=>null, 'meta_id'=>"", 'post_id'=>"", 'meta_key'=>"", 'meta_value'=>"", 'page'=>$this->__page]);
    }
}