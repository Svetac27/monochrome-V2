<?php
if (!session_id()) {
    session_start(); // Ensure session is started
}
/**
 * monochrome functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package monochrome
 */


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', implode('.', str_split(time(), 2)) );
	// define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function monochrome_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on monochrome, use a find and replace
		* to change 'monochrome' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'monochrome', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'monochrome' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'monochrome_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'monochrome_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function monochrome_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'monochrome_content_width', 640 );
}
add_action( 'after_setup_theme', 'monochrome_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function monochrome_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'monochrome' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'monochrome' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'monochrome_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function monochrome_scripts() {
	wp_enqueue_style( 'monochrome-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'monochrome-style', 'rtl', 'replace' );

	wp_enqueue_script( 'monochrome-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'monochrome_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require_once( get_template_directory() . '/shortcode.functions.php' );

// Add custom fields to the General Settings page
function custom_general_settings_fields() {
    add_settings_field(
        'social_media',
        'Social Media Accounts',
        'render_social_media_fields',
        'general'
    );

    register_setting('general', 'social_media');

    add_settings_field(
        'contact_us',
        'Contact Us',
        'render_contact_us_fields',
        'general'
    );

    register_setting('general', 'contact_us');

    if (current_user_can('administrator')) {
        add_settings_field(
            'exclusive_contents',
            'Exclusive Contents',
            'render_exclusive_contents_fields',
            'reading'
        );

        register_setting('reading', 'exclusive_contents');
    }
}
add_action('admin_init', 'custom_general_settings_fields');

// Render the custom field
function render_social_media_fields() {

    $socialMediaAccounts = [
    	'linkedin',
    	'facebook',
    	'youtube',
    	'twitter'
    ];
   	

   	$socials = get_option('social_media');
    foreach ($socialMediaAccounts as $social) {
    echo '<div><label><strong>'.strtoupper($social).'</strong></label><br><input type="text" class="regular-text ltr" name="social_media['.$social.']" value="' . esc_attr($socials[$social] ??  '') . '" /><br><br></div>';

    }
}
// Render the custom field
function render_exclusive_contents_fields() {
    $settings = get_option('exclusive_contents');
    $token = $settings['token'] ?? '';
    ?>
        <div>
            <label>
                <strong>
                    Token
                </strong>
            </label>
            <br>
            <input type="text" class="regular-text ltr" name="exclusive_contents[token]" value="<?php echo $token; ?>" />
            <br>
            <br>
        </div>
    <?php
}
function render_contact_us_fields() {

    $fields = [
    	'Title' => 'text',
    	'Text' => 'textarea',
    	'Button Text' => 'text',
    	'Button Link' => 'text',
    	'Form To Open' => 'text',
    	'Form Message' => 'textarea',
    ];
   	

   	$values = get_option('contact_us');
    foreach ($fields as $field => $type) {
    echo '<div>
    		<label>
    				<strong>'.strtoupper($field).'</strong>
    		</label>
    		<br>';
    		if ($type == 'textarea') {
    		echo '<textarea class="regular-text ltr" name="contact_us['.$field.']">' . esc_attr($values[$field] ??  '') . '</textarea><br><br>';

    		} else {

    		echo '<input type="text" class="regular-text ltr" name="contact_us['.$field.']" value="' . esc_attr($values[$field] ??  '') . '" /><br><br>';
    		}
    echo '</div>';
    }
}

function register_my_menus() {
    register_nav_menus(array(
        'header-menu' => 'Header Menu',
        'mobile-menu' => 'Mobile Menu',
        'footer-menu' => 'Footer Menu',
        // Add more menu locations as needed
    ));
}
add_action('init', 'register_my_menus');

add_filter('the_title', 'modify_title_output', 10, 2);

function modify_title_output($title, $post_id) {
    return str_replace('&nbsp', ' ', html_entity_decode($title, ENT_QUOTES | ENT_HTML5));
}


// Add custom meta field for post order
add_action('add_meta_boxes', 'custom_post_order_meta_box');

function custom_post_order_meta_box() {
    add_meta_box('post_order_meta_box', 'Post Order', 'custom_post_order_meta_box_callback', 'post', 'side', 'default');
}

function custom_post_order_meta_box_callback($post) {
    $order = get_post_meta($post->ID, 'post_order', true);
    echo '<label for="post_order">Order:</label>';
    echo '<input type="number" id="post_order" name="post_order" value="' . esc_attr($order) . '">';
}

add_action('save_post', 'save_custom_post_order');

function save_custom_post_order($post_id) {
    if (array_key_exists('post_order', $_POST)) {
        update_post_meta($post_id, 'post_order', $_POST['post_order']);
    }
}

function get_primary_category($post_id) {
    $categories = get_the_category($post_id);
    
    // Check if there are categories assigned to the post
    if ($categories) {
        // Get the first category (primary category)
        $primary_category = $categories[0]; 
        
        return $primary_category;
        // Check if the category has a parent category
        while ($primary_category->parent != 0) {
            // Get the parent category
            $primary_category = get_category($primary_category->parent);
        }
        
        return $primary_category;
    }
    
    return false; // Return false if no categories are assigned to the post
}


function get_single_tag($post_id) {
	$tags = get_the_tags($post_id);
	if ($tags) {
		foreach($tags as $tag) {
			return $tag;
		}
	} return false;
}

// Add custom classes based on menu item text
function custom_menu_item_classes($classes, $item, $args) {
    $classes[] = sanitize_title($item->title); // Add text as class (sanitized)
    return $classes;
}
add_filter('nav_menu_css_class', 'custom_menu_item_classes', 10, 3);

add_post_type_support( 'page', 'excerpt' );

function remove_p_tag_around_strong_link($content) {
    // Regular expression to match <p> tags that only contain a <strong> tag with an <a> tag inside
    // and potentially other inline elements like <i> for icons
    $pattern = '/<p>\s*(<strong>\s*<a [^>]+>.*<\/a>\s*<\/strong>)\s*<\/p>/i';
    // Replace matched pattern with just the <strong> and <a> tags
    $replacement = '$1';
    // Apply the pattern and return the modified content
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

// Hook into 'the_content' filter
add_filter('the_content', 'remove_p_tag_around_strong_link');

function remove_attribute($html, $attr) {
    if ($html) {
        return preg_replace('/\s*'.$attr.'="[^"]*"/i', '', $html);
    }
    return $html;
}

// Add custom image size
function thumbnail_crop_from_top() {
    // Width: 300px, Height: 360px, Hard Crop: true
    add_image_size('crop-from-top', 300, 360, true);
}
add_action('after_setup_theme', 'thumbnail_crop_from_top');

// Enable support for post thumbnails
function setup_theme_support() {
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'setup_theme_support');

// Custom image crop function to crop from top center
function custom_image_resize_dimensions($default, $orig_w, $orig_h, $dest_w, $dest_h, $crop) {
    if ($crop) {
        // Top Center Crop
        $aspect_ratio = $orig_w / $orig_h;
        $new_w = min($dest_w, $orig_w);
        $new_h = min($dest_h, $orig_h);

        if (!$new_w) {
            $new_w = intval($new_h * $aspect_ratio);
        }

        if (!$new_h) {
            $new_h = intval($new_w / $aspect_ratio);
        }

        $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

        $crop_w = round($new_w / $size_ratio);
        $crop_h = round($new_h / $size_ratio);

        $s_x = floor(($orig_w - $crop_w) / 2);
        $s_y = 0; // Start from top

        return array(0, 0, $s_x, $s_y, $new_w, $new_h, $crop_w, $crop_h);
    }

    return $default;
}
add_filter('image_resize_dimensions', 'custom_image_resize_dimensions', 10, 6);

// Add custom endpoint for retrieving posts of a specific post type
function custom_post_type_endpoint() {
    register_rest_route( 'custom/v1', '/posts/(?P<post_type>[a-zA-Z0-9_,-]+)', array(
        'methods'  => 'GET',
        'callback' => 'custom_get_posts_by_post_type',
        'permission_callback' => '__return_true', // Always allow access
    ) );
}
add_action( 'rest_api_init', 'custom_post_type_endpoint' );

// Callback function to retrieve posts by post type
function custom_get_posts_by_post_type( $data ) {

    // Get the post type from the URL parameter
    $post_type = $data['post_type'];
	$page = $_GET['page'] ?? 0;
	$itemsPerPage = $_GET['itemsPerPage'] ?? -1;

    // Query posts of the specified post type
    $args = array(
        'post_type'      => explode(',', $post_type),
        'posts_per_page' => $itemsPerPage,
		'paged' => $page,
		'post_status' => 'publish',
		'orderby' => 'date',
		'ignore_sticky_posts' => true,

		'order'   => 'DESC',
		'post_parent'    => 0, // Get only parent posts
    );
    $posts_query = new WP_Query( $args );

    // Prepare array to store post data
    $posts_data = array();

    // Loop through posts and store data
    if ( $posts_query->have_posts() ) {
		while ( $posts_query->have_posts() ) {
			$posts_query->the_post();
			// if ($post_type == 'blogs') {
				ob_start();
				get_template_part('template-parts/component', 'blog-card');
				$post_data = ob_get_clean();
				$posts_data[] = $post_data;
			// } else {
			// 	$post_data = array(
			// 		'id'         => get_the_ID(),
			// 		'title'      => get_the_title(),
			// 		'content'    => get_the_content(),
			// 		'excerpt'    => get_the_excerpt(),
			// 		'permalink'  => get_permalink(),
			// 	);
			// 	$posts_data[] = $post_data;
			// }
		}
		wp_reset_postdata();
	}

    // Return the posts data
    return $posts_data;
}

function slugify($text) {
    // Replace non-letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // Transliterate to ASCII if possible
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // Trim
    $text = trim($text, '-');

    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // Lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return '';
    }

    return $text;
}

function get_category_slugs_from_url() {
    if (isset($_SERVER['REQUEST_URI'])) {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        if (strpos($path, 'category/') === 0) {
            $categories_part = substr($path, strlen('category/'));
            $categories = explode(',', $categories_part);
            return array_map('sanitize_title', $categories);
        }
    }
    return array();
}




// Filter for displaying the title in the frontend
function custom_filter_the_title($title, $id = null) {
    // Check if we're in the admin area
    if (is_admin()) {
        return $title;
    }

    // Check if we're in the main query and a single post/page/custom post type
    if (in_the_loop() && is_main_query() && is_singular()) {
        // Get the custom field value
        $custom_title = get_post_meta($id, 'h1_title', true);

        // If the custom field has a value, return it as the title
        if (!empty($custom_title)) {
            return $custom_title;
        }
    }

    return $title;
}
add_filter('the_title', 'custom_filter_the_title', 10, 2);

// Filter for getting the title in other contexts
function custom_filter_get_the_title($title, $id) {
    // Get the custom field value
    $custom_title = get_post_meta($id, 'h1_title', true);

    // If the custom field has a value, return it as the title
    if (!empty($custom_title)) {
        return $custom_title;
    }

    return $title;
}
add_filter('get_the_title', 'custom_filter_get_the_title', 10, 2);

function acf_search_join( $join ) {
    global $pagenow, $wpdb;

    if ( is_admin() && 'edit.php' === $pagenow && !empty($_GET['s']) ) {
        $join .= " LEFT JOIN {$wpdb->postmeta} acf_meta ON {$wpdb->posts}.ID = acf_meta.post_id ";
    }

    return $join;
}
add_filter( 'posts_join', 'acf_search_join' );

function acf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_admin() && 'edit.php' === $pagenow && !empty($_GET['s']) ) {
        $acf_fields = array('h1_title'); // Add your ACF field names here

        $where = preg_replace(
            "/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(" . $wpdb->posts . ".post_title LIKE $1) OR (acf_meta.meta_key IN ('" . implode("','", $acf_fields) . "') AND acf_meta.meta_value LIKE $1)",
            $where
        );
    }

    return $where;
}
add_filter( 'posts_where', 'acf_search_where' );

function acf_search_distinct( $where ) {
    global $pagenow;

    if ( is_admin() && 'edit.php' === $pagenow && !empty($_GET['s']) ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'acf_search_distinct' );
function my_custom_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=monochrome-projects', // Parent slug
        'Sort Tags', // Page title
        'Sort Tags', // Menu title
        'manage_options', // Capability
        'sort-tags', // Menu slug
        'sort_tags_admin_page' // Function
    );
}

add_action('admin_menu', 'my_custom_admin_menu');
// Register the admin page and settings
function sort_tags_admin_page() {
    if (isset($_POST) && isset($_POST['sort_tags'])) {
        save_sorted_tags($_POST);
    }
    ?>
    <div class="wrap">
        <h1>Sort Tags</h1>
        <?php
        settings_fields('sort_tags_group');
        do_settings_sections('sort-tags');
        ?>
    </div>
    <?php
}

// Register settings, sections, and fields
function sort_tags_register_settings() {
    register_setting('sort_tags_group', 'sort_tags');

    add_settings_section(
        'sort_tags_section',
        'Sort Tags',
        'sort_tags_section_callback',
        'sort-tags'
    );

    add_settings_field(
        'sort_tags_field',
        'Tags Order',
        'sort_tags_field_callback',
        'sort-tags',
        'sort_tags_section'
    );
}

add_action('admin_init', 'sort_tags_register_settings');

// Callback for section
function sort_tags_section_callback() {
    echo 'Drag and drop to sort tags.';
}

// Callback for field
function sort_tags_field_callback() {
    // Get all tags used in the custom post type
    $custom_post_type = 'monochrome-projects'; // Your custom post type
    
    $tags = get_terms( array(
        'taxonomy' => 'post_tag',
        'object_ids' => get_posts( array(
            'post_type' => $custom_post_type,
            'posts_per_page' => -1,
            'fields' => 'ids',
        )),
    ));
    
    // Get the sorted tags from the options
    $sorted_tags = get_option('sort_tags');
    
    // Ensure $sorted_tags is an array
    if (!is_array($sorted_tags)) {
        $sorted_tags = array();
    }
    ?>
    <form method="post">
        <?php
    echo '<ul id="sortable">';

    foreach ($sorted_tags as $slug => $name) {
        echo '<li class="ui-state-default" data-id="' . esc_attr($slug) . '" style="padding: 5px 10px; background: white; border: 1px dashed black; cursor: grab;"><input type="hidden" name="sort_tags[' . $slug . ']" id="sort_tags_order" value="' . $name . '" />' . esc_html($name) . '</li>';
    }
    foreach ($tags as $tag) {
        $tag_slug = $tag->slug;
        $tag_name = $tag->name;
        // Use the slug to sort the tags
        $sorted_name = isset($sorted_tags[$tag_slug]) ? $sorted_tags[$tag_slug] : $tag_name;

        if (!in_array($tag_slug, array_keys($sorted_tags))) {
            echo '<li class="ui-state-default" data-id="' . esc_attr($tag_slug) . '" style="padding: 5px 10px; background: white; border: 1px dashed black; cursor: grab;"><input type="hidden" name="sort_tags[' . $tag_slug . ']" id="sort_tags_order" value="' . $sorted_name . '" />' . esc_html($sorted_name) . '</li>';

        }
    }
    echo '</ul>';

        // Encode the sorted tags as an array
        submit_button();
        ?>
    </form>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $("#sortable").sortable({
                update: function(event, ui) {
                    var sortedIDs = $("#sortable").sortable("toArray", { attribute: "data-id" });
                    var sortedTags = {};
                    $("#sortable li").each(function(index) {
                        var slug = $(this).data("id");
                        var name = $(this).text().trim();
                        sortedTags[slug] = name;
                    });
                }
            });
            $("#sortable").disableSelection();
        });
    </script>
    <?php
}

