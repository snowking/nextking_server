<?php
class IndexAction extends Action
{
	/**
	 * 
	 * 初始化
	 */
	function _initialize(){
		
		header("Content-Type:application/json; charset=utf-8");
		
    }
    
    
	public function index(){
	
		$this -> ajaxReturn(null, 'Hello King', 1, 'json');
		
	}
}