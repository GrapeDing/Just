<?php
    header('content-type:text/html;charset=utf-8');
    mysql_set_charset('utf8');
    require_once ("config.php");

    $link = mysql_connect($localhost, $USERNAME, $DBPASS);
    mysql_query("set names 'utf8'", $link);
    mysql_select_db($DBNAME);
    
    $id = $_POST['uid'];
    $oldpwd = md5($_POST['oldpwd']);
    $newpwd = md5($_POST['newpwd']);
    $result = 1;//0:成功 1:NG
    
    $sql1 = "update user set password = '{$newpwd}' where (id = '$uid' and password = '{$oldpwd}')";
    $r1 = mysql_query($sql1);
    
    if ($r1 == true)
    {
       $result = 0;
    } else  {
        $result = 1;
    }
    
    $arr = array(
            'result' => $result
            );
    $strr = json_encode($arr);
    mysql_close($link);
    echo($strr);
?>
    
