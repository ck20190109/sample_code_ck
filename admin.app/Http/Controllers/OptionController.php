<?php
namespace App\Http\Controllers;

use App\WriteLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Exception;
use App\Http\Controllers\Controller;

class OptionController extends Controller {
    
    protected $__table = null;
    protected $__page = 1;
    protected $__pagesize = 8;
    
    public function __construct() {
        $this->__table = 'team_football_1001_options';
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

        $options = DB::table($this->__table)->select()->where($filters)
                                                       ->where(function($qb){
                                                                                $qb->where('option_name','=','theme_mods_team')
                                                                                   ->orWhere('option_name','=','sponsor_logos_for_nav');
                                                                              })
                                                       ->paginate($this->__pagesize,array('*'),'page',$this->__page);

        return $options;
    }
    
    public function read($id, Request $vals) {
        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;
        $data = DB::table($this->__table)->select()->where('option_id','=', $id)->get()->all();
        if (count($data)==0) {
			$data = array();
			$data[0] = new \stdClass();
			$data[0]->option_id = "";
			$data[0]->option_name = "";
			$data[0]->option_value = "";
		}

        $options = $this->query($vals);

        try {
            $option_array = unserialize($data[0]->option_value);

            $mdl_name = 'mdl__socials';
            $mdl_prefix = 's';
            $name = 'Social';
            $mdl__socials = json_encode($option_array['mdl__socials']);
            $table_form_socials = view('option_mdl', ['option_array'=>$option_array, 'mdl_name'=>$mdl_name, 'mdl_prefix'=>$mdl_prefix, 'name'=>$name, 'mdl__socials'=>$mdl__socials]);

            $mdl_name = 'mdl__contacts';
            $mdl_prefix = 'c';
            $name = 'Contact';
            $mdl__contacts = json_encode($option_array['mdl__contacts']);
            $table_form_contacts = view('option_mdl', ['option_array'=>$option_array, 'mdl_name'=>$mdl_name, 'mdl_prefix'=>$mdl_prefix, 'name'=>$name, 'mdl__contacts'=>$mdl__contacts]);
        }
        catch(Exception $e) {
            $table_form_socials = "";
            $table_form_contacts = "";
        }

        echo view('option', ['lang'=>$lg, 'options'=>$options, 'option_id'=>$data[0]->option_id, 'option_name'=>$data[0]->option_name, 'option_value'=>$data[0]->option_value, 'table_form_socials'=>$table_form_socials, 'table_form_contacts'=>$table_form_contacts, 'page'=>$this->__page]);
    }

    public function save(Request $vals) {
        $data = $vals->all();
        $o_data = array();
        if ($data['option_id']>0)
            $o_data = DB::table($this->__table)->select('option_id')->where('option_id','=', $data['option_id'])->get()->all();

        if ($data['mdl__socials']!="" && $data['mdl__contacts']!="") {
            $mdl__socials = json_decode($data['mdl__socials']);
            $mdl__contacts = json_decode($data['mdl__contacts']);
            $data['option_value'] = array();
            for($i=0;$i<count($mdl__socials);$i++) {
                $mdl = array();
                $mdl['text'] = $mdl__socials[$i]->text;
                $mdl['link'] = $mdl__socials[$i]->link;
                $mdl['icon'] = $mdl__socials[$i]->icon;
                $mdl__socials[$i] = $mdl;
            }
            for($i=0;$i<count($mdl__contacts);$i++) {
                $mdl = array();
                $mdl['text'] = $mdl__contacts[$i]->text;
                $mdl['link'] = $mdl__contacts[$i]->link;
                $mdl['icon'] = $mdl__contacts[$i]->icon;
                $mdl__contacts[$i] = $mdl;
            }
            $data['option_value']['mdl__socials'] = $mdl__socials;
            $data['option_value']['mdl__contacts'] = $mdl__contacts;
            $data['option_value'] = serialize($data['option_value']);
        }

        if (count($o_data)>0)
            DB::table($this->__table)->where('option_id','=', $data['option_id'])->update(['option_name'=>$data['option_name'], 'option_value'=>$data['option_value']]);
        else 
            $data['option_id'] = DB::table($this->__table)->insertGetId(['option_name'=>$data['option_name'], 'option_value'=>$data['option_value']]);

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $options = $this->query($vals);

        echo view('option', ['lang'=>$lg, 'options'=>$options, 'option_id'=>"", 'option_name'=>"", 'option_value'=>"", 'table_form_socials'=>"", 'table_form_contacts'=>"", 'page'=>$this->__page]);
    }

    public function delete($id, Request $vals) {
        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;
        $data = DB::table($this->__table)->select()->where('option_id','=', $id)->get()->all();
        if (count($data)>0)
            DB::table($this->__table)->where('option_id','=', $id)->delete();
        else {
            $data = array();
            $data[0] = new \stdClass();
            $data[0]->option_id = "";
            $data[0]->option_name = "";
            $data[0]->option_value = "";
        }

        $options = $this->query($vals);

        try {
            $option_array = unserialize($data[0]->option_value);

            $mdl_name = 'mdl__socials';
            $mdl_prefix = 's';
            $name = 'Social';
            $mdl__socials = json_encode($option_array['mdl__socials']);
            $table_form_socials = view('option_mdl', ['option_array'=>$option_array, 'mdl_name'=>$mdl_name, 'mdl_prefix'=>$mdl_prefix, 'name'=>$name, 'mdl__socials'=>$mdl__socials]);

            $mdl_name = 'mdl__contacts';
            $mdl_prefix = 'c';
            $name = 'Contact';
            $mdl__contacts = json_encode($option_array['mdl__contacts']);
            $table_form_contacts = view('option_mdl', ['option_array'=>$option_array, 'mdl_name'=>$mdl_name, 'mdl_prefix'=>$mdl_prefix, 'name'=>$name, 'mdl__contacts'=>$mdl__contacts]);
        }
        catch(Exception $e) {
            $table_form_socials = "";
            $table_form_contacts = "";
        }

        echo view('option', ['lang'=>$lg, 'options'=>$options, 'option_id'=>$data[0]->option_id, 'option_name'=>$data[0]->option_name, 'option_value'=>$data[0]->option_value, 'table_form_socials'=>$table_form_socials, 'table_form_contacts'=>$table_form_contacts, 'page'=>$this->__page]);
    }

    public function realAll(Request $vals) {

        $lg = MainMenuDB::getLanguage();
        $lg = $lg==false ? "":$lg;

        $options = $this->query($vals);

        echo view('option', ['lang'=>$lg, 'options'=>$options, 'option_id'=>"", 'option_name'=>"", 'option_value'=>"", 'table_form_socials'=>"", 'table_form_contacts'=>"", 'page'=>$this->__page]);
    }
}
