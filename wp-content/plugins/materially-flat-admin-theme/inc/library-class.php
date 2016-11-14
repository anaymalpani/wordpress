<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	/*
		Library Class for use in Materially Flat Admin Theme plugin
	*/
if(!class_exists('MFAT_Library' )){
	class MFAT_Library{
		
		// The name of the cache for the the fonts.
 	   private $mfat_cache_name = '';
		// Admin notice text.
 	   private $admin_notice = '';
		
		 /**
    	 * Get the full list of fonts from Google.
    	 * Return as an array: font-family => array(variants)
    	 * This is the same format as returned by get_fallback_fonts(), and is
    	 * actually used to generate the content of fonts.json.
		 * $api_url: URL of google font api to retrieve the list of google fonts available
	     * $google_api_key: Google API key used in conjuction with $api url to retrieve list of
		 *				   google fonts available.
    	 */

    	public function get_google_font_data($api_url, $google_api_key){
        	$font_list = false;
	        // The API key should be URL-safe.
    	    // We need to ensure it is when setting it in the admin page.
        	$api_data = wp_remote_get($api_url . $google_api_key);
	        // If the fetch failed, then report it to the admin.
	        if (is_wp_error($api_data)) {
	            $error_message = $api_data->get_error_message();
	            $this->admin_notice = "Error fetching Google font: $error_message";
	            return $font_list;
	        }

	        $response = $api_data['response'];

	        if (200 === $response['code']) {
    	        $font_list = json_decode($api_data['body'], true);
    	    }

    	    // At this point we could try deciphering the error messages that Google returns,
    	    // but they are complex structures.
	
    	    if (empty($font_list) || !is_array($font_list)) {
    	        $errors = json_decode($api_data['body'], true);
    	        if (isset($errors['error']['errors'][0]) && is_array($errors['error']['errors'][0])) {
    	            $error_details = array();
        	        foreach($errors['error']['errors'][0] as $k => $v) {
        	            $error_details[] = "$k: $v";
        	        }
            	    $this->admin_notice = implode('; ', $error_details);
            	}
            	return $font_list;
        	}

        	$fonts = array();
        	foreach($font_list['items'] as $font) {
        	    $variants = $font['variants'];

            	// Normalise the weights. Make sure every variant has
            	// an explicit weight. This makes it easier to process later.
            	// Also abreviate "italic" to "i".
            	//
            	// Font weights are (as defined by Google's font overview pages):
            	//  100 ultra-light
            	//  200 light
            	//  300 book ("light")
            	//  400 normal
            	//  500 medium
            	//  600 semi-bold
            	//  700 bold
            	//  800 extra-bold
            	//  900 ultra-bold
            	// Simplify the data a little for storage, and make it more consistent.

            	foreach($variants as $vkey => $vname) {
            	    if ($vname == 'regular') $variants[$vkey] = '400';
            	    if ($vname == 'italic') {
            	        $vname = '400italic';
            	        $variants[$vkey] = $vname;
            	    }
                	if (strpos($vname, 'italic') !== false) {
                	    $variants[$vkey] = str_replace('italic', 'i', $vname);
                	}
            	}

            	$fonts[$font['family']] = $variants;
        	}	

        	// Sort by keys, which will be the font name.
        	ksort($fonts);
		
    	    return $fonts;
   	 }

    	/**
    	 * Get the full list of fonts from Google.
		 * $google_fonts: array containig unformatted google fonts
		 * $cache_name: cache for storing the list of google font
     	 */

    	public function get_google_fonts($google_fonts, $cache_name){
        // Get the font data from Google.
      	  $font_list = $google_fonts;

      	  if (empty($font_list)){
				$font_list = $this->get_google_fonts_cached($cache_name);
				return $font_list;
			}
    	    // Format the font data
	
    	    $mfat_fonts = array();
    	    foreach($font_list as $family => $variants) {
			   if(in_array(400, $variants) && in_array(700, $variants)){
        	        $mfat_fonts[] = array(
            	        'name' => $family,
                	    'variant' => ':' . implode(',', $variants)
                	);
			   	}
        	}
	        return $mfat_fonts;
	    }
		/**
	     * Get the full list of Google fonts.
    	 * We look first in the cache generated by the settings page, and then in
	     * the local cache file if not in the transient cache generated in the settings
	     * page.
	     */
	
    	public function get_google_fonts_cached($cache_name){
	        // Transient caching.
	        if (false === ($fonts = get_transient($cache_name))) {
	            $fonts = $this->get_fallback_fonts();
	
    	        // Cache indefinitely. The cache will be refreshed on a visit to the settings page.
    	      if (!empty($fonts)) set_transient($cache_name, $fonts, 60*60*24*7);
    	    }
			//delete_transient($this->mfat_cache_name);

    	    return $fonts;
    	}
		 /**
    	 * Returns fallback font data, in the same format as get_google_font_data().
    	 */

    	public function get_fallback_font_data(){
	        $file = dirname(__FILE__) . '/fonts.json';
	
    	    if (is_readable($file)) {
    	        $data = file_get_contents($file);
    	        return json_decode($data, true);
    	    }

    	    return null;
    	}
	
    	/**
    	 * Returns fonts, pulled from the local fallback file.
    	 */
	
	    public function get_fallback_fonts()
	    {
	        $font_data = $this->get_fallback_font_data();
	        $mfat_fonts = array();

	        if ( !empty($font_data)) {
    	    	foreach($font_data as $family => $variants) {
				   if(in_array(400, $variants) && in_array(700, $variants)){
    	        	    $mfat_fonts[] = array(
    	            	    'name' => $family,
        	            	'variant' => ':' . implode(',', $variants)
            		    );
				   }
				}
        	}
	
    	    return $mfat_fonts;
    	}
		/**
		* Function responsible for replacing the default one that comes with wordpress,
		* because of compatibility reasons
	 	*/
		function do_settings_sections( $page ) {
			global $wp_settings_sections, $wp_settings_fields;
			
			if ( ! isset( $wp_settings_sections[$page] ) )
				return;
			
			foreach ( (array) $wp_settings_sections[$page] as $section ) {
				if ( $section['title'] )
				echo "<h3>{$section['title']}</h3>\n";

				if ( $section['callback'] )
				call_user_func( $section['callback'], $section );

				if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || 
				!isset( $wp_settings_fields[$page][$section['id']] ) )
					continue;
				echo '<table class="form-table">';
				$this->do_settings_fields( $page, $section['id'] );
				echo '</table>';
			}
		}

		/**
		 * Function for replacing the default one in wordpress,
		 * this is just for compatibility purposes
		 */
		function do_settings_fields($page, $section) {
			global $wp_settings_fields;
		
			if ( ! isset( $wp_settings_fields[$page][$section] ) )
				return;
		
			foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
				$class = '';
		
				if ( ! empty( $field['args']['class'] ) ) {
					$class = ' class="' . esc_attr( $field['args']['class'] ) . '"';
				}
		
				echo "<tr{$class}>";
		
				if ( ! empty( $field['args']['label_for'] ) ) {
					echo '<th scope="row"><label for="' . esc_attr( $field['args']['label_for'] ) . '">' . $field['title'] . '</label></th>';
				} 
				else {
					echo '<th scope="row">' . $field['title'] . '</th>';
				}
		
				echo '<td>';
				call_user_func($field['callback'], $field['args']);
				echo '</td>';
				echo '</tr>';
			}
		}
		
		function compile_admin_sass($args){
			$admin_url = esc_url(admin_url(add_query_arg(array('page' => 'mfat-main'),'admin.php'))); 
			$scss = '';
			foreach($args as $key => $value){
				$scss .= "\${$key}: $value;\n";
			}
			
			if(false === ( $creds = request_filesystem_credentials($admin_url, '', false, false, array()))){
				return true;
			}
			// Inititialize the API
			if(!WP_Filesystem($creds)){
				request_filesystem_credentials($admin_url, '', true);
				return false;
			} 
			global $wp_filesystem;
			
			//Get all the needed sass files
			$variable_scss_file = MFAT_CUSTOM_DIR . '/admin-variables.scss';
			$admin_scss_file = MFAT_CUSTOM_DIR . '/admin.scss';
			$admin_css_file = MFAT_CUSTOM_DIR .  '/admin.css';
			$adminbar_scss_file = MFAT_CUSTOM_DIR . '/adminbar.scss';
			$adminbar_css_file = MFAT_CUSTOM_DIR . '/adminbar.css';
			
			/*
			* Copy all the custom scss code into the variable scss file and 
			* if it doesn't succeed exit.
			*/
			if( !$wp_filesystem->put_contents($variable_scss_file, $scss, FS_CHMOD_FILE))
				wp_die("<pre> Could not write custom file");
				
			//Compile and write to both the admin and admin bar stylesheet file.
			require_once(MFAT_DIR.'/inc/phpsass/SassParser.php');
			$sass = new SassParser(array('style' => SassRenderer::STYLE_COMPRESSED));
			$admin_css = $sass->toCss($admin_scss_file);
			$adminbar_css = $sass->toCss($adminbar_scss_file);
			
			/*
			* Copy all the admin css code into the admin css file and 
			* if it doesn't succeed exit.
			*/
			if( !$wp_filesystem->put_contents($admin_css_file, $admin_css, FS_CHMOD_FILE))
				wp_die("<pre> Could not write the admin css file");
			
			/*
			* Copy all the adminbar css code into the adminbar css file and 
			* if it doesn't succeed exit.
			*/
			if( !$wp_filesystem->put_contents($adminbar_css_file, $adminbar_css, FS_CHMOD_FILE))
				wp_die("<pre> Could not write the admin bar css file");
			
 		}
		 
		function compile_login_sass($args){
			$login_url = esc_url(admin_url(add_query_arg(array('page' => 'mfat-login'),'admin.php')));
			$scss = '';
			foreach($args as $key => $value){
				$scss .= "\${$key}: $value;\n";
			}
			
			if(false === ( $creds = request_filesystem_credentials($login_url, '', false, false, array()))){
				return true;
			}
			// Inititialize the API
			if(!WP_Filesystem($creds)){
				request_filesystem_credentials($login_url, '', true);
				return false;
			} 
			global $wp_filesystem;
			
			//Get all the needed sass files
			$variable_scss_file = MFAT_CUSTOM_DIR . '/login-variables.scss';
			$login_scss_file = MFAT_CUSTOM_DIR . '/login.scss';
			$login_css_file = MFAT_CUSTOM_DIR .  '/login.css';
			
			/*
			* Copy all the custom scss code into the variable scss file and 
			* if it doesn't succeed exit.
			*/
			
			if( !$wp_filesystem->put_contents($variable_scss_file, $scss, FS_CHMOD_FILE))
				wp_die("<pre> Could not write custom file");
				
			//Compile and write to the login stylesheet file.
			require_once(MFAT_DIR.'/inc/phpsass/SassParser.php');
			$sass = new SassParser(array('style' => SassRenderer::STYLE_COMPRESSED));
			$login_css = $sass->toCss($login_scss_file);
			
			/*
			* Copy all the login css code into the login css file and 
			* if it doesn't succeed exit.
			*/
			
			if( !$wp_filesystem->put_contents($login_css_file, $login_css, FS_CHMOD_FILE))
				wp_die("<pre> Could not write the login css file");
		}

		function compile_imported_sass($admin_args, $login_args){
			$url = esc_url(admin_url(add_query_arg(array('page' => 'mfat-settings'),'admin.php')));
			$admin_scss = '';
			$login_scss = '';
			foreach($admin_args as $key => $value){
				$admin_scss .= "\${$key}: $value;\n";
			}
			
			foreach($login_args as $key => $value){
				$login_scss .= "\${$key}: $value;\n";
			}
			
			if(false === ( $creds = request_filesystem_credentials($url, '', false, false, array()))){
				return true;
			}
			// Inititialize the API
			if(!WP_Filesystem($creds)){
				request_filesystem_credentials($url, '', true);
				return false;
			} 
			global $wp_filesystem;
			
			//Get all the needed sass files
			$admin_variables_file = MFAT_CUSTOM_DIR . '/admin-variables.scss';
			$admin_scss_file = MFAT_CUSTOM_DIR . '/admin.scss';
			$admin_css_file = MFAT_CUSTOM_DIR .  '/admin.css';
			$adminbar_scss_file = MFAT_CUSTOM_DIR . '/adminbar.scss';
			$adminbar_css_file = MFAT_CUSTOM_DIR . '/adminbar.css';
			$login_variables_file = MFAT_CUSTOM_DIR . '/login-variables.scss';
			$login_scss_file = MFAT_CUSTOM_DIR . '/login.scss';
			$login_css_file = MFAT_CUSTOM_DIR . '/login.css';
			
			/*
			* Copy all the custom scss code into the variable scss file and 
			* if it doesn't succeed exit.
			*/
			if((!$wp_filesystem->put_contents($admin_variables_file, $admin_scss, FS_CHMOD_FILE)) || (
			!$wp_filesystem->put_contents($login_variables_file, $login_scss, FS_CHMOD_FILE)
			))
				wp_die("<pre> Could not write custom file");
				
			//Compile and write to both the admin and admin bar stylesheet file.
			require_once(MFAT_DIR.'/inc/phpsass/SassParser.php');
			$sass = new SassParser(array('style' => SassRenderer::STYLE_COMPRESSED));
			$admin_css = $sass->toCss($admin_scss_file);
			$adminbar_css = $sass->toCss($adminbar_scss_file);
			$login_css = $sass->toCss($login_scss_file);
			
			/*
			* Copy all the admin css code into the admin css file and 
			* if it doesn't succeed exit.
			*/
			if(!$wp_filesystem->put_contents($admin_css_file, $admin_css, FS_CHMOD_FILE))
				wp_die("<pre> Could not write the admin css file");
			
			/*
			* Copy all the adminbar css code into the adminbar css file and 
			* if it doesn't succeed exit.
			*/
			if(!$wp_filesystem->put_contents($adminbar_css_file, $adminbar_css, FS_CHMOD_FILE))
				wp_die("<pre> Could not write the admin bar css file");
			
			/*
			* Copy all the login css code into the login css file and 
			* if it doesn't succeed exit.
			*/
			if(!$wp_filesystem->put_contents($login_css_file, $login_css, FS_CHMOD_FILE))
				wp_die("<pre> Could not write the login css file");
			
 		}
		
	}//end class
}//end if