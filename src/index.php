<?php
    header("Cache-Control: private, no-cache, no-store, max-age=0, must-revalidate, proxy-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: Tue, 01 Jan 1980 1:00:00 GMT");
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="public/css/normalize.min.css">
        <link rel="stylesheet" href="public/css/main.css">

        <script src="public/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <?php
            echo "Teste 123!!!";
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="public/js/main.js"></script>
    </body>
</html>