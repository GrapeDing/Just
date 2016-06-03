<?php
    header('content-type:text/html;charset=utf-8');
    mysql_set_charset('utf8');
    require_once("config.php");

    $link = mysql_connect($localhost,$USERNAME,$DBPASS);
    mysql_query("set names 'utf8'",$link);
    mysql_select_db($DBNAME);
    
    $uid = $_POST['uid'];
    $mobile = $_POST['mobile'];
    
    $sql1 = "select * from user where mobile = $mobile and fuid = 0";
    $r1 = mysql_query($sql1);
    $result = 1;//0:成功 1:好友已绑定 2:错误
    
    if ($r1 == true)
    {
        if (mysql_num_rows($r1)) {
            $row = mysql_fetch_assoc($r1);
            $fuid = $row['id'];
            $fmobile = $row['mobile'];
            $result = 0;
            if($uid == $row['id']){
                $result = 3;
            }else{
                $sql2 = "update user set fuid = $fuid ,chgdata = now() where id = $uid";
                $r2 = mysql_query($sql2);
                
                $sql3 = "update user set fuid = $uid, chgdata = now() where id = $fuid";
                $r2 = mysql_query($sql3);
            }
        }else{
            $result = 2;
        }      
    }
    else
    {
     $result = 1;
    }
    
    $arr = array(
            'result' => $result,
            'fuid' => $fuid,
            'fmobile' => $fmobile,
            'sql2' => $sql2,
            'sql3' => $sql3
            );
    $strr = json_encode($arr);
    mysql_close($link);
    echo($strr);
?>