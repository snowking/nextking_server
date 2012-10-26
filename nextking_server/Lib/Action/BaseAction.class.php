<?php

/**
 * @Date 2012.3.16
 * @File: BaseAction.class.php
 * @Author King
 */
class BaseAction extends Action {

    /**
     * 
     * 初始化
     */
    function _initialize() {

        header("Content-Type:application/json; charset=utf-8");
        $this->autoLogin();
    }

    public function test() {

        $this->ajaxReturn(null, "Hello", 0, 'json');
    }

    public function index() {
        $this->isLogin();
        $this->ajaxReturn(null, 'Yes, you have login', 1, 'json');
    }

    /**
     * 
     * 检查是否登录
     */
    protected function isLogin() {

        if (!session(C('SESSION_AUTH_KEY'))) {
            $this->ajaxReturn(null, 'you are not login', 900001, 'json');
        }
    }
    
    /**
     * 
     * 返回当前用户id
     */
    protected function userID() {

        return cookie(C('COOKIE_USER_ID'));
    }

    /**
     * 
     * 根据cookie自动登录
     */
    protected function autoLogin() {

        if (session(C('SESSION_AUTH_KEY'))) {
            return;
        }

        $name = $id = null;

        if (cookie(C('COOKIE_USER_NAME'))) {
            $name = cookie(C('COOKIE_USER_NAME'));
        }
        if (cookie(C('COOKIE_USER_ID'))) {
            $id = cookie(C('COOKIE_USER_ID'));
        }
        if ($name && $id) {

            $user = M('User');

            $data = array();
            $data['id'] = $id;
            $data['account'] = $name;
            $rs = $user->where($data)
                    ->find();

            if ($rs) {
                session(C('SESSION_AUTH_KEY'), $name);
            } else {
                $this->ajaxReturn(null, 'you are not login', 900001, 'json');
            }
        }
    }

}