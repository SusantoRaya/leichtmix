<?php

use frontend\components\MenuHelper;
use yii\helpers\Html;

$this->registerCss(
    <<< 'CSS'
    .mx--70{
        margin: 0px 70px;
    }
   
    CSS
);

?>
<footer class="htc__foooter__area bg__theme footer--6">
    <div class="mt-3">

        <div style="background-color: #ecedec;">
            <div class="row justify-content-center align-items-center ptb--30 mx--70">
                <div class="col-12 col-md-4 text-center text-md-start mb-1 order-1">
                    <ul>
                        <li><span class="fw-semibold">Tim Project Broco Aerated:</span></li>
                        <li>Telp: 021-3847089</li>
                        <li>WA: 0851-0038-5015</li>
                        <li>Email: marketingbroco@gmail.com</li>
                    </ul>
                </div>
                <div class="col-12 col-md-4 text-center mb-1 order-3 order-md-2">
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
                <div class="col-12 col-md-4 text-center text-md-end mb-1 order-2 order-md-3">
                    <ul>
                        <li><span class="fw-semibold">Tim Retail Broco Aerated :</span></li>
                        <li>Telp: 021-21201167</li>
                        <li>WA: 0819-0880-8868</li>
                        <li>Email: sales.retail@broco.net</li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- Start Copyright Area -->
        <div class="htc__copyright__area">
            <div class="row mx--70">
                <div class="col-12 col-md-6 text-white text-center text-md-start fs-sm">
                    <div class="ptb--10">
                        <p class="text-white">Copyright © 2025 PT Broco Aerated Concrete Industry. All rights reserved.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-white text-center text-md-end">
                    <div class="ptb--10 ">
                        <img height="20px;" src="<?= Yii::getAlias('@web') ?>/images/favicon.ico" alt="logo" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->
    </div>
</footer>