<div class="slider">
    <div class="items">
        <?php echo $args["images"]; ?>
    </div>
    <div class="btns">
        <?php if($args["count"]>1): ?>
            <span class="slider-btn btn-left">
                <img src="<?php echo get_template_directory_uri() ?>/assets/logo/arrowl.svg" alt="logo en forme de flèche">
            </span>
            <span class="slider-btn btn-right">
                <img src="<?php echo get_template_directory_uri() ?>/assets/logo/arrowr.svg" alt="logo en forme de flèche">
            </span>
        <?php endif; ?>
        <div class="btns-selectors">
            <?php for ($i=0; $i < $args["count"]; $i++):?>
                <span class="slider-btn btn-select" data-id="<?php echo $i; ?>">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/logo/gem2.svg" alt="logo en forme de gème">
                </span>
            <?php endfor; ?>
        </div>
    </div>
</div>