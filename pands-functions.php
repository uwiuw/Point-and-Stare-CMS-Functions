<?php
/*
  Plugin Name: Point and Stare CMS Functions
  Plugin URI: https://github.com/PointandStare/Point-and-Stare-CMS-Functions
  Description: This MU plugin will generate special functions that help convert your WordPress install into a CMS, add security and generally white label the admin.
  Version: 2.0.1
  Author: Lee Rickler
  Author URI: http://pointandstare.com
  This plugin is licensed under the GNU General Public License version 2 or later.
  THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

 */

// TO REMOVE THIS FROM YOUR SETTINGS MENU SIMPLY UNCOMMENT THIS LITTLE LOT
//function delete_submenu_items() {
//    remove_submenu_page('options-general.php', UW_P_SLUG);
//
//}
//add_action('admin_init', 'delete_submenu_items');
// add the admin options page

define('UW_P_SLUG', 'pands-script');

function isWeOnOurPage() {
    $page = $_GET['page'];
    if ($page === UW_P_NAME) {
        return true;
    }

    return false;

}

function pands_all_hooks() {

    $options = get_option('pands_script_plugin_options');
    if (defined('WP_ADMIN')) {
        add_action('admin_init', 'pands_script_admin_init');
        add_action('admin_init', 'pands_remove_boxes');

        //all admin-page-rendering-related hook
        add_filter('admin_title', 'pands_admin_title');
        add_action('admin_head', 'pands_custom_admin_logo');
        add_filter('admin_footer_text', 'modify_footer_admin');
        if ($options['footer_ver'] != "") {
            add_filter('update_footer', 'change_footer_version', 9999);
        }

        //all menu-related hook
        add_action('admin_menu', 'pands_script_add_page');
        add_action('admin_menu', 'disable_default_dashboard_widgets');
        add_action('admin_menu', 'remove_admin_menus');
        add_action('admin_menu', 'remove_submenus');

        //backend page coolums
        add_filter('manage_pages_columns', 'custom_pages_columns');

        if (isWeOnOurPage()) {
            /**
             * initiate jquery only on our page
             */
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-tabs');

            wp_deregister_script('jquery');
            if ($options['jquery_path'] != "") {
                wp_register_script('jquery', ($options['jquery_path']), false);
            } else {
                wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.js"), true);
            }
            wp_enqueue_script('jquery');
        }

        if ($options['change_howdy'] != "") {
            add_filter('gettext', 'change_howdy', 10, 3);
        }
        /**
         * @todo make this operation only happen in dashboard
         */
        if ($options['add_first_pands_dashboard_widget'] == 1) {
            add_action('wp_dashboard_setup', 'add_first_pands_dashboard_widget');
        }
        if ($options['add_second_pands_dashboard_widget'] == 1) {
            add_action('wp_dashboard_setup', 'add_second_pands_dashboard_widget');
        }
    } else {
        /**
         * @todo seperate between login pae and default wp template.
         */
        add_action('do_robots', 'mytheme_robots'); //no robot can access backend
        add_action('login_head', 'my_custom_login_logo');
        add_filter('login_headerurl', 'change_wp_login_url');
        add_filter('login_headertitle', 'change_wp_login_title');
        add_action('wp_head', 'blog_favicon');

        // REMOVE HEADER TAT
        if ($options['remove_rsd_link'] == 1)
            remove_action('wp_head', 'rsd_link');
        if ($options['remove_wp_generator'] == 1)
            remove_action('wp_head', 'wp_generator');
        if ($options['remove_feed_links'] == 1)
            remove_action('wp_head', 'feed_links', 2);
        if ($options['remove_index_rel_link'] == 1)
            remove_action('wp_head', 'index_rel_link');
        if ($options['remove_wlwmanifest_link'] == 1)
            remove_action('wp_head', 'wlwmanifest_link');
        if ($options['remove_feed_links_extra'] == 1)
            remove_action('wp_head', 'feed_links_extra', 3);
        if ($options['remove_start_post_rel_link'] == 1)
            remove_action('wp_head', 'start_post_rel_link', 10, 0);
        if ($options['remove_parent_post_rel_link'] == 1)
            remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        if ($options['remove_adjacent_posts_rel_link_wp_head'] == 1)
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    }

    //front and backend hooking
    add_action('wp_before_admin_bar_render', 'sl_dashboard_tweaks_render');
    add_action('widgets_init', 'my_unregister_widgets');
    if ($options['remove_admin_bar'] == 1) {
        add_filter('show_admin_bar', '__return_false');
    }
    if ($options['google_analytics_number'] != "") {
        add_action('wp_footer', 'add_google_analytics');
    }

}

