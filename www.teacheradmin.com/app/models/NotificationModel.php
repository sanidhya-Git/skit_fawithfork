<?php
class NotificationModel extends Database {
  public function fetch_list_writer_story_data(){
    if($this->Query("SELECT * FROM tbl_writer_stories_info  ORDER BY id DESC")) {
      $data = $this->fetchAll();
      return $data;
    }
  }

  public function MatchstoryToken($story_token, $flag=0) {
    if($this->Query("SELECT * FROM tbl_writer_stories_info WHERE story_token=? AND flag=?", [$story_token, $flag])) {
      if($this->rowCount()>0) {
        return true;
      }else {
        return false;
      }
    }
  }

  public function delete_story_data($token, $story_token){
    if ($this->Query("UPDATE tbl_writer_stories_info SET flag = 1 WHERE story_token =?", [$story_token])) {
      return true;
    } else {
      return false;
    }
  }
  
  public function storyapprove($token, $story_token, $approve_status = 1) {
    if($this->Query("UPDATE tbl_writer_stories_info SET approve_status='$approve_status' WHERE story_token=?", [$story_token])) {
      return true;
    }
  }

  public function storydisapprove($token, $story_token, $approve_status = 0) {
    if($this->Query("UPDATE tbl_writer_stories_info SET approve_status='$approve_status' WHERE story_token=?", [$story_token])) {
      return true;
    }
  }

  public function fetch_list_story_details_data($story_token){
    if($this->Query("SELECT * FROM tbl_writer_stories_info WHERE story_token = ?", [$story_token])) {
      $data = $this->fetchAll();
      return $data;
    }
  }

   public function aviable_story_data_in_table($story_token) {
    if($this->Query("SELECT * FROM tbl_writer_stories_info WHERE story_token=?", [$story_token])) {
      if($this->rowCount()>0) {
        return true;
      }else {
        return false;
      }
    }
  }

  public function add_remark_details($storyid, $writer_token, $story_token, $remark_token, $remark){
    $remark_date = $this->DateFunction('M-d-Y');
    if($this->Query("INSERT INTO tbl_remark_info (storyid, writer_token, story_token, remark_token, remark, remark_date, status, flag) VALUES ('$storyid', '$writer_token', '$story_token', '$remark_token', '$remark', '$remark_date', 1,0)")) {
      return true;
    }else {
      return false;
    }
  }
}