// Save sorted tags
function save_sorted_tags($option) {
    if (isset($_POST['sort_tags'])) {
        // Decode the JSON string to an array
        $sorted_tags = $_POST['sort_tags'];
        // Ensure the data is an array before saving
        update_option('sort_tags', $sorted_tags);
    }
}
// add_filter('pre_update_option_sort_tags', 'save_sorted_tags');


function add_dummy_items($array, $after, $dummy_item, $numberOfItemsToAdd = 1) {
    $result = [];
    $counter = 0;

    foreach ($array as $item) {
        $result[] = $item;
        $counter++;

        // Every 4 items, add a dummy item
        if ($counter % $after == 0) {

            for ($i = 0; $i < $numberOfItemsToAdd; $i++) {
                $result[] = $dummy_item;
            }
        }
    }

    return $result;
}

function group_array_by($array, $by = 3) {
    return array_chunk($array, $by);
}

function get_posts_as_array($args) {
    $query = new WP_Query($args);
    $posts_array = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $posts_array[] = array(
                'ID' => get_the_ID(),
                'title' => get_the_title(),
                'content' => get_the_content(),
                'excerpt' => get_the_excerpt(),
                'permalink' => get_permalink(),
                'author' => get_the_author(),
                'date' => get_the_date(),
                'thumbnail_url' => get_the_post_thumbnail_url(get_the_ID(), 'full'), // Full-size image URL
            );
        }
    }

    wp_reset_postdata(); // Reset post data
    return $posts_array;
}

