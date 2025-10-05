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
            <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header pr--60 pl--60">
                <div class="container-fluid">

                    <div class="row align-items-center">
                        <div class="col-md-2 col-lg-2 col-6">
                            <div class="logo">
                                <a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">
                                    <img width="200px" src="<?= Yii::getAlias('@web') ?>/images/logo/leichtmix.png"
                                        alt="logo"
                                        class="img-responsive">
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-10 col-lg-10 d-none d-md-block">
                            <nav class="mainmenu__nav  d-none d-lg-block">
                                <ul class="main__menu">
                                    <li class="drop"><a href="<?= Yii::$app->urlManager->createUrl(['product/index', 'category_slug' => 'all']) ?>">Produk</a>
                                        <ul class="dropdown mega_dropdown">

                                            <ul class="mega__item">
                                                <?php foreach (MenuHelper::getConventionalCategories() as $category): ?>

                                                    <li>
                                                        <a href="<?= Url::to(['product/index', 'category_slug' => $category->slug]) ?>">
                                                            <?= $category->name ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>


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
                                        <a href="<?= Yii::$app->urlManager->createUrl(['site/certificate']) ?>"> Unduh Brosur</a>
                                    </li>


                                </ul>
                            </nav>
                            <div class="mobile-menu clearfix d-block d-lg-none">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <li><a href="index.html">Home</a>
                                            <ul>
                                                <li><a href="index.html">Home 1</a></li>
                                                <li><a href="index-2.html">Home 2</a></li>
                                                <li><a href="index-3.html">Home 3</a></li>
                                                <li><a href="index-4.html">Home 4</a></li>
                                                <li><a href="index-5.html">Home 5</a></li>
                                                <li><a href="index-6.html">Home 6</a></li>
                                                <li><a href="index-7.html">Home 7</a></li>
                                                <li><a href="index-8.html">Home 8</a></li>
                                                <li><a href="index-9.html">Home 9</a></li>
                                                <li><a href="index-10.html">Home 10</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="about.html">About</a></li>

                                        <li><a href="#">pages</a>
                                            <ul>
                                                <li><a href="about.html">about</a></li>
                                                <li><a href="shop.html">shop</a></li>
                                                <li><a href="shop-sidebar.html">shop sidebar</a></li>
                                                <li><a href="product-details.html">product details</a></li>
                                                <li><a href="cart.html">cart</a></li>
                                                <li><a href="wishlist.html">wishlist</a></li>
                                                <li><a href="checkout.html">checkout</a></li>
                                                <li><a href="team.html">team</a></li>
                                                <li><a href="login-register.html">login & register</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">contact</a></li>
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

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
