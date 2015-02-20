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
                <p><?php echo /*$link->author,*/ '<span>' . Yii::$app->formatter->asDate($link->timestamp, 'M/d/Y H:i:s') . '</span>' ?></p>
                <p>
                    <?php
                        if (strpos($link->link,'youtu') !== false ) {
                            $startPos = strpos($link->link, '">');
                            $endPos = strpos($link->link, '</a>');

                            echo '<iframe width="420" height="315" src="' . str_replace("watch?v=", "v/", substr($link->link, $startPos+2, $endPos - $startPos-2)) . '" frameborder="0" allowfullscreen></iframe>';
                        } else {
                            echo $link->link;
                        }
                    ?>

                </p>
            </div>
<!-- end post -->

<?php endforeach; ?>
        </div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>