function store_token_in_session() {
    if (isset($_POST['ectoken'])) {
        $_SESSION['ectoken'] = sanitize_text_field($_POST['ectoken']);
        wp_send_json_success('Token stored in session.');
    } else {
        wp_send_json_error('Token not provided.');
    }

    wp_die();
}
add_action('wp_ajax_store_token_in_session', 'store_token_in_session');
add_action('wp_ajax_nopriv_store_token_in_session', 'store_token_in_session');
function handle_ectoken_param() {
    $storedToken = get_option('exclusive_contents')['token'] ?? false;

    if (isset($_GET['ectoken'])) {
        $_SESSION['ectoken'] = $_GET['ectoken'];
        $ectoken = $_GET['ectoken'];

        ?>
        <script type="text/javascript">
            localStorage.setItem('ectoken', '<?php echo esc_js($ectoken); ?>');
            // Redirect without ectoken
            var url = new URL(window.location.href);
            var params = url.searchParams;
            params.delete('ectoken'); // Replace 'paramName' with the actual parameter name
            url.search = params.toString();
            window.location.href = url.href;
        </script>
        <?php
        exit;
    } else {

        if (!isset($_SESSION['ectoken'])) {
        ?>
            <script>
                // Send token to the server and return a promise
                async function sendTokenToServer() {
                    var ectoken = localStorage.getItem('ectoken');
                    if (ectoken) {
                        try {
                            const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams({
                                    action: 'store_token_in_session',
                                    ectoken: ectoken
                                })
                            });

                            if (!response.ok) {
                                throw new Error('Failed to send token to server.');
                            }

                            const data = await response.json();
                            console.log('Token sent to server and session updated.');
                            return true;
                        } catch (error) {
                            console.error(error);
                            return false;
                        }
                    } else {
                        console.error('No token found in local storage.');
                        return false;
                    }
                }

                // Execute the function and redirect after successful token storage
                (async () => {
                    const success = await sendTokenToServer();
                    if (success) {
                        // Redirect without ectoken
                        // var url = new URL(window.location.href);
                        // window.location.href = url.href;
                    }
                })();
            </script>

        <?php
        }
    }
}
add_action('wp_head', 'handle_ectoken_param');

