<?php
/*
 Plugin Name: Point and Stare CMS Functions
 Plugin URI:https://github.com/PointandStare/Point-and-Stare-CMS-Functions
 Description: This MU plugin will generate special functions that help convert you WordPress install into a CMS, add security, white lable and SEO facilities.
 Version: 1.0.3
 Author: Lee Rickler (and many others)
 Author URI: http://pointandstare.com
 
 This plugin is licensed under the GNU General Public License version 2 or later.
*/

// POINT AND STARE PLUGIN UPDATE NOTIFICATOR
// UN/COMMENT THIS LINE IF YOU DON'T/ DO WANT TO BE NOTIFIED OF UPDATES
// DON'T FORGET TO UPLOAD THE FILE TO YOUR MU-PLUGINS FOLDER

require_once('pands-notifier.php');

// ** MAIN IMAGE REPLACEMENTS ** //

// CUSTOM ADMIN LOGIN HEADER LOGO

function my_custom_login_logo() {
    echo '<style type="text/css"> h1 a { background-image:url('.get_bloginfo('template_directory').'/images/YOUR_MAIN_LOGO.png) !important; } </style>';
   }
add_action('login_head', 'my_custom_login_logo');

// CUSTOM ADMIN LOGIN HEADER LINK & ALT TEXT

function change_wp_login_url() {
    echo bloginfo('url');  // OR ECHO YOUR OWN URL
   }
   function change_wp_login_title() {
    echo get_option('blogname'); // OR ECHO YOUR OWN ALT TEXT
   }
add_filter('login_headerurl', 'change_wp_login_url');
add_filter('login_headertitle', 'change_wp_login_title');

// REMOVE LOGIN ERROR STYLE

add_filter('login_errors',create_function('$a', "return null;"));

// ADD FAVICON

function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.png" />';
}
add_action('wp_head', 'blog_favicon');

// REPLACE ADMIN WP LOGO

add_action('admin_head', 'my_custom_logo');
function my_custom_logo() {
   echo '<style type="text/css">
   li#wp-admin-bar-wp-logo a { background: #000 url('.get_bloginfo('wpurl').'/favicon.png) no-repeat right !important}
   li#wp-admin-bar-wp-logo ul { visibility:hidden; display:none; background:#000!important }</style>';
   }

// ** FRONT END ** //

// * REMOVE HEADER TAT * //
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// Prevents WordPress from testing ssl capability on domain.com/xmlrpc.php?rsd
remove_filter('atom_service_url','atom_service_url_filter');

// ADD JQUERY PROPERLY

if (!is_admin()) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("/PATH/TO/js/main.js"), false);
	wp_enqueue_script('jquery');
}

// ** LOGIN PAGE ** //

add_filter('login_errors', create_function('$a', "return null;"));


// ** BACK END ** //

// REMOVE ADMIN BAR //

add_filter( 'show_admin_bar', '__return_false' );

// REMOVE NEW l10n SCRIPT REFERENCE //

if ( !is_admin() ) {
function my_init_method() {
wp_deregister_script( 'l10n' );
}
add_action('init', 'my_init_method'); 
}

// CHANGE 'HOWDY' TO 'LOGGED IN AS'

function change_howdy($translated, $text, $domain) {
	if (!is_admin() || 'default' != $domain)
	return $translated;
	if (false !== strpos($translated, 'Howdy,'))
	return str_replace('Howdy,', 'Logged in as', $translated);
	return $translated;
	}
add_filter('gettext', 'change_howdy', 10, 3);

// REMOVE UNUSED PROFILE FIELDS

	function my_new_contactmethods( $contactmethods ) {
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	return $contactmethods;
	}
add_filter('user_contactmethods','my_new_contactmethods',10,1);

// STOP NAGGING ME //

add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

// REMOVE META BOXES FROM DEFAULT PAGES SCREEN
// Un/comment as required

