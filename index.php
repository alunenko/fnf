<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <title>FNF</title>
</head>
    <body>

    <!-- primitive, prototype, crutch logic... chaotic things -> from my head to code -->
    <?php
        $handle = @fopen("output.csv", "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                #echo $buffer;
                $res[] = explode(",", $buffer);
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }

        foreach ($res as $str => $value) {
            foreach ($value as $item => $itemVal) {
                if (strpos($itemVal, 'youtu') !== false) {
                    #print_r($value);die('123');
                    $pubdate = date("m/d/Y h:m:s", substr($value[1], 1, -1));

                    $startPos = strpos($itemVal, 'http', 20);
                    $endPos = strpos($itemVal, '</a>');
                    
                    $youtubeLinks[] = str_replace("watch?v=", "v/", substr($itemVal, $startPos, $endPos - $startPos));
                } else {
                    $otherLinks[] = $itemVal;
                }
            }
        }
    ?>

<!-- wrapper -->
        <div style="
    width: 960px;
    margin: 0 auto;
">


<!-- post -->
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
<!-- end post -->

<!-- post -->
    <?php
            echo '<div style="
    margin-bottom: 50px;
    border-bottom: 1px solid;
    padding-bottom: 25px;
">';
        foreach ($youtubeLinks as $link => $linkVal) {
            echo '<p>posted <span>' . $pubdate . '</span></p><iframe width="420" height="315" src="' . $linkVal . '" frameborder="0" allowfullscreen></iframe>';
        }
            echo '</div>';
    ?>
<!-- end post -->

            
        </div>
    </body>
</html>