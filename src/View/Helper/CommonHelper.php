<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Common helper
 */
class CommonHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function getUserSex($opted = NULL) {
        $options = [USER_SEX_MALE => 'Male', USER_SEX_FEMALE => 'Female', USER_SEX_DIVERSE => 'Gender Diverse'];
        if (!empty($opted)) {            
            return isset($options[$opted]) ? $options[$opted] : NULL;
        }
        return "";
    }

    public function getUserStatus($opted = NULL) {
        $options = [USER_STATUS_ACTIVE => 'Active', USER_STATUS_SUSPENDED => 'Suspended'];
        if (!empty($opted)) {
            return isset($options[$opted]) ? $options[$opted] : NULL;
        }
        return "";
    }

    public function getAccountStatus($opted = NULL) {
        $options = [USER_ACCOUNT_FREE => 'Free', USER_ACCOUNT_FREE => 'Premium'];
        if (!empty($opted)) {
            return isset($options[$opted]) ? $options[$opted] : NULL;
        }
        return "";
    }

    public function getUserOption($opted = NULL) {
        $options = [USER_OPTION_NO => 'No', USER_OPTION_YES => 'Yes', USER_OPTION_SOCIALLY => 'Socially', USER_OPTION_NEVER => 'Never'];
        if (!empty($opted)) {            
            return isset($options[$opted]) ? $options[$opted] : NULL;
        }
        return "";
    }

    public function getUserNature($opted = NULL) {
        $options = [USER_NATURE_FRIENDLY => 'Friendly', USER_OPTION_NEVER => 'Never'];
        if (!empty($opted)) {            
            return isset($options[$opted]) ? $options[$opted] : NULL;
        }
        return "";
    }

    public function getContentType($opted = NULL) {
        $options = [CONTENT_TYPE_ABOUT_US => 'About Us', CONTENT_TYPE_PRIVACY_POLICY => "Privacy Policy", CONTENT_TYPE_TERMS => 'Terms'];
        if (!empty($opted)) {
            return isset($options[$opted]) ? $options[$opted] : NULL;
        }
        return $options;
    }
}
