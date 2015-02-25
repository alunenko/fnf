<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
$this->title = 'Fun/news feed';
?>
<!-- wrapper -->
        <div style="
    width: 960px;
    margin: 0 auto;
">


<?php foreach ($links as $link): ?>

<!-- post -->
            <div style="
    margin-bottom: 50px;
    border-bottom: 1px solid;
    padding-bottom: 25px;
">
                <p><?php echo Yii::$app->formatter->asDate($link->timestamp, 'M/d/Y H:i:s') ?></p>
                <p>
                    <?php
                        if (strpos($link->link, 'youtu') !== false ) {
                            $startPos = strpos($link->link, '">');
                            $endPos = strpos($link->link, '</a>');

                            echo '<iframe width="420" height="315" src="' . str_replace("watch?v=", "v/", substr($link->link, $startPos+2, $endPos - $startPos-2)) . '" frameborder="0" allowfullscreen></iframe>';
                        } else if ((strpos($link->link, 'jpg') !== false) || (strpos($link->link, 'gif') !== false) || (strpos($link->link, 'jpeg') !== false) || (strpos($link->link, 'png') !== false) || (strpos($link->link, 'vk.com/doc') !== false)) {
                            $startPos = strpos($link->link, '">');
                            $endPos = strpos($link->link, '</a>');

                            $file = substr($link->link, $startPos+2, $endPos - $startPos-2);
                            $file_headers = @get_headers($file);
                            if(($file_headers[0] == 'HTTP/1.1 404') || ($file_headers[0] == 'HTTP/1.1 302 Moved Temporarily')) {
                                echo '404';
                            }
                            else {
                                $startPos = strpos($link->link, '">');
                                $endPos = strpos($link->link, '</a>');
                                echo '<img src="'. substr($link->link, $startPos+2, $endPos - $startPos-2) . '"/>';   
                            }
                        } else if (strpos($link->link, 'coub') !== false) {
                            $startPos = strpos($link->link, '">');
                            $endPos = strpos($link->link, '</a>');
                            $coubLink = substr($link->link, $startPos+2, $endPos - $startPos-2);

                            $startPos = strpos($coubLink, 'view/');
                            $endPos = strlen($coubLink);
                            $coubLink = substr($coubLink, $startPos+5, $endPos);

                            echo '<iframe src="//coub.com/embed/' . $coubLink . '?muted=false&autostart=false&originalSize=false&hideTopBar=false&startWithHD=false" allowfullscreen="true" frameborder="0" width="640" height="360"></iframe>';
                        } /*else if (strpos($link->link, 'facebook') !== false) {
                            $startPos = strpos($link->link, 'v=');
                            $endPos = strpos($link->link, '&');
                            $facebook = substr($link->link, $startPos+2, $endPos - $startPos-2);

                            echo $facebook;

                            echo '<object width="400" height="224" > 
                             <param name="allowfullscreen" value="true" /> 
                             <param name="allowscriptaccess" value="always" /> 
                             <param name="movie" value="http://www.facebook.com/v/xxx" /> 
                             <embed src="http://www.facebook.com/video.php?v=' . $facebook . '" type="application/x-shockwave-flash"  
                               allowscriptaccess="always" allowfullscreen="true" width="400" height="224"> 
                             </embed> 
                            </object>';
                        }*/ else {
                            $startPos = strpos($link->link, 'href="');
                            $endPos = strpos($link->link, '">', $startPos+strlen('href="'));
                            $usualLink = substr($link->link, $startPos+strlen('href="'), $endPos - ($startPos+strlen('href="')));
                            echo '<a style="font-size: 40px" href="' . $usualLink . '">'. $usualLink . '</a>';
                        }
                    ?>

                </p>
            </div>
<!-- end post -->

<?php endforeach; ?>
        </div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>