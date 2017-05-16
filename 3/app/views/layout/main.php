<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?=ASSETS_WEB_PATH;?>/style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
    <?php if (!\App::request()->getIsHomePage()): ?>
        <div class="panel">
            <a class="go-home" href="<?=\App::request()->goBack();?>">< Go back</a>
        </div>
    <?php endif; ?>
        <div class="container">
            <?=$content;?>
        </div>
    </body>
</html>