//main loader
add_action('plugins_loaded', 'pands_all_hooks');

function pands_script_add_page() {
    add_options_page('PandS CMS', 'PandS CMS Functions', 'manage_options', UW_P_SLUG, 'pands_script_page');

}

function pands_script_admin_init() {
    register_setting('pands_script_options', 'pands_script_plugin_options');

}

// display the admin options page
function pands_script_page() {
    include( 'html' . DIRECTORY_SEPARATOR . 'script_page.php');

}

// Rename the admin page title
function pands_admin_title() {
    $options = get_option('pands_script_plugin_options');
    if ($options['admin_title'] == "") {
        $new_title = __('Control panel for ', 'pands_admin') . get_option('blogname');
    }
    else
        $new_title = $options['admin_title'];

    return $new_title;

}

// 	function pands_admin_favicon() { $options =
// get_option('pands_script_plugin_options'); if
// ($options['admin_favicon_url'] == ""){ echo '<style type="text/css">
// li#wp-admin-bar-wp-logo a { background: #000
// url('.get_bloginfo('wpurl').'/favicon.png) no-repeat right
// !important} li#wp-admin-bar-wp-logo ul { visibility:hidden;
// display:none; background:#000!important }</style>';
//    }
// 	   else echo '<link rel="Shortcut Icon" type="image/x-icon"
//    href="'.$options['admin_favicon_url'].'" />';
//    add_action('admin_head', 'pands_admin_favicon');
// }
// REPLACE ADMIN WP LOGO
function pands_custom_admin_logo() {
    $options = get_option('pands_script_plugin_options');
    if ($options['admin_wp_logo'] == "") {
        echo '<style type="text/css">
   li#wp-admin-bar-wp-logo a, #wp-logo { background: url(' . get_bloginfo('wpurl') . '/favicon.png) no-repeat right !important}
   #wpadminbar .ab-wp-logo {display:block;height: 28px;width:16px;  background:none!important }</style>';
    } else {
        echo '<style type="text/css">
   li#wp-admin-bar-wp-logo a, #wp-logo { background: url(' . $options['admin_wp_logo'] . ') no-repeat right !important}
   #wpadminbar .ab-wp-logo {display:block;height: 28px;width:16px;  background:none!important }</style>';
    }

}

// LOGIN HEADER LOGO
function my_custom_login_logo() {
    $options = get_option('pands_script_plugin_options');
    if ($options['custom_admin_header_logo'] == "") {

    } else {
        echo '<style type="text/css"> h1 a { background-image:url(' . $options['custom_admin_header_logo'] . '/images/YOUR_MAIN_LOGO.png) !important; } </style>';
    }

}

// CUSTOM ADMIN LOGIN HEADER LINK & ALT TEXT
function change_wp_login_url() {
    $options = get_option('pands_script_plugin_options');
    if ($options['custom_admin_login_header_link'] == "") {
        echo bloginfo('url');  // OR ECHO YOUR OWN URL}
    } else {
        echo $options['custom_admin_login_header_link'];
    }

}

function change_wp_login_title() {
    $options = get_option('custom_admin_login_header_link_alt_text');
    if ($options['custom_admin_login_header_link_alt_text'] == "") {
        echo get_option('blogname'); // OR ECHO YOUR OWN ALT TEXT
    } else {
        echo $options['custom_admin_login_header_link_alt_text'];
    }

}

