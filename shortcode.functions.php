<?php


function getTemplatePart($slug, $name = null, $args = []) {

	// start buffer
	ob_start();

	// call template (with html output)
	get_template_part( $slug, $name, $args);

	// return buffered output
	return ob_get_clean();
}

add_shortcode('monochrome-icon', 'displayMonochromeIcon');
function displayMonochromeIcon ($atts) {;
	return '<i class="icon-'.($atts['type'] ?? '').'"></i>';
}

add_shortcode( 'monochrome-slider', 'monochromeSlider' );
function monochromeSlider( $atts ) {
	$postType = $atts['posttype'] ?? 'post';
	$limit = $atts['limit'] ?? -1;
	$category = isset($atts['category']) ? $atts['category'] : false;

	$args = array(  
        'post_type' => $postType,
		'posts_per_page' => $limit,
        'post_status' => 'publish',
		'order'   => 'ASC'
    );

	if ($category) {
		$args['taxonomy'] = 'category';
		$args['term'] = $category;
	}

	if ($postType == 'testimonials') {
		$withVideo = isset($atts['showvideo']) ? $atts['showvideo']  : 'true';

		if ($withVideo == 'false') {
	       	return getTemplatePart( 'template-parts/carousel', 'testimonials-no-video', $args);
		} else if ($withVideo == 'true') {
	       	return getTemplatePart( 'template-parts/carousel', 'testimonialsV2', $args);
		}
	} else {
		get_template_part( 'template-parts/carousel', 'v2', $args);
	}
}
add_shortcode( 'global-brands', 'globalBrands' );
function globalBrands( $atts ) {
	return getTemplatePart( 'template-parts/global', 'brands', $atts);
}


add_shortcode('monochrome-awards', 'monochromeAwards');
function monochromeAwards ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'awards');
}

add_shortcode('monochrome-showcase-section', 'monochromeShowCaseSection');
function monochromeShowCaseSection ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'showcasesection', $atts);
}

add_shortcode('monochrome-servicenow-products', 'getServiceNowProducts');
function getServiceNowProducts ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'servicenowproducts');
}

add_shortcode('monochrome-testimonials', 'getTestimonials');
function getTestimonials ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'testimonials', $atts);
}
add_shortcode('monochrome-pricing', 'getPricings');
function getPricings ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'pricing');
}
add_shortcode('monochrome-pricing-packages', 'getPricingPackages');
function getPricingPackages ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'pricingpackages', $atts);
}
add_shortcode('monochrome-faqs', 'getFAQs');
function getFAQs ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'faqs', $atts);
}
add_shortcode('monochrome-showcase-page', 'getShowcase');
function getShowcase ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'showcasepage', $atts);
}
add_shortcode('monochrome-services-section', 'getServicesOffered');
function getServicesOffered ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'services');
}
add_shortcode('monochrome-core-functionality', 'generateCoreFunctionality');
function generateCoreFunctionality ($atts) {
	return getTemplatePart( 'template-parts/monochrome', 'core-functionality');
}
add_shortcode('monochrome-blogs', 'getBlogs');
function getBlogs ($args) {
	return getTemplatePart( 'template-parts/monochrome', 'blogs', $args);
}
add_shortcode('monochrome-process', 'getProcess');
function getProcess ($args) {
	return getTemplatePart( 'template-parts/monochrome', 'process', $args);
}

add_shortcode('monochrome-upgrade-insurance', 'getUpgradeInsurance');
function getUpgradeInsurance ($args) {
	return getTemplatePart( 'template-parts/monochrome', 'upgrade-insurance', $args);
}
add_shortcode('monochrome-team-members', 'getTeamMembers');
function getTeamMembers ($args) {
	return getTemplatePart( 'template-parts/monochrome', 'team-members', $args);
}

add_shortcode('monochrome-offices-section', 'getOfficesSection');
function getOfficesSection ($args) {
	return getTemplatePart( 'template-parts/monochrome', 'offices-section', $args);
}

add_shortcode('monochrome-cta-widget', 'getCTAWidget');
function getCTAWidget ($args) {
	return getTemplatePart( 'template-parts/monochrome', 'cta-widget', $args);
}

add_shortcode('monochrome-download', 'getDownloadSection');
function getDownloadSection ($args) {
	return getTemplatePart( 'template-parts/monochrome', 'download-section', $args);
}


