<?php
/**
 * Plugin Name:      "medani web & design - News module"
 * Description:      This plugin will display a shortcode to show the latest x Posts. This shortcode should then be used on the pages, just in the WYSIWYG editor.
 * Version:          1.0
 * Author:           Adam Gyarmati
 * Text Domain:      newsmodule
 */

/** Register the above function using the admin_menu action hook */
 add_action( 'admin_menu', 'newsmodule_menu' );

	function newsmodule_menu(){    
		$page_title = 'News module';   
		$menu_title = 'News module';   
		$capability = 'manage_options';   
		$menu_slug  = 'newsmodule';   
		$function   = 'newsmodule_function';   
		$icon_url   = 'dashicons-admin-post';   
		$position   = 5; 

/** Create a function that contains the menu-building code. */
	add_menu_page( 
		$page_title,                 
		$menu_title,                   
		$capability,                  
		$menu_slug,                   
		$function,                   
		$icon_url,                   
		$position ); 
	} 

/** HTML output for the page */
	function newsmodule_function() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have permisson!' ) );
		}else{
		
/** Fetch datas from wordpress database */
				
			if (isset($_POST['submit'])) {
				$postnumber = trim($_POST['postnumber']);

				global $wpdb;
				$querystr = "SELECT * FROM $wpdb->posts 
							WHERE $wpdb->posts.post_type = 'post'
							ORDER BY $wpdb->posts.post_date DESC LIMIT 0,$postnumber";

				$pageposts = $wpdb->get_results($querystr, OBJECT);
			
			}

		var_dump($pageposts);
		//echo $postnumber;

?>
			 <html><!--It drives out of the same page / without action it does not take the value-->
				<form name="form" method="POST">
				Number<input type="number" id="postnumber" name="postnumber"><br>
				<input type="submit" name="submit" value="submit">
				</form>
			</html>
<?php
		

/** Create a shortcode from pageposts value */
			function news_module_shortcode()
			{  
				var_dump($pageposts);
				 
			}  

			add_shortcode( 'news_mod', 'news_module_shortcode' );
		}
	}
?>