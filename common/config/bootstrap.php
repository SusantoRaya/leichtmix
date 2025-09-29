
<?php
Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/uploads'); // filesystem base
Yii::setAlias('@bannerPath', Yii::getAlias('@uploads') . '/banner'); // physical path to banner images

// @bannerUrl is no longer used (we build URLs dynamically in Banner model)
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
