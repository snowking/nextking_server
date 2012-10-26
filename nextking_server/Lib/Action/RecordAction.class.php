<?php

class RecordAction extends BaseAction {
    
    
    
    // 文件上传
    protected function _upload() {
        import('@.ORG.UploadFile');
        //导入上传类
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize            = 3292200;
        //设置上传文件类型
        $upload->allowExts          = explode(',', 'jpg,gif,png,jpeg');
        //设置附件上传目录
        $upload->savePath           = getUploadPath();
        //设置需要生成缩略图，仅对图像文件有效
        $upload->thumb              = true;
        // 设置引用图片类库包路径
        $upload->imageClassPath     = '@.ORG.Image';
        //设置需要生成缩略图的文件后缀
        $upload->thumbPrefix        = 'm_,s_';  //生产2张缩略图
        //设置缩略图最大宽度
        $upload->thumbMaxWidth      = '120,2048';
        //设置缩略图最大高度
        $upload->thumbMaxHeight     = '120,2048';
        //设置上传文件规则
        $upload->saveRule           = 'uniqid';
        //删除原图
        $upload->thumbRemoveOrigin  = false;
        if (!$upload->upload()) {
            //捕获上传异常
            
            $this->ajaxReturn(null, error($upload->getErrorMsg()), 300101, 'json');
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();
            import('@.ORG.Image');
            //给m_缩略图添加水印, Image::water('原文件名','水印图片地址')
            //Image::water($uploadList[0]['savepath'] . 'm_' . $uploadList[0]['savename'], APP_PATH.'Tpl/Public/Images/logo.png');
            $_POST['image'] = $uploadList[0]['savename'];
            
            $data = array();
            $data['type'] = 'picture';
            $data['title'] = $_POST['image'];
            $data['picture'] = getShowPath() . $uploadList[0]['savename'];
            $data['thumbnail'] =  getShowPath() . 'm_' . $uploadList[0]['savename'];

            $attachment_id = M('Attachment')->add($data);
            
            
            return $attachment_id;
        }

    }
    

    public function add() {

        $this->isLogin();
        $uid = $this->userID();

        $title = $this->_param('title');
        $content = $this->_param('content');
        $parent_id = $this->_param('parent_id');
        
        $attachment_id = null;
        
        if (!empty($_FILES)) {
            //如果有文件上传 上传附件
            $attachment_id = $this->_upload();
        }
    
       
        $arr = array();
        $arr['uid'] = $uid;
        $arr['title'] = $title;
        $arr['content'] = $content;
        $arr['client'] = getClient($_SERVER["HTTP_USER_AGENT"]);
        $arr['parent_id'] = $parent_id;
        $arr['create_time'] = time();

        $record_id = M('Record')->add($arr);
        
        
        if ($attachment_id){
            
            $randa = array();
            $randa['record_id'] = $record_id;
            $randa['att_id'] = $attachment_id;
            
            M('Randa')->add($randa);
        }

        $this->ajaxReturn(D('Record')->full('id=' . $record_id), 'Add Record Success.', 1, 'json');
    }

    public function user_list() {

        $this->isLogin();

        $uid = $this->_param('id');
        $offset = $this->_param('offset');
        $size = $this->_param('size');

        if (empty($uid)) {
            $uid = $this->userID();
        }
        if (empty($offset)){
            $offset = 0;
        }
        if (empty($size)){
            $size = 15;
        }

        
        $sets = array();
        $sets['values'] = D('Record')->user_list($uid, $offset, $size);

        $this->ajaxReturn($sets, 'List Feed Success.', 1, 'json');
    }
    
    
    public function wiki_list() {

        $this->isLogin();

        if (empty($offset)){
            $offset = 0;
        }
        if (empty($size)){
            $size = 15;
        }

        
        $sets = array();
        $sets['values'] = D('Record')->user_list($uid, $offset, $size);

        $this->ajaxReturn($sets, 'List Wiki Success.', 1, 'json');
    }

}