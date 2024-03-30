<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <header>
        <div class="navbar">
            <div class="logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                ?>
                    <a href="<?php echo home_url(); ?>"><span><?php bloginfo('name') ?></span></a>
                <?php
                }
                ?>
            </div>

            <nav class="menu">
                <ul class="menu-items">
                    <?php wp_nav_menu(array('theme_location' => 'wp_planty_main_menu', 'depth' => 0)); ?>
                </ul>
            </nav>
        </div>

    </header>