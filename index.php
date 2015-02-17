<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <title>FNF</title>
</head>
    <body>
        <div style="
    width: 960px;
    margin: 0 auto;
">
            <div style="
    margin-bottom: 50px;
    border-bottom: 1px solid;
    padding-bottom: 25px;
">
                                <?php 
                    $urlImage = 'https://pp.vk.me/c421817/v421817939/2973/Hul7Yy2D9UQ.jpg';
                    $img_name = time().".jpg";
                    file_put_contents('images/'.$img_name, file_get_contents($urlImage));

                ?>
                <p>posted <span><?php echo date('m/d/Y h:i:s') ?></span></p>
                <img src="<?php echo 'images/'.$img_name ?>" alt="img">
            </div>

            <div style="
    margin-bottom: 50px;
    border-bottom: 1px solid;
    padding-bottom: 25px;
">
<p>posted <span><?php echo date('m/d/Y h:i:s') ?></span></p>
<iframe width="420" height="315" src="https://www.youtube.com/embed/sVby7a2dpr8" frameborder="0" allowfullscreen></iframe>
            </div>

            
        </div>
    </body>
</html>