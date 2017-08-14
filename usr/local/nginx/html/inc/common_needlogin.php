<?php
    header("Cache-Control: no-cache, must-revalidate"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    $bizsession = new bizsession();
    $bizsession->setappid($appid);
    $before=$_COOKIE["bizsession_".$appid].""; 
    $remeber=$_COOKIE["bizremember_".$appid].""; 
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

    if (!$bizsession->islogin() || $_GET['relogin']==1)
    {
	if ($remember!="")
	{
		if ($bizsession->login('9^'.$remeber)!=true)
		{
			setcookie("bizremember_".$appid, "", 0);
		}
		else
		{
			setcookie("bizremember_".$appid, $remember, time()+3600*24*365*10);
		}
	}

        if (!$bizsession->islogin() && $bizsession->login('1^'.$_GET['code'])!=true)
        {
            echo '请通过PAS社区微信公众号注册并登录！【<a href="pasreg.php" data-ajax=false>注册步骤说明</a>】';
            exit;
        }
    }
?>
