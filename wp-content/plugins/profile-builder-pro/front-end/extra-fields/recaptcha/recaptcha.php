<?php
/**
 * The reCAPTCHA server URL's
 */
define("WPPB_RECAPTCHA_API_SERVER", "http://www.google.com/recaptcha/api");
define("WPPB_RECAPTCHA_API_SECURE_SERVER", "https://www.google.com/recaptcha/api");
define("WPPB_RECAPTCHA_VERIFY_SERVER", "www.google.com");

/**
 * Encodes the given data into a query string format
 * @param $data - array of string elements to be encoded
 * @return string - encoded request
 */
function _wppb_recaptcha_qsencode ($data) {
        $req = "";
        foreach ( $data as $key => $value )
			$req .= $key . '=' . urlencode( stripslashes($value) ) . '&';

        // Cut the last '&'
        $req=substr($req,0,strlen($req)-1);
        return $req;
}



/**
 * Submits an HTTP POST to a reCAPTCHA server
 * @param string $host
 * @param string $path
 * @param array $data
 * @param int port
 * @return array response
 */
function _wppb_recaptcha_http_post($host, $path, $data, $port = 80) {

        $req = _wppb_recaptcha_qsencode ($data);

        $http_request  = "POST $path HTTP/1.0\r\n";
        $http_request .= "Host: $host\r\n";
        $http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
        $http_request .= "Content-Length: " . strlen($req) . "\r\n";
        $http_request .= "User-Agent: reCAPTCHA/PHP\r\n";
        $http_request .= "\r\n";
        $http_request .= $req;

        $response = '';
        if( false == ( $fs = @fsockopen($host, $port, $errno, $errstr, 10) ) )
			echo $errorMessage = '<span class="error">'. __('Could not open socket!', 'profilebuilder') .'</span><br/><br/>';

        fwrite($fs, $http_request);

        while ( !feof($fs) )
			$response .= fgets($fs, 1160); // One TCP-IP packet
        fclose($fs);
        $response = explode("\r\n\r\n", $response, 2);

        return $response;
}



/**
 * Gets the challenge HTML (javascript and non-javascript version).
 * This is called from the browser, and the resulting reCAPTCHA HTML widget
 * is embedded within the HTML form it was called from.
 * @param string $pubkey A public key for reCAPTCHA
 * @param string $error The error given by reCAPTCHA (optional, default is null)
 * @param boolean $use_ssl Should the request be made over ssl? (optional, default is false)

 * @return string - The HTML to be embedded in the user's form.
 */
function wppb_recaptcha_get_html ( $pubkey, $error = null, $use_ssl = false ){

	if ($pubkey == null || $pubkey == '')
		echo $errorMessage = '<span class="error">'. __("To use reCAPTCHA you must get an API key from", "profilebuilder"). " <a href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a></span><br/><br/>";
	
	$server = ( $use_ssl ? WPPB_RECAPTCHA_API_SECURE_SERVER : WPPB_RECAPTCHA_API_SERVER );

	$errorpart = ( $error ? "&amp;error=".$error : '' );

	return '
		<script type="text/javascript" src="'.$server.'/challenge?k='.$pubkey.$errorpart.'"></script>
		<noscript>
			<iframe src="'. $server . '/noscript?k=' . $pubkey . $errorpart . '" height="300" width="500" frameborder="0"></iframe><br/>
			<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
			<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
		</noscript>';
}




/**
 * A wppb_ReCaptchaResponse is returned from wppb_recaptcha_check_answer()
 */
class wppb_ReCaptchaResponse {
	var $is_valid;
	var $error;
}


/**
  * Calls an HTTP POST function to verify if the user's guess was correct
  * @param string $privkey
  * @param string $remoteip
  * @param string $challenge
  * @param string $response
  * @param array $extra_params an array of extra variables to post to the server
  * @return wppb_ReCaptchaResponse
  */
