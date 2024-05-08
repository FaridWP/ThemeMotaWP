<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title>Nathalie Mota</title>
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <header>
        <div class="navbar">
            <div class="navbar__logo">
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

            <nav class="navbar__menu">
                <ul class="navbar__menu__items">
                    <?php wp_nav_menu(array('theme_location' => 'nathaliemota_menu', 'depth' => 0)); ?>
                </ul>
                <button class="hamburger hamburger--squeeze" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </nav>
        </div>
        <div class="navbar__menu__mobile">
            <nav>
                <ul>
                    <?php wp_nav_menu(array('theme_location' => 'nathaliemota_menu', 'depth' => 0)); ?>
                </ul>
            </nav>
        </div>

    </header>