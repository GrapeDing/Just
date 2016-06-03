<?php

    header('content-type:text/html;charset=utf-8');
    mysql_set_charset('utf8');
    require_once("config.php");
    
    $link = mysql_connect($localhost,$USERNAME,$DBPASS);
    mysql_query("set names 'utf8'",$link);
    mysql_select_db($DBNAME);

    $id = $_POST['id'];
     
    $sql = "DELETE FROM todolist WHERE id = '{$id}'";
    $r = mysql_query($sql);
	$result = 1;
	
   if ($r == true) {
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
