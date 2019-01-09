<?php
namespace App\Http\Processors;

use App\Http\Models\Model;

class PersistentProcessor extends Processor
{
    protected $model = null;
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
    
    public function model() {    
        
        if ($this->model == null)   $this->model = new Model($this->table);
        
        return $this->model;
    }
}
