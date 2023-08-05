<?php 

// PayPal configuration 
define('PAYPAL_ID', 'sb-webvw26953009@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE);
 
define('PAYPAL_RETURN_URL', 'http://localhost/music-web/scripts/paypal-success.php'); 
define('PAYPAL_CANCEL_URL', 'http://localhost/music-web/scripts/paypal-cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://localhost/music-web/scripts/paypal-ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 
// Database configuration 
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'melomaniac'); 
define('DB_USERNAME', 'testuser'); 
define('DB_PASSWORD', 'testuser');
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");