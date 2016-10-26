<?php
// include the LinkedIn class
require_once('linkedin_3.2.0.class.php');
if ((isset($_REQUEST['linkedin']) && $_REQUEST['linkedin'] == 'yes') || (isset($_SESSION['linkedin']) && $_SESSION['linkedin'] == 'yes')) {
    global $cs_plugin_options, $wpdb;
    if (isset($_REQUEST['linkedin']))
        $_SESSION['linkedin'] = $_REQUEST['linkedin'];
    else {
        unset($_SESSION['linkedin']);
    }
    if (isset($cs_plugin_options['cs_linkedin_app_id']))
        $linkedin_app_id = $cs_plugin_options['cs_linkedin_app_id'];
    if (isset($cs_plugin_options['cs_linkedin_secret']))
        $linkedin_secret = $cs_plugin_options['cs_linkedin_secret'];

    try {
        // start the session
        if (session_id() == '') {
            session_start();
        }
        //if (!session_start()) {
        if (!isset($_SESSION)) {
            throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
        }
        // display constants
        $API_CONFIG = array(
            'appKey' => $linkedin_app_id,
            'appSecret' => $linkedin_secret,
        );
        //define('DEMO_GROUP', '4010474');
        //define('DEMO_GROUP_NAME', 'A2zwebhelp Demo');
        define('PORT_HTTP', '80');
        define('PORT_HTTP_SSL', '443');
        // set index
        $_REQUEST[LINKEDIN::_GET_TYPE] = (isset($_REQUEST[LINKEDIN::_GET_TYPE])) ? $_REQUEST[LINKEDIN::_GET_TYPE] : '';
        switch ($_REQUEST[LINKEDIN::_GET_TYPE]) {
            case 'initiate':
                if (isset($_REQUEST['apply_job_id']) && $_REQUEST['apply_job_id'] != '') {
                    $_SESSION['apply_job_id'] = $_REQUEST['apply_job_id'];
                }
                /**
                 * Handle user initiated LinkedIn connection, create the LinkedIn object.
                 */
                // check for the correct http protocol (i.e. is this script being served via http or https)
                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                    $protocol = 'https';
                } else {
                    $protocol = 'http';
                }
                // set the callback url
                $API_CONFIG['callbackUrl'] = $protocol . '://' . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
                $OBJ_linkedin = new LinkedIn($API_CONFIG);
                // check for response from LinkedIn
                $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';
                if (!$_GET[LINKEDIN::_GET_RESPONSE]) {
                    // LinkedIn hasn't sent us a response, the user is initiating the connection
                    // send a request for a LinkedIn access token
                    $response = $OBJ_linkedin->retrieveTokenRequest();
                    //echo "<pre>";print_r($response);exit;
                    if ($response['success'] === TRUE) {
                        // store the request token
                        $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];
                        // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
                        header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
                        exit;
                    } else {
                        // bad token request
                        ?>
                        <script>
                            alert("<?php echo _e('Request token retrieval failed. Please check your settings and then try again.!', 'jobhunt'); ?>");
                            window.opener.location.reload();
                            window.close();
                        </script>
                        <?php
                    }
                } else {
                    // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
                    $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
                    if ($response['success'] === TRUE) {
                        // the request went through without an error, gather user's 'access' tokens
                        $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];
                        // set the user as authorized for future quick reference
                        $_SESSION['oauth']['linkedin']['authorized'] = TRUE;
                        $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
                        if ($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
                            $OBJ_linkedin = new LinkedIn($API_CONFIG);
                            $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
                            $OBJ_linkedin->setResponseFormat(LINKEDIN::_RESPONSE_XML);
                        }

                        $response = $OBJ_linkedin->profile('~:(id,first-name,last-name,picture-url,email-address,phone-numbers,headline)');
                        //$response = $OBJ_linkedin->profile('~:(first-name,last-name,headline,location:(name),skills:(skill:(name)),educations:(id,school-name,field-of-study))');
                        //$response = $OBJ_linkedin->skills('~:(skills:(skill:(name)))');
                        if ($response['success'] === TRUE) {
                            $result = new SimpleXMLElement($response['linkedin']);
                            $linkedin_id = (string) $result->id;
                            $linkedin_firstname = (string) $result->{'first-name'};
                            $linkedin_lastname = (string) $result->{'last-name'};
                            $linkedin_picture_url = (string) $result->{'picture-url'};
                            $linkedin_email = (string) $result->{'email-address'};
                            $linkedin_phone = (string) $result->{'phone-numbers'};
                            $linkedin_job_title = (string) $result->{'headline'};
                            #############################################
                            #       Login / register as guest user      #
                            #############################################
                            $email = filter_var($linkedin_email, FILTER_SANITIZE_EMAIL);
                            if (!is_user_logged_in()) {
                                $ID = email_exists($email);
                                if ($ID == NULL) { // Register
                                    //print_r($ID);exit;
                                    if ($ID == false) { // Real register
                                        //require_once get_template_directory() . WPINC . '/registration.php';
                                        $random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);
                                        if (!isset($cs_linkedin_settings['linkedin_user_prefix']))
                                            $cs_linkedin_settings['linkedin_user_prefix'] = 'linkedin-';
                                        $sanitized_user_login = sanitize_user($cs_linkedin_settings['linkedin_user_prefix'] . $linkedin_firstname);
                                        if (!validate_username($sanitized_user_login)) {
                                            $sanitized_user_login = sanitize_user($cs_linkedin_settings['linkedin_user_prefix'] . $result->{'id'});
                                        }
                                        $defaul_user_name = $sanitized_user_login;
                                        $i = 1;
                                        while (username_exists($sanitized_user_login)) {
                                            $sanitized_user_login = $defaul_user_name . $i;
                                            $i++;
                                        }
                                        $ID = wp_create_user($sanitized_user_login, $random_password, $email);

                                        if (!is_wp_error($ID)) {
                                            $new_user = new WP_User($ID);
                                            // update user meta
                                            $new_user->set_role('cs_candidate');
                                            update_user_meta($ID, 'cs_user_last_activity_date', strtotime(date('d-m-Y H:i:s')));
                                            update_user_meta($ID, 'cs_allow_search', 'yes');
                                            update_user_meta($ID, 'cs_user_status', 'active');
                                            // Notification
                                            wp_new_user_notification($ID, $random_password);
                                            $user_info = get_userdata($ID);
                                            wp_update_user(array(
                                                'ID' => $ID,
                                                'display_name' => $linkedin_firstname . " " . $linkedin_lastname,
                                                'first_name' => $linkedin_firstname,
                                                'last_name' => $linkedin_lastname,
                                            ));
                                            update_user_meta($ID, 'cs_linkedin_default_password', $user_info->user_pass);
                                            update_user_meta($ID, 'cs_user_linkedin_id', $linkedin_id);
                                            update_user_meta($ID, 'cs_user_registered', 'linkedin');
                                            update_post_meta($candidate_postid, 'user_img', $linkedin_picture_url);

                                            if (isset($cs_plugin_options['cs_candidate_review_option']) && $cs_plugin_options['cs_candidate_review_option'] == 'on') {
                                                $wpdb->update(
                                                        $wpdb->prefix . 'users', array('user_status' => 1), array('ID' => esc_sql($ID))
                                                );
                                                update_user_meta($ID, 'cs_user_status', 'active');
                                            } else {
                                                $wpdb->update(
                                                        $wpdb->prefix . 'users', array('user_status' => 0), array('ID' => esc_sql($ID))
                                                );
                                                update_user_meta($ID, 'cs_user_status', 'inactive');
                                            }
                                        } else {
                                            return;
                                        }
                                    }

                                    if (isset($cs_linkedin_settings['linkedin_redirect_reg']) && $cs_linkedin_settings['linkedin_redirect_reg'] != '' && $cs_linkedin_settings['linkedin_redirect_reg'] != 'auto') {
                                        set_site_transient(cs_linkedin_uniqid() . '_linkedin_r', $cs_linkedin_settings['linkedin_redirect_reg'], 3600);
                                    }
                                } else { // if already exist
                                    $current_user = get_userdata($ID);
                                    $user_roles = isset($current_user->roles) ? $current_user->roles : '';
                                    if (($user_roles != '' && in_array("cs_candidate", $user_roles))) {
                                        // update user meta
                                        update_user_meta($ID, 'cs_user_last_activity_date', strtotime(date('d-m-Y H:i:s')));
                                        update_user_meta($ID, 'cs_allow_search', 'yes');
                                        update_user_meta($ID, 'cs_user_status', 'active');
                                    } else {
                                        ?>
                                        <script>
                                            alert("<?php echo _e('This Linked-in profile is already linked with other account. Linking process failed!', 'jobhunt'); ?>");
                                            window.opener.location.reload();
                                            window.close();
                                        </script>
                                        <?php
                                        $ID = Null;     // set null bcz this user exist in other Role
                                    }
                                }

                                if ($ID) {
                                    // start the session
                                    //if (session_id() == '') {
                                    //     session_start();
                                    // }
                                    //echo "userinfo===<pre>";print_r($status);exit;
//                                    $user_info = get_userdata($ID);
////                                    //print_r($user_info);
                                    //exit;
                                    ?>
                                    <script>
                                        window.opener.location.href = "index.php?likedin-login-request=<?php echo $ID; ?>";
                                        window.close();
                                    </script>
                                    <?php
                                    exit();
                                }
                            } else {
                                $user_info = wp_get_current_user();
                                set_site_transient($user_info->ID . '_cs_linkedin_admin_notice', __('This Linked-in profile is already linked with other account. Linking process failed!', 'jobhunt'), 3600);
                            }

                            #############################################
                            #       End Login / Register User           #
                            #############################################                           
                        }
                    } else {
                        // bad token access
                        ?>
                        <script>
                            alert("<?php echo _e('Request token retrieval failed. Please check your settings and then try again.!', 'jobhunt'); ?>");
                            window.opener.location.reload();
                            window.close();
                        </script>
                        <?php
                    }
                }
                break;

            default:
                // nothing being passed back, display demo page
                // check PHP version
                if (version_compare(PHP_VERSION, '5.0.0', '<')) {
                    throw new LinkedInException('You must be running version 5.x or greater of PHP to use this library.');
                }

                // check for cURL
                if (extension_loaded('curl')) {
                    $curl_version = curl_version();
                    $curl_version = $curl_version['version'];
                } else {
                    throw new LinkedInException('You must load the cURL extension to use this library.');
                }
                break;
        }
    } catch (LinkedInException $e) {
        // exception raised by library call
        echo $e->getMessage();
    }
}
?>
