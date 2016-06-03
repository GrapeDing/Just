<?php

    header('content-type:text/html;charset=utf-8');
    mysql_set_charset('utf8');
    require_once("config.php");
    
    $link = mysql_connect($localhost,$USERNAME,$DBPASS);
    mysql_query("set names 'utf8'",$link);
    mysql_select_db($DBNAME);
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $alerttime = $_POST['alerttime'];
    $sort = $_POST['sort'];
    $state = $_POST['state'];
    $ring = $_POST['ring'];
    $frequency = $_POST['frequency'];
    
    $sql = "update todolist set title='{$title}',content='{$content}',alerttime=$alerttime,sort=$sort,state=$state,ring=$ring,frequency=$frequency where id=$id";

    $result = mysql_query($sql);
    if ($result) {
        $result = 0;
    }else{
        $result = 1;
    }

    $arr = array(
                'result' => $result
                );
    $strr = json_encode($arr);
    mysql_close($link);
    echo($strr);

?>
