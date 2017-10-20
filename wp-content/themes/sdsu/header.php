<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'> 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=31" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href="<?php bloginfo( 'template_directory' ); ?>/jQuery.mmenu-master/src/css/jquery.mmenu.all.css" type="text/css" rel="stylesheet" />

<style type="text/css">


/* staff directory persistent headers */


.floatingHeader {
  position: fixed;
  top: 0;
  visibility: hidden;
  background:#5B090D;
  border:none;
 }
	

</style>
<?php
	/*
	 * We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<!--[if lt IE 9]>
    <script src="<?php bloginfo( 'template_directory' ); ?>/html5shiv-master/dist/html5shiv.min.js"></script>
<![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64091433-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body <?php body_class(); ?>>
<a title="Skip to Mobile Content" href="#skip_mobile_nav" style="position:absolute;left:-9999px">Skip to Content</a>
<div id="wrapper" class="hfeed">
	<a title="top anchor" name="top"></a>
	
		<header role="banner">
			<div class="top">
				<div class="top_wrap">
					
					
					
					
					
					<div class="top_right">
				
						<div class="search" role="search">
							<img alt="Search Our Database Below" class="search_click" src="<?php bloginfo( 'template_directory' ); ?>/images/search.png"/>
							<div class="search_dropdown">
								<?php get_search_form(); ?>
							</div><!-- search_dropdown -->
						</div><!-- search -->
					</div><!-- top_right -->
				</div><!-- top_wrap -->
			</div><!-- top -->
			<div class="banner">
				<div class="header_wrap">
					<div id="logo">
						<a title="Professional Excellence - San Diego State University School of Social Work" class="logo_academy" href="<?php bloginfo( 'url' ); ?>"><span class="academy_word">Academy</span> <span class="for_word">for</span> <span class="line_break">Professional Excellence</span></a>
						<a title="Professional Excellence - San Diego State University School of Social Work" href="<?php bloginfo( 'url' ); ?>" class="logo_sdsu">San Diego State University <span class="line_break">School of Social Work</span></a>
					</div><!-- logo -->
				</div><!-- header_wrap -->
			</div><!-- banner -->
			<div class="menu_wrapper">
				<div class="inner_menu">
										
					<a title="Browse Through Our Programs" class="mobile_menu_img" href="#mobile_menu"><img alt="Navigation to all of our resources" src="<?php bloginfo( 'template_directory' ); ?>/images/mobile_menu.png"/></a>
					
					
					
					

   <nav id="mobile_menu">
						<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
					</nav><!-- mobile menu -->
   
 
   
   <nav id="desktop_menu">
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				</nav><!-- desktop menu -->


					
					
					
				
				</div><!-- inner menu -->
			</div><!-- menu wrapper -->
		</header>
		<main role="main">
		<div id="skip_mobile_nav"></div><!-- skip_mobile_nav -->