// ADD FAVICON
function blog_favicon() {
    $options = get_option('pands_script_plugin_options');
    if ($options['blog_favicon'] == "") {
        echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo('wpurl') . '/favicon.png" />';
    } else {
        echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . $options['blog_favicon'] . '" />';
    }

}

// CHANGE 'HOWDY' TO 'LOGGED IN AS'
function change_howdy($translated, $text, $domain) {
    $options = get_option('pands_script_plugin_options');
    if (!is_admin() || 'default' != $domain)
        return $translated;
    if (false !== strpos($translated, 'Howdy,'))
        return str_replace('Howdy,', $options['change_howdy'], $translated);
    return $translated;

}

// REMOVE META BOXES FROM DEFAULT PAGES SCREEN
function pands_remove_boxes() {
    $options = get_option('pands_script_plugin_options');
    // *** For posts *** //
    if ($options['postcustom_post'] == 1)
        remove_meta_box('postcustom', 'post', 'normal');
    if ($options['postexcerpt_post'] == 1)
        remove_meta_box('postexcerpt', 'post', 'normal');
    if ($options['trackbacksdiv_post'] == 1)
        remove_meta_box('trackbacksdiv', 'post', 'normal');
    if ($options['commentstatusdiv_post'] == 1)
        remove_meta_box('commentstatusdiv', 'post', 'normal');
    if ($options['revisionsdiv_post'] == 1)
        remove_meta_box('revisionsdiv', 'post', 'normal');
    if ($options['authordiv_post'] == 1)
        remove_meta_box('authordiv', 'post', 'normal');
    if ($options['categorydiv_post'] == 1)
        remove_meta_box('categorydiv', 'post', 'normal');
    if ($options['tagsdiv-post_tag_post'] == 1)
        remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
    if ($options['submitdiv_post'] == 1)
        remove_meta_box('submitdiv', 'post', 'normal');

    // *** For pages *** //
    if ($options['postcustom_page'] == 1)
        remove_meta_box('postcustom', 'page', 'normal');
    if ($options['commentsdiv_page'] == 1)
        remove_meta_box('commentsdiv', 'page', 'normal');
    if ($options['commentstatusdiv_page'] == 1)
        remove_meta_box('commentstatusdiv', 'page', 'normal');
    if ($options['revisionsdiv_page'] == 1)
        remove_meta_box('revisionsdiv', 'page', 'normal');
    if ($options['authordiv_page'] == 1)
        remove_meta_box('authordiv', 'page', 'normal');
    if ($options['pageparentdiv_page'] == 1)
        remove_meta_box('pageparentdiv', 'page', 'normal');
    if ($options['submitdiv_page'] == 1)
        remove_meta_box('submitdiv', 'page', 'normal');
    if ($options['postexcerpt_page'] == 1)
        remove_meta_box('postexcerpt', 'page', 'normal');

}

// DISABLE DEFAULT DASHBOARD WIDGETS
function disable_default_dashboard_widgets() {
    $options = get_option('pands_script_plugin_options');
    if ($options['dashboard_right_now'] == 1)
        remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    if ($options['dashboard_recent_comments'] == 1)
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    if ($options['dashboard_incoming_links'] == 1)
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    if ($options['dashboard_plugins'] == 1)
        remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    if ($options['dashboard_quick_press'] == 1)
        remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
    if ($options['dashboard_recent_drafts'] == 1)
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    if ($options['dashboard_primary'] == 1)
        remove_meta_box('dashboard_primary', 'dashboard', 'core');
    if ($options['dashboard_secondary'] == 1)
        remove_meta_box('dashboard_secondary', 'dashboard', 'core');

}

