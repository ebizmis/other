<?php
    header("Cache-Control: no-cache, must-revalidate"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    $bizsession = new bizsession();
    $bizsession->setappid($appid);
    $before=$_COOKIE["bizsession_".$appid].""; 
    $str = $bizsession->initialize($before);
    $after=$str; 
    setcookie("bizsession_".$appid, $str, 0);
    $bizsession->sethost($_SERVER['SERVER_NAME']);
    $bizsession->setport($_SERVER["SERVER_PORT"]);
    $bizsession->setquery($_SERVER["QUERY_STRING"]);
    if ($_SERVER["SERVER_PORT"]=80)
    {
        $bizsession->setpath('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]); 
    }
    else if ($_SERVER["SERVER_PORT"]=443)
    {
        $bizsession->setpath('https://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]); 
    }
    else
    {
        $bizsession->setpath('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]); 
    }
?>
