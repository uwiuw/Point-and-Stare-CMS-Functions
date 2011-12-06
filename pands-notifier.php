<?php
/*
  Plugin Name: Point and Stare Updater
  Plugin URI: http://pointandstare.com
  Description: This MU plugin will generate an update notice for the Point and Stare plugins when required.
  Version: 0.2
  Author: Lee Rickler
  Author URI: http://pointandstare.com

  This plugin is licensed under the GNU General Public License version 2 or later.
 */

add_action('admin_init', 'pands_plugin_init');
add_action('admin_menu', 'pands_plugin_add_page');
add_action('admin_menu', 'pands_plugin_updates');

// Init plugin options to white list our options
function pands_plugin_init() {
    register_setting('pands_plugin_options_group', 'pands_plugin_options');

    /* Setup default values */
    $default_values = array(
        'pands_header_search' => 'Normal',
        'pands_nav_type' => 'One Level',
        'pands_layout' => 'Small Sidebar on Left'
    );

    /* Set the options to a variable */
    $pands_option = get_option('pands_plugin_options');

    /* If the options are empty, add the defaults */
    if (!$pands_option)
        update_option('pands_plugin_options', $default_values);

}

/* Sanitize and validate input. Accepts an array, return a sanitized array. */

function pands_plugin_options_validate($input) {
    if (!is_array($input))
        return $input;

}

/* Check for Point and Stare Plugin updates */

function pands_plugin_updates() {
    global $plugin_update, $changelog_output;

    $theme_data = get_plugin_data(WP_CONTENT_DIR . '/mu-plugins/pands-functions.php');

    $plugin_update['current_version'] = $theme_data['Version'];

    $changelog = file_get_contents('http://pointandstare.com/clients/wp-pands/version.txt');

    preg_match_all('/<version>(.+?)<\/version>/is', $changelog, $matches);
    preg_match_all('/<description>(.+?)<\/description>/is', $changelog, $desc);
    preg_match_all('/<date>(.+?)<\/date>/is', $changelog, $date);

    $changelog_count = count($matches[0]);

    $i = 0;
    foreach ($matches[0] as $val) {
        $changelog_output .= '<h3>' . $val . '</h3><p>' . $date[0][$i] . '</p><p>' . $desc[0][$i] . '</p>';
        $i++;
    }

    if (preg_match('/<item>.*?<version>(.+?)<\/version>.*?<\/item>/is', $changelog, $matches))
        $plugin_update['new_version'] = esc_html($matches[1]);

    if (preg_match('/<item>.*?<description>(.+?)<\/description>.*?<\/item>/is', $changelog, $matches))
        $plugin_update['desc'] = $matches[1];

    if ($plugin_update['current_version'] < $plugin_update['new_version'])
        $opts = "<span class='update-plugins count-1'><span class='update-count'>1</span></span>";

    add_dashboard_page('PandS Updates', 'PandS Updates' . $opts, 'edit_plugins', 'pands_plugin_options', 'pands_plugin_updates_output');

}

function pands_plugin_updates_output() {
    global $plugin_update, $changelog_output;
    ?>
    <div class="wrap">
        <div class="icon32" id="icon-options-general"><br></div>
        <h2>Point and Stare CMS Functions Updates</h2>
        <?php
        if ($plugin_update['current_version'] < $plugin_update['new_version']) {
            echo '<div id="message" class="updated fade">
			<p><strong>There is a new version of the Point and Stare CMS Functions Plugin available</strong>. You have version ' . $plugin_update['current_version'] . ' installed.  Update to ' . $plugin_update['new_version'] . '.</p>
			</div>
			<p>Download the new version and install manually via FTP:</p>
			<p><a class="button" href="https://github.com/PointandStare/Point-and-Stare-CMS-Functions/zipball/master">Download Point and Stare CMS Functions Plugin ' . $plugin_update['new_version'] . '</a></p>
			<p><strong>Please Note:</strong> Depending on your configuration, some settings may be lost. Please install on your test install first.<br />Also, because of the customisations that you\'re required to manually make, you will only download, not automatically install, these files.<br />Once your changes have been made, FTP the file to your mu-plugins folder.
			<h2>Changelog</h2>' . $changelog_output
            ;
        } else {
            ?>
            <h3>You have the latest version of the Point and Stare CMS Functions Plugin.</h3>
        </div>
        <?php
    }

}