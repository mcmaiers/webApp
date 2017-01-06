<?php
$FritzBox['Host']      	= FRITZ_BOX_HOST;
$FritzBox['Passwort']   = FRITZ_BOX_PASSWORD;
$FritzBox['webcm']      ='/cgi-bin/webcm';

$sid=FritzLogin(); //Bei der Fritzbox anmelden und die Sessionid holen

function FritzLogin(){
   global $FritzBox;
   $fritzpage      ='http://'.$FritzBox['Host'].'/login_sid.lua';
   $xml          = new SimpleXMLElement(file_get_contents($fritzpage));
   $challange       = $xml->Challenge; //Wert von Challenge abrufen
   $response       = file_get_contents($fritzpage.'?username=&response='.$challange . '-' . md5( iconv('ISO8859-1', 'UTF-16LE', $challange . '-' . $FritzBox['Passwort']) )); //Login
   $xml          = new SimpleXMLElement($response);
   $sid          = $xml->SID; //SID abrufen die f¸r alle weiteren Aktionen gebraucht wird
   unset($xml);
   return $sid;
}

$csv = file_get_contents('http://' . $FritzBox['Host'] .'/fon_num/foncalls_list.lua?sid='.$sid.'&csv='); //Anrufliste abrufen
$csv=explode("\n",$csv);

unset($csv[0]);
unset($csv[1]);
$data = array_values($csv);

?>
	
	<head>
	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').DataTable(
				  "searching": false,
					"paging": false
				);
			} );
		</script>
	</head>
	<body>
		<div class="container">

<table id="example" cellspacing="0" width="100%">
<thead>
	<tr>
		<th>Datum</th>
		<th>Rufnummer</th>
	</tr>
</thead>

<tbody>

<?php

array_splice($data, 20);

foreach($data as $row) {

	$callerData = explode(';', $row);
	
	$type = getCallerData($callerData,0);
	
	if($type == 4) {
	echo "
	<tr>
		<td>".getCallerData($callerData,1)."</td>
		<td>".getCallerData($callerData,3)." / ".getCallerData($callerData,2)."</td>
	</tr>";
	}
	
	
}

?>
</tbody>
</table>
<script type="text/javascript">
	// For demo to fit into DataTables site builder...
	$('#example')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');
	
		
</script>
	</body>
<?php

function getCallerData($callerData,$i) {
	if(isset($callerData[$i])) { 
		return $callerData[$i];
	} else { 
		return '';
	}
}

?>