function ecAllowed () {
    $userECToken = $_SESSION['ectoken'] ?? false;
    $storedToken = get_option('exclusive_contents')['token'] ?? false;
    return $userECToken && $storedToken && $userECToken == $storedToken;
}

function custom_password_form() {
    ob_start();
	get_template_part( 'template-parts/content', 'protected', ['is-modal' => false]);
    return ob_get_clean();
}
function bypass_password_protection($required, $post) {
    // Bypass the password protection if ecAllowed() returns true
    if (ecAllowed()) {
        return false; // Do not require a password
    }
    // Return the original required status if ecAllowed() returns false
    return $required;
}
add_filter('post_password_required', 'bypass_password_protection', 10, 2);

// 1. Register the Meta Box
function my_custom_meta_box() {
    // Only add to 'monochrome-projects' post type
    $post_type = 'monochrome-projects';
    
    add_meta_box(
        'my_gallery',          // Unique ID for the meta box
        'Gallery',             // Meta box title
        'my_gallery_callback', // Callback function that renders the meta box
        $post_type,            // Post type where the meta box should appear
        'normal',              // Context (normal, side, advanced)
        'high'                 // Priority (high, core, default, low)
    );
}
add_action('add_meta_boxes', 'my_custom_meta_box');

// 2. Callback Function to Render the Meta Box
function my_gallery_callback($post) {
    $gallery = get_post_meta($post->ID, '_my_gallery', true);
    $mobile_gallery = get_post_meta($post->ID, '_my_mobile_gallery', true);
    ?>
    <div>
        <h4>Desktop Gallery</h4>
        <a href="#" class="button button-primary" id="upload_images_button">Add Images</a>
        <ul id="gallery_images">
            <?php
            if ($gallery) {
                foreach ($gallery as $image) {
                    echo '<li>
                        <div class="image-item" style="background-image:url('.esc_url($image).')"></div>
                        <a href="#" class="remove-image">Remove</a>
                        <input type="hidden" name="my_gallery[]" value="'.esc_url($image).'">
                    </li>';
                }
            }
            ?>
        </ul>
    </div>

    <div>
        <h4>Mobile Gallery</h4>
        <a href="#" class="button button-primary" id="upload_mobile_images_button">Add Mobile Images</a>
        <ul id="mobile_gallery_images">
            <?php
            if ($mobile_gallery) {
                foreach ($mobile_gallery as $image) {
                    echo '<li>
                        <div class="image-item" style="background-image:url('.esc_url($image).')"></div>
                        <a href="#" class="remove-image">Remove</a>
                        <input type="hidden" name="my_mobile_gallery[]" value="'.esc_url($image).'">
                    </li>';
                }
            }
            ?>
        </ul>
    </div>

    <style>
        #gallery_images, #mobile_gallery_images {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 15px;
        }
        #gallery_images li, #mobile_gallery_images li {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .image-item {
            width: 150px;
            height: 150px;
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
        }
        @media screen and (max-width: 1023px) {
            #gallery_images, #mobile_gallery_images {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }
        @media screen and (max-width: 991px) {
            #gallery_images, #mobile_gallery_images {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        @media screen and (max-width: 767px) {
            #gallery_images, #mobile_gallery_images {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
    </style>
<script>
    jQuery(document).ready(function($) {
        var desktopFrame, mobileFrame;

        // Handler for desktop images button
        $('#upload_images_button').on('click', function(e) {
            e.preventDefault();

            if (desktopFrame) {
                desktopFrame.open();
                return;
            }

            desktopFrame = wp.media({
                title: 'Select Images for Desktop Gallery',
                button: { text: 'Add Images' },
                multiple: true
            });

            desktopFrame.on('select', function() {
                var attachments = desktopFrame.state().get('selection').toJSON();
                var gallery = $('#gallery_images');
                attachments.forEach(function(attachment) {
                    gallery.append('<li><div class="image-item" style="background-image:url(' + attachment.url + ')"></div><input type="hidden" name="my_gallery[]" value="' + attachment.url + '"><a href="#" class="remove-image">Remove</a></li>');
                });
            });

            desktopFrame.open();
        });

        // Handler for mobile images button
        $('#upload_mobile_images_button').on('click', function(e) {
            e.preventDefault();

            if (mobileFrame) {
                mobileFrame.open();
                return;
            }

            mobileFrame = wp.media({
                title: 'Select Images for Mobile Gallery',
                button: { text: 'Add Mobile Images' },
                multiple: true
            });

            mobileFrame.on('select', function() {
                var attachments = mobileFrame.state().get('selection').toJSON();
                var gallery = $('#mobile_gallery_images');
                attachments.forEach(function(attachment) {
                    gallery.append('<li><div class="image-item" style="background-image:url(' + attachment.url + ')"></div><input type="hidden" name="my_mobile_gallery[]" value="' + attachment.url + '"><a href="#" class="remove-image">Remove</a></li>');
                });
            });

            mobileFrame.open();
        });

        $('#gallery_images, #mobile_gallery_images').on('click', '.remove-image', function(e) {
            e.preventDefault();
            $(this).closest('li').remove();
        });
    });
</script>

    <?php
}

// 3. Save the Meta Box Data
function save_my_gallery($post_id) {
    // Check if the post type is 'monochrome-projects'
    if (get_post_type($post_id) !== 'monochrome-projects') {
        return;
    }

    // Save the desktop gallery
    if (isset($_POST['my_gallery'])) {
        update_post_meta($post_id, '_my_gallery', $_POST['my_gallery']);
    } else {
        delete_post_meta($post_id, '_my_gallery');
    }

    // Save the mobile gallery
    if (isset($_POST['my_mobile_gallery'])) {
        update_post_meta($post_id, '_my_mobile_gallery', $_POST['my_mobile_gallery']);
    } else {
        delete_post_meta($post_id, '_my_mobile_gallery');
    }
}
add_action('save_post', 'save_my_gallery');




function ec_body_class($classes) {
    if (ecAllowed()) {
        $classes[] = 'ec-allowed';
    }

    return $classes;
}
add_filter('body_class', 'ec_body_class');

function is_exact_shortcode($string) {
    // Regex pattern to match a full shortcode
    $pattern = '/^\[[a-zA-Z0-9_\-]+[^\]]*\]$/';

    // Check if the string matches the full shortcode pattern
    if (preg_match($pattern, $string)) {
        // Extract shortcode name
        preg_match('/^\[([a-zA-Z0-9_\-]+)/', $string, $matches);
        $shortcode_name = $matches[1] ?? '';

        // Check if the shortcode is registered in WordPress
        if ($shortcode_name && shortcode_exists($shortcode_name)) {
            return true;
        }
    }
    return false;
}
add_filter('wp_video_shortcode_override', 'custom_video_shortcode_output', 10, 2);

function custom_video_shortcode_output($output, $atts) {
    // Temporarily remove the filter to avoid recursion
    remove_filter('wp_video_shortcode_override', 'custom_video_shortcode_output', 10, 2);

    // Use default video shortcode output to ensure consistent rendering
    $output = wp_video_shortcode($atts);

    // Re-add the filter after getting the output
    add_filter('wp_video_shortcode_override', 'custom_video_shortcode_output', 10, 2);

    return $output;
}


// Hook to add the menu item under 'General' settings
add_action('admin_menu', 'custom_settings_menu');

function custom_settings_menu() {
    // Add a submenu under 'General' settings
    add_options_page(
        'Contact Form Settings',            // Page title
        'Contact Form Settings',            // Menu title
        'manage_options',             // Capability required to access the page
        'contact-form-settings',            // Menu slug
        'contact_form_settings'   // Callback function to render the HTML content
    );
}

// Callback function to display the HTML form
function contact_form_settings() {
    // Check if the user has the necessary permissions
    if (!current_user_can('manage_options')) {
        return;
    }

    // Check if the form is submitted and process the form data
    if (isset($_POST['submit'])) {
        // Handle form submission, e.g., sanitize and save data
        $input_value = $_POST['contact_form_settings'];
        // Save the option value
        update_option('contact_form_settings', $input_value);

        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    // Get the existing option value
    $option_value = get_option('contact_form_settings', '');

    // Display the HTML form
    ?>
    <div class="wrap">
        <h1>Contact Form Settings</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Modal Title</th>
                    <td><input type="text" name="contact_form_settings[title]" value="<?php echo esc_attr($option_value['title'] ?? ''); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Modal Description</th>
                    <td>
                    <?php 
                        // Display the WYSIWYG editor
                        wp_editor(
                            ($option_value['description'] ?? ''),   // The content to be displayed
                            'custom_wysiwyg', // Editor ID
                            array(
                                'textarea_name' => 'contact_form_settings[description]', // Name of the textarea
                                'media_buttons' => true,  // Show media buttons
                                'teeny'         => false, // Use minimal editor
                                'textarea_rows' => 10,    // Height of the editor
                                'editor_class'  => 'custom-wysiwyg-class' // CSS class for styling
                            )
                        ); 
                        ?>    
                </tr>

                <?php 
                    // made it array to make it easier to add/remove
                    $forms = [
                        'general-enquiry',
                        'request-showcase-access',
                        'download-presentation-pack',
                        'book-a-meeting'
                    ];

                foreach ($forms as $form) { ?>
                    <tr valign="top">
                        <th scope="row">
                        <?php  
                            $slug = str_replace(['-', '_'], ' ', $form);
                            $title_case = ucwords($slug);    
                            echo $title_case; ?>
                        </th>
                        <td>
                            
                    <?php 
                        // Display the WYSIWYG editor
                        wp_editor(
                            ($option_value[$form] ?? ''),   // The content to be displayed
                            'custom_wysiwyg-'.$form, // Editor ID
                            array(
                                'textarea_name' => 'contact_form_settings['.$form.']', // Name of the textarea
                                'media_buttons' => true,  // Show media buttons
                                'teeny'         => false, // Use minimal editor
                                'textarea_rows' => 10,    // Height of the editor
                                'editor_class'  => 'custom-wysiwyg-class' // CSS class for styling
                            )
                        ); 
                        ?>    
                        </td>
                    </tr>
                <?php }
                ?>
            </table>
            <?php submit_button('Save Settings'); ?>
        </form>
    </div>
    <?php
}

function remove_protected_title_prefix($title) {
    // Remove "Protected: " from the title
    return '%s'; 
}
add_filter('protected_title_format', 'remove_protected_title_prefix');


function getTagsUsedInPostCategory ($postType, $categorySlug) {
    // Get the term ID of the specified category
    $category = get_category_by_slug($categorySlug);
    if (!$category) {
        return array(); // Return empty array if category not found
    }

    // Get all child categories (including the specified category)
    $category_ids = get_term_children($category->term_id, 'category');

    $category_ids[] = $category->term_id; // Include the parent category itself

    // Query for posts in the specified custom post type and all categories
    $query_args = array(
        'post_type' => $postType,
        'posts_per_page' => -1, // Get all posts
        'category__in' => $category_ids, // Filter by category ID including children
        'fields' => 'ids', // Only get post IDs to save memory
    );
    $query = new WP_Query($query_args);

    // Collect tags
    $tags = array();
    if ($query->have_posts()) {
        foreach ($query->posts as $post_id) {
            $post_tags = wp_get_post_tags($post_id);
            foreach ($post_tags as $tag) {
                $tags[$tag->slug] = $tag->name; // Store tag slug as key and name as value
            }
        }
        wp_reset_postdata();
    }

    return $tags;
}

function add_custom_menu_item($items, $args) {
    // Specify the menu location where you want to add the custom item
    if ($args->theme_location == 'mobile-menu') {
        // Custom menu item markup
        $custom_item = '<li class="menu-item custom-menu-item block md:!hidden"><a href="#contact">Contact Us</a></li>';
        
        // Append or prepend the custom item to the existing menu items
        $items .= $custom_item; // To append
        // $items = $custom_item . $items; // To prepend
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_custom_menu_item', 10, 2);

function getAllTagsUsedInPostType ($post_type) {

    // Get all published posts of the specified custom post type
    $args = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => -1, // Fetch all posts
    );

    $query = new WP_Query($args);
    $all_tags = array(); // Array to store all unique tags

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            // Get the tags associated with each post
            $tags = get_the_terms($post_id, 'post_tag');

            if (!is_wp_error($tags) && !empty($tags)) {
                foreach ($tags as $tag) {
                    $all_tags[$tag->term_id] = $tag;
                }
            }
        }
        wp_reset_postdata();
    }

    return $all_tags;
}
function remove_ectoken_from_session() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['ectoken'])) {
        unset($_SESSION['ectoken']);
        wp_send_json_success('ECToken removed from session successfully');
    } else {
        wp_send_json_error('ECToken not found in session', 404);
    }
}

