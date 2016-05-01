<?php
    $short_url = $_GET['url'];
    function GetLongUrl($short_url) {
        include 'config.php';
        $db = new PDO('mysql:host=' . $mysql_dbhost . ';dbname=' . $mysql_dbname . ';port=' . $mysql_dbport, $mysql_dbuser, $mysql_dbpassword);
	$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	$db ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC );
	$sql = $db->prepare('SELECT * FROM ' . $mysql_table . ' WHERE short_url = "'.$short_url.'"');
        $sql->execute();
        $res = $sql->fetch(PDO::FETCH_ASSOC);
	    $db = null;
	    return (is_array($res)) ? $res['long_url'] : false;
    }

    $long_url = GetLongUrl($short_url);
    if (!$long_url) exit();
    Header("HTTP/1.1 301 Moved Permanently");
    Header("Location: " . $long_url);
?>
