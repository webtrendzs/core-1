<?php

OC_JSON::checkAdminUser();
OCP\JSON::callCheck();

try {
	OC_App::enable(OC_App::cleanAppId($_POST['appid']));
	OC_JSON::success();
} catch (Exception $e) {
	if ($e instanceof MissingDependencyException) {
		$l = OC_L10N::get('settings');
		OC_JSON::error(array( "data" => array("message" => $l->t("App can not be installed, because it depends on %s", $e->getMessage())) ));
	} else {
		OC_JSON::error(array("data" => array("message" => $e->getMessage()) ));
	}
}
