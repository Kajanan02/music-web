<?php 

// PayPal configuration 
define('PAYPAL_ID', 'sb-webvw26953009@business.example.com'); 
define('PAYPAL_SANDBOX', TRUE);
 
define('PAYPAL_RETURN_URL', 'http://www.example.com/success.php'); 
define('PAYPAL_CANCEL_URL', 'http://www.example.com/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://www.example.com/ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 
// Database configuration 
/*define('DB_HOST', 'DB_HOST'); 
define('DB_NAME', 'DB_NAME'); 
define('DB_USERNAME', 'DB_USERNAME'); 
define('DB_PASSWORD', 'DB_PASSWORD'); */
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");