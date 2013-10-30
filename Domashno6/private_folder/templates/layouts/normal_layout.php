<!DOCTYPE html>
<html>
    <head>
        <title><?= $data['title']; ?></title>
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <meta charset="UTF-8">       
    </head>
    <body>
        <div id="header">
            <?php
            include $data['header'];
            ?>
        </div>
        <div id="content">
            <?php
            include $data['content'];
            ?>
        </div>
    </body>
</html>
