<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package monochrome
 */

?>

	<footer id="colophon" class="site-footer px-page">
		<div class="w-full page-wrapper mx-auto">
			<div class="">
				<div class="w-container lg:pb-0 mt-50px lg:mt-0">
					<?php get_template_part('template-parts/footer', 'contact'); ?>
				</div>
			</div>
			<div class="site-info flex items-center justify-between py-6 md:py-[70px]">
				<div class="left-menu text-14px font-gilroy">
					<?php
				    wp_nav_menu(array(
				        'theme_location' => 'footer-menu',
				    ));
					?>
				</div>
				<div class="right-menu flex gap-20px items-center">
					<span class="opacity-50 text-14px font-gilroy pr-20px">&copy; 2024 Monochrome</span>
					<?php
					$socials = get_option('social_media');
					foreach ($socials as $key => $social) {
						if (!empty($social)) {
							$socialIcon = $key == 'twitter' ? 'x' : $key;
							echo  '<a href="'.$social.'" target="_blank"><i class="p-0 icon-'.$socialIcon.'"></i></a>';
						}
					}
					?>
				</div>

			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php get_template_part('template-parts/modal', 'contact'); ?>

<?php wp_footer(); ?>

<?php /*
<script>
  window.intercomSettings = {
    api_base: "https://api-iam.intercom.io",
    app_id: "xrcs52t1",
  };
</script>


<script>
  // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/xrcs52t1'
  (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/xrcs52t1';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script> */ ?>
</html>
