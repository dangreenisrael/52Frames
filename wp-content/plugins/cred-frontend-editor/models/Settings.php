<?php
/**************************************************

Cred settings model

**************************************************/

/**
 *
 * $HeadURL: https://www.onthegosystems.com/misc_svn/crud/tags/1.3.4/models/Settings.php $
 * $LastChangedDate: 2014-08-18 14:03:21 +0000 (Mon, 18 Aug 2014) $
 * $LastChangedRevision: 26052 $
 * $LastChangedBy: riccardo $
 *
 */

final class CRED_Settings_Model extends CRED_Abstract_Model implements CRED_Singleton
{

    private $option_name = 'cred_cred_settings';

/**
 * Class constructor
 */
    public function __construct()
    {
        parent::__construct();
        add_action('admin_notices', array( $this, 'updateSettingsMessage'));
    }

    public function prepareDB()
    {
        $defaults=array(
            'wizard' => 1,
            'syntax_highlight' => 1,
            'cache_notice'=>1,
            'export_settings'=>1,
            'export_custom_fields'=>1,
            'recaptcha'=>array(
                'public_key'=>'',
                'private_key'=>''
            ),
            'dont_load_cred_css' => 0,
            'use_bootstrap' => 0,
        );

        // CRED_PostExpiration
        $defaults = apply_filters('cred_ext_general_settings_options', $defaults);

        $settings = get_option($this->option_name);

        if ($settings==false || $settings==null)
            update_option($this->option_name,$defaults);
    }

    public function getSettings()
    {
        return get_option($this->option_name);
    }

    public function updateSettings($settings)
    {
        return update_option($this->option_name,$settings);
    }

    public function updateSettingsMessage()
    {
        if( array_key_exists( 'settings', $_POST ) ) {
            echo '<div class="updated"><p><strong>';
            _e('Settings saved.', 'wp-cred');
            echo '</strong></p></div>';
        }
    }
}
