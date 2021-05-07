<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title><?php bloginfo('name') ?> - <?php the_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
    <div class="call">
        <div class="call__background"></div>
        <div class="call__body">
            <div class="call__close">
                <span>x</span>
            </div>
            <div class="call__top-image">
                <img src="<?php get_bloginfo('language') == 'ru-RU' ? the_field('image', 837) : the_field('image', 843); ?>" alt="">
                <div class="call__logo">
                    <img src="<?php get_bloginfo('language') == 'ru-RU' ? the_field('logo', 90) : the_field('logo', 465); ?>" alt="Местные">
                </div>
            </div>
            
            <h3 class="call__title"><?php get_bloginfo('language') == 'ru-RU' ? the_field('title', 837) : the_field('title', 843); ?></h3>

            <?php echo (get_bloginfo('language') == 'ru-RU' ? do_shortcode('[contact-form-7 id="842" title="Обратный звонок"]') : do_shortcode('[contact-form-7 id="848" title="Callback"]')); ?>
        </div>
    </div>
	
	<div class="lightbox">
        <div class="lightbox__background"></div>
		<div class="lightbox__body">
			<img src="<?php the_field('logo', 90) ?>" alt="">
		</div>
    </div>

    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="header__top">
                    <div class="header__top-left">
                        <div class="header__logo">
                            <a href="/"> <img src="<?php get_bloginfo('language') == 'ru-RU' ? the_field('logo', 90) : the_field('logo', 465); ?>" alt="Местные"></a>
                        </div>
                        <div class="header__info">
                            <div class="header__weather">
                                <?php echo (get_bloginfo('language') == 'ru-RU' ? 'В Мурманске' : 'In Murmansk'); ?>: <span class="header__weather-number">
								<?php
								$apiKey = "99583b594f8925a68b1428ae1a8a1f20";
								$cityId = "524305";
								$apiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=ru&units=metric&APPID=" . $apiKey;
								
								$crequest = curl_init();

								curl_setopt($crequest, CURLOPT_HEADER, 0);
								curl_setopt($crequest, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($crequest, CURLOPT_URL, $apiUrl);
								curl_setopt($crequest, CURLOPT_FOLLOWLOCATION, 1);
								curl_setopt($crequest, CURLOPT_VERBOSE, 0);
								curl_setopt($crequest, CURLOPT_SSL_VERIFYPEER, false);
								$response = curl_exec($crequest);
								curl_close($crequest);
								$data = json_decode($response);
								$currentTime = time();
								print_r($data->main->temp);
								?></span>&deg;
                            </div>
                            <div class="header__slogan">
                                <?php get_bloginfo('language') == 'ru-RU' ? the_field('slogan', 85) : the_field('slogan', 479); ?>
                            </div>
                        </div>
						 <a href="#" class="button show-call-form"><?php get_bloginfo('language') == 'ru-RU' ? the_field('button-text', 85) : the_field('button-text', 479); ?></a>
                    </div> 
                    <div class="header__top-right">
                        <?php if(get_bloginfo('language') == 'ru-RU') : ?>
                                <a class="header__language-switch" href="<?php echo get_permalink(244); ?>">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/en_US.png'; ?>" alt="">
                                </a>
                            <?php else : ?>
                                <a class="header__language-switch" href="<?php echo get_permalink(8); ?>">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/img/ru_RU.png'; ?>" alt="">
                                </a>
                            <?php endif; ?>
                        <div class="header__contacts">
                           
                            <!--<span class="header__address"><?php get_bloginfo('language') == 'ru-RU' ? the_field('address', 90) : the_field('address', 465); ?></span>-->
                            <span class="header__phone-number"><?php get_bloginfo('language') == 'ru-RU' ? the_field('phone-number', 90) : the_field('phone-number', 465); ?></span>
                        </div>
                    </div>
                    <div class="header__navbar-menu-button">
                        <div class="header__navbar-menu-button-line"></div>
                        <div class="header__navbar-menu-button-line"></div>
                        <div class="header__navbar-menu-button-line"></div>
                    </div>
                </div>
                    <?php wp_nav_menu([
                        'theme_location'    => 'header',
                        'menu'              => '',
                        'container'         => 'nav',
                        'container_class'   => 'header__navbar',
                        'container_id'      => false,
                        'menu_class'        => 'header__navbar-menu',
                        'menu_id'           => false,
                    ]); ?>
                </nav>
            </div>
        </div>

        <nav class="header__navbar-mobile">
            <img class="header__navbar-mobile-logo" src="<?php the_field('logo', 90); ?>" alt="">
            <div class="header__contacts">
                <span class="header__address"><?php the_field('address', 90); ?></span>
                <span class="header__phone-number"><?php the_field('phone-number', 90); ?></span>
            </div>

            <?php wp_nav_menu([
                'theme_location'    => 'header',
                'menu'              => '',
                'container'         => false,
                'menu_class'        => 'header__navbar-mobile-menu',
                'menu_id'           => false,
            ]); ?>

            <a href="#" class="header__navbar-mobile-button button"><?php the_field('button-text', 85); ?></a>
        </nav>
        <div class="header__navbar-mobile-bg"></div>
    </header>
