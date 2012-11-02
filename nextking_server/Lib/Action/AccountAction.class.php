<?php

/**
 * @Date 2012.3.16
 * @File: AccountAction.class.php
 * @Author King
 */
class AccountAction extends BaseAction {

    /**
     * 
     * 初始化
     */
    function _initialize() {

        header("Content-Type:application/json; charset=utf-8");
    }

    /**
     * 
     * 登录接口
     */
    public function login() {

        $account = $this->_param('account');
        $password = $this->_param('password');

        if (empty($account) || empty($password)) {
            $this->ajaxReturn(null, 'Need account and password.', 100101, 'json');
        }

        $loginOk = false;

        $data = array();
        $data['account'] = $account;
        $data['password'] = md5($password);

        $rs = M('User')->field(array('id', 'name', 'search_key', 'sign', 'avatar', 'gender', 'company', 'city', 'location', 'mobile', 'email', 'birthday'))->where($data)->find();

        if ($rs) {
            $loginOk = true;
        } else {
            $this->ajaxReturn(null, 'Wrong Account or Password.', 100102, 'json');
        }

        if ($loginOk) {

            cookie(C('COOKIE_USER_NAME'), $account, 60 * 60 * 24 * 7);
            cookie(C('COOKIE_USER_ID'), $rs['id'], 60 * 60 * 24 * 7);
            session(C('SESSION_AUTH_KEY'), $account);

            $this->ajaxReturn($rs, 'Login OK', 1, 'json');
        } else {
            $this->ajaxReturn(null, 'Login Failed.', 100103, 'json');
        }
    }

    /**
     * 
     * 注销接口
     */
    public function logout() {

        session(C('SESSION_AUTH_KEY'), null);
        session_destroy();

        cookie(C('COOKIE_USER_NAME'), null);
        cookie(C('COOKIE_USER_ID'), null);

        $this->ajaxReturn(null, 'Logout Success', 1, 'json');
    }

    /**
     * 
     * 用户注册接口
     */
    public function register() {

        $account = $this->_param('account');
        $name = $this->_param('name');
        $password = $this->_param('password');




//        if ((str_len($name) < 5) || (str_len($name) > 20)) {
//            $this->ajaxReturn(null, '用户名长度错误，长度必须是5-20位', 0, 'json');
//        }
//
//        if (!preg_match("/^[0-9a-zA-Z]{6,16}$/", $password)) {
//            $this->ajaxReturn(null, '密码不能含有特殊字符，长度必须是6-16位', 0, 'json');
//        }
//
//        if ($password != $rePassword) {
//            $this->ajaxReturn(null, '两次输入的密码必须一致', 0, 'json');
//        }




        if (empty($name) || empty($password) || empty($account)) {
            $this->ajaxReturn(null, 'Need Name, Password and Account', 100301, 'json');
        }
        $tempAccount = M('User');

        $cdata = array();
        $cdata['account'] = $account;
        if ($tempAccount->where($cdata)->find()) {
            $this->ajaxReturn(null, 'Account Already Exist', 100302, 'json');
        }

        $arr = array();
        $arr['account'] = $account;
        $arr['name'] = $name;
        $arr['password'] = md5($password);
        $arr['create_time'] = time();
        $arr['create_ip'] = get_client_ip();

        $nowAccount = M('User')->add($arr);
        
        $filter = array();
        $filter['id'] = $nowAccount;
        
        if ($nowAccount) {
            session(C('SESSION_AUTH_KEY'), $account);
            $this->ajaxReturn(D('User')->full($filter), 'Register Success', 1, 'json');
        } else {
            $this->ajaxReturn(null, 'Register Failed', 100303, 'json');
        }
    }
}