add_action('wp_ajax_remove_ectoken', 'remove_ectoken_from_session');
add_action('wp_ajax_nopriv_remove_ectoken', 'remove_ectoken_from_session');

// The endpoint for this action is: /wp-admin/admin-ajax.php?action=remove_ectoken
function clear_jetpack_cache() {
    if (!current_user_can('manage_options')) {
        wp_send_json_error('You do not have permission to perform this action', 403);
        return;
    }

    $jetpack_active = class_exists('Jetpack') && Jetpack::is_active();

    if ($jetpack_active) {
        // Clear Jetpack page cache
        do_action('jetpack_page_cache_purge_all');

        // Clear Jetpack Boost cache if available
        if (function_exists('jetpack_boost_page_optimize_clear_cache')) {
            jetpack_boost_page_optimize_clear_cache();
        }

        // Clear WordPress object cache
        wp_cache_flush();

        // Clear OPcache if available
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }

        // Clear WP Super Cache if available
        if (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache();
        }

        // Instruct the browser to clear its cache
        header("Clear-Site-Data: \"cache\"");

        wp_send_json_success('All Jetpack and related caches cleared successfully');
    } else {
        wp_send_json_error('Jetpack is not active on this site', 400);
    }
}

add_action('wp_ajax_clear_jetpack_cache', 'clear_jetpack_cache');




