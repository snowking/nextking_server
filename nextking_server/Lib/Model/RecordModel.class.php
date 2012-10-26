<?php

class RecordModel extends Model {

    public function simpleField() {
        return array('id', 'uid', 'content');
    }

    public function fullField() {
        return array('id', 'parent_id', 'uid', 'title', 'content', 'client', 'create_time');
    }

    public function full($filter) {


        $record = $this->field($this->fullField())->where($filter)->find();
        $user = D('User')->simple('id=' . $record['uid']);
        $record['user'] = $user;
        unset($record['uid']);


        $attachments = $this->getAttachments($record['id']);
        if ($attachments) {
            $record['attachments'] = $attachments;
        }

        return $record;
    }

    public function full_list($filter) {

        return $this->field($this->fullField())->where($filter)->select();
    }

    public function simple($filter) {

        return $this->field($this->simpleField())->where($filter)->find();
    }

    public function simple_list($filter) {

        return $this->field($this->simpleField())->where($filter)->select();
    }

    public function getAttachments($record_id) {

        $attachments = M('Randa')->field('att_id')->where('record_id=' . $record_id)->select();
        if ($attachments) {
            $attString = '';

            foreach ($attachments as $value) {
                $attString = $attString . $value['att_id'];
            }

            $filter = array();
            $filter['id'] = array('in', $attString);
            $list = D('Randa')->simple_list($filter);
            return $list;
        }
        return null;
    }

    public function user_list($uid, $offset, $size) {

        $user = D('User')->simple('id=' . $uid);

        $records = $this->field($this->fullField())->where('uid=' . $uid)->limit($offset . ',' . $size)->select();

        foreach ($records as $key => $record) {

            $records[$key]['user'] = $user;
            unset($records[$key]['uid']);

            $attachments = $this->getAttachments($record['id']);
            if ($attachments) {
                $records[$key]['attachments'] = $attachments;
            }
        }


        return $records;
    }

}