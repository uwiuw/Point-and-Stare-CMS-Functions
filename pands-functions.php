<?php
/*
 Plugin Name: Point and Stare CMS Functions
 Plugin URI: https://github.com/PointandStare/Point-and-Stare-CMS-Functions
 Description: This MU plugin will generate special functions that help convert your WordPress install into a CMS, add security and generally white label the admin.
 Version: 2.0
 Author: Lee Rickler
 Author URI: http://pointandstare.com
 
 This plugin is licensed under the GNU General Public License version 2 or later.
 
THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

// TO REMOVE THIS FROM YOUR SETTINGS MENU SIMPLY UNCOMMENT THIS LITTLE LOT
// function delete_submenu_items() {
// 		remove_submenu_page( 'options-general.php', 'pands-script');
// }
// add_action( 'admin_init', 'delete_submenu_items' );

// add the admin options page
add_action('admin_menu', 'pands_script_add_page');
function pands_script_add_page() {
add_options_page('PandS CMS', 'PandS CMS Functions', 'manage_options', 'pands-script', 'pands_script_page');
}
add_action( 'admin_init', 'pands_script_admin_init' );
function pands_script_admin_init() {
	register_setting( 'pands_script_options', 'pands_script_plugin_options');
}

 // display the admin options page
function pands_script_page() {
?>
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
	text-decoration:none
	}

div#tabs-pands-script ul li:hover, div#tabs-pands-script ul li:hover a, div#tabs-pands-script ul li.ui-tabs-selected,
div#tabs-pands-script ul li.ui-tabs-selected a{
	background:#555;
	color:#fff
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
	<th scope="row">Change the Login logo<br /><span class="th-small">Default is the WordPress logo - 310px x 70px</span></th>
    <td><input class="ui-widget-text" name="pands_script_plugin_options[custom_admin_header_logo]" type="text" value="<?php echo $options['custom_admin_header_logo']; ?>" /></td>
</tr>
<tr>
    <th scope="row">Login logo link<br /><span class="th-small">Only change this if required - default is your site URL</span></th>
    <td><input class="ui-widget-text" name="pands_script_plugin_options[custom_admin_login_header_link]" type="text" value="<?php echo $options['custom_admin_login_header_link']; ?>" /></td>
</tr>
<tr>
    <th scope="row">Login page logo Alt text<br /><span class="th-small">Change this to your company strapline</span></th>
    <td><input class="ui-widget-text" name="pands_script_plugin_options[custom_admin_login_header_link_alt_text]" type="text" value="<?php echo $options['custom_admin_login_header_link_alt_text']; ?>" /></td>
</tr>
</table>
<table class="pands-cms-options-table">
	<tr>
    <td class="panel-title" colspan="2">Global Admin area</td>
</tr>
<tr>
    <th scope="row" title="Change the Admin page title">Admin page title</th>
    <td><input class="ui-widget-text" name="pands_script_plugin_options[admin_title]" type="text" value="<?php echo $options['admin_title']; ?>" /></td>
</tr>
<!-- 
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
    <td>Appearence</td>
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
<tr><td>Right now</td>
    <td><input name="pands_script_plugin_options[dashboard_right_now]" type="checkbox" value="1" <?php checked('1', $options['dashboard_right_now']); ?> /></td>
</tr>    
<tr><td>Recent comments</td>
    <td><input name="pands_script_plugin_options[dashboard_recent_comments]" type="checkbox" value="1" <?php checked('1', $options['dashboard_recent_comments']); ?> /></td>
</tr>
    
<tr><td>Incoming links</td>
    <td><input name="pands_script_plugin_options[dashboard_incoming_links]" type="checkbox" value="1" <?php checked('1', $options['dashboard_incoming_links']); ?> /></td>
    </tr>
    
    <tr><td>Plugins</td>
    <td><input name="pands_script_plugin_options[dashboard_plugins]" type="checkbox" value="1" <?php checked('1', $options['dashboard_plugins']); ?> /></td>
    </tr>
    
    <tr><td>Quick press</td>
    <td><input name="pands_script_plugin_options[dashboard_quick_press]" type="checkbox" value="1" <?php checked('1', $options['dashboard_quick_press']); ?> /></td>
    </tr>
    
    <tr><td>Recent drafts</td>
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
<tr><td colspan="2">
    <table border="1">
<tr><td>Use Welcome panel</td>
    <td><input name="pands_script_plugin_options[add_first_pands_dashboard_widget]" type="checkbox" value="1" <?php checked('1', $options['add_first_pands_dashboard_widget']); ?> /></td>
</tr>
  <tr>
    <td>Title</td>
    <td><input name="pands_script_plugin_options[main_dashboard_title]" type="text" value="<?php echo $options['main_dashboard_title']; ?>" /></td>
  </tr>
  <tr>
    <td style="vertical-align:top">Content</td>
    <td><textarea name="pands_script_plugin_options[main_dashboard_body]" cols="50" rows="10"><?php echo $options['main_dashboard_body']; ?></textarea></td>
  </tr></table></td></tr>
    <tr><td colspan="2"><table border="1">
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
  </tr></table></td></tr>
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
  <tr><td>Custom Fields</td>
    <td><input name="pands_script_plugin_options[postcustom_post]" type="checkbox" value="1" <?php checked('1', $options['postcustom_post']); ?> /></td></tr>
     
    <tr><td>Excerpt</td>
    <td><input name="pands_script_plugin_options[postexcerpt_post]" type="checkbox" value="1" <?php checked('1', $options['postexcerpt_post']); ?> /></td></tr>
    
    <tr><td>Send Trackbacks</td>
     <td><input name="pands_script_plugin_options[trackbacksdiv_post]" type="checkbox" value="1" <?php checked('1', $options['trackbacksdiv_post']); ?> /></td></tr>
     
    <tr><td>Discussions</td>
    <td><input name="pands_script_plugin_options[commentstatusdiv_post]" type="checkbox" value="1" <?php checked('1', $options['commentstatusdiv_post']); ?> /></td></tr>
      
      <tr><td>Revisions</td>
      <td><input name="pands_script_plugin_options[revisionsdiv_post]" type="checkbox" value="1" <?php checked('1', $options['revisionsdiv_post']); ?> /></td></tr>
   
<tr>   <td>Author</td>
  <td><input name="pands_script_plugin_options[authordiv_post]" type="checkbox" value="1" <?php checked('1', $options['authordiv_post']); ?> /></td></tr>
   
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
  
  <tr><td>Custom Fields</td>
    <td><input name="pands_script_plugin_options[postcustom_page]" type="checkbox" value="1" <?php checked('1', $options['postcustom_page']); ?> /></td></tr>
    </table>
    
    <table class="pands-cms-options-table">
    <th colspan="2">For Pages</th>
    <tr><td>Excerpt</td>
    <td><input checked="checked" name="pands_script_plugin_options[postexcerpt_page]"
    type="checkbox"
    value="1" <?php checked('1', $options['postexcerpt_page']); ?> /></td></tr>
    
    <tr><td>Page Attributes</td>
 <td><input name="pands_script_plugin_options[pageparentdiv_page]" type="checkbox" value="1" <?php checked('1', $options['pageparentdiv_page']); ?> /></td></tr>
   
   <tr><td>Discussions</td>
  <td><input class="checkbox" name="pands_script_plugin_options[commentstatusdiv_page]" type="checkbox" value="1" <?php checked('1', $options['commentstatusdiv_page']); ?> /></td></tr>

<tr><td>Revisions</td>
 <td><input name="pands_script_plugin_options[revisionsdiv_page]" type="checkbox" value="1" <?php checked('1', $options['revisionsdiv_page']); ?> /></td></tr>
 
 <tr><td>Author</td>
 <td><input name="pands_script_plugin_options[authordiv_page]" type="checkbox" value="1" <?php checked('1', $options['authordiv_page']); ?> /></td></tr>

<tr><td>Comments</td>
  <td><input name="pands_script_plugin_options[commentsdiv_page]" type="checkbox" value="1" <?php checked('1', $options['commentsdiv_page']); ?> /></td></tr>
  
  <tr><td>Publish</td>
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
    
    <tr><td>Archives</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Archives]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Archives']); ?> /></td>
    </tr>
    
    <tr><td>Calendar</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Calendar]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Calendar']); ?> /></td>
    </tr> 
    
     <tr><td>Categories</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Categories]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Categories']); ?> /></td>
    </tr>
    
    <tr><td>Custom Menu</td>
    <td><input name="pands_script_plugin_options[WP_Nav_Menu_Widget]" type="checkbox" value="1" <?php checked('1', $options['WP_Nav_Menu_Widget']); ?> /></td>
    </tr>
    
    <tr><td>Links</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Links]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Links']); ?> /></td>
    </tr>
    
    <tr><td>Meta</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Meta]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Meta']); ?> /></td>
    </tr>
    
    <tr><td>Pages</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Pages]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Pages']); ?> /></td>
    </tr>
    
    <tr><td>Recent comments</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Recent_Comments]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Recent_Comments']); ?> /></td>
    </tr>
    
    <tr><td>Recent posts</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Recent_Posts]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Recent_Posts']); ?> /></td>
    </tr>
    
    <tr><td>RSS</td>
    <td><input name="pands_script_plugin_options[WP_Widget_RSS]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_RSS']); ?> /></td>
    </tr>
    
    <tr><td>Search</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Search]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Search']); ?> /></td>
    </tr>
    
    <tr><td>Tag cloud</td>
    <td><input name="pands_script_plugin_options[WP_Widget_Tag_Cloud]" type="checkbox" value="1" <?php checked('1', $options['WP_Widget_Tag_Cloud']); ?> /></td>
    </tr>
    
    <tr><td>Text</td>
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
    <th scope="row">Remove RSD Link</th>
    <td><input name="pands_script_plugin_options[remove_rsd_link]" type="checkbox" value="1" <?php checked('1', $options['remove_rsd_link']); ?> /></td>
  </tr>
  <tr>
    <th scope="row">Remove site and comments RSS feeds</th>
    <td><input name="pands_script_plugin_options[remove_feed_links]" type="checkbox" value="1" <?php checked('1', $options['remove_feed_links']); ?> /></td>
  </tr>
   <tr>
    <th scope="row">Remove WP Generator meta tag</th>
    <td><input name="pands_script_plugin_options[remove_wp_generator]" type="checkbox" value="1" <?php checked('1', $options['remove_wp_generator']); ?> /></td>
  </tr>
   <tr>
    <th scope="row">Remove Index relation links</th>
    <td><input name="pands_script_plugin_options[remove_index_rel_link]" type="checkbox" value="1" <?php checked('1', $options['remove_index_rel_link']); ?> /> </td>
  </tr>
   <tr>
    <th scope="row">Remove Post relation links - start</th>
    <td><input name="pands_script_plugin_options[remove_start_post_rel_link]" type="checkbox" value="1" <?php checked('1', $options['remove_start_post_rel_link']); ?> /></td>
  </tr>
   <tr>
    <th scope="row">Remove Post relation links - Parent</th>
    <td><input name="pands_script_plugin_options[remove_parent_post_rel_link]" type="checkbox" value="1" <?php checked('1', $options['parent_post_rel_link']); ?> /></td>
  </tr>
   <tr>
    <th scope="row">Remove Post relation links from wp-head</th>
    <td><input name="pands_script_plugin_options[remove_adjacent_posts_rel_link_wp_head]" type="checkbox" value="1" <?php checked('1', $options['adjacent_posts_rel_link_wp_head']); ?> /></td>
  </tr>
   <tr>
    <th scope="row">Remove extra feed links</th>
    <td><input name="pands_script_plugin_options[remove_feed_links_extra]" type="checkbox" value="1" <?php checked('1', $options['remove_feed_links_extra']); ?> /></td>
  </tr>
 <tr>
    <th scope="row">Remove WLW tag</th>
    <td><input name="pands_script_plugin_options[remove_wlwmanifest_link]" type="checkbox" value="1" <?php checked('1', $options['remove_wlwmanifest_link']); ?> /></td>
  </tr>
  <tr>
    <td class="panel-title" colspan="2">Add dev elements</td>
  </tr>
   <tr>
    <th scope="row">JQuery Path<br /><span class="th-small">Add the absolute path of your prefered JQuery file.<br />Defaults to jQuery JavaScript Library v1.7 hosted by Google</span></th>
    <td><input class="ui-widget-text" name="pands_script_plugin_options[jquery_path]" type="text" value="<?php echo $options['jquery_path']; ?>" /></td>
  </tr>
  <tr>
    <th scope="row">Google analytics<br /><span class="th-small">Only add the ID - UA-XXXXXX-XX</span></th>
    <td><input name="pands_script_plugin_options[google_analytics_number]" type="text" value="<?php echo $options['google_analytics_number']; ?>" /></td>
  </tr>
</table>
</div>
</div>
<input name="Submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>
<?php
}
wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	
$options = get_option('pands_script_plugin_options');

// Rename the admin page title
function pands_admin_title() {
$options = get_option('pands_script_plugin_options');
if ($options['admin_title'] == ""){
$new_title= __('Control panel for ', 'pands_admin') . get_option('blogname');
}
else $new_title= $options['admin_title'];

return $new_title;
}
add_filter('admin_title', 'pands_admin_title');

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
if ($options['admin_wp_logo'] == ""){
echo '<style type="text/css">
   li#wp-admin-bar-wp-logo a, #wp-logo { background: url('.get_bloginfo('wpurl').'/favicon.png) no-repeat right !important}
   #wpadminbar .ab-wp-logo {display:block;height: 28px;width:16px;  background:none!important }</style>';
   }
else 
{
echo '<style type="text/css">
   li#wp-admin-bar-wp-logo a, #wp-logo { background: url('.$options['admin_wp_logo'].') no-repeat right !important}
   #wpadminbar .ab-wp-logo {display:block;height: 28px;width:16px;  background:none!important }</style>';
   }
}
add_action('admin_head', 'pands_custom_admin_logo');

// LOGIN HEADER LOGO
function my_custom_login_logo() {
$options = get_option('pands_script_plugin_options');
if ($options['custom_admin_header_logo'] == ""){}
else {
echo '<style type="text/css"> h1 a { background-image:url('.$options['custom_admin_header_logo'].'/images/YOUR_MAIN_LOGO.png) !important; } </style>';
}
   }
add_action('login_head', 'my_custom_login_logo');

// CUSTOM ADMIN LOGIN HEADER LINK & ALT TEXT
function change_wp_login_url() {
$options = get_option('pands_script_plugin_options');
if ($options['custom_admin_login_header_link'] == ""){
 echo bloginfo('url');  // OR ECHO YOUR OWN URL}
 }
else {
echo $options['custom_admin_login_header_link'];
}
   }
   function change_wp_login_title() {
   $options = get_option('custom_admin_login_header_link_alt_text');
if ($options['custom_admin_login_header_link_alt_text'] == ""){
echo get_option('blogname'); // OR ECHO YOUR OWN ALT TEXT
}
else {
echo $options['custom_admin_login_header_link_alt_text'];
}    
   }
add_filter('login_headerurl', 'change_wp_login_url');
add_filter('login_headertitle', 'change_wp_login_title');

// ADD FAVICON
function blog_favicon() {
$options = get_option('pands_script_plugin_options');
if ($options['blog_favicon'] == ""){
echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.png" />';
}
else {
echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.$options['blog_favicon'].'" />';
}
}
add_action('wp_head', 'blog_favicon');

// ADD JQUERY PROPERLY
if (!is_admin()) {
	wp_deregister_script('jquery');
	if ( $options['jquery_path']!="")	wp_register_script('jquery', ($options['jquery_path']), false);
	else wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.js"), true);
	wp_enqueue_script('jquery');
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
if ( $options['change_howdy']!= "") add_filter('gettext', 'change_howdy', 10, 3);

// REMOVE META BOXES FROM DEFAULT PAGES SCREEN
function pands_remove_boxes() {
$options = get_option('pands_script_plugin_options');
	// *** For posts *** //
	if ($options['postcustom_post'] == 1) remove_meta_box( 'postcustom' , 'post' , 'normal' );
	if ($options['postexcerpt_post'] == 1) remove_meta_box( 'postexcerpt' , 'post' , 'normal' );
	if ($options['trackbacksdiv_post'] == 1) remove_meta_box( 'trackbacksdiv' , 'post' , 'normal' );
	if ($options['commentstatusdiv_post'] == 1) remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' );
	if ($options['revisionsdiv_post'] == 1) remove_meta_box( 'revisionsdiv' , 'post' , 'normal' );
	if ($options['authordiv_post'] == 1) remove_meta_box( 'authordiv' , 'post' , 'normal' );
	if ($options['categorydiv_post'] == 1) remove_meta_box( 'categorydiv' , 'post' , 'normal' );
	if ($options['tagsdiv-post_tag_post'] == 1) remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' );
	if ($options['submitdiv_post'] == 1) remove_meta_box( 'submitdiv' , 'post' , 'normal' );

	// *** For pages *** //
	if ($options['postcustom_page'] == 1) remove_meta_box( 'postcustom' , 'page' , 'normal' );
	if ($options['commentsdiv_page'] == 1) remove_meta_box( 'commentsdiv' , 'page' , 'normal' );
	if ($options['commentstatusdiv_page'] == 1) remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' );
	if ($options['revisionsdiv_page'] == 1) remove_meta_box( 'revisionsdiv' , 'page' , 'normal' );
	if ($options['authordiv_page'] == 1) remove_meta_box( 'authordiv' , 'page' , 'normal' );
	if ($options['pageparentdiv_page'] == 1) remove_meta_box( 'pageparentdiv' , 'page' , 'normal' );
	if ($options['submitdiv_page'] == 1) remove_meta_box( 'submitdiv' , 'page' , 'normal' );
	if ($options['postexcerpt_page'] == 1) remove_meta_box( 'postexcerpt' , 'page' , 'normal' );
}
add_action('admin_init', 'pands_remove_boxes');

// DISABLE DEFAULT DASHBOARD WIDGETS
function disable_default_dashboard_widgets() {
$options = get_option('pands_script_plugin_options');
	if ($options['dashboard_right_now'] == 1) remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	if ($options['dashboard_recent_comments'] == 1) remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	if ($options['dashboard_incoming_links'] == 1) remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	if ($options['dashboard_plugins'] == 1) remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	if ($options['dashboard_quick_press'] == 1) remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	if ($options['dashboard_recent_drafts'] == 1) remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	if ($options['dashboard_primary'] == 1) remove_meta_box('dashboard_primary', 'dashboard', 'core');
	if ($options['dashboard_secondary'] == 1) remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

// REMOVE DEFAULT WIDGETS //
function my_unregister_widgets() {
$options = get_option('pands_script_plugin_options');
	if ($options['WP_Widget_Pages'] == 1) unregister_widget( 'WP_Widget_Pages' );
	if ($options['WP_Widget_Meta'] == 1) unregister_widget( 'WP_Widget_Meta' );
	if ($options['WP_Widget_Calendar'] == 1) unregister_widget( 'WP_Widget_Calendar' );
	if ($options['WP_Widget_Archives'] == 1) unregister_widget( 'WP_Widget_Archives' );
	if ($options['WP_Widget_Links'] == 1) unregister_widget( 'WP_Widget_Links' );
	if ($options['WP_Widget_Categories'] == 1) unregister_widget( 'WP_Widget_Categories' );
	if ($options['WP_Widget_Recent_Posts'] == 1) unregister_widget( 'WP_Widget_Recent_Posts' );
	if ($options['WP_Widget_Search'] == 1) unregister_widget( 'WP_Widget_Search' );
	if ($options['WP_Widget_Tag_Cloud'] == 1) unregister_widget( 'WP_Widget_Tag_Cloud' );
	if ($options['WP_Widget_RSS'] == 1) unregister_widget( 'WP_Widget_RSS' );
	if ($options['WP_Widget_Tag_Cloud'] == 1) unregister_widget( 'WP_Widget_Tag_Cloud' );
	if ($options['WP_Widget_Recent_Comments'] == 1) unregister_widget( 'WP_Widget_Recent_Comments' );
	if ($options['WP_Nav_Menu_Widget'] == 1) unregister_widget( 'WP_Nav_Menu_Widget' );
	if ($options['WP_Widget_Text'] == 1) unregister_widget( 'WP_Widget_Text' );
}
add_action( 'widgets_init', 'my_unregister_widgets' );

// REMOVE MENU ITEMS
function remove_admin_menus(){
$options = get_option('pands_script_plugin_options');
	if ($options['link-manager_menu_item'] == 1) remove_menu_page('link-manager.php'); // Links
    if ($options['edit-comments_menu_item'] == 1) remove_menu_page('edit-comments.php'); // Comments
    if ($options['tools_menu_item'] == 1) remove_menu_page('tools.php'); // Tools
    if ($options['themes_menu_item'] == 1) remove_menu_page('themes.php'); // Appearence
	if ($options['upload_menu_item'] == 1) remove_menu_page('upload.php'); // Media
    if ($options['edit_menu_item'] == 1) remove_menu_page('edit.php?post_type=page'); // Pages
    if ($options['plugins_menu_item'] == 1) remove_menu_page('plugins.php'); // Plugins
    if ($options['users_menu_item'] == 1) remove_menu_page('users.php'); // Users
    if ($options['options-general_menu_item'] == 1) remove_menu_page('options-general.php'); // Settings
    }
add_action('admin_menu', 'remove_admin_menus');

// REMOVE SUBMENUS
function remove_submenus() {
$options = get_option('pands_script_plugin_options');
	global $submenu;
	if ($options['updates_submenu'] == 1) unset($submenu['index.php'][10]); // Removes 'Updates'
	if ($options['themes_submenu'] == 1) unset($submenu['themes.php'][5]); // Removes 'Themes'
	if ($options['widgets_submenu'] == 1) unset($submenu['themes.php'][7]); // Removes 'Widgets'
	if ($options['menu_submenu'] == 1) unset($submenu['themes.php'][10]); // Removes 'Menu'
	if ($options['tags_submenu'] == 1) unset($submenu['edit.php'][16]); // Removes 'Tags'
	if ($options['plugin_editor_submenu'] == 1) unset($submenu['plugins.php'][15]); // Removes 'Plugin editor'
	if ($options['writing_submenu'] == 1) unset($submenu['options-general.php'][15]); // Removes 'Writing'
	if ($options['discussion_submenu'] == 1) unset($submenu['options-general.php'][25]); // Removes 'Discussion'
	if ($options['reading_submenu'] == 1) unset($submenu['options-general.php'][20]); // Removes 'Reading'
	if ($options['privacy_submenu'] == 1) unset($submenu['options-general.php'][35]); // Removes 'Privacy'
	if ($options['permalinks_submenu'] == 1) unset($submenu['options-general.php'][40]); // Removes 'Permalinks'
	}
add_action('admin_menu', 'remove_submenus');

// REMOVE HEADER TAT
	if ($options['remove_rsd_link'] == 1) remove_action('wp_head', 'rsd_link');
	if ($options['remove_wp_generator'] == 1) remove_action('wp_head', 'wp_generator');
	if ($options['remove_feed_links'] == 1) remove_action('wp_head', 'feed_links', 2);
	if ($options['remove_index_rel_link'] == 1) remove_action('wp_head', 'index_rel_link');
	if ($options['remove_wlwmanifest_link'] == 1) remove_action('wp_head', 'wlwmanifest_link');
	if ($options['remove_feed_links_extra'] == 1) remove_action('wp_head', 'feed_links_extra', 3);
	if ($options['remove_start_post_rel_link'] == 1) remove_action('wp_head', 'start_post_rel_link', 10, 0);
	if ($options['remove_parent_post_rel_link'] == 1) remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	if ($options['remove_adjacent_posts_rel_link_wp_head'] == 1) remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	
	if ($options['remove_admin_bar'] == 1) add_filter( 'show_admin_bar', '__return_false' );

// Remove WordPress sub-menu from the admin bar, add custom admin logo instead and remove "Visit Site" sub-menu under site-name.
// Piet Bos  (email: senlinonline@gmail.com)
function sl_dashboard_tweaks_render() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'id'    => 'wp-logo',
		'title' => '<span class="sl-dashboard-logo"></span>',
		'href'  => is_admin() ? home_url( '/' ) : admin_url(),
		'meta'  => array(
		'title' => __('Visit the Frontend of your website'),
		),
	) );
	$wp_admin_bar->remove_menu('about');
	$wp_admin_bar->remove_menu('wporg');
	$wp_admin_bar->remove_menu('documentation');
	$wp_admin_bar->remove_menu('support-forums');
	$wp_admin_bar->remove_menu('feedback');
	$wp_admin_bar->remove_menu('view-site');
}
add_action( 'wp_before_admin_bar_render', 'sl_dashboard_tweaks_render' );

function custom_pages_columns($defaults) {
   unset($defaults['comments']);
   return $defaults;
   }
add_filter('manage_pages_columns', 'custom_pages_columns');

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
$options = get_option('pands_script_plugin_options');
echo '<h3>'. $options['main_dashboard_title'].'</h3>
<p>'. $options['main_dashboard_body'].'</p>';
 }
function add_first_pands_dashboard_widget() {
  wp_add_dashboard_widget( 'first_pands_dashboard_widget', __( 'Welcome' ), 'first_pands_dashboard_widget' );
}
if ($options['add_first_pands_dashboard_widget'] == 1) add_action('wp_dashboard_setup', 'add_first_pands_dashboard_widget' );

// SECONDARY DASBOARD PANEL
function second_pands_dashboard_widget() { 
$options = get_option('pands_script_plugin_options');
echo '<h3>'. $options['secondary_dashboard_title'].'</h3>
<p>'. $options['secondary_dashboard_body'].'</p>';
 }
function add_second_pands_dashboard_widget() {
  wp_add_dashboard_widget( 'second_pands_dashboard_widget', __( 'HOW TO:' ), 'second_pands_dashboard_widget' );
}
if ($options['add_second_pands_dashboard_widget'] == 1) add_action('wp_dashboard_setup', 'add_second_pands_dashboard_widget' );

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
add_action( 'do_robots', 'mytheme_robots' );

// ADMIN FOOTER STUFF
function modify_footer_admin () {
$options = get_option('pands_script_plugin_options');
  echo '<a href="'.$options['company_url'].'"><img src="'.$options['favicon_company_url'].'" /></a> '.get_bloginfo('name').' online presence developed by <a href="'.$options['company_url'].'">'.$options['company_name'].'</a>.';
}

add_filter('admin_footer_text', 'modify_footer_admin');
function change_footer_version() {
$options = get_option('pands_script_plugin_options');  
  return 'Version '.$options['footer_ver'];
}
if ($options['footer_ver'] != "") add_filter( 'update_footer', 'change_footer_version', 9999 );

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
if ($options['google_analytics_number'] != "") add_action('wp_footer', 'add_google_analytics');
?>