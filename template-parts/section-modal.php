<?php

/**
 * Template part for displaying section modal
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NathalieMota
 */

?>
<div class="popup">
    <section id="modal" class="modal">
        <div class="modal__container">
            <div class="close_modal">
                <h3>✖️</h3>
            </div>
            <div class="modal__titre">
                <img class="modal__img__xl" src="<?php echo get_template_directory_uri() . '/assets/images/Contact_header.png' ?>">
                <img class="modal__img__xs" src="<?php echo get_template_directory_uri() . '/assets/images/Contact_header_mobile.png' ?>">
            </div>
            <div class="modal__form">
                <?php echo do_shortcode('[contact-form-7 id="585c0be" title="Contact"]'); ?>
            </div>
        </div>
        <div id="overlay"></div>
    </section>
</div>