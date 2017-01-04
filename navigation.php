<?php
$navigationArray = getNavigation();
$template = '';
foreach($navigationArray as $floor => $floorData) {

    $template .=
    '<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$floor.'<span class="caret"></span></a>
        <ul class="dropdown-menu">
        ';

        if(isset($floorData['rooms']) && count($floorData['rooms']) > 0) {
            foreach($floorData['rooms'] as $roomId => $roomName) {
                $template .= '<li><a href="index.php?module=room&id='.$roomId.'">'.$roomName.'</a></li><li class="divider"></li>';
            }
        }
        $template .= '
        </ul>
    </li>
        ';
}
echo $template;
?>