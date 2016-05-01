<?php
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Short URL</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dialog.css" rel="stylesheet">
    <script type="text/javascript" src="js/dialog.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>
    function post(URL, PARAMS) {        
        var temp = document.createElement("form");
        temp.action = URL;
        temp.method = "post";
        temp.style.display = "none";
        for (var x in PARAMS) {
            var opt = document.createElement("textarea");
            opt.name = x;
            opt.value = PARAMS[x];
            temp.appendChild(opt);
        }
        document.body.appendChild(temp);
        temp.submit();
        return temp;
    }

    function PostData() {
        $.ajax({
            type: "POST",
            url: "create_url.php",
            data: "long_url=" + $("#long_url").val() + "&short_url=" + $("#short_url").val() + "&password=" + $("#password").val(),
            success: function(msg) {
                if (msg == '1') {
                    $M({
                        title: 'error',
                        content: '短网址长度超出限制',
                        ok: false
                    });
                }
               else if (msg == '2') {
                    $M({
                        title: 'error',
                        content: '短网址已存在',
                        ok: false
                    });
                }
                else {
                    post('shorten/index.php', {long_url: $("#long_url").val(), short_url: msg});
                }
            }
        });
        return false;
    }
</script>
</head>
<body>
<div class="container" style="width: 30%;">

    <div id="main">
        <div id="msg" class="hidden alert alert-warning" role="alert">
        </div>
        <div class="page-header">
            <h1><?php echo $site_title; ?></h1>
        </div>
        <div id="form">
            <form onsubmit="return PostData()">

                <div class="form-group">
                    <label for="long_url">URL</label>
                    <input id="long_url" type="text" name="long_url" autofocus="autofocus" required="required" placeholder="Paste your long URL here" class="form-control">
                </div>

                <div class="form-group">
                    <label for="short_url">Custom short URL</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic_addon1"><?php echo $site_url;?></span>
                        <input id="short_url" type="text" name="short_url" class="form-control" aria-describedby="basic_addon1">
                    </div>
                    <p class="help-block">*Leave it blank if you want a random one.</p>
                    <p class="help-block">*Custom short URL should have no more than 20 characters.
                </div>

                <div class="form-group">
                    <label for "password">Password</label>
                    <input id="password" type="text" name="password" class="form-control">
                    <p class="help-block">*Leave it blank if you don't want to delete the short url.</p>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        <div id="result" style="visibility: hidden;">
            <div><input type="url" name="shorten-url" value="" id="shorten"></div>
        </div>
    </div>

</div>

<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