function pands_remove_boxes() {

	// *** For posts *** //
	//remove_meta_box( 'postcustom' , 'post' , 'normal' );
	//remove_meta_box( 'postexcerpt' , 'post' , 'normal' );
	//remove_meta_box( 'trackbacksdiv' , 'post' , 'normal' );
	//remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' );
	//remove_meta_box( 'revisionsdiv' , 'post' , 'normal' );
	//remove_meta_box( 'authordiv' , 'post' , 'normal' );
	//remove_meta_box( 'categorydiv' , 'post' , 'normal' );
	//remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' );
	//remove_meta_box( 'submitdiv' , 'post' , 'normal' );

	// *** For pages *** //
	//remove_meta_box( 'postcustom' , 'page' , 'normal' );
	//remove_meta_box( 'commentsdiv' , 'page' , 'normal' );
	//remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' );
	//remove_meta_box( 'revisionsdiv' , 'page' , 'normal' );
	//remove_meta_box( 'authordiv' , 'page' , 'normal' );
	//remove_meta_box( 'pageparentdiv' , 'page' , 'normal' );
	//remove_meta_box( 'submitdiv' , 'page' , 'normal' );
	//remove_meta_box( 'postexcerpt' , 'page' , 'normal' );
}

add_action('admin_init', 'pands_remove_boxes');

// DISABLE DEFAULT DASHBOARD WIDGETS
// Un/comment as required

function disable_default_dashboard_widgets() {
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

// REMOVE DEFAULT WIDGETS //
// Un/comment as required

add_action( 'widgets_init', 'my_unregister_widgets' );

function my_unregister_widgets() {
	unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Archives' );
	unregister_widget( 'WP_Widget_Links' );
	unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Search' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Widget_RSS' );
}

// REMOVE MENU ITEMS
// Un/comment as required

function remove_admin_menus(){
	remove_menu_page('link-manager.php'); // Links
    remove_menu_page('edit-comments.php'); // Comments
    remove_menu_page('tools.php'); // Tools
    //remove_menu_page('themes.php'); // Appearence
	// remove_menu_page('upload.php'); // Media
    // remove_menu_page('edit.php?post_type=page'); // Pages
    // remove_menu_page('plugins.php'); // Plugins
    // remove_menu_page('themes.php'); // Appearance
    // remove_menu_page('users.php'); // Users
    // remove_menu_page('options-general.php'); // Settings
    }
add_action('admin_menu', 'remove_admin_menus');

function remove_submenus() {
	global $submenu;
	unset($submenu['index.php'][10]); // Removes 'Updates'
	//unset($submenu['themes.php'][5]); // Removes 'Themes'
	//unset($submenu['themes.php'][7]); // Removes 'Widgets'
	//unset($submenu['themes.php'][10]); // Removes 'Menu'
	unset($submenu['edit.php'][16]); // Removes 'Tags'
	unset($submenu['plugins.php'][15]); // Removes 'Plugin editor'
	unset($submenu['options-general.php'][15]); // Removes 'Writing'
	unset($submenu['options-general.php'][25]); // Removes 'Discussion'
	unset($submenu['options-general.php'][20]); // Removes 'Reading'
	unset($submenu['options-general.php'][35]); // Removes 'Privacy'
	unset($submenu['options-general.php'][40]); // Removes 'Permalinks'
	}
add_action('admin_menu', 'remove_submenus');

// AND THEN CHANGE THE ADMIN MENU ORDER
   function custom_menu_order($menu_ord) {
       if (!$menu_ord) return true;
       return array(
        'index.php', // Dashboard
        'edit.php', // Posts
        'edit.php?post_type=page', // Pages
        'upload.php', // Media
        'users.php', // Users
        'plugins.php', // Plugins
    );
   }
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');

// ** REMOVE EDITOR FROM ADMIN MENU ** //
function remove_editor_menu() {
   remove_action('admin_menu', '_add_themes_utility_last', 101);
   }
add_action('_admin_menu', 'remove_editor_menu', 1);

function custom_pages_columns($defaults) {
   unset($defaults['comments']);
   return $defaults;
   }
add_filter('manage_pages_columns', 'custom_pages_columns');

