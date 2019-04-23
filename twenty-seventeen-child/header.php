<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="The Hammer Theatre is a distinctive, high-quality performance venue in the heart of downtown San José. The theatre serves the city's community and San Jose State University through high-quality programming including music, theatre, educational lectures and other performing arts expressive of the unique characteristics and diverse cultures that comprise Silicon Valley.">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119086310-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-119086310-1');
</script>

<script type="text/javascript">
	// <!-- Google Tag Manager -->
	(function(w,d,s,l,i){
                    w[l]=w[l]||[];
                    w[l].push({"gtm.start":new Date().getTime(),event:"gtm.js"});
                    var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;
                    j.src="https://www.googletagmanager.com/gtm.js?id="+i+dl;
                    f.parentNode.insertBefore(j,f);
                    })(window,document,"script","dataLayer","GTM-5KDXX2H");

    // <!-- End Google Tag Manager -->
</script>

</head>

<body <?php body_class(); ?>>

	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5KDXX2H"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TXSNHMP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



<!-- Loading icon -->
<div id="load">
<div style="height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;">
<p style="padding-bottom: 182px;">LOADING...</p>
</div>
</div>

<script>
        document.onreadystatechange = function () {
          var state = document.readyState
          if (state == 'complete') {
            document.getElementById('interactive');
            document.getElementById('load').style.visibility="hidden";
          }
        }
</script>
<!-- END of Loading icon -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php endif; ?>

	</header><!-- #masthead -->


	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		echo '<div id="single-featured-image-container" class="single-featured-image-header paddingLeft paddingRight">';
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