// REMOVE DEFAULT WIDGETS //
function my_unregister_widgets() {
    $options = get_option('pands_script_plugin_options');
    if ($options['WP_Widget_Pages'] == 1)
        unregister_widget('WP_Widget_Pages');
    if ($options['WP_Widget_Meta'] == 1)
        unregister_widget('WP_Widget_Meta');
    if ($options['WP_Widget_Calendar'] == 1)
        unregister_widget('WP_Widget_Calendar');
    if ($options['WP_Widget_Archives'] == 1)
        unregister_widget('WP_Widget_Archives');
    if ($options['WP_Widget_Links'] == 1)
        unregister_widget('WP_Widget_Links');
    if ($options['WP_Widget_Categories'] == 1)
        unregister_widget('WP_Widget_Categories');
    if ($options['WP_Widget_Recent_Posts'] == 1)
        unregister_widget('WP_Widget_Recent_Posts');
    if ($options['WP_Widget_Search'] == 1)
        unregister_widget('WP_Widget_Search');
    if ($options['WP_Widget_Tag_Cloud'] == 1)
        unregister_widget('WP_Widget_Tag_Cloud');
    if ($options['WP_Widget_RSS'] == 1)
        unregister_widget('WP_Widget_RSS');
    if ($options['WP_Widget_Tag_Cloud'] == 1)
        unregister_widget('WP_Widget_Tag_Cloud');
    if ($options['WP_Widget_Recent_Comments'] == 1)
        unregister_widget('WP_Widget_Recent_Comments');
    if ($options['WP_Nav_Menu_Widget'] == 1)
        unregister_widget('WP_Nav_Menu_Widget');
    if ($options['WP_Widget_Text'] == 1)
        unregister_widget('WP_Widget_Text');

}

// REMOVE MENU ITEMS
function remove_admin_menus() {
    $options = get_option('pands_script_plugin_options');
    if ($options['link-manager_menu_item'] == 1)
        remove_menu_page('link-manager.php'); // Links
    if ($options['edit-comments_menu_item'] == 1)
        remove_menu_page('edit-comments.php'); // Comments
    if ($options['tools_menu_item'] == 1)
        remove_menu_page('tools.php'); // Tools
    if ($options['themes_menu_item'] == 1)
        remove_menu_page('themes.php'); // Appearance
    if ($options['upload_menu_item'] == 1)
        remove_menu_page('upload.php'); // Media
    if ($options['edit_menu_item'] == 1)
        remove_menu_page('edit.php?post_type=page'); // Pages
    if ($options['plugins_menu_item'] == 1)
        remove_menu_page('plugins.php'); // Plugins
    if ($options['users_menu_item'] == 1)
        remove_menu_page('users.php'); // Users
    if ($options['options-general_menu_item'] == 1)
        remove_menu_page('options-general.php'); // Settings

}

// REMOVE SUBMENUS
function remove_submenus() {
    $options = get_option('pands_script_plugin_options');
    global $submenu;
    if ($options['updates_submenu'] == 1)
        unset($submenu['index.php'][10]); // Removes 'Updates'
    if ($options['themes_submenu'] == 1)
        unset($submenu['themes.php'][5]); // Removes 'Themes'
    if ($options['widgets_submenu'] == 1)
        unset($submenu['themes.php'][7]); // Removes 'Widgets'
    if ($options['menu_submenu'] == 1)
        unset($submenu['themes.php'][10]); // Removes 'Menu'
    if ($options['tags_submenu'] == 1)
        unset($submenu['edit.php'][16]); // Removes 'Tags'
    if ($options['plugin_editor_submenu'] == 1)
        unset($submenu['plugins.php'][15]); // Removes 'Plugin editor'
    if ($options['writing_submenu'] == 1)
        unset($submenu['options-general.php'][15]); // Removes 'Writing'
    if ($options['discussion_submenu'] == 1)
        unset($submenu['options-general.php'][25]); // Removes 'Discussion'
    if ($options['reading_submenu'] == 1)
        unset($submenu['options-general.php'][20]); // Removes 'Reading'
    if ($options['privacy_submenu'] == 1)
        unset($submenu['options-general.php'][35]); // Removes 'Privacy'
    if ($options['permalinks_submenu'] == 1)
        unset($submenu['options-general.php'][40]); // Removes 'Permalinks'

}

