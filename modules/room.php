<div class="row">
	<?php
	$devices = getConfig('devices');
	$roomId = $_GET['id'];

	foreach($devices as $deviceName => $deviceData	) {
		if($deviceData['active'] == '1' && $deviceData['room'] == $roomId ) {

			if($deviceData['category'] == 'switch') {
				echo '
					<div class="col-xs-4">
						'.$deviceData['name'].'
					</div>
					<div class="col-xs-4">
						<a target="toggler" href="'.getWebHook($deviceData,'on').'"><button type="button" style="width:100%;" class="btn btn-success">An</button></a>
					</div>
					<div class="col-xs-4">
						<a target="toggler" href="'.getWebHook($deviceData,'off').'"><button type="button" style="width:100%;" class="btn btn-default">Aus</button></a>
					</div>
					<br/><br/>
					<hr class="deviceDelimiter">
					<br/>
				';
			}

			if($deviceData['category'] == 'button') {
				echo '
					<div class="col-xs-4">
						'.$deviceData['name'].'
					</div>
					<div class="col-xs-4">
					</div>
					<div class="col-xs-4">
						<a target="toggler" href="'.getWebHook($deviceData,'on').'"><button type="button" style="width:100%;" class="btn btn-success">'.$deviceData['buttonName'].'</button></a>
					</div>
					<br/><br/>
					<hr class="deviceDelimiter">
					<br/>
				';
			}

			if($deviceData['category'] == 'shutter') {
				echo '
					<div class="col-xs-4">
						'.$deviceData['name'].'
					</div>
					<div class="col-xs-4">
						<a target="toggler" href="https://'.$homeeId.'.hom.ee/api/v2/webhook_trigger?webhooks_key='.$webhookKey.'&event='.$deviceData['homeeWebHookEvents']['up'].'"><button type="button" style="width:100%;" class="btn btn-success glyphicon glyphicon-chevron-up"></button></a>
						<a target="toggler" href="https://'.$homeeId.'.hom.ee/api/v2/webhook_trigger?webhooks_key='.$webhookKey.'&event='.$deviceData['homeeWebHookEvents']['down'].'"><button type="button" style="width:100%;" class="btn btn-success glyphicon glyphicon-chevron-down"></button></a>
					</div>
					<div class="col-xs-4">
						<a target="toggler" href="https://'.$homeeId.'.hom.ee/api/v2/webhook_trigger?webhooks_key='.$webhookKey.'&event='.$deviceData['homeeWebHookEvents']['stop'].'"><button type="button" style="width:100%; height:70px;" class="btn btn-default glyphicon glyphicon-pause"></button></a>
					</div>
					<br/><br/>
					<hr class="deviceDelimiter">
					<br/>
				';
			}

			if($deviceData['category'] == 'ipcam') {
				echo '
					<div class="col-xs-12">
						'.$deviceData['name'].'
						<img width="100%" class="img-thumbnail" src="'.$deviceData['link'].'">
					</div>
					<br/><br/>
					<hr class="deviceDelimiter">
					<br/>
				';
			}
		}
	}
	?>
</div>