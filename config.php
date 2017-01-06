<?php
define ('DB_SERVER','localhost');
define ('DB_NAME','homee');
define ('DB_USER','root');
define ('DB_PASSWD','');
@MYSQL_CONNECT(DB_SERVER,DB_USER,DB_PASSWD);
@MYSQL_SELECT_DB(DB_NAME);

define ('APP_NAME','homee webLayer');

define ('HOST','xxx.xxx.xxx.xxx');

define ('HOMEE_HOST','http://xxx.xxx.xxx.xxx:7681');
define ('HOMEE_ADMIN','xxxxxx');
define ('HOMEE_PASSWORD','xxxxxx');
define ('HOMEE_ID','000xxxxxx');
define ('HOMEE_KEY','xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

define ('FRITZ_BOX_HOST','fritz.box');
define ('FRITZ_BOX_PASSWORD','xxxxxx');

define ('PIMATIC_USER','xxxxxx');
define ('PIMATIC_PASSWORD','xxxxxx');
?>