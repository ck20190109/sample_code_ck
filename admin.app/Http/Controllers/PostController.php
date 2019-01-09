<?php
namespace App\Http\Controllers;

use App\WriteLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller {
    
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
                                                     ->where(function($qb){$qb->where('post_status','=','publish')->orWhere('post_status','=','draft');})
                                                     ->where('post_type','=','post')
                                                     ->orderBy('post_status','desc')
                                                     ->paginate($this->__pagesize,array('*'),'page',$this->__page);

        return $posts;
    }

    protected function getTimeline($id) {
        $data = DB::select("SELECT * FROM ".config('database.connections.mysql.prefix')."team_football_1001_posts WHERE post_type='timeline_post' AND post_parent=".$id);
        return $data;
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
            $data[0]->post_image_path = "";
			$data[0]->post_modified = "";
			$data[0]->post_modified_gmt = "";
			$data[0]->post_type = "post";
			$data[0]->post_mime_type = "text/html";
            $t_data = array();
            $t_data[0] = new \stdClass();
            $t_data[0]->ID = "";
            $t_data[0]->post_content = "";
            $t_data[0]->post_parent = "";
            $t_data[0]->post_title = "";
            $t_data[0]->post_status = "";
            $t_data[0]->post_type = "timeline_post";
		}
		else {
            $data[0]->post_name = $lg=="" ? $data[0]->post_name: substr($data[0]->post_name,4);
            $data[0]->post_image_path = substr(url('/'),0,-13).'/uploads/'.str_replace ('-','/',substr($data[0]->post_modified,0,8));
            $t_data = $this->getTimeline($id);
            if (count($t_data)==0) {
                $t_data = array();
                $t_data[0] = new \stdClass();
                $t_data[0]->ID = "";
                $t_data[0]->post_content = "";
                $t_data[0]->post_parent = "";
                $t_data[0]->post_title = "";
                $t_data[0]->post_status = "";
                $t_data[0]->post_type = "timeline_post";
            }
        }

        $posts = $this->query($vals);

        $hdr = view('post_header',['ID'=>$data[0]->ID]);
        $ftr = view('post_footer');

        echo view('post', ['lang'=>$lg, 'posts'=>$posts, 'post_header'=>$hdr,
                                                'post_footer'=>$ftr,
                                                'ID'=>$data[0]->ID,
                                                'post_date'=>$data[0]->post_date,
                                                'post_date_gmt'=>$data[0]->post_date_gmt,
                                                'post_content'=>$data[0]->post_content,
                                                'post_title'=>$data[0]->post_title,
                                                'post_excerpt'=>$data[0]->post_excerpt,
                                                'post_status'=>$data[0]->post_status,
                                                'post_name'=>$data[0]->post_name,
                                                'post_image_path'=>$data[0]->post_image_path,
                                                'post_modified'=>$data[0]->post_modified,
                                                'post_modified_gmt'=>$data[0]->post_modified_gmt,
                                                'post_type'=>$data[0]->post_type,
                                                'post_mime_type'=>$data[0]->post_mime_type,
                                                'page'=>$this->__page,
                                                't_ID'=>$t_data[0]->ID,
                                                't_post_content'=>$t_data[0]->post_content,
                                                't_post_parent'=>$t_data[0]->post_parent,
                                                't_post_title'=>$t_data[0]->post_title,
                                                't_post_status'=>$t_data[0]->post_status,
                                                't_post_type'=>$t_data[0]->post_type,
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

        $data['post_name'] = $lg=="" ? $data['post_name']: $lg. $data['post_name'];

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
                                                                                'post_content_filtered'=>" ",
                                                                                'post_mime_type'=>"text/html"
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
                                                                    'post_content_filtered'=>" ",
                                                                    'post_mime_type'=>"text/html"
                                                                ]);

        $data['post_parent'] = $data['ID'];
        $o_data = array();
        if ($data['t_ID']>0)
            $o_data = DB::table($this->__table)->select('ID')->where('ID','=', $data['t_ID'])->get()->all();
        if (count($o_data)>0)
            DB::table($this->__table)->where('ID','=', $data['t_ID'])->update(['post_date'=>$data['post_date'],
                                                                                'post_date_gmt'=>$data['post_date_gmt'],
                                                                                'post_content'=>$data['t_post_content'],
                                                                                'post_title'=>$data['t_post_title'],
                                                                                'post_excerpt'=>$data['post_excerpt'],
                                                                                'post_status'=>$data['t_post_status'],
                                                                                'post_name'=>$data['post_name'],
                                                                                'post_modified'=>$data['post_modified'],
                                                                                'post_modified_gmt'=>$data['post_modified_gmt'],
                                                                                'post_type'=>$data['t_post_type'],
                                                                                'post_mime_type'=>"text/html"
                                                                            ]);
        else
            $data['t_ID'] = DB::table($this->__table)->insertGetId(['post_date'=>$data['post_date'],
                                                                    'post_date_gmt'=>$data['post_date_gmt'],
                                                                    'post_content'=>$data['t_post_content'],
                                                                    'post_parent'=>$data['post_parent'],
                                                                    'post_title'=>$data['t_post_title'],
                                                                    'post_excerpt'=>$data['post_excerpt'],
                                                                    'post_status'=>$data['t_post_status'],
                                                                    'post_name'=>$data['post_name'],
                                                                    'post_modified'=>$data['post_modified'],
                                                                    'post_modified_gmt'=>$data['post_modified_gmt'],
                                                                    'post_type'=>$data['t_post_type'],
                                                                    'post_mime_type'=>"text/html"
                                                                ]);

        if ($vals->hasFile('post_large')) {
            $t_dir = substr(base_path(),0,-5).'uploads/'.str_replace('-','/',substr($data['post_modified'],0,8));

            @mkdir($t_dir);

            $f_n = $data['post_name'];
            $f_n = $lg=="" ? $f_n: substr($f_n,4);

            $l_f = $f_n.'.jpg';

            $vals->post_large->move($t_dir, $l_f);

            $s_f = $f_n.'-300.jpg';
            $s_i = new SimpleImage();
            $s_i->load($t_dir.$l_f);
            $s_i->resizeToWidth(300);
            $s_i->save($t_dir.$s_f);
        }

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $posts = $this->query($vals);

        $hdr = "";
        $ftr = "";
        $data = array();
        $data['ID'] = "";
        $data['post_date'] = "";
        $data['post_date_gmt'] = "";
        $data['post_content'] = "";
        $data['post_title'] = "";
        $data['post_excerpt'] = "";
        $data['post_status'] = "";
        $data['post_name'] = "";
        $data['post_image_path'] = "";
        $data['post_modified'] = "";
        $data['post_modified_gmt'] = "";
        $data['post_type'] = "post";
        $data['post_mime_type'] = "text/html";
        $data['t_ID'] = "";
        $data['t_post_content'] = "";
        $data['t_post_parent'] = "";
        $data['t_post_title'] = "";
        $data['t_post_status'] = "";
        $data['t_post_type'] = "timeline_post";

        echo view( 'post', ['lang'=>$lg, 'posts'=>$posts, 'post_header'=>$hdr,
                                                'post_footer'=>$ftr,
                                                'ID'=>$data['ID'],
                                                'post_date'=>$data['post_date'],
                                                'post_date_gmt'=>$data['post_date_gmt'],
                                                'post_content'=>$data['post_content'],
                                                'post_title'=>$data['post_title'],
                                                'post_excerpt'=>$data['post_excerpt'],
                                                'post_status'=>$data['post_status'],
                                                'post_name'=>$data['post_name'],
                                                'post_image_path'=>$data['post_image_path'],
                                                'post_modified'=>$data['post_modified'],
                                                'post_modified_gmt'=>$data['post_modified_gmt'],
                                                'post_type'=>$data['post_type'],
                                                'post_mime_type'=>$data['post_mime_type'],
                                                't_ID'=>$data['t_ID'],
                                                't_post_content'=>$data['t_post_content'],
                                                't_post_parent'=>$data['t_post_parent'],
                                                't_post_title'=>$data['t_post_title'],
                                                't_post_status'=>$data['t_post_status'],
                                                't_post_type'=>$data['t_post_type'],
                                                'page'=>$this->__page]);
    }

    public function delete($id, Request $vals) {
        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;
        $data = DB::table($this->__table)->select()->where('ID','=', $id)->get()->all();
        if (count($data)>0) {
            $data[0]->post_name = $lg=="" ? $data[0]->post_name: substr($data[0]->post_name,4);
            $data[0]->post_image_path = substr(url('/'),0,-13).'/uploads/'.str_replace ('-','/',substr($data[0]->post_modified,0,8));
            DB::table($this->__table)->where('ID','=', $id)->delete();
            $t_data = $this->getTimeline($id);
            if (count($t_data)==0) {
                $t_data = array();
                $t_data[0] = new \stdClass();
                $t_data[0]->ID = "";
                $t_data[0]->post_content = "";
                $t_data[0]->post_parent = "";
                $t_data[0]->post_title = "";
                $t_data[0]->post_status = "";
                $t_data[0]->post_type = "timeline_post";
            }
            DB::table($this->__table)->where('post_parent','=', $id)->delete();
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
            $data[0]->post_image_path = "";
            $data[0]->post_modified = "";
			$data[0]->post_modified_gmt = "";
			$data[0]->post_type = "post";
			$data[0]->post_mime_type = "text/html";
            $t_data = array();
            $t_data[0] = new \stdClass();
            $t_data[0]->ID = "";
            $t_data[0]->post_content = "";
            $t_data[0]->post_parent = "";
            $t_data[0]->post_title = "";
            $t_data[0]->post_status = "";
            $t_data[0]->post_type = "timeline_post";
		}

        $posts = $this->query($vals);

        $hdr = view('post_header',['ID'=>$data[0]->ID]);
        $ftr = view('post_footer');

        echo view('post', ['lang'=>$lg, 'posts'=>$posts, 'post_header'=>$hdr,
                                                'post_footer'=>$ftr,
                                                'ID'=>$data[0]->ID,
                                                'post_date'=>$data[0]->post_date,
                                                'post_date_gmt'=>$data[0]->post_date_gmt,
                                                'post_content'=>$data[0]->post_content,
                                                'post_title'=>$data[0]->post_title,
                                                'post_excerpt'=>$data[0]->post_excerpt,
                                                'post_status'=>$data[0]->post_status,
                                                'post_name'=>$data[0]->post_name,
                                                'post_image_path'=>$data[0]->post_image_path,
                                                'post_modified'=>$data[0]->post_modified,
                                                'post_modified_gmt'=>$data[0]->post_modified_gmt,
                                                'post_type'=>$data[0]->post_type,
                                                'post_mime_type'=>$data[0]->post_mime_type,
                                                't_ID'=>$t_data[0]->ID,
                                                't_post_content'=>$t_data[0]->post_content,
                                                't_post_parent'=>$t_data[0]->post_parent,
                                                't_post_title'=>$t_data[0]->post_title,
                                                't_post_status'=>$t_data[0]->post_status,
                                                't_post_type'=>$t_data[0]->post_type,
                                                'page'=>$this->__page]);
    }

    public function realAll(Request $vals) {

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $posts = $this->query($vals);

        echo view('post', ['lang'=>$lg, 'posts'=>$posts, 'post_header'=>"",
                                                'post_footer'=>"",
                                                'ID'=>"",
                                                'post_date'=>"",
                                                'post_date_gmt'=>"",
                                                'post_content'=>"",
                                                'post_title'=>"",
                                                'post_excerpt'=>"",
                                                'post_status'=>"",
                                                'post_name'=>"",
                                                'post_image_path'=>"",
                                                'post_modified'=>"",
                                                'post_modified_gmt'=>"",
                                                'post_type'=>"post",
                                                'post_mime_type'=>"text/html",
                                                't_ID'=>"",
                                                't_post_content'=>"",
                                                't_post_parent'=>"",
                                                't_post_title'=>"",
                                                't_post_status'=>"",
                                                't_post_type'=>"timeline_post",
                                                'page'=>$this->__page]);
    }

    public function Upload(Request $vals) {
        $data = $vals->all();

        if ($vals->hasFile('post_image')) {
            $t_dir = substr(base_path(),0,-5).'uploads/'.str_replace('-','/',substr($data['post_modified'],0,8));

            @mkdir($t_dir);

            $l_f = $vals->file('post_image')->getClientOriginalName();

            $vals->post_image->move($t_dir, $l_f);
        }

        $data['post_image_path'] = substr(url('/'),0,-13).'/uploads/'.str_replace ('-','/',substr($data['post_modified'],0,8));

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $posts = $this->query($vals);

        $hdr = view('post_header',['ID'=>$data['ID']]);
        $ftr = view('post_footer');

        echo view('post', ['lang'=>$lg, 'posts'=>$posts, 'post_header'=>$hdr,
                                                'post_footer'=>$ftr,
                                                'ID'=>$data['ID'],
                                                'post_date'=>$data['post_date'],
                                                'post_date_gmt'=>$data['post_date_gmt'],
                                                'post_content'=>$data['post_content'],
                                                'post_title'=>$data['post_title'],
                                                'post_excerpt'=>$data['post_excerpt'],
                                                'post_status'=>$data['post_status'],
                                                'post_name'=>$data['post_name'],
                                                'post_image_path'=>$data['post_image_path'],
                                                'post_modified'=>$data['post_modified'],
                                                'post_modified_gmt'=>$data['post_modified_gmt'],
                                                'post_type'=>$data['post_type'],
                                                'post_mime_type'=>$data['post_mime_type'],
                                                't_ID'=>$data['t_ID'],
                                                't_post_content'=>$data['t_post_content'],
                                                't_post_parent'=>$data['t_post_parent'],
                                                't_post_title'=>$data['t_post_title'],
                                                't_post_status'=>$data['t_post_status'],
                                                't_post_type'=>$data['t_post_type'],
                                                'page'=>$this->__page]);
    }
}