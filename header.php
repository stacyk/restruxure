<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yoga
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'yoga' ); ?></a>

  <header class="site-header">
    <nav id="site-navigation" class="main-navigation">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'menu_id'        => 'primary-menu',
        ) );
      ?>
    </nav><!-- #site-navigation -->


    <div class="site-branding">
      <?php if ( is_front_page() && is_home() ) : ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo yoga_get_svg( array( 'icon' => 'logo', 'title' => 'Re:Struxure' ) ); // WPCS: XSS ok. ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Restruxure', 'yoga' ); ?></span></a></h1>
      <?php else : ?>
        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo yoga_get_svg( array( 'icon' => 'logo', 'title' => 'Re:Struxure' ) ); // WPCS: XSS ok. ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Restruxure', 'yoga' ); ?></span></a></p>
      <?php endif; ?>


        <?php $description = get_bloginfo( 'description', 'display' ); ?>
        <?php if ( $description || is_customize_preview() ) : ?>
          <p class="site-description"><?php echo $description; // WPCS: xss ok. ?></p>
        <?php endif; ?>

    </div><!-- .site-branding -->

    <!-- Search Form -->
    <?php if ( is_front_page() ) : ?>
      <?php get_search_form(); ?>
    <?php endif; ?>

  </header><!-- .site-header -->

  <div id="content" class="site-content">