// ** AND COMMENTS FROM THE DROPDOWN ** //

function custom_favorite_actions($actions) {
   unset($actions['edit-comments.php']);
   return $actions;
   }
add_filter('favorite_actions', 'custom_favorite_actions');

// CUSTOM COMMENTS

function wp_threaded_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
	?>
		<li <?php comment_class(); ?>>
			<div class="comment clearfix">
				<div class="ct-avatar"><?php echo get_avatar( $comment, 20 ); ?></div>
				<span class="ct-author"><?php if(get_comment_author_url()) : ?><a href="<?php echo get_comment_author_url(); ?>"><?php comment_author(); ?></a><?php else : ?><?php comment_author(); ?><?php endif; ?></span>
				<span class="ct-date"><?php printf(__('%1$s at %2$s',''), get_comment_date(), get_comment_time()); ?></span>
				<div class="ct-text clearfix" id="comment-<?php comment_ID() ?>">
					<?php comment_text(); ?>
					<?php if ($comment->comment_approved == '0'): ?><p class="warning"><?php _e('Your comment is awaiting moderation.','mystique'); ?></p><?php endif; ?>
					<div class="clearfix">
						<?php if (function_exists('comment_reply_link')) { comment_reply_link(array_merge( $args, array('add_below' => 'comment-reply', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'Reply &not;'))); } ?>
					</div>
					<a id="comment-reply-<?php comment_ID() ?>"></a>
				</div>
			</div>
	<?php
	}

// MAIN DASHBOARD PANEL

function first_pands_dashboard_widget() { 
echo '<h3>Hello '.get_bloginfo('name').' user!</h3>
<p>Fill this with more HTML or PHP.</p>';
echo '<h3>Hello WordPress user!</h3>
<p>Write any required messages in here</p>';
 }
function add_first_pands_dashboard_widget() {
  wp_add_dashboard_widget( 'first_pands_dashboard_widget', __( 'Widget Title!' ), 'first_pands_dashboard_widget' );
}
add_action('wp_dashboard_setup', 'add_first_pands_dashboard_widget' );

// SECONDARY DASBOARD PANEL

function second_pands_dashboard_widget() { 
echo '<h3>Add Blog Article</h3>
<p>You can drag/ drop this over to the right side.</p>';
 }
function add_second_pands_dashboard_widget() {
  wp_add_dashboard_widget( 'second_pands_dashboard_widget', __( 'HOW TO:' ), 'second_pands_dashboard_widget' );
}
add_action('wp_dashboard_setup', 'add_second_pands_dashboard_widget' );

// ADD FEATURED IMAGES //

add_theme_support( 'post-thumbnails' );
add_post_type_support( 'page', 'excerpt' );
add_image_size('post-secondary-image-thumbnail', 340, 221);

// ** REMOVE HELP TAB AND TEXT ** //

class RemoveAdminHelpLinkButton {
  static function on_load() {
    add_filter('contextual_help',array(__CLASS__,'contextual_help'));
    add_action('admin_notices',array(__CLASS__,'admin_notices'));
  }
  static function contextual_help($contextual_help) {
    ob_start();
    return $contextual_help;
  }
  static function admin_notices() {
    echo preg_replace('#<div id="contextual-help-link-wrap".*>.*</div>#Us','',ob_get_clean());
	echo preg_replace('#<div id="mapp_metabox".*>.*</div>#Us','',ob_get_clean());
  }
}
RemoveAdminHelpLinkButton::on_load();

class RemovePageAttributesHelpText {
  static function on_load() {
    add_action('admin_notices',array(__CLASS__,'admin_notices'));
    add_action('dbx_post_sidebar',array(__CLASS__,'dbx_post_sidebar'));
  }
  static function admin_notices() {
    ob_start();
  }
  static function dbx_post_sidebar() {
    $match_text = '<p>Need help? Use the Help tab in the upper right of your screen.</p>';
    echo str_replace($match_text,'',ob_get_clean());
  }
}
RemovePageAttributesHelpText::on_load();

// ** REMOVE EXCERPT META BOX TEXT ** //

