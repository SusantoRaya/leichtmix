 <!-- Start Bradcaump area -->
 <?php $banner = Yii::$app->banner->getByPage('aboutus'); ?>
 <?php if ($banner): ?>
     <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?= $banner->getImageUrl() ?>) no-repeat scroll center center / cover ;">
         <div class="ht__bradcaump__wrap">
             <div class="container">

             </div>
         </div>
     </div>
 <?php endif; ?>
 <!-- End Bradcaump area -->


 <!-- Start Our Store Area -->
 <section class="htc__store__area ptb--120 bg__white">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="section__title section__title--2 text-center">
                     <h1 class="title__line">TENTANG KAMI</h1>
                     <hr style="border: 1px solid #000;">
                 </div>
             </div>
         </div>

         <div class="py-5">

             <div class="row">
                 <div class="content col-md-4 mb-3">
                     <img width="100%" src="<?= Yii::getAlias('@web') ?>/images/logo/leichtmix.png"
                         alt="logo"
                         class="img-responsive">
                 </div>
                 <div class="content col-md-8">
                     <?= $about->content ?? '' ?> <!-- show formatted HTML -->
                 </div>
             </div>
         </div>


     </div>
 </section>
 <!-- End Our Store Area -->