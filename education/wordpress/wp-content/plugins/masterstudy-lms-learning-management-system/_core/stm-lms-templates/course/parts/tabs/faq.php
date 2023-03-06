<?php
stm_lms_register_style('faq');
$faq = get_post_meta(get_the_ID(), 'faq', true);
if (!empty($faq)) :
	$faq = json_decode($faq, true);
    if(!empty($faq)): ?>

    <div class="panel-group" id="stm_lms_faq"role="tablist" aria-multiselectable="true" >

        <?php foreach ($faq as $faq_id => $faq_doc):
            if (empty($faq_doc['answer']) or empty($faq_doc['question'])) continue; ?>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab"  id="heading<?php echo esc_attr($faq_id); ?>">
                    <h4 class="panel-title">
                        <a role="button"class="heading_font collapsed" data-toggle="collapse" data-parent="#wpsm_accordion1"  data-target="#collapse_stm<?php echo esc_attr($faq_id); ?>" aria-expanded="false" aria-controls="#collapse_stm<?php echo esc_attr($faq_id); ?>">
                            <i class="fa fa-angle-down"></i>
                            <?php echo sanitize_text_field($faq_doc['question']); ?>
                        </a>
                    </h4>
                </div>
                <div id="collapse_stm<?php echo esc_attr($faq_id); ?>"  class="panel-collapse collapse " >
                    <div class="panel-body">
                    <?php echo html_entity_decode($faq_doc['answer']); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>
<?php endif;