class RemoveUnwantedPageEditingText {
  static function on_load() {
    add_action('admin_notices',array(__CLASS__,'admin_notices'));
    add_action('dbx_post_sidebar',array(__CLASS__,'dbx_post_sidebar'));
  }
  static function admin_notices() {
    ob_start();
  }
  static function dbx_post_sidebar() {
    $html = str_replace('<p>Need help? Use the Help tab in the upper right of your screen.</p>','',ob_get_clean());
    echo str_replace('Excerpts are optional hand-crafted summaries of your content that can be used in your theme.' .
     ' <a href="http://codex.wordpress.org/Excerpt" target="_blank">Learn more about manual excerpts.</a>','',$html);
  }
}
RemoveUnwantedPageEditingText::on_load();

// REMOVE SPECIFIC MENU ITEMS

function remove_menus () {
global $menu;
if( (current_user_can('install_themes')) ) { $restricted = array(__('')); } // check if admin and hide these for admins
else { $restricted = array(__('Links'),__('Settings'), __('Tools')); } // hide these for other roles
end ($menu);
while (prev($menu)){
$value = explode(' ',$menu[key($menu)][0]);
if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
}
}
add_action('admin_menu', 'remove_menus');

// CHANGE DEFAULT FROM EMAIL ADDRESS

function res_fromemail($email) {
    $wpfrom = get_option('admin_email');
    return $wpfrom;
}

function res_fromname($email){
    $wpfrom = get_option('blogname');
    return $wpfrom;
}

add_filter('wp_mail_from', 'res_fromemail');
add_filter('wp_mail_from_name', 'res_fromname');

// ADMIN FOOTER STUFF

function modify_footer_admin () {
  echo '<a href="http://MYURL.com"><img src="http://PATH/TO/image.png" /></a> '.get_bloginfo('name').' online presence developed by <a href="http://MYURL.com">MY COMPANY</a>.';
}

add_filter('admin_footer_text', 'modify_footer_admin');
function change_footer_version() {
  return 'Version 1.0';
}
add_filter( 'update_footer', 'change_footer_version', 9999 );

// - AND FINALLY - //

// Add robots.txt rules

function mytheme_robots()
{
	echo "Disallow: /cgi-bin\n";
	echo "Disallow: /wp-admin\n";
	echo "Disallow: /wp-includes\n";
	echo "Disallow: /tag\n";
	echo "Disallow: /wget\n";
	echo "Disallow: /httpd\n";
	echo "Disallow: /wp-content\n";
	echo "Disallow: /wp-content/plugins\n";
	echo "Disallow: /wp-content/cache\n";
	echo "Disallow: /wp-content/themes\n";
	echo "Disallow: /wp-content/upgrade\n";
	echo "Disallow: /wp-content/uploads\n";
	echo "Disallow: /trackback\n";
	echo "Disallow: /feed\n";
	echo "Disallow: /comments\n";
	echo "Disallow: /category/*/*\n";
	echo "Disallow: */trackback\n";
	echo "Disallow: */feed\n";
	echo "Disallow: */comments\n";
	echo "Disallow: /*?*\n";
	echo "Disallow: /*?\n";
	echo "Disallow: */print\n\n";
	
	echo "User-agent: Googlebot-Image\n";
	echo "Disallow:/* \n\n";
	
	echo "User-agent: Mediapartners-Google*\n";
	echo "Disallow:/* \n\n";
	
	echo "User-agent: Adsbot-Google\n";
	echo "Disallow: /\n\n";
	
	echo "User-agent: Googlebot-Mobile\n";
	echo "Allow: /\n\n";
	
	echo "User-agent: duggmirror\n";
	echo "Disallow:/* \n\n";
	
	echo "Sitemap: http://MYDOMAIN.com/sitemap.xml";
	
}
add_action( 'do_robots', 'mytheme_robots' );

// ** Add Google Analytics Tracking Code ** ??
function add_google_analytics() {
?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php
}
add_action('wp_footer', 'add_google_analytics');
?>