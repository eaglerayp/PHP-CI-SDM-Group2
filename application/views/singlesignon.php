<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
require_once('simplesamlphp/lib/_autoload.php');
$auth = new SimpleSAML_Auth_Simple('default-sp');
$auth->requireAuth();

$attrs = $auth->getAttributes();


ob_start();
$url = site_url("user/logining/".$attrs['userid'][0]);
echo "<script type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>"; 


?>


