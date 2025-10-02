<?php

use frontend\components\MenuHelper;
use yii\helpers\Html;
?>
<footer class="htc__foooter__area bg__theme footer--6">
    <div class="mt-3">

        <div style="background-color: #ecedec;">
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
                            <p>© 2025 Leichtmix Electrical. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->
    </div>
</footer>