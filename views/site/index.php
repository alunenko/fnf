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


<?php foreach ($links as $index=>$link): ?>

<!-- post -->
            <div id="<?php echo 'post'.$index ?>" style="
    margin-bottom: 50px;
    border-bottom: 1px solid;
    padding-bottom: 25px;
">
                <p><?php echo Yii::$app->formatter->asDate($link->timestamp, 'M/d/Y H:i:s') ?></p>
                <p>
                    <?php /*check from scratch to 1/26/2015 12:21:29 */
                        if (strpos($link->link, 'youtube') !== false ) {

                            $startPos = strpos($link->link, '">');
                            $endPos = strpos($link->link, '</a>');

                            if (strpos(substr($link->link, $startPos+2, $endPos - $startPos-2), '?feature=') == true) {
                                $rrr = substr($link->link, $startPos+2, $endPos - $startPos-2);
                                $zzz = str_replace("watch?feature=player_embedded", "", $rrr);
                                $zzz1 = str_replace("&", "", $zzz);
                                $zzz2 = str_replace("amp;v=", "v/", $zzz1);

                                echo '<iframe width="420" height="315" src="' . $zzz2 . '" frameborder="0" allowfullscreen></iframe>';
                            } else if (strpos($link->link, '<ss ') == true) {
                                $firstIter = strpos($link->link, '<a');
                                $eee = substr($link->link, $firstIter+9);
                                $secondIter = strpos($eee, '">h');
                                $yyy = substr($eee, 0, $secondIter);

                                echo '<iframe width="420" height="315" src="' . str_replace("watch?v=", "v/", $yyy) . '" frameborder="0" allowfullscreen></iframe>';
                            } else {
                                echo '<iframe width="420" height="315" src="' . str_replace("watch?v=", "v/", substr($link->link, $startPos+2, $endPos - $startPos-2)) . '" frameborder="0" allowfullscreen></iframe>';
                            }
                        } else if (strpos($link->link, 'youtu.') !== false ) {
                            $startPos = strpos($link->link, '.be/')+4;
                            $cutFirstPart = substr($link->link, $startPos);
                            $endPos = strpos($cutFirstPart, '">');
                            $youTubeShortHash = substr($cutFirstPart, 0, $endPos);

                            echo '<iframe width="420" height="315" src=https://www.youtube.com/embed/' . $youTubeShortHash . ' frameborder="0" allowfullscreen></iframe>';
                        } /*else if (strpos($link->link, 'vk.com') !== false ) {
                            $startPos = strpos($link->link, 'href="');
                            $endPos = strpos($link->link, '">', $startPos+strlen('href="'));
                            $vk = substr($link->link, $startPos+strlen('href="'), $endPos - ($startPos+strlen('href="')));

                            echo '<video controls="" name="media"><source src="' . $vk . '" type="video/mp4"></video>';
                        }*/ else if ((strpos($link->link, 'jpg') !== false) || (strpos($link->link, 'gif') !== false) || (strpos($link->link, 'jpeg') !== false) || (strpos($link->link, 'png') !== false) || (strpos($link->link, 'vk.com/doc') !== false)) {
                            /* TODO: check this timestamp 2/10/2015 18:04:04 and 2/10/2015 16:48:04 and 1/27/2015 10:15:00 */
                            $startPos = strpos($link->link, '">');
                            $endPos = strpos($link->link, '</a>');

                            $file = substr($link->link, $startPos+2, $endPos - $startPos-2);
                            $file_headers = @get_headers($file);
                            if(($file_headers[0] == 'HTTP/1.1 404') || ($file_headers[0] == 'HTTP/1.1 302 Moved Temporarily')) {
                                echo '404';
                            }
                            else {
                                if (strpos(substr($link->link, $startPos+2, $endPos - $startPos-2), 'gifv') == true) {
                                    echo '<img src="'. str_replace("gifv", "gif", substr($link->link, $startPos+2, $endPos - $startPos-2)) . '"/>';   
                                } else if (strpos(substr($link->link, $startPos+2, $endPos - $startPos-2), 'dropbox') == true) {
                                    $dropbox = substr($link->link, $startPos+2, $endPos - $startPos-2);
                                    echo '<a style="font-size: 40px; word-break: break-all;" href="' . $dropbox . '" target="_blank">'. $dropbox . '</a>';
                                } else if (strpos($link->link, 'href') == false) {
                                    if (strpos($link->link, 'jpg') == true) {
                                        $endPos = strpos($link->link, '.jpg');
                                        echo '<img style="max-width: 100%;" src="'. substr($link->link, 0, $endPos+4) . '"/>';
                                    } else if (strpos($link->link, 'jpeg') == true) {
                                        $endPos = strpos($link->link, '.jpeg');
                                        echo '<img style="max-width: 100%;" src="'. substr($link->link, 0, $endPos+5) . '"/>';
                                    } else if (strpos($link->link, 'gif') == true) {
                                        $endPos = strpos($link->link, '.gif');
                                        echo '<img style="max-width: 100%;" src="'. substr($link->link, 0, $endPos+4) . '"/>';
                                    } else if (strpos($link->link, 'png') == true) {
                                        $endPos = strpos($link->link, '.png');
                                        echo '<img style="max-width: 100%;" src="'. substr($link->link, 0, $endPos+4) . '"/>';
                                    } else {
                                        echo 'TODO: add new image checker';
                                    }
                                } else {
                                    echo '<img style="max-width: 100%;" src="'. substr($link->link, $startPos+2, $endPos - $startPos-2) . '"/>';
                                }
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
                        }*/ /*else if (RUTUBE) {
                            <iframe width="720" height="405" src="//rutube.ru/play/embed/7477613" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>
                        }*/
                        else if (strpos($link->link, '9gag') !== false ) {
                            $startPos = strpos($link->link, 'href="');
                            $endPos = strpos($link->link, '">', $startPos+strlen('href="'));
                            $usualLink = substr($link->link, $startPos+strlen('href="'), $endPos - ($startPos+strlen('href="')));

                            echo '<video controls="" name="media"><source src="' . $usualLink . '" type="video/mp4"></video>';
                        } else {
                            $startPos = strpos($link->link, 'href="');
                            $endPos = strpos($link->link, '">', $startPos+strlen('href="'));
                            $usualLink = substr($link->link, $startPos+strlen('href="'), $endPos - ($startPos+strlen('href="')));

                            echo '<a style="font-size: 40px; word-break: break-all;" href="' . $usualLink . '" target="_blank">'. $usualLink . '</a>';
                        }
                    ?>

                </p>
            </div>
<!-- end post -->

<?php endforeach; ?>
        </div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>