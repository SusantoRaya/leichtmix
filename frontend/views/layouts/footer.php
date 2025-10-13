<?php

use frontend\components\MenuHelper;
use yii\helpers\Html;
?>
<footer class="htc__foooter__area bg__theme footer--6">
    <div class="mt-3">

        <div style="background-color: #ecedec;">
            <div class="row justify-content-center align-items-center p-3">
                <div class="col-md-12 col-lg-12 text-center">
                    <div class="logo">
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">
                            <img width="200px" src="<?= Yii::getAlias('@web') ?>/images/logo/leichtmix.png"
                                alt="logo"
                                class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
            <ul class="social__icon ptb--20">
                <?php $links = MenuHelper::getSosmed(); ?>

                <?php foreach ($links as $link): ?>

                    <li>
                        <a href="<?= $link->url ?>" target="_blank">
                            <?php if ($link->icon): ?>
                                <i class="<?= $link->icon ?>"></i>
                            <?php else: ?>
                                <?= Html::encode($link->name) ?>
                            <?php endif; ?>
                        </a>
                    </li>

                <?php endforeach; ?>

            </ul>
        </div>
        <!-- Start Copyright Area -->
        <div class="htc__copyright__area">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="copyright__inner">
                        <div class="copyright">
                            <p>© 2025 Broco Aerated Concrete Industry. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->
    </div>
</footer>