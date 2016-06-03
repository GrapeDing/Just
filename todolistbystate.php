<?php
    header('content-type:text/html;charset=utf-8');
    @mysql_set_charset('utf8');
    require_once 'config.php';

    $link = mysql_connect($localhost,$USERNAME,$DBPASS);
    mysql_query("set names 'utf8'",$link);
    mysql_select_db($DBNAME);
    
    $uid = $_POST['uid'];
    $state = $_POST['state'];
    
    $sql1 = "select count(*) from todolist where (uid=$uid and state = '$state')";
    $sql2 = "select * from todolist where (uid=$uid and state = '$state') order by sort asc,createtime desc";
    

    $result = mysql_query($sql1);
    $total_num = 0;
    $arr = array();
    $total_num=mysql_result($result,0);
    $arr['total_num'] = $total_num;
    $arr['result'] = 0;
    
    
    if($total_num != 0 ){
        $result = mysql_query($sql2);
        $arr['result'] = 1;// 0 OK,1 NG
        $arrListInfo = array();
        $arr['list'] =$arrListInfo;
    
        $arrListInfoTemp = array();
    
        if($result && mysql_num_rows($result)){
            $arr['result'] = 0;
            while ($row =mysql_fetch_assoc($result)){
                $arrTemp = array(
                    'id' => $row['id'],
                    'together' => $row['together'],
                    'title' => $row['title'],
                    'content' => $row['content'],
                    'createtime' => $row['createtime'],
                    'alerttime' => $row['alerttime'],
                    'sort' => $row['sort'],
                    'state' => $row['state'],
                    'ring' => $row['ring'],
                    'frequency' => $row['frequency']
                );
                $arrListInfoTemp[] = $arrTemp;
    
            }
            $arr['list'] =$arrListInfoTemp;
        }
    }
    
    $strr = json_encode($arr);
    mysql_close($link);
    echo($strr);
    
?>