<?php

use Wafl\AppSupport\WebIndex;

require_once(__DIR__ . "/../../Application.php");
$application = WebIndex::BootstrapApplication(__DIR__ . "/../../Application.syrp", "test", "\\Wafl\\Application\\Application");
?>