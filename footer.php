<footer>
    <!-- Chargement de la Modal -->
    <?php echo get_template_part('template-parts/section', 'modal'); ?>
    <?php echo get_template_part('template-parts/section', 'lightbox'); ?>
    <div class="footer__menu">
        <ul>
            <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'depth' => 0)); ?>
            <li>
                <p>tous droits réservés</p>
            </li>
        </ul>
    </div>
</footer>
</body>
<?php wp_footer(); ?>

</html>