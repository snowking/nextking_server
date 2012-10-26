<?php

/**
 * @Date 2012.3.12
 * @File: ImageAction.class.php
 * @Author King
 */
class ImageAction extends BaseAction {

    /**
     * 
     * 上传图片接口
     */
    public function test() {

        $this->ajaxReturn(null, "Hello", 0, 'json');
    }

    /**
     * 
     * 获取图片信息
     */
    public function listall() {
        $this->isLogin();
        $list =  M('User')->select();
   
        $this->ajaxReturn($list, 'You come here', 1, 'json');
    }

//    public function push() {
//
//        $this->isLogin();
//
//        import("ORG.Net.UploadFile");
//
//        $upload = new UploadFile();
//
//        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
//        $upload->savePath = getUploadPath();
//        $upload->saveRule = 'uniqid';
//        $upload->thumb = true;
//        $upload->thumbMaxWidth = "120,2048";
//        $upload->thumbMaxHeight = "120,2048";
//
//        if ($upload->upload()) {
//
//            $info = $upload->getUploadFileInfo();
//
//            $thumb = $upload->thumbPrefix;
//
//            $data['uid'] = getUid();
//            $data['title'] = $info[0]['name'];
//            $data['create_time'] = time();
//            $data['url'] = getShowPath() . $info[0]['savename'];
//            $data['thumb_url'] = getShowPath() . $thumb . $info[0]['savename'];
//            $data['filesize'] = $info[0]['size'];
//            $data['state'] = 1;
//
//            $img = M('Image');
//            $change['state'] = 0;
//            $img->where('title="' . $info[0]['name'] . '" and state="1"')
//                    ->save($change);
//
//            if ($imgid = $img->add($data)) {
//                $data['id'] = $imgid;
//
//                $this->ajaxReturn($data, '成功上传文件 ', 1, 'json');
//            } else {
//                $this->ajaxReturn(null, '上传文件出错！', 0, 'json');
//            }
//        } else {
//            $this->ajaxReturn(null, $upload->getErrorMsg(), 0, 'json');
//        }
//    }

    /**
     * 
     * 获取图片信息
     */
    public function pull() {

        
        $this->isLogin();
        
        $uid = $this->_param['uid'];
        $offset = $this->_param['offset'];
        $size = $this->_param['size'];
        $state = $this->_param['state'];
        
        if (empty($uid)) {
            $uid = cookie(C('COOKIE_USER_ID'));
        }

        if (empty($offset)) {
            $offset = 0;
        }

        if (empty($size)) {
            $size = 1;
        }

        if (empty($state)) {
            $state = 0;
        }
        
        $images = M('Image')->where('uid='.$uid)->select();
        $user = M('User')->where('id='.$uid)->find();

        foreach ($images as $key => $image) {
            $images[$key]['user'] = $user;
        }
        
        
        $list = D('Imageview')->where('User.id='.$uid)->select();
        
        
        $this->ajaxReturn($list, 'list image succeed', 1, 'json');
    }

}