function wppb_recaptcha_check_answer ( $privkey, $remoteip, $challenge, $response, $extra_params = array() ){

	if ( $remoteip == null || $remoteip == '' )
		echo '<span class="error">'. __("For security reasons, you must pass the remote ip to reCAPTCHA!", "profilebuilder") .'</span><br/><br/>';
	
	
        //discard spam submissions
        if ($challenge == null || strlen($challenge) == 0 || $response == null || strlen($response) == 0) {
			$recaptcha_response = new wppb_ReCaptchaResponse();
			$recaptcha_response->is_valid = false;
			$recaptcha_response->error = 'incorrect-captcha-sol';
			
			return $recaptcha_response;
        }

        $response = _wppb_recaptcha_http_post (WPPB_RECAPTCHA_VERIFY_SERVER, "/recaptcha/api/verify",
                                          array (
                                                 'privatekey' => $privkey,
                                                 'remoteip' => $remoteip,
                                                 'challenge' => $challenge,
                                                 'response' => $response
                                                 ) + $extra_params
                                          );

        $answers = explode ("\n", $response [1]);
        $recaptcha_response = new wppb_ReCaptchaResponse();

        if (trim ($answers [0]) == 'true') {
                $recaptcha_response->is_valid = true;
        }
        else {
                $recaptcha_response->is_valid = false;
                $recaptcha_response->error = $answers [1];
        }
        return $recaptcha_response;

}

/**
 * gets a URL where the user can sign up for reCAPTCHA. If your application
 * has a configuration page where you enter a key, you should provide a link
 * using this function.
 * @param string $domain The domain where the page is hosted
 * @param string $appname The name of your application
 */
function wppb_recaptcha_get_signup_url ($domain = null, $appname = null) {

	return "https://www.google.com/recaptcha/admin/create?" .  _wppb_recaptcha_qsencode (array ('domains' => $domain, 'app' => $appname));
}

function _wppb_recaptcha_aes_pad($val) {
	$block_size = 16;
	$numpad = $block_size - (strlen ($val) % $block_size);
	return str_pad($val, strlen ($val) + $numpad, chr($numpad));
}

/* Mailhide related code */

