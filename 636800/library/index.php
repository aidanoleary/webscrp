<?php
    $page_title = "Home";
    $root = SERVER['DOCUMENT_ROOT'];
    $common_folder = $root .= "/636800/common/";
    $header = $common_folder .= "header.php";
    $footer = $common_folder .= "footer.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" Content="text/html; charset=utf-8" />
           <title><?php echo($page_title) ?></title>
    </head>
    <body>
        <?php
            include_once($header);
        ?>

        <div id="page_content">


        </div>

        <?php
            include_once($footer);
        ?>
    </body>
</html>