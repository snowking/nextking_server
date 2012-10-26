<?php


class RandaModel extends Model {

    public function simple_list($filter) {
       
        return $this->where($filter)->order('id desc')->select();
       
    }

    
}