function _wppb_recaptcha_aes_encrypt($val,$ky) {
	if (! function_exists ("mcrypt_encrypt"))
		echo $errorMessage = '<span class="error">'. __("To use reCAPTCHA Mailhide, you need to have the mcrypt php module installed!", "profilebuilder") .'</span><br/><br/>';
		
	$mode=MCRYPT_MODE_CBC;   
	$enc=MCRYPT_RIJNDAEL_128;
	$val=_wppb_recaptcha_aes_pad($val);
	return mcrypt_encrypt($enc, $ky, $val, $mode, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0");
}


function _wppb_wppb_recaptcha_mailhide_urlbase64 ($x) {
	return strtr(base64_encode ($x), '+/', '-_');
}

/* gets the reCAPTCHA Mailhide url for a given email, public key and private key */
function wppb_recaptcha_mailhide_url($pubkey, $privkey, $email) {
	if ($pubkey == '' || $pubkey == null || $privkey == "" || $privkey == null)
		echo '<span class="error">'. __("To use reCAPTCHA Mailhide, you have to sign up for a public and private key; you can do so at", "profilebuilder"). " <a href='http://www.google.com/recaptcha/mailhide/apikey'>http://www.google.com/recaptcha/mailhide/apikey</a></span><br/><br/>";
	

	$ky = pack('H*', $privkey);
	$cryptmail = _wppb_recaptcha_aes_encrypt ($email, $ky);
	
	return "http://www.google.com/recaptcha/mailhide/d?k=" . $pubkey . "&c=" . _wppb_wppb_recaptcha_mailhide_urlbase64 ($cryptmail);
}

/**
 * gets the parts of the email to expose to the user.
 * eg, given johndoe@example,com return ["john", "example.com"].
 * the email is then displayed as john...@example.com
 */
function _wppb_recaptcha_mailhide_email_parts ($email) {
	$arr = preg_split("/@/", $email );

	if (strlen ($arr[0]) <= 4) {
		$arr[0] = substr ($arr[0], 0, 1);
	} else if (strlen ($arr[0]) <= 6) {
		$arr[0] = substr ($arr[0], 0, 3);
	} else {
		$arr[0] = substr ($arr[0], 0, 4);
	}
	return $arr;
}

/**
 * Gets html to display an email address given a public an private key.
 * to get a key, go to:
 *
 * http://www.google.com/recaptcha/mailhide/apikey
 */
function wppb_recaptcha_mailhide_html($pubkey, $privkey, $email) {
	$emailparts = _wppb_recaptcha_mailhide_email_parts ($email);
	$url = wppb_recaptcha_mailhide_url ($pubkey, $privkey, $email);
	
	return htmlentities($emailparts[0]) . "<a href='".htmlentities( $url )."' onclick=\"window.open('".htmlentities( $url )."', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;\" title=\"Reveal this e-mail address\">...</a>@" . htmlentities ($emailparts [1]);

}

/* the function to display error message on the registration page */
function wppb_add_captcha_error_message( $publickey, $privatekey ){
    if( !empty( $_POST["recaptcha_challenge_field"] ) )
        $recaptcha_challenge_field = $_POST["recaptcha_challenge_field"];
    else
        $recaptcha_challenge_field = '';

    if( !empty( $_POST["recaptcha_response_field"] ) )
        $recaptcha_response_field = $_POST["recaptcha_response_field"];
    else
        $recaptcha_response_field = '';

	$resp = wppb_recaptcha_check_answer ( $privatekey, $_SERVER["REMOTE_ADDR"], $recaptcha_challenge_field, $recaptcha_response_field );

	if ( !empty( $_POST ) )
		return ( ( !$resp->is_valid ) ? false : true );
}
 
/* the function to add recaptcha to the registration form o PB */
function wppb_recaptcha_handler ( $output, $form_location, $field, $user_id, $field_check_errors, $request_data ){
	if ( $field['field'] == 'reCAPTCHA' ){
		$item_title = apply_filters( 'wppb_'.$form_location.'_recaptcha_custom_field_'.$field['id'].'_item_title', wppb_icl_t( 'plugin profile-builder-pro', 'custom_field_'.$field['id'].'_title_translation', $field['field-title'] ) );
		$item_description = wppb_icl_t( 'plugin profile-builder-pro', 'custom_field_'.$field['id'].'_description_translation', $field['description'] );

		if ( $form_location == 'register' ){
			echo '<script type="text/javascript">var RecaptchaOptions = {theme : \''.apply_filters ( 'wppb_recaptcha_theme_settings', 'default_theme' ).'\' }; </script>'; //https://developers.google.com/recaptcha/docs/customization#Standard_Themes
			
			$error_mark = ( ( $field['required'] == 'Yes' ) ? '<span class="wppb-required" title="'.wppb_required_field_error($field["field-title"]).'">*</span>' : '' );
						
			if ( array_key_exists( $field['id'], $field_check_errors ) )
				$error_mark = '<img src="'.WPPB_PLUGIN_URL.'assets/images/pencil_delete.png" title="'.wppb_required_field_error($field["field-title"]).'"/>';
	
				$publickey = trim( $field['public-key'] );
				$privatekey = trim( $field['private-key'] );

				if ( ( $field['public-key'] == null ) || ( $field['public-key'] == '' ) )
					return '<span class="custom_field_recaptcha_error_message" id="'.$field['meta-name'].'_error_message">'.apply_filters( 'wppb_'.$form_location.'_recaptcha_custom_field_'.$field['id'].'_error_message', __("To use reCAPTCHA you must get an API public key from:", "profilebuilder"). '<a href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>' ).'</span>';
					
				if ( ( $field['private-key'] == null ) || ( $field['private-key'] == '' ) )
					return '<span class="custom_field_recaptcha_error_message" id="'.$field['meta-name'].'_error_message">'.apply_filters( 'wppb_'.$form_location.'_recaptcha_custom_field_'.$field['id'].'_error_message', __("To use reCAPTCHA you must get an API private key from:", "profilebuilder"). '<a href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>' ).'</span>';

				return '<style type="text/css">#recaptcha_area{line-height:0;}</style><label for="recaptcha_response_field">'.$item_title.$error_mark.'</label>'.wppb_recaptcha_get_html( trim( $field['public-key'] ), null, ( ( !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ) ? false : true ) );
		}
	}
}
add_filter( 'wppb_output_form_field_recaptcha', 'wppb_recaptcha_handler', 10, 6 );


/* handle field validation */
function wppb_check_recaptcha_value( $message, $field, $request_data, $form_location ){
	if( $field['field'] == 'reCAPTCHA' ){
		if ( $form_location == 'register' ){
			if ( ( wppb_add_captcha_error_message( trim( $field['public-key'] ), trim( $field['private-key'] ) ) == false ) && ( $field['required'] == 'Yes' ) ){
				return wppb_required_field_error($field["field-title"]);
			}
		}
	}

    return $message;
}
add_filter( 'wppb_check_form_field_recaptcha', 'wppb_check_recaptcha_value', 10, 4 );