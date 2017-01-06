<?php
$roomid = $_GET['roomid'];
$result = mysqlquery("SELECT * FROM buttons WHERE roomId = ".$roomid." ORDER BY sortId ASC");
while($row = mysqlfetch($result))
{

   echo '
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b>'.utf8_encode($row['name']).'</b></div>
            <div class="panel-body">
            '.getButtonTemplate($row['identifier']).'
            </div>
        </div>
    </div>
    ';

}