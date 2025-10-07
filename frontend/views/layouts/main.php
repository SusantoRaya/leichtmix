<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use frontend\components\MenuHelper;
use yii\helpers\Url;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Leichtmix Industries</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- Bootstrap Fremwork Main Css -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <!-- All Plugins css -->
    <!-- <link rel="stylesheet" href="css/plugins.css"> -->
    <!-- Theme shortcodes/elements style -->
    <!-- <link rel="stylesheet" href="css/shortcode/shortcodes.css"> -->
    <!-- Theme main style -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <!-- Responsive css -->
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    <!-- User style -->
    <!-- <link rel="stylesheet" href="css/custom.css"> -->

    <!-- Modernizr JS -->
    <!-- <script src="js/vendor/modernizr-3.11.2.min.js"></script> -->
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <!-- Body main wrapper start -->
    <div class="wrapper home-9 wrap__box__style--1">
        <!-- Start Header Style -->
        <header id="header" class="htc-header header--3 bg__white">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                <div class="container-fluid">

                    <div class="row align-items-center">
                        <div class="col-md-2 col-lg-2 col-6">
                            <div class="logo">
                                <a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">
                                    <img src="<?= Yii::getAlias('@web') ?>/images/logo/leichtmix.png"
                                        alt="logo"
                                        class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-10 col-lg-10 d-none d-md-block">
                            <nav class="mainmenu__nav  d-none d-lg-block">
                                <ul class="main__menu">
                                    <li class="drop"><a href="#">Produk</a>
                                        <ul class="dropdown mega_dropdown">

                                            <ul class="mega__item">
                                                <?php foreach (MenuHelper::getModernCategories() as $category): ?>

                                                    <li>
                                                        <a href="<?= Url::to(['product/index', 'category_slug' => $category->slug]) ?>">
                                                            <?= $category->name ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>

                                        </ul>
                                    </li>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['site/about-us']) ?>">Tentang Kami</a></li>

                                    <li class="drop">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/contact-us']) ?>">Hubungi Kami</a>
                                    </li>
                                    <li class="drop">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/certificate']) ?>">Sertifikasi</a>
                                    </li>
                                    <li class="drop">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/project']) ?>">Referensi Proyek</a>
                                    </li>
                                    <li class="drop brochure-btn">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/download-brochure']) ?>"> Unduh Brosur</a>
                                    </li>


                                </ul>
                            </nav>
                            <div class="mobile-menu clearfix d-block d-lg-none">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <li><a href="#">Produk</a>
                                            <ul>
                                                <?php foreach (MenuHelper::getModernCategories() as $category): ?>
                                                    <li>
                                                        <a href="<?= Url::to(['product/index', 'category_slug' => $category->slug]) ?>">
                                                            <?= $category->name ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <li><a href="<?= Yii::$app->urlManager->createUrl(['site/about-us']) ?>">Tentang Kami</a></li>

                                        <li>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/contact-us']) ?>">Hubungi Kami</a>
                                        </li>
                                        <li>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/certificate']) ?>">Sertifikasi</a>
                                        </li>
                                        <li>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/project']) ?>">Referensi Proyek</a>
                                        </li>
                                        <li class="">
                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/download-brochure']) ?>"> <i class="fa-solid fa-download"></i>
                                                Unduh Brosur</a>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Style -->

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="#" method="get">
                                    <input placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->

        </div>
        <!-- End Offset Wrapper -->

        <!-- Start Slider Area -->
        <?php if (Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id == 'index') { ?>
            <?php echo $this->render('home_banner'); ?>
        <?php } ?>
        <!-- Start Slider Area -->

        <div class="page-content">
            <div class="pt--10">

                <?= $content; ?>


                <!-- Start Footer Area -->
                <?= $this->render('footer') ?>
                <!-- End Footer Area -->
            </div>
        </div>
    </div>
    <!-- Body main wrapper end -->
    <a href="https://wa.me/6281908808868" target="_blank" class="whatsapp-float" aria-label="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
