<?php
namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Model
{
    protected $table = null;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($table)
    {
        $this->table = $table;
    }
    
    public function read($id)
    {
        $bt = DB::table($this->table)->where('id', $id);
        return $bt;
    }
    
    public function save($vals)
    {
        $id = DB::table($this->table)->where('id', $vals['id'])->value('id');
        if (0<$id) {
            DB::table($this->table)->where('id',$vals['id'])->update($vals);
        }
        else {
            $vals['id'] = DB::table($this->table)->insertGetId($vals);
        }
        return $vals;
    }
    
    public function delete($id)
    {
        $bt = DB::table($this->table)->where('id', $id);
        if (0<$bt['id']) {
            DB::table($this->table)->where('id', $id)->delete();
        }
        return $bt;
    }
}
