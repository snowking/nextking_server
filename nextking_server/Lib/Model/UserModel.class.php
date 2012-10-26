<?php

class UserModel extends Model {

    public function simpleField() {
        return array('id', 'name', 'avatar');
    }
    
    public function fullField() {
        return array('id', 'name', 'search_key', 'sign', 'avatar', 'gender', 'company', 'city', 'location', 'mobile', 'email', 'birthday');
    }
    
    public function full($filter) {
       
        return $this->field( $this->fullField())->where($filter)->find();
       
    }
    public function full_list($filter) {
       
        return $this->field( $this->fullField())->where($filter)->select();
       
    }
    
    public function simple($filter) {
       
        return $this->field( $this->simpleField())->where($filter)->find();
       
    }
    
    public function simple_list($filter) {
       
        return $this->field( $this->simpleField())->where($filter)->select();
       
    }


}