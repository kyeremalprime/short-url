<?php
/*error_code & details*/
//1: length of short url limit excepted
/*2: short url already exist*/

    function JudgeShortUrl($short_url) {
        include 'config.php';
        $db = new PDO('mysql:host=' . $mysql_dbhost . ';dbname=' . $mysql_dbname . ';port=' . $mysql_dbport, $mysql_dbuser, $mysql_dbpassword);
	$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	$db ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC );
	$sql = $db->prepare('SELECT * FROM ' . $mysql_table . ' WHERE short_url = "'.$short_url.'"');
        $sql->execute();
        $res = $sql->fetch(PDO::FETCH_ASSOC);
	$db = null;
	return (is_array($res)) ? true : false;
    }
    
	function InsertUulinfo($long_url, $short_url, $password) {
		include 'config.php';
        $db = new PDO('mysql:host=' . $mysql_dbhost . ';dbname=' . $mysql_dbname . ';port=' . $mysql_dbport, $mysql_dbuser, $mysql_dbpassword);
		$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		$db ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC );
		$sql_sent = "insert into " . $mysql_table . " ( long_url, short_url, password ) values ( '".$long_url."', '".$short_url."', '".$password."' );";
		$db ->exec($sql_sent);
		$db = null;
	}

    function GetRandomString($length) {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;
        for($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)];
        }
        return $str;
    }

    function GetRand($length) {
        for ($str = GetRandomString($length); JudgeShortUrl($str); $str = GetRandomString($length));
        return $str;
    }

    $long_url = $_POST['long_url'];
    $short_url = $_POST['short_url'];
    $password = $_POST['password'];
    if (strlen($short_url) == 0) $short_url = GetRand(8);
    if (strlen($short_url) > 20) die('1');
    if (JudgeShortUrl($short_url)) die('2');
    InsertUulinfo($long_url, $short_url, $password);
    die($short_url);
?>
