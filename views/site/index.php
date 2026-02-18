<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->registerJsFile("js/site.js");

?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12 mb-3">
                <?= Html::input("url", "url", null, ['id' => 'url', 'placeholder' => 'Введите адрес сайта']) ?>
                <?= Html::button("ok", ['onclick' => 'validateAndProceedUrl()']) ?>
            </div>
        </div>

        <div class="row">
            <div id="result" class="col-12 mb-3">

            </div>
        </div>

    </div>
</div>
