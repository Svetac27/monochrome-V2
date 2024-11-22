<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package monochrome
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> style="margin-top: 0!important;">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link rel='stylesheet' href="<?php echo get_template_directory_uri() . '/custom.css'; ?>" type='text/css' media='all' />

		
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-S4RRS4V5ZR"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-S4RRS4V5ZR');
	</script>
</head>

<body class="max-w-full scrolled-top <?php echo implode(' ', get_body_class()); ?>">

<?php 
	get_template_part( 'template-parts/portal');
?>
<?php wp_body_open(); ?>

<div id="page" class="site max-w-full overflow-hidden <?php echo sanitize_title(get_the_title()); ?>">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'monochrome' ); ?></a>

	<div class="navbar-gradient-bg fixed lg:absolute top-0 w-full h-[200px]"></div>
	<header id="masthead" class="absolute lg:absolute top-0 site-header flex justify-between items-center w-full p-20px lg:pl-30px">
		<div class="site-branding ">
			<a href="/" class="text-black flex">
				<?php get_template_part('template-parts/logo', 'monochrome', ['class' => 'my-15px']); ?>
			</a>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation md:flex lg:block">
			<button 
				onclick="this.closest('nav').classList.toggle('open')"
			class="menu-toggle block lg:hidden" aria-controls="primary-menu" aria-expanded="false">
				<i class="icon-menu p-0 text-12px"></i>
				<svg class="icon-close text-black" xmlns="http://www.w3.org/2000/svg" width="18.031" height="18.031" viewBox="0 0 18.031 18.031">
					<g id="Group_4261" data-name="Group 4261" transform="translate(-1851.67 -49.729)">
						<line id="Line_206" data-name="Line 206" y2="24" transform="translate(1869.171 50.26) rotate(45)" fill="none" stroke="currentColor" stroke-width="1.5"/>
						<line id="Line_207" data-name="Line 207" x2="24" transform="translate(1852.201 50.26) rotate(45)" fill="none" stroke="currentColor" stroke-width="1.5"/>
					</g>
				</svg>
			</button>
			<a class="wp-element-button show-contact-modal hidden md:block lg:hidden font-gilroy-semi-bold ml-38px !leading-[12px] z-100">Contact Us</a>

			
			<div class="desktop-menu items-center h-[56px] gap-4 nav-items hidden lg:flex uppercase font-gilroy text-14px tracking-wider">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header-menu',
						'menu_id'        => 'primary-menu'
					)
				);
				?>
				<a class="wp-element-button show-contact-modal hidden lg:block font-gilroy-semi-bold ml-3 !leading-[12px]">Contact Us</a>
			</div>
			<div class="flex items-center gap-4 nav-items mobile-menu lg:hidden">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'mobile-menu',
						'menu_id'        => 'mobile-menu'
					)
				);
				?>
			</div>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
