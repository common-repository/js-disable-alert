<?php
/*
Plugin Name: js Disable Alert
Plugin URI: http://shariarbd.com/plugins/js-disable-alert/
Description: js Disable Alert is actually JavaScript Disable Alert. When any one visit your site with a browser of disabled JavaScript, Plugin will notify that person to enable JavaScript. But it only work when JavaScriipt will be disabled. You can change/set font color, font size, background color and display position of the alert message. Plugin is created by <cite><a href="http://shariarbd.com/" title="Md. Sahriar">Md. Shariar</a>.</cite>
Version: 1.2
Author: Md. Shariar
Author URI: http://shariarbd.com/ 
License: GPL2
*/
//Disable unauthorized access
if (!function_exists ('is_admin')) {
   header('Status: 403 Forbidden');
   header('HTTP/1.1 403 Forbidden');
   exit();
   }

// Option Page
 function jada_option()
{
      $jsda_updates=isset($_POST['jsda_update']) ? 1:2;
      if($jsda_updates==1){
        if($_POST['jsda_update']){
  		  update_option('jsda_message',$_POST['jsda_message']);
  		  update_option('jsda_message_position',$_POST['jsda_message_position']);
      	update_option('jsda_font_size',$_POST['jsda_font_size']);
      	update_option('jsda_font_color',$_POST['jsda_font_color']);
        update_option('jsda_bg_color',$_POST['jsda_bg_color']);

          echo '<h3>Plugin has been updated.</h3>';
        }
  	 }
  	$jsda_message = get_option('jsda_message');
  	$jsda_message_position = get_option('jsda_message_position');
    $jsda_font_size = get_option('jsda_font_size');
    $jsda_font_color = get_option('jsda_font_color');
    if(!$jsda_message) $jsda_message="Dear Visitor, Please Enable JavaScript of your Browser. Currently JavaScript is disabled.";
    $jsda_bg_color = get_option('jsda_bg_color');
  	?>


<div class="wrap">
  <form method="post" id="jsda_option">
  <h2>js Disable Alert Option Page</h2>
  <div class="welcome-panel">
    <h4><label for="jsda-message"> Custom Message</label></h4>
    * If Empty, Default Message will be displayed. Please be noted that the message will only be displayed when the JavaScript of browser of the visitor is in disable mode.  
    <br><input id="jsda-message" class="large-text" type="text" name="jsda_message" value="<?php echo $jsda_message; ?>"> </input>
    
    <h4><label for="jsda-message-position"> Message Position</label></h4>
    * By default, Top. It's the position of the message where it will appear on your site.<br>
    <select name="jsda_message_position" id="jsda-message-position">
        <option value="top" <?php if($jsda_message_position=="top") echo"selected=\"selected\""; ?>>Top</option>
        <option value="bottom" <?php if($jsda_message_position=="bottom") echo"selected=\"selected\""; ?>>Bottom</option>
    </select> 
    
    <h4><label for="jsda-font-color"> Font Color</label></h4>
    * Default font color is #FF0000 which is red. 
    <br><input id="jsda-font-color" type="text" name="jsda_font_color" value="<?php if($jsda_font_color){echo $jsda_font_color;}else echo"#F00"; ?>" class="my-color-field"  data-default-color="#F00"/>
    
    <h4><label for="jsda-font-size"> Font Size</label></h4>
    * Default font size is 20px, If you want to put em it's also supported. Example 1.3em or 26px . Please do not add <strong>;</strong> as plugin will automatically add this on css.
    <br><input id="jsda-font-size" type="text" name="jsda_font_size" value="<?php if($jsda_font_size) {echo $jsda_font_size;} else echo"20px"; ?>"/>

    <h4><label for="jsda-font-color"> Background Color</label></h4>
    * Default background color is #EEEE22 which is Yellow. 
    <br><input id="jsda-bg-color" type="text" name="jsda_bg_color" value="<?php if($jsda_bg_color){echo $jsda_bg_color;}else echo"#F00"; ?>" class="my-color-field"  data-default-color="#EEEE22"/>
    
    <br><br>
    <input type="submit" name="jsda_update" value="Update" class="button button-primary">
    </form><!-- /#jada_option -->
    <br><br>For Support or Suggestion, Please visit <a href="http://shariarbd.com/plugins/js-disable-alert/" target="_blank">js Disable Alert Plugin Page</a>
    <br>  <br>
    You may love to have a look on my other two WordPress Plugin <br>
    1. <a href="http://wordpress.org/plugins/scroll-top-and-bottom/" target="_blank">Scroll Top and Bottom</a><br>
    2. <a href="http://wordpress.org/plugins/internet-explorer-alert/" target="_blank">Internet Explorer Alert!</a>
    <br>  <br>
  </div><!-- /.welcome-panel -->
</div><!-- /.wrap -->

<?php
}

 function jsda_admin()
{
  if (function_exists('add_options_page')) {
    add_options_page('js Disable Alert', 'js Disable Alert', 'manage_options','jsda.php','jada_option');
  }
}
add_action('admin_menu','jsda_admin',1);


function jsda_actions( $links, $file ) {
		if( $file == 'js-disable-alert/jsda.php' && function_exists( "admin_url" ) ) {
			$settings_link = '<a href="' . admin_url( 'options-general.php?page=jsda.php' ) . '">' .'Settings' . '</a>';
			array_unshift( $links, $settings_link ); // before other links
		}
		return $links;
}
add_filter('plugin_action_links', 'jsda_actions', 10, 2 );



function jsda_alert_message() 
{
$jsda_message = get_option('jsda_message');
if($jsda_message=="" || $jsda_message==" " ){
  echo '<noscript><p class="jsda-alert-message">Dear Visitor, Please Enable JavaScript of your Browser. Currently JavaScript is disabled</p></noscript>';

}else{
   echo '<noscript><p class="jsda-alert-message">'.$jsda_message.'</p></noscript>';
}
}
add_action('wp_footer', 'jsda_alert_message');

function jsda_css(){
    $jsda_message_position = get_option('jsda_message_position');
    $jsda_font_size = get_option('jsda_font_size');
    $jsda_font_color = get_option('jsda_font_color');
    $jsda_bg_color = get_option('jsda_bg_color');
?>
<style type="text/css"> 
.jsda-alert-message{
    position: fixed;
    text-align: center;
    width: 100%;
    min-height: 35px;
    z-index: 9999999999;
    margin: 0;
    <?php 
    if($jsda_message_position=="bottom"){echo "bottom:0;";} else {echo "top:0;";}
    if($jsda_font_color=="" || $jsda_font_color==" "){echo "color:#F00;";} else {echo "color:$jsda_font_color;";} 
    if($jsda_font_size=="" || $jsda_font_size==" "){echo "font-size:20px;";} else {echo "font-size:$jsda_font_size;";}  
    if($jsda_bg_color=="" || $jsda_bg_color==" "){echo "background:##EEEE22;";} else {echo "background:$jsda_bg_color;";} 
    ?>
  }
</style>
<?php }
add_action('wp_head', 'jsda_css');

add_action( 'admin_enqueue_scripts', 'jsda_enqueue_color_picker' );
function jsda_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('js/myscript.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
?>