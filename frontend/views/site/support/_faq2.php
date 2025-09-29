<?php
use yii\helpers\Html;
?>

<?php if (!empty($faqs)): ?>
    <div class="accordion" id="faqAccordion">
        <?php foreach ($faqs as $index => $faq):?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?= $index ?>">
                    <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse<?= $index ?>"
                        aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>"
                        aria-controls="collapse<?= $index ?>">
                        <?= Html::encode($faq->question) ?>
                    </button>
                </h2>
                <div id="collapse<?= $index ?>"
                    class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>"
                    aria-labelledby="heading<?= $index ?>"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <?= nl2br(Html::encode($faq->answer)) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p><em>No FAQs available for this category.</em></p>
<?php endif; ?>