// Remove WordPress sub-menu from the admin bar, add custom admin logo instead and remove "Visit Site" sub-menu under site-name.
// Piet Bos  (email: senlinonline@gmail.com)
function sl_dashboard_tweaks_render() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
        'id' => 'wp-logo',
        'title' => '<span class="sl-dashboard-logo"></span>',
        'href' => is_admin() ? home_url('/') : admin_url(),
        'meta' => array(
            'title' => __('Visit the Frontend of your website'),
        ),
    ));
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('view-site');

}

function custom_pages_columns($defaults) {
    unset($defaults['comments']);
    return $defaults;

}

// CUSTOM COMMENTS
function wp_threaded_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?>>
        <div class="comment clearfix">
            <div class="ct-avatar"><?php echo get_avatar($comment, 20); ?></div>
            <span class="ct-author"><?php if (get_comment_author_url()) : ?><a href="<?php echo get_comment_author_url(); ?>"><?php comment_author(); ?></a><?php else : ?><?php comment_author(); ?><?php endif; ?></span>
            <span class="ct-date"><?php printf(__('%1$s at %2$s', ''), get_comment_date(), get_comment_time()); ?></span>
            <div class="ct-text clearfix" id="comment-<?php comment_ID() ?>">
                <?php comment_text(); ?>
                <?php if ($comment->comment_approved == '0'): ?><p class="warning"><?php _e('Your comment is awaiting moderation.', 'mystique'); ?></p><?php endif; ?>
                <div class="clearfix">
                    <?php
                    if (function_exists('comment_reply_link')) {
                        comment_reply_link(array_merge($args, array('add_below' => 'comment-reply', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'Reply &not;')));
                    }
                    ?>
                </div>
                <a id="comment-reply-<?php comment_ID() ?>"></a>
            </div>
        </div>
        <?php

    }

// MAIN DASHBOARD PANEL
    function first_pands_dashboard_widget() {
        $options = get_option('pands_script_plugin_options');
        echo '<h3>' . $options['main_dashboard_title'] . '</h3><p>' . $options['main_dashboard_body'] . '</p>';

    }

    function add_first_pands_dashboard_widget() {
        wp_add_dashboard_widget('first_pands_dashboard_widget', __('Welcome'), 'first_pands_dashboard_widget');

    }

// SECONDARY DASBOARD PANEL
    function second_pands_dashboard_widget() {
        $options = get_option('pands_script_plugin_options');
        echo '<h3>' . $options['secondary_dashboard_title'] . '</h3>
<p>' . $options['secondary_dashboard_body'] . '</p>';

    }

    function add_second_pands_dashboard_widget() {
        wp_add_dashboard_widget('second_pands_dashboard_widget', __('HOW TO:'), 'second_pands_dashboard_widget');

    }

// OPTIONAL - AUTO CREATE ROBOTS.TXT FILE
// ADAPT AS REQUIRED
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

// ADMIN FOOTER STUFF
    function modify_footer_admin() {
        $options = get_option('pands_script_plugin_options');
        echo '<a href="' . $options['company_url'] . '"><img src="' . $options['favicon_company_url'] . '" /></a> ' . get_bloginfo('name') . ' online presence developed by <a href="' . $options['company_url'] . '">' . $options['company_name'] . '</a>.';

    }

    function change_footer_version() {
        $options = get_option('pands_script_plugin_options');
        return 'Version ' . $options['footer_ver'];

    }

    // ADD GOOGLE ANALYTICS TRACKING CODE
    function add_google_analytics() {
        $options = get_option('pands_script_plugin_options');
        ?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '<?php echo $options['google_analytics_number']; ?>']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    <?php

}