<?php
    use Cake\Core\Configure;

    define("ADMIN_LAYOUT", "admin");
    define("ADMIN_LOGIN_LAYOUT", "admin_login");
    // define("RESET_PASSWORD", "reset_password");
    define("APP_NAME", "LiveBait");
    define("BASE_URL", "http://dev2.xicom.us/livebait/");
    define('SITEURL', 'http://dev2.xicom.us/livebait/');
    define("EMAILS_ENABLED",true);
    define("EMAIL_FROM","support@livebait.com");  
    define("EMAIL_FROM_NAME","LiveBait");

    define("UPLOAD_DIR_NAME", "uploads");
    define("USER_IMAGE_UPLOAD_DIR", UPLOAD_DIR_NAME . DS . "users" . DS . "{user_id}" . DS);

    define('SPAM_FOLDER', UPLOAD_DIR_NAME . DS . "spams" . DS);

    define("USER_SEX_MALE", 1);
    define("USER_SEX_FEMALE", 2);
    define("USER_SEX_DIVERSE", 3);
    
    define("USER_OPTION_NO", 0);
    define("USER_OPTION_YES", 1);
    define("USER_OPTION_SOCIALLY", 2);
    define("USER_OPTION_NEVER", 3);

    define("USER_NATURE_FRIENDLY", 1);
    define("USER_NATURE_NEVER", 2);

    define("USER_ACCOUNT_FREE", 1);
    define("USER_ACCOUNT_PREMIUM", 2);

    define("USER_STATUS_ACTIVE", 0);
    define("USER_STATUS_SUSPENDED", 1);

    define("CONTENT_TYPE_ABOUT_US", 1);
    define("CONTENT_TYPE_PRIVACY_POLICY", 2);
    define("CONTENT_TYPE_TERMS", 3);

    define("REQUEST_STATUS_PENDING", 0);
    define("REQUEST_STATUS_ACCEPT", 1);
    define("REQUEST_STATUS_REJECT", 2);
    define("REQUEST_STATUS_NOT_INTRESTED", 4);

    define('PRO_PUSH_HOST','gateway.push.apple.com');
    define('PRO_PUSH_PORT','2195');
    define('DEV_PUSH_HOST','gateway.sandbox.push.apple.com');
    define('DEV_PUSH_PORT','2195');

    define('GOOGLE_CLIENT_ID','831976150603-9ilcd08kfbqenqkdcb0gspmmkb4e174j.apps.googleusercontent.com');