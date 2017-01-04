<?php
$string = file_get_contents("config.json");
$checkSum = md5($string);

if(!isset($_SESSION['JSON_CONFIG']) || $_SESSION['JSON_CONFIG_CHECKSUM'] != $checkSum) {
    $configArray = json_decode(utf8_encode($string), true);
    $_SESSION['JSON_CONFIG'] = $configArray;
    $_SESSION['JSON_CONFIG_CHECKSUM'] = md5($string);;
}

define ('DB_SERVER' ,getConfig('config.provider.database.server'));
define ('DB_NAME'   ,getConfig('config.provider.database.name'));
define ('DB_USER'   ,getConfig('config.provider.database.username'));
define ('DB_PASSWD' ,getConfig('config.provider.database.password'));
@MYSQL_CONNECT(DB_SERVER,DB_USER,DB_PASSWD);
@MYSQL_SELECT_DB(DB_NAME);

$homeeId = getConfig('config.provider.homee.id');
$webhookKey = getConfig('config.provider.homee.webhookKey');

/**
 * @param $path
 * @return string
 */
function getConfig($path){

    $paths = explode(".", $path);
    $items = $_SESSION['JSON_CONFIG'];
    foreach($paths as $ndx){
        if(isset($items[$ndx])) {
            $items = $items[$ndx];
        } else {
            return '';
        }
    }
    return $items;
}

function getNavigation() {
    return getConfig('floors');
}


function getWebHook($device,$state) {

	$homeeId = getConfig('config.provider.homee.id');
	$webhookKey = getConfig('config.provider.homee.webhookKey');


    if($device['type'] == '1') {
        if($state == 'on') {
            $event = $device['homeeWebHookEvents']['on'];
        } else {
            $event = $device['homeeWebHookEvents']['off'];
        }
        return 'https://'.$homeeId.'.hom.ee/api/v2/webhook_trigger?webhooks_key='.$webhookKey.'&event='.$event;
    }
}
