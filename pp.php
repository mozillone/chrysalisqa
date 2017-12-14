<?php
require "./app/Helpers/Paypal/Auth/OAuthTokenCredential";
$sdkConfig = array(
  "mode" => "sandbox"
);

$cred = new OAuthTokenCredential("AQkquBDf1zctJOWGKWUEtKXm6qVhueUEMvXO_-MCI4DQQ4-LWvkDLIN2fGsd","EL1tVxAjhT7cJimnz5-Nsx9k2reTKSVfErNQF-CmrwJgxRtylkGTKlU4RvrX", $sdkConfig);
echo "<pre>"; print_r($cred); exit;

?>
