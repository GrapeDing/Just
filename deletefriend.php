<?php
    header('content-type:text/html;charset=utf-8');
    mysql_set_charset('utf8');
    require_once("config.php");

    $link = mysql_connect($localhost,$USERNAME,$DBPASS);
    mysql_query("set names 'utf8'",$link);
    mysql_select_db($DBNAME);
    
    $id = $_POST['uid'];
    $fuid = $_POST['fuid'];
    
    $sql1 = "update user set fuid = '0' ,chgdata = now() where id = '{$id}' or id = '{$fuid}'";
    $r1 = mysql_query($sql1);
    
    if ($r1 == true)
    {
       $result = 0;
    }
    else
    {
        $result = 1;//NG
    }

    $arr = array(
            'result' => $result
            );
    $strr = json_encode($arr);
    mysql_close($link);
    echo($strr);
?>