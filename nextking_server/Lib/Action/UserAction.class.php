<?php

/**
 * @Date 2012.3.12
 * @File: UserAction.class.php
 * @Author King
 */
class UserAction extends BaseAction {

    public function get() {

        $this->isLogin();

        $uid = $this->_param('id');
        if (empty($uid)) {
            $uid = $this->userID();
        }
        $filter = array();
        $filter['id'] = $uid;

        $list = D('User')->full($filter);
        if ($list){
           $this->ajaxReturn($list, 'Get User Success.', 1, 'json'); 
        }
        else{
           $this->ajaxReturn($list, 'Get User Failed.', 200101, 'json');
        }
        
    }

    public function li() {

        $this->isLogin();


        $uid = $this->_param('id');

        if (empty($uid)) {
            $uid = $this -> userID();
        }

        $filter = array();
        $filter['id'] = array('in', $uid);


        $list = D('User') -> simple_list($filter);

        $this->ajaxReturn($list, 'List User Success.', 1, 'json');
    }
    
    
    public function follow() {
        
        $this->isLogin();

        $my_uid = $this->userID();
        $there_uid = $this ->_param('id');

        if (empty($there_uid)) {
            $this->ajaxReturn(null, 'Need id.', 200301, 'json');
        }
        
        if ($there_uid == $my_uid){
            
            $this->ajaxReturn(null, 'Could not follow self.', 200303, 'json');
        }
        
        if (!D('User')->simple('id='.$there_uid)){
            $this->ajaxReturn(null, 'No this One.', 200304, 'json');
        }
        
        
        
        $data = array();
        $data['uid'] = $my_uid;
        $data['friend_uid'] = $there_uid;
        
        if(!M('Relation')->where($data)->find()){
            
            if (!M('Relation')->add($data)){
                $this->ajaxReturn(null, 'Follow Failed.', 200302, 'json');
            }
            
            
        }
        
        $this->ajaxReturn(null, 'Follow Success.', 1, 'json');
        
    }
    
    public function unfollow() {
        
        $this->isLogin();

        $my_uid = $this->userID();
        $there_uid = $this ->_param('id');

        if (empty($there_uid)) {
            $this->ajaxReturn(null, 'Need id.', 200301, 'json');
        }
        
        if ($there_uid == $my_uid || !D('User')->simple('id='.$there_uid) ){
            
            $this->ajaxReturn(null, 'Wrong ID.', 200401, 'json');
        }
        
        $data = array();
        $data['uid'] = $my_uid;
        $data['friend_uid'] = $there_uid;
        
        if(M('Relation')->where($data)->find()){
            
            if (!M('Relation')->delete($data)){
                $this->ajaxReturn(null, 'UnFollow Failed.', 200402, 'json');
            }
            
            
        }
        
        $this->ajaxReturn(null, 'UnFollow Success.', 1, 'json');
        
    }
    
    
    public function friend_list() {
        
        $this->isLogin();

        $uid = $this->_param('id');

        if (empty($uid)) {
            $uid = $this -> userID();
        }

        $friends = M('Relation')->field('friend_uid')->where('uid='.$uid)->select();
        $friendString = '';
        
        foreach ($friends as $value) {
            $friendString = $friendString.$value['friend_uid'];
        }
        
        $filter = array();
        $filter['id'] = array('in', $friendString);
        
        $list = D('User') -> simple_list($filter);

        $this->ajaxReturn($list, 'List Friends Success.', 1, 'json');
        
    }
    

}