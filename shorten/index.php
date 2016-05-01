<?php
    $short_url = $_POST['short_url'];
    $long_url = $_POST['long_url'];
    include 'phpqrcode/qrlib.php';
    include '../config.php';
    QRcode::png($site_url . $short_url, "../img/" . md5($short_url) . ".png", "H", 10, 4);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shorten result</title>
    <meta name="description" content="Shorten result" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Begin page content -->
<div class="container">

    <div id="main">
        <div class="page-header">
            <h1> Shorten Result </h1>
        </div>
        <div id="shorten-page">
            <div id="result" class="result" >

                <input type="url" name="shorten-url" value="<?php echo $site_url . $short_url; ?>" id="shorten" autofocus="autofocus" class="form-control" style="margin-left:auto;margin-right:auto;margin-bottom:10%">

                <a href="<?php echo $site_url . "img/" . md5($short_url). ".png" ?>" class="thumbnail" style="margin-left:auto;margin-right:auto">
                    <img src="<?php echo $site_url . "img/" . md5($short_url). ".png" ?>">
                </a>
            </div>
        </div>

    </div>

</div>

<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script src="jquery.qrcode.min.js"></script>

</body>
</html>
