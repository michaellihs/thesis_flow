<?php
if (FLOW3_PATH_ROOT !== '/var/www/kunden/thesis/' || !file_exists('/var/www/kunden/thesis/Data/Temporary/Production/Configuration/ProductionConfigurations.php')) {
	unlink(__FILE__);
	return array();
}
return require '/var/www/kunden/thesis/Data/Temporary/Production/Configuration/ProductionConfigurations.php';
?>