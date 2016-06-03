<?php
    header('content-type:text/html;charset=utf-8');
    mysql_set_charset('utf8');
    require_once("config.php");

    $link = mysql_connect($localhost,$USERNAME,$DBPASS);
    mysql_query("set names 'utf8'",$link);
    mysql_select_db($DBNAME);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_md5 = md5($password);
    
    $sql1 = "select * from user where ((username = '$username' and password = '$password_md5') or (mobile = '$username' and password = '$password_md5'))";
    $r1 = mysql_query($sql1);
    
    
    if (r1 == true){
        if(mysql_num_rows($r1)){
            $row = mysql_fetch_assoc($r1);
            $result = 0;
            $id = $row['id'];
            $fuid = $row['fuid'];
            $chgdata = $row['chgdata'];
            $sql3 = "UPDATE `user` SET `lastlogin` = now() WHERE `id` = '{$row['id']}'";
            $r3 = mysql_query($sql3);
            
            $sql1 = "select * from user where id = '$fuid'";
            $r1 = mysql_query($sql1);
            $row = mysql_fetch_assoc($r1);
            $mobile = $row['mobile'];
        
        }else{
            $result = 2;//0 OK ,1 NG
        }
    }else{
        $result = 1;
    }
    
    
    $arr = array(
                'result' => $result,
                'id' => $id,
                'fuid'=> $fuid,
                'fmobile'=> $mobile,
                'chgdata'=> empty($chgdata)?'':$chgdata
                );
    $strr = json_encode($arr);
    mysql_close($link);
    echo($strr);
?>