function disable_default_stylesheet() {
    wp_dequeue_style( 'monochrome-style' ); // 'theme-style' might be 'your-theme-slug-style'

    
    $style_version = filemtime(get_stylesheet_directory() . '/style.css');
    wp_enqueue_style('monochrome-style-modified', get_stylesheet_uri(), array(), $style_version);
}
add_action( 'wp_enqueue_scripts', 'disable_default_stylesheet', 20 );

function custom_post_permalink($permalink, $post) {
    if ($post->post_type === 'post') {
        return home_url('/monolog/' . $post->post_name . '/');
    }
    return $permalink;
}
add_filter('post_link', 'custom_post_permalink', 10, 2);

function custom_post_rewrite_rules($wp_rewrite) {
    $new_rules = array(
        'monolog/([^/]+)/?$' => 'index.php?post_type=post&name=$matches[1]',
    );
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'custom_post_rewrite_rules');

function flush_rewrite_rules_on_activation() {
    custom_post_rewrite_rules($GLOBALS['wp_rewrite']);
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flush_rewrite_rules_on_activation');


function display_page_conditions() {
    if (current_user_can('administrator')) {
        ?>
        <style>
            #debug-conditions {
                background: #222;
                color: #fff;
                padding: 10px;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: 9999;
                font-size: 20px;
            }
        </style>
        <div id="debug-conditions">
            <strong>Debug Info:</strong> 
            <?php 
            echo json_encode([
                'is_singular' => is_singular(),
                'is_single' => is_single(),
                'is_page' => is_page(),
                'is_home' => is_home(),
                'is_archive' => is_archive(),
                'is_category' => is_category(),
                'is_tag' => is_tag(),
                'is_search' => is_search(),
                'is_404' => is_404(),
            ], JSON_PRETTY_PRINT);
            ?>
        </div>
        <?php
    }
}
// add_action('wp_body_open', 'display_page_conditions');