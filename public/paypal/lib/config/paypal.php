<?php
/**
 *  If you make this application for live payments then update following variable values:
 *  Change MODE from sandbox to live
 *  Update PayPal Client ID and Secret to match with your live paypal app details
 *  Change Base URL to https://api.paypal.com/v1/
 *  finally make sure that APP URL matcher to your application url
 */
define('MODE', 'sandbox');
define('CURRENCY', 'USD');
define('APP_URL', 'http://localhost/paypal/');
define("PayPal_CLIENT_ID", "AS0tCI0Ipj5f7bE-f9R-4y3JfHbpDpA_JjIN3I6YTonmzJsjjmXFGMDuC7k8c4ar-qBGdpDBz0gAS52Z");
define("PayPal_SECRET", "EHidLA1Rh2jxQMnAWIeIORWhPfEHSiIW2rFdYX5Ur0636LkNTpHIG3gTa1nHhVITZ9DND45BJPF8KlBn");
define("PayPal_BASE_URL", "https://api.sandbox.paypal.com/v1/");
?>