<?php
function getButtonTemplate($buttonIdentifier) {

    $template = '';
    $result = mysql_query("SELECT * FROM buttons WHERE identifier = '".$buttonIdentifier."'");
    if($row = mysql_fetch_array($result))
    {
        switch ($row['type']) {
            case "1":
                $buttonText = 'Ausführen';
                if(!empty($row['buttonText'])) {
                    $buttonText = $row['buttonText'];
                }
                $template = '
            <div class="col-xs-12">
                <a target="toggler" href="'.homeeWebHook($row['webhook1']).'"><button type="button" style="width:100%;" class="btn btn-success btn-lg ">'.$buttonText.'</button></a>
            </div>';
                break;
            case "2":
                $template = '

			<div class="col-xs-4">
				<a target="toggler" href="'.homeeWebHook($row['webhook1']).'"><button type="button" style="width:100%;" class="btn btn-success btn-lg glyphicon glyphicon-chevron-up"></button></a>
			</div>
			<div class="col-xs-4">
				<a target="toggler" href="'.homeeWebHook($row['webhook2']).'"><button type="button" style="width:100%;" class="btn btn-default btn-lg glyphicon glyphicon-pause"></button></a>
			</div>
			<div class="col-xs-4">
				<a target="toggler" href="'.homeeWebHook($row['webhook3']).'"><button type="button" style="width:100%;" class="btn btn-success btn-lg glyphicon glyphicon-chevron-down"></button></a>
			</div>
            ';
                break;
            case "3":
                $template = '
            <div class="col-xs-6">
                <a target="toggler" href="'.homeeWebHook($row['webhook1']).'"><button type="button" style="width:100%;" class="btn btn-success btn-lg ">An</button></a>
            </div>
            <div class="col-xs-6">
                <a target="toggler" href="'.homeeWebHook($row['webhook2']).'"><button type="button" style="width:100%;" class="btn btn-default btn-lg ">Aus</button></a>
            </div>
            ';
                break;
            case "4":
                $template = '
            <div class="col-xs-6">
                <a target="toggler" href="'.pimaticWebHook($row['identifier'],'turnOn').'"><button type="button" style="width:100%;" class="btn btn-success btn-lg ">An</button></a>
            </div>
            <div class="col-xs-6">
                <a target="toggler" href="'.pimaticWebHook($row['identifier'],'turnOff').'"><button type="button" style="width:100%;" class="btn btn-default btn-lg ">Aus</button></a>
            </div>
            ';
                break;
            case "5":
                $template = '
                <a target="toggler" href="'.homeeWebHook($row['webhook1']).'">
                    <img width="100%" class="img-responsive" src="'.$row['link'].'">
                </a>';
                break;
        }
    }


    return $template;
}


function homeeWebHook($event) {
    return 'https://'.HOMEE_ID.'.hom.ee/api/v2/webhook_trigger?webhooks_key='.HOMEE_KEY.'&event='.$event;
}

function pimaticWebHook($identifier,$state) {
    return 'http://'.PIMATIC_USER.':'.PIMATIC_PASSWORD.'@'.HOST.'/api/device/'.$identifier.'/'.$state.'';
}

function getNavi() {
    if(isset($_SESSION['username'])) {
        $template = '
    <li><a href="index.php">Dashboard</a></li>
    ';
        $result = mysql_query("SELECT * FROM floors  ORDER BY sortId ASC");
        while($row = mysql_fetch_array($result)) {
            $template .= '<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$row['name'].'<span class="caret"></span></a>
        ';
            $resultRooms = mysql_query("SELECT * FROM rooms WHERE floorId = ".$row['id']." ORDER BY sortId ASC");
            if(!$resultRooms == false) {
                $template .= '<ul class="dropdown-menu">';
                while($rowRooms = mysql_fetch_array($resultRooms)) {
                    $template .= '<li><a href="index.php?module=buttons&roomid='.$rowRooms['id'].'">'.$rowRooms['name'].'</a></li><li class="divider"></li>';
                }
                $template .= '</ul>';
            }
            $template .= '</li>';
        }

        if(!empty(FRITZ_BOX_PASSWORD)) {
            $template .= '<li><a href="index.php?module=calls">Anrufe</a></li>';
        }
        $template .= '<li><a href="index.php?module=admin">Adminstration</a></li>';
        return $template;
    }
}

?>