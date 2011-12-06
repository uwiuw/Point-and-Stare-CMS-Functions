<div>
    <h2>Point and Stare CMS functions WordPress plugin</h2>
    <h3>This MU plugin will generate special functions that help convert your WordPress install into a CMS, add security and generally white label the admin.</h3>
    <p>Simply choose the options required, below, and click save to see changes.<br />I welcome further suggestions, corrections or simply a better way of doing stuff, so feel free to <a href="mailto:lee@pointandstare.com">email</a> or <a href="https://github.com/PointandStare/Point-and-Stare-CMS-Functions" target="_blank">fork</a>.</p>
    <style media="screen" type="text/css">
        div#tabs-pands-script ul {
            list-style:none
        }

        div#tabs-pands-script ul li {
            background:#eee;
            display:inline-block;
            height:30px;
            padding:10px 15px 0 15px;
            width:auto
        }

        div#tabs-pands-script ul li a {
            color:#555;
            font-weight:bold;
            text-decoration:none;
            display:block;
            height:30px;
        }

        div#tabs-pands-script ul li:hover, div#tabs-pands-script ul li:hover a, div#tabs-pands-script ul li.ui-tabs-selected,
        div#tabs-pands-script ul li.ui-tabs-selected a{
            background:#555;
            color:#fff;
        }

        div#tabs-pands-script ul li {
            border-radius: 3px 3px 0px 0px;
            -moz-border-radius: 3px 3px 0px 0px;
            -webkit-border-radius: 3px 3px 0px 0px;
            border: 0px solid #800000
        }

        table.pands-cms-options-table {
            padding:3px
        }

        table.pands-cms-options-table td.panel-title {
            background:#555;
            color:#fff
        }

        table.pands-cms-options-table th {
            text-align:left;
            font-weight:normal
        }
        table.pands-cms-options-table th, table.pands-cms-options-table td {
            background:#e8e8e8;
            margin:6px;
            padding:6px
        }

        table.pands-cms-options-table .th-small {
            color:#666;
            font-size:86%
        }

        table.pands-cms-options-table td input {
            display:block;
            width:260px
        }

        input.checkbox {
            background:#fff;
            display:inline-block;
            border:1px solid #000;
            width:16px;
            height:16px
        }

    </style>
    <script>
        jQuery(function() {
            jQuery( "#tabs-pands-script" ).tabs();
        });
    </script>
    <form action="options.php" method="post">
        <?php settings_fields('pands_script_options'); ?>
        <?php $options = get_option('pands_script_plugin_options'); ?>
        <div id="tabs-pands-script">
            <ul>
                <li><a href="#tabs-pands-admin" title="Use these fields to personalise the login page and admin area">General settings</a></li>
                <li id="pands-dashboard" title="You can remove widgets and add your own panels using these options"><a href="#tabs-pands-dashboard">Custom dashboard settings</a></li>
                <li title="Keep the write pages to a minimal by reducing clutter"><a href="#tabs-pands-pages-posts">Pages &amp; Posts</a></li>
                <li title="If you need to stop your client adding a ton of widgets, switch them off here"><a href="#tabs-pands-widgets">Widgets</a></li>
                <li title="Use these options to change elements on the front end of the website"><a href="#tabs-pands-front-end">Front end</a></li>
            </ul>
            <input name="Submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" /><br />
            <div id="tabs-pands-admin">
                <h3>Use these fields to personalise the login page and admin area.</h3>
                <table class="pands-cms-options-table">
                    <tr>
                        <td class="panel-title" colspan="2">Custom login page</td>
                    </tr>
                    <tr>
                        <td>Change the Login logo<br /><span class="th-small">Default is the WordPress logo - 310px x 70px</span></td>
                        <td><input class="ui-widget-text" name="pands_script_plugin_options[custom_admin_header_logo]" type="text" value="<?php echo $options['custom_admin_header_logo']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Login logo link<br /><span class="th-small">Only change this if required - default is your site URL</span></td>
                        <td><input class="ui-widget-text" name="pands_script_plugin_options[custom_admin_login_header_link]" type="text" value="<?php echo $options['custom_admin_login_header_link']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Login page logo Alt text<br /><span class="th-small">Change this to your company strapline</span></td>
                        <td><input class="ui-widget-text" name="pands_script_plugin_options[custom_admin_login_header_link_alt_text]" type="text" value="<?php echo $options['custom_admin_login_header_link_alt_text']; ?>" /></td>
                    </tr>
                </table>
                <table class="pands-cms-options-table">
                    <tr>
                        <td class="panel-title" colspan="2">Global Admin area</td>
                    </tr>
                    <tr>
                        <td title="Change the Admin page title">Admin page title</td>
                        <td><input class="ui-widget-text" name="pands_script_plugin_options[admin_title]" type="text" value="<?php echo $options['admin_title']; ?>" /></td>
                    </tr>
                    <!--
                    // NEED TO REVISIT THIS
                    <tr>
                        <th scope="row">Admin Favicon url<br /><span class="th-small">Only change this if required, default is to your site URL</span></th>
                        <td><input class="ui-widget-text" name="pands_script_plugin_options[admin_favicon_url]" type="text" value="<?php echo $options['admin_favicon_url']; ?>" /></td>
                    </tr>
                    -->
                    <tr>
                        <th scope="row">Admin WP Logo<br /><span class="th-small">Paste the full path to change admin logo (top left)<br />or leave blank to use your main favicon</span></th>
                        <td><input class="ui-widget-text" name="pands_script_plugin_options[admin_wp_logo]" type="text" value="<?php echo $options['admin_wp_logo']; ?>" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Don't like 'Howdy'?<br /><span class="th-small">Change it.</span></th>
                        <td><input class="ui-widget-text" name="pands_script_plugin_options[change_howdy]" type="text" value="<?php echo $options['change_howdy']; ?>" /></td>
                    </tr>
                </table>
                <table class="pands-cms-options-table">
                    <tr>
                        <td class="panel-title" colspan="2">Remove admin menu items</td>
                    </tr>
                    <tr>
                        <th scope="col" colspan="2" class="th-small">Remove top level menu items</th>
                    </tr>
                    <tr>
                        <td>Links</td>
                        <td><input name="pands_script_plugin_options[link-manager_menu_item]" type="checkbox" value="1" <?php checked('1', $options['link-manager_menu_item']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Comments</td>
                        <td><input name="pands_script_plugin_options[edit-comments_menu_item]" type="checkbox" value="1" <?php checked('1', $options['edit-comments_menu_item']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Tools</td>
                        <td><input name="pands_script_plugin_options[tools_menu_item]" type="checkbox" value="1" <?php checked('1', $options['tools_menu_item']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Appearance</td>
                        <td><input name="pands_script_plugin_options[themes_menu_item]" type="checkbox" value="1" <?php checked('1', $options['themes_menu_item']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Media</td>
                        <td><input name="pands_script_plugin_options[upload_menu_item]" type="checkbox" value="1" <?php checked('1', $options['upload_menu_item']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Pages</td>
                        <td><input name="pands_script_plugin_options[edit_menu_item]" type="checkbox" value="1" <?php checked('1', $options['edit_menu_item']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Plugins</td>
                        <td><input name="pands_script_plugin_options[plugins_menu_item]" type="checkbox" value="1" <?php checked('1', $options['plugins_menu_item']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Users</td>
                        <td><input name="pands_script_plugin_options[users_menu_item]" type="checkbox" value="1" <?php checked('1', $options['users_menu_item']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Settings</td>
                        <td><input name="pands_script_plugin_options[options-general_menu_item]" type="checkbox" value="1" <?php checked('1', $options['options-general_menu_item']); ?> />
                        </td>
                    </tr>
                </table>
                <table class="pands-cms-options-table">
                    <tr>
                        <th scope="col" colspan="2" class="th-small">Remove submenu items</th>
                    </tr>
                    <tr>
                        <td>Updates</td>
                        <td><input name="pands_script_plugin_options[updates_submenu]" type="checkbox" value="1" <?php checked('1', $options['updates_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Themes</td>
                        <td><input name="pands_script_plugin_options[themes_submenu]" type="checkbox" value="1" <?php checked('1', $options['themes_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Widgets</td>
                        <td><input name="pands_script_plugin_options[widgets_submenu]" type="checkbox" value="1" <?php checked('1', $options['widgets_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Menu</td>
                        <td><input name="pands_script_plugin_options[menu_submenu]" type="checkbox" value="1" <?php checked('1', $options['menu_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Tags</td>
                        <td><input name="pands_script_plugin_options[tags_submenu]" type="checkbox" value="1" <?php checked('1', $options['tags_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Plugin Editor</td>
                        <td><input name="pands_script_plugin_options[plugin_editor_submenu]" type="checkbox" value="1" <?php checked('1', $options['plugin_editor_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Writing</td>
                        <td><input name="pands_script_plugin_options[writing_submenu]" type="checkbox" value="1" <?php checked('1', $options['writing_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Discussion</td>
                        <td><input name="pands_script_plugin_options[discussion_submenu]" type="checkbox" value="1" <?php checked('1', $options['discussion_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Reading</td>
                        <td><input name="pands_script_plugin_options[reading_submenu]" type="checkbox" value="1" <?php checked('1', $options['reading_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Privacy</td>
                        <td><input name="pands_script_plugin_options[privacy_submenu]" type="checkbox" value="1" <?php checked('1', $options['privacy_submenu']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Permalinks</td>
                        <td><input name="pands_script_plugin_options[permalinks_submenu]" type="checkbox" value="1" <?php checked('1', $options['permalinks_submenu']); ?> />
                        </td>
                    </tr>
                </table>
                <table class="pands-cms-options-table">
                    <tr>
                        <td class="panel-title" colspan="2">Footer information</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="th-small">Add the dev co name, URL, favicon and site version number.<br />These details will appear below in the footer.</th></tr>
                    <tr>
                        <td>Company Name</td>
                        <td><input name="pands_script_plugin_options[company_name]" type="text" value="<?php echo $options['company_name']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>URL</td>
                        <td><input name="pands_script_plugin_options[company_url]" type="text" value="<?php echo $options['company_url']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>favicon url</td>
                        <td><input name="pands_script_plugin_options[favicon_company_url]" type="text" value="<?php echo $options['favicon_company_url']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Version number</td>
                        <td><input name="pands_script_plugin_options[footer_ver]" type="text" value="<?php echo $options['footer_ver']; ?>" /></td>
                    </tr>
                </table>
            </div>
            <div id="tabs-pands-dashboard">
                <h3>You can remove widgets and add your own panels using these options.</h3>
                <table class="pands-cms-options-table">
                    <tr>
                        <td class="panel-title" colspan="2">Remove dashboard widgets</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="th-small">Replace them with your own panels below</th>
                    </tr>
                    <tr>
                        <td>Right now</td>
                        <td><input name="pands_script_plugin_options[dashboard_right_now]" type="checkbox" value="1" <?php checked('1', $options['dashboard_right_now']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Recent comments</td>
                        <td><input name="pands_script_plugin_options[dashboard_recent_comments]" type="checkbox" value="1" <?php checked('1', $options['dashboard_recent_comments']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Incoming links</td>
                        <td><input name="pands_script_plugin_options[dashboard_incoming_links]" type="checkbox" value="1" <?php checked('1', $options['dashboard_incoming_links']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Plugins</td>
                        <td><input name="pands_script_plugin_options[dashboard_plugins]" type="checkbox" value="1" <?php checked('1', $options['dashboard_plugins']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Quick press</td>
                        <td><input name="pands_script_plugin_options[dashboard_quick_press]" type="checkbox" value="1" <?php checked('1', $options['dashboard_quick_press']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Recent drafts</td>
                        <td><input name="pands_script_plugin_options[dashboard_recent_drafts]" type="checkbox" value="1" <?php checked('1', $options['dashboard_recent_drafts']); ?> /></td>
                    </tr>
                    <tr>
                        <td>WordPress news</td>
                        <td><input name="pands_script_plugin_options[dashboard_primary]" type="checkbox" value="1" <?php checked('1', $options['dashboard_primary']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Other WordPress news</td>
                        <td><input name="pands_script_plugin_options[dashboard_secondary]" type="checkbox" value="1" <?php checked('1', $options['dashboard_secondary']); ?> /></td>
                    </tr>
                </table>
                <table class="pands-cms-options-table">
                    <tr>
                        <td class="panel-title" colspan="2">Add custom dashboard panels</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table border="1">
                                <tr>
                                    <td>Use Welcome panel</td>
                                    <td><input name="pands_script_plugin_options[add_first_pands_dashboard_widget]" type="checkbox" value="1" <?php checked('1', $options['add_first_pands_dashboard_widget']); ?> /></td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td><input name="pands_script_plugin_options[main_dashboard_title]" type="text" value="<?php echo $options['main_dashboard_title']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:top">Content</td>
                                    <td><textarea name="pands_script_plugin_options[main_dashboard_body]" cols="50" rows="10"><?php echo $options['main_dashboard_body']; ?></textarea></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table border="1">
                                <tr>
                                    <td>Use 'How to' panel</td>
                                    <td><input name="pands_script_plugin_options[add_second_pands_dashboard_widget]" type="checkbox" value="1" <?php checked('1', $options['add_second_pands_dashboard_widget']); ?> /></td>
                                </tr>
                                <tr>
                                    <td>Title</td>
                                    <td><input name="pands_script_plugin_options[secondary_dashboard_title]" type="text" value="<?php echo $options['secondary_dashboard_title']; ?>" /></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:top">Content</td>
                                    <td><textarea name="pands_script_plugin_options[secondary_dashboard_body]" cols="50" rows="10"><?php echo $options['secondary_dashboard_body']; ?></textarea></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tabs-pands-pages-posts">
                <h3>Keep the write pages to a minimal by reducing clutter</h3>
                <table class="pands-cms-options-table">
                    <tr>
                        <td class="panel-title" colspan="2">Remove write page furniture</td>
                    </tr>
                    <tr>
                        <th colspan="2">For Posts</th>
                    </tr>
                    <tr>
                        <td>Custom Fields</td>
                        <td><input name="pands_script_plugin_options[postcustom_post]" type="checkbox" value="1" <?php checked('1', $options['postcustom_post']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Excerpt</td>
                        <td><input name="pands_script_plugin_options[postexcerpt_post]" type="checkbox" value="1" <?php checked('1', $options['postexcerpt_post']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Send Trackbacks</td>
                        <td><input name="pands_script_plugin_options[trackbacksdiv_post]" type="checkbox" value="1" <?php checked('1', $options['trackbacksdiv_post']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Discussions</td>
                        <td><input name="pands_script_plugin_options[commentstatusdiv_post]" type="checkbox" value="1" <?php checked('1', $options['commentstatusdiv_post']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Revisions</td>
                        <td><input name="pands_script_plugin_options[revisionsdiv_post]" type="checkbox" value="1" <?php checked('1', $options['revisionsdiv_post']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td><input name="pands_script_plugin_options[authordiv_post]" type="checkbox" value="1" <?php checked('1', $options['authordiv_post']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td><input name="pands_script_plugin_options[categorydiv_post]" type="checkbox" value="1" <?php checked('1', $options['categorydiv_post']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Post Tags</td>
                        <td><input name="pands_script_plugin_options[tagsdiv-post_tag_post]" type="checkbox" value="1" <?php checked('1', $options['tagsdiv-post_tag_post']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Publish</td>
                        <td><input name="pands_script_plugin_options[submitdiv_post]" type="checkbox" value="1" <?php checked('1', $options['submitdiv_post']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Custom Fields</td>
                        <td><input name="pands_script_plugin_options[postcustom_page]" type="checkbox" value="1" <?php checked('1', $options['postcustom_page']); ?> /></td>
                    </tr>
                </table>
                <table class="pands-cms-options-table">
                    <th colspan="2">For Pages</th>
                    <tr>
                        <td>Excerpt</td>
                        <td><input checked="checked" name="pands_script_plugin_options[postexcerpt_page]"
                                   type="checkbox"
                                   value="1" <?php checked('1', $options['postexcerpt_page']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Page Attributes</td>
                        <td><input name="pands_script_plugin_options[pageparentdiv_page]" type="checkbox" value="1" <?php checked('1', $options['pageparentdiv_page']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Discussions</td>
                        <td><input class="checkbox" name="pands_script_plugin_options[commentstatusdiv_page]" type="checkbox" value="1" <?php checked('1', $options['commentstatusdiv_page']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Revisions</td>
                        <td><input name="pands_script_plugin_options[revisionsdiv_page]" type="checkbox" value="1" <?php checked('1', $options['revisionsdiv_page']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td><input name="pands_script_plugin_options[authordiv_page]" type="checkbox" value="1" <?php checked('1', $options['authordiv_page']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Comments</td>
                        <td><input name="pands_script_plugin_options[commentsdiv_page]" type="checkbox" value="1" <?php checked('1', $options['commentsdiv_page']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Publish</td>
                        <td><input name="pands_script_plugin_options[submitdiv_page]" type="checkbox" value="1" <?php checked('1', $options['submitdiv_page']); ?> /></td>
                        </td>
                    </tr>
                </table></div>
            <div id="tabs-pands-widgets">
                <table class="pands-cms-options-table">
                    <h3>If you need to stop your client adding a ton of widgets, switch them off here.</h3>
                    <tr>
                        <td class="panel-title" colspan="2">Remove Default Widgets</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="th-small">Stop your client from adding too many widgets by turning them off.</th>
                    </tr>
                    <tr>
                        <td>Archives</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Archives]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Archives']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Calendar</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Calendar]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Calendar']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Categories</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Categories]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Categories']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Custom Menu</td>
                        <td><input name="pands_script_plugin_options[WP_Nav_Menu_Widget]" type="checkbox" value="1" <?php checked('1', $options['WP_Nav_Menu_Widget']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Links</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Links]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Links']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Meta</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Meta]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Meta']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Pages</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Pages]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Pages']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Recent comments</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Recent_Comments]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Recent_Comments']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Recent posts</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Recent_Posts]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Recent_Posts']); ?> /></td>
                    </tr>
                    <tr>
                        <td>RSS</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_RSS]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_RSS']); ?> /></td>
                    </tr>

                    <tr>
                        <td>Search</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Search]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Search']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Tag cloud</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Tag_Cloud]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Tag_Cloud']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Text</td>
                        <td><input name="pands_script_plugin_options[WP_Widget_Text]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Text']); ?> /></td>
                    </tr>
                </table></div>
            <div id="tabs-pands-front-end">
                <h3>Use these options to change elements on the front end of the website.</h3>
                <table class="pands-cms-options-table">
                    <tr>
                        <td class="panel-title" colspan="2">Visible front end</td>
                    </tr>
                    <tr>
                        <td>Remove v3 admin bar<br /><span class="th-small">Removes the enforced admin bar across the top.<br />We don't want to spoil your lovely design, now, do we?</span></td>
                        <td><input name="pands_script_plugin_options[remove_admin_bar]" type="checkbox" value="1" <?php checked('1', $options['remove_admin_bar']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Site wide favicon<br /><span class="th-small">Absolute path to a 16px x 16px icon</span></td>
                        <td><input class="ui-widget-text" name="pands_script_plugin_options[blog_favicon]" type="text" value="<?php echo $options['blog_favicon']; ?>" /></td>
                    </tr>
                </table>
                <br />
                <table class="pands-cms-options-table">
                    <tr>
                        <td class="panel-title" colspan="2">Remove header meta tags</td>
                    </tr>
                    <tr>
                        <td>Remove RSD Link</td>
                        <td><input name="pands_script_plugin_options[remove_rsd_link]" type="checkbox" value="1" <?php checked('1', $options['remove_rsd_link']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Remove site and comments RSS feeds</td>
                        <td><input name="pands_script_plugin_options[remove_feed_links]" type="checkbox" value="1" <?php checked('1', $options['remove_feed_links']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Remove WP Generator meta tag</td>
                        <td><input name="pands_script_plugin_options[remove_wp_generator]" type="checkbox" value="1" <?php checked('1', $options['remove_wp_generator']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Remove Index relation links</td>
                        <td><input name="pands_script_plugin_options[remove_index_rel_link]" type="checkbox" value="1" <?php checked('1', $options['remove_index_rel_link']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Remove Post relation links - start</td>
                        <td><input name="pands_script_plugin_options[remove_start_post_rel_link]" type="checkbox" value="1" <?php checked('1', $options['remove_start_post_rel_link']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Remove Post relation links - Parent</td>
                        <td><input name="pands_script_plugin_options[remove_parent_post_rel_link]" type="checkbox" value="1" <?php checked('1', $options['parent_post_rel_link']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Remove Post relation links from wp-head</td>
                        <td><input name="pands_script_plugin_options[remove_adjacent_posts_rel_link_wp_head]" type="checkbox" value="1" <?php checked('1', $options['adjacent_posts_rel_link_wp_head']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Remove extra feed links</td>
                        <td><input name="pands_script_plugin_options[remove_feed_links_extra]" type="checkbox" value="1" <?php checked('1', $options['remove_feed_links_extra']); ?> /></td>
                    </tr>
                    <tr>
                        <td>Remove WLW tag</td>
                        <td><input name="pands_script_plugin_options[remove_wlwmanifest_link]" type="checkbox" value="1" <?php checked('1', $options['remove_wlwmanifest_link']); ?> /></td>
                    </tr>
                    <tr>
                        <td class="panel-title" colspan="2">Add dev elements</td>
                    </tr>
                    <tr>
                        <td>JQuery Path<br /><span class="th-small">Add the absolute path of your prefered JQuery file.<br />Defaults to jQuery JavaScript Library v1.7 hosted by Google</span></td>
                        <td><input class="ui-widget-text" name="pands_script_plugin_options[jquery_path]" type="text" value="<?php echo $options['jquery_path']; ?>" /></td>
                    </tr>
                    <tr>
                        <td>Google analytics<br /><span class="th-small">Only add the ID - UA-XXXXXX-XX</span></td>
                        <td><input name="pands_script_plugin_options[google_analytics_number]" type="text" value="<?php echo $options['google_analytics_number']; ?>" /></td>
                    </tr>
                </table>
            </div>
        </div>
        <input name="Submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
    </form>
</div>