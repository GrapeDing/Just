<?php
    header('content-type:text/html;charset=utf-8');
    mysql_set_charset('utf8');
    require_once("config.php");
    
    $link = mysql_connect($localhost,$USERNAME,$DBPASS);
    mysql_query("set names 'utf8'",$link);
    mysql_select_db($DBNAME);
    
    $together = $_POST['together'];
    $uid = $_POST['uid'];
    $title = $_POST['title'];
    $content = $_POST['content'];
   // $createtime = $_POST['createtime'];
    $alerttime = $_POST['alerttime'];
    $createtime = $alerttime;
    $sort = $_POST['sort'];
    $createid = $_POST['createid'];
    $state = $_POST['state'];
    $ring = $_POST['ring'];
    $frequency = $_POST['frequency'];

    
    if($together == 1){
        $sql = "insert into todolist(uid,together,title,content,createtime,alerttime,sort,createid,state,ring,frequency) values($uid,$together,'{$title}','{$content}',$createtime,$alerttime,$sort,$uid,$state,$ring,$frequency)";
        $r = mysql_query($sql);
    }else if($together == 2){
        $sql = "insert into todolist(uid,together,title,content,createtime,alerttime,sort,createid,state,ring,frequency) values($uid,$together,'{$title}','{$content}',$createtime,$alerttime,$sort,$uid,$state,$ring,$frequency)";
        $r = mysql_query($sql);
        
        $sql = "insert into todolist(uid,together,title,content,createtime,alerttime,sort,createid,state,ring,frequency) values($createid,$together,'{$title}','{$content}',$createtime,$alerttime,$sort,$uid,$state,$ring,$frequency)";
        $r = mysql_query($sql);
    }else{
        $sql = "insert into todolist(uid,together,title,content,createtime,alerttime,sort,createid,state,ring,frequency) values($createid,$together,'{$title}','{$content}',$createtime,$alerttime,$sort,$uid,$state,$ring,$frequency)";
        $r = mysql_query($sql);
    }
    
    if ($r) {
        $result = 0;
    }else{
        $result = 1;
    }

    $arr = array(
                'result' => $result,
                'id' => mysql_insert_id()
                );
    $strr = json_encode($arr);
    mysql_close($link);
    echo($strr);

?>
