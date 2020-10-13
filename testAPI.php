<?php
//https://1xbet.com/LiveFeed/Get1x2_VZip?champs=7067&count=1000
function getMultiRequest($urls)
{
  $mh = curl_multi_init();
  $conn = [];
  $result = [];

  for ($i=0;$i<count($urls); $i++) {
    $conn[$i] = curl_init($urls[$i]);
    curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($conn[$i], CURLOPT_USERAGENT, 'Your application name');
    curl_setopt($conn[$i], CURLOPT_TIMEOUT, 2000);
    curl_multi_add_handle($mh, $conn[$i]);
  }
  do {
    $status = curl_multi_exec($mh, $active);
  } while ($status === CURLM_CALL_MULTI_PERFORM || $active);
  for ($i=0;$i<count($urls); $i++) {
    $result[$i] = curl_multi_getcontent($conn[$i]);
    curl_multi_remove_handle($mh, $conn[$i]); // удаляем поток из мультикурла
    curl_close($conn[$i]); // закрываем отдельное соединение (поток)
  }
  return $result;
}
  if ($_GET['q']=='old')
  {
  $url = "https://1xbet.com/LiveFeed/GetChampsZip?sport=1&country=1";
  $json_data = file_get_contents($url);
  //file_put_contents("1xbet", $json_data);
  $obj = json_decode($json_data);
  class fMatch{
  	public $time,$league,$match,$score,$attack,$dangerousattack,
  	$possession,$on_target,$off_target,$penalty,$corner,$yellow_card,$red_card;
  };
  class league{
  	public $lId,$lName;
  }
$i=0;
  while($i<count($obj->Value))
  {
 	$queue[$i][0]=$obj->Value[$i]->LI;
 	$queue[$i][1]=$obj->Value[$i]->LE;
 	// echo $queue[$i][0] . " " . $queue[$i][1];
 	$i++; 	
  }
$allMatches=0;
  for($j=0;$j<$i;$j++){
  	// echo $queue[$j][1] . "<br>";
  	if ($queue[$j][1] =='' || !(stristr($queue[$j][1],'Alternative Matches')===FALSE))continue;
  	$url = "https://1xbet.com/LiveFeed/Get1x2_VZip?champs=". $queue[$j][0]."&count=2000&lng=en";
  	$json_data = file_get_contents($url);
  	$obj = json_decode($json_data);
  	for($k=0;$k<count($obj->Value); $k++){
  		if (!(stristr($obj->Value[$k]->O1E, "/") === FALSE)) continue;
  		$urlM = "https://1xbet.com/LiveFeed/GetGameZip?id=" . $obj->Value[$k]->I;
  		$json_data = file_get_contents($urlM);
  		$objM = json_decode($json_data);
  		$tablematches[$allMatches][0]=$obj->Value[$k]->SC->TS;
  		$tablematches[$allMatches][1]=$queue[$j][1];
  		$tablematches[$allMatches][2]=$obj->Value[$k]->O1E;
  		$tablematches[$allMatches][3]=$obj->Value[$k]->O2E;
  		$tablematches[$allMatches][4]=$obj->Value[$k]->SC->FS->S1;
  		$tablematches[$allMatches][5]=$obj->Value[$k]->SC->FS->S2;
    $tablematches[$allMatches][22]=$obj->Value[$k]->I;
		 for ($l=0;$l<count($objM->Value->SC->S);$l++){
			 if ($objM->Value->SC->S[$l]->Key=='Attacks1')$tablematches[$allMatches][6]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key=='Attacks2')$tablematches[$allMatches][7]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key=='DanAttacks1')$tablematches[$allMatches][8]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'DanAttacks2')$tablematches[$allMatches][9]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOn1')$tablematches[$allMatches][10]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOn2')$tablematches[$allMatches][11]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOff1')$tablematches[$allMatches][12]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOff2')$tablematches[$allMatches][13]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IPenalty1')$tablematches[$allMatches][14]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IPenalty2')$tablematches[$allMatches][15]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ICorner1')$tablematches[$allMatches][16]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ICorner2')$tablematches[$allMatches][17]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IYellowCard1')$tablematches[$allMatches][18]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IYellowCard2')$tablematches[$allMatches][19]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IRedCard1')$tablematches[$allMatches][20]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IRedCard2') $tablematches[$allMatches][21]=$objM->Value->SC->S[$l]->Value;
		 }
		 $allMatches++;
 	}

 }
 	$all = $allMatches;
 	for($allMatches=0;$allMatches<$all; $allMatches++){
	echo '<tr>';
	echo '<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>'; 
	echo '<td><b>'. (intval($tablematches[$allMatches][0]/60)+intval($tablematches[$allMatches][0]%60>0?1:0)) . '\'' . '</b></td>'; //TIMER
	echo '<td>';
	if (!(stristr($tablematches[$allMatches][1],'.') === FALSE))echo '<img src="images/16/' . substr($tablematches[$allMatches][1],0,strpos($tablematches[$allMatches][1],'.')) . '-flag.png"> ';
	echo '<b>'.$tablematches[$allMatches][1] .'</td>';//LEAGUE
	echo '<td><b>1. ' . $tablematches[$allMatches][2] . '<br>2. ' . $tablematches[$allMatches][3] . '</b></td>'; //Teams
	echo '<td><b>' . ($tablematches[$allMatches][4]==''? 0 : $tablematches[$allMatches][4]) . '<br>' . ($tablematches[$allMatches][5]==''? 0 : $tablematches[$allMatches][5]) . '</b></td>';//Scores
	echo '<td><b>' . $tablematches[$allMatches][6] . '<br>' . $tablematches[$allMatches][7] . '</b></td>';//Attacks
	echo '<td><b>' . $tablematches[$allMatches][8] . '<br>' . $tablematches[$allMatches][9] . '</b></td>';//DanAttacks
	echo '<td><b>' . $tablematches[$allMatches][10] . '<br>' . $tablematches[$allMatches][11] . '</b></td>';//ShotsOn
	echo '<td><b>' . $tablematches[$allMatches][12] . '<br>' . $tablematches[$allMatches][13] . '</b></td>';//ShotsOff
	echo '<td><b>' . $tablematches[$allMatches][14] . '<br>' . $tablematches[$allMatches][15] . '</b></td>';//Penalty
	echo '<td><b>' . $tablematches[$allMatches][16] . '<br>' . $tablematches[$allMatches][17] . '</b></td>';//Corner
	echo '<td><b>' . $tablematches[$allMatches][18] . '<br>' . $tablematches[$allMatches][19] . '</b></td>';//YellowCard
	echo '<td><b>' . $tablematches[$allMatches][20] . '<br>' . $tablematches[$allMatches][21] . '</b></td>';//RedCard
 echo '<td><a href="getGraphCoefs?id=' . $tablematches[$allMatches][22] . '" target="_blank"><span class="material-icons">
timeline
</span></a></td>'; 
	echo '<td><b>';
	if (intval(max(intval($tablematches[$allMatches][8]),intval($tablematches[$allMatches][9]))/max(1,intval($tablematches[$allMatches][8])+intval($tablematches[$allMatches][9]))*100)>=75)
	echo '<span class="badge badge-danger">' . intval(max(intval($tablematches[$allMatches][8]),intval($tablematches[$allMatches][9]))/max(1,intval($tablematches[$allMatches][8])+intval($tablematches[$allMatches][9]))*100) . '</span>';
	else echo intval(max(intval($tablematches[$allMatches][8]),intval($tablematches[$allMatches][9]))/max(1,intval($tablematches[$allMatches][8])+intval($tablematches[$allMatches][9]))*100);


	echo '</b></td>';//Momentum
	
	echo '</tr>';


	// echo "<br>";
}
}
else if ($_GET['q'] == 'all'){
	$url = "https://1xbet.com/LiveFeed/Get1x2_VZip?sports=1&count=500&mode=4&country=2";
  $json_data = file_get_contents($url);
  //file_put_contents("1xbet", $json_data);
  $obj = json_decode($json_data);

$allMatches=0;
$url = array();
$size=count($obj->Value);
  for($j=0;$j<$size;$j++){

  		$tablematches[$allMatches][0]=$obj->Value[$j]->SC->TS;
  		$tablematches[$allMatches][1]=$obj->Value[$j]->LE;
  		$tablematches[$allMatches][2]=$obj->Value[$j]->O1E;
  		$tablematches[$allMatches][3]=$obj->Value[$j]->O2E;
  		$tablematches[$allMatches][4]=$obj->Value[$j]->SC->FS->S1;
  		$tablematches[$allMatches][5]=$obj->Value[$j]->SC->FS->S2;
    $tablematches[$allMatches][22]=$obj->Value[$j]->I;
  		$urls[$allMatches]='https://1xbet.com/LiveFeed/GetGameZip?id='.$obj->Value[$j]->I;
		 $allMatches++;
 }
 $result = getMultiRequest($urls);
 for ($iter =0; $iter<$allMatches; $iter++){
 	
 	$objM = json_decode($result[$iter]);
  if (is_array($objM->Value->SC->S)){
 	$counter = count($objM->Value->SC->S);
 	 for ($l=0;$l<$counter;$l++){
			 if ($objM->Value->SC->S[$l]->Key=='Attacks1')$tablematches[$iter][6]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key=='Attacks2')$tablematches[$iter][7]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key=='DanAttacks1')$tablematches[$iter][8]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'DanAttacks2')$tablematches[$iter][9]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOn1')$tablematches[$iter][10]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOn2')$tablematches[$iter][11]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOff1')$tablematches[$iter][12]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOff2')$tablematches[$iter][13]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IPenalty1')$tablematches[$iter][14]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IPenalty2')$tablematches[$iter][15]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ICorner1')$tablematches[$iter][16]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ICorner2')$tablematches[$iter][17]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IYellowCard1')$tablematches[$iter][18]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IYellowCard2')$tablematches[$iter][19]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IRedCard1')$tablematches[$iter][20]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IRedCard2') $tablematches[$iter][21]=$objM->Value->SC->S[$l]->Value;
		 }
  }
 }
 	$all = $allMatches;
 	for($allMatches=0;$allMatches<$all; $allMatches++){
	echo '<tr>';
	echo '<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>'; 
	echo '<td><b>'. (intval($tablematches[$allMatches][0]/60)+intval($tablematches[$allMatches][0]%60>0?1:0)) . '\'' . '</b></td>'; //TIMER
	echo '<td>';
	if (!(stristr($tablematches[$allMatches][1],'.') === FALSE))echo '<img src="images/16/' . substr($tablematches[$allMatches][1],0,strpos($tablematches[$allMatches][1],'.')) . '-flag.png"> ';
	echo '<b>'.$tablematches[$allMatches][1] .'</td>';//LEAGUE
	echo '<td><b>1. ' . $tablematches[$allMatches][2] . '<br>2. ' . $tablematches[$allMatches][3] . '</b></td>'; //Teams
	echo '<td><b>' . ($tablematches[$allMatches][4]==''? 0 : $tablematches[$allMatches][4]) . '<br>' . ($tablematches[$allMatches][5]==''? 0 : $tablematches[$allMatches][5]) . '</b></td>';//Scores
	echo '<td><b>' . $tablematches[$allMatches][6] . '<br>' . $tablematches[$allMatches][7] . '</b></td>';//Attacks
	echo '<td><b>' . $tablematches[$allMatches][8] . '<br>' . $tablematches[$allMatches][9] . '</b></td>';//DanAttacks
	echo '<td><b>' . $tablematches[$allMatches][10] . '<br>' . $tablematches[$allMatches][11] . '</b></td>';//ShotsOn
	echo '<td><b>' . $tablematches[$allMatches][12] . '<br>' . $tablematches[$allMatches][13] . '</b></td>';//ShotsOff
	echo '<td><b>' . $tablematches[$allMatches][14] . '<br>' . $tablematches[$allMatches][15] . '</b></td>';//Penalty
	echo '<td><b>' . $tablematches[$allMatches][16] . '<br>' . $tablematches[$allMatches][17] . '</b></td>';//Corner
	echo '<td><b>' . $tablematches[$allMatches][18] . '<br>' . $tablematches[$allMatches][19] . '</b></td>';//YellowCard
	echo '<td><b>' . $tablematches[$allMatches][20] . '<br>' . $tablematches[$allMatches][21] . '</b></td>';//RedCard
	echo '<td><b>';
	if (intval(max(intval($tablematches[$allMatches][8]),intval($tablematches[$allMatches][9]))/max(1,intval($tablematches[$allMatches][8])+intval($tablematches[$allMatches][9]))*100)>=75)
	echo '<span class="badge badge-danger">' . intval(max(intval($tablematches[$allMatches][8]),intval($tablematches[$allMatches][9]))/max(1,intval($tablematches[$allMatches][8])+intval($tablematches[$allMatches][9]))*100) . '</span>';
	else echo intval(max(intval($tablematches[$allMatches][8]),intval($tablematches[$allMatches][9]))/max(1,intval($tablematches[$allMatches][8])+intval($tablematches[$allMatches][9]))*100);


	echo '</b></td>';//Momentum
	 echo '<td><a href="getGraphCoefs.php?id=' . $tablematches[$allMatches][22] . '" target="_blank"><span class="material-icons">
timeline
</span></a></td>'; 
	echo '</tr>';


	// echo "<br>";
}
}else if ($_GET['q']=='getapi'){
	$url = "https://1xbet.com/LiveFeed/Get1x2_VZip?sports=1&count=500&mode=4&country=1";
    $json_data = file_get_contents($url);
   $obj = json_decode($json_data);

$allMatches=0;
$k=0;
$url = array();
$size=count($obj->Value);
  for($j=0;$j<$size;$j++){
  	if (strpos($obj->Value[$j]->LE, "Alternative Matches") !== false) continue;
 	if (strpos($obj->Value[$j]->O1E , '/') !== false) continue;
  		$tablematches[$allMatches]['Time']=$obj->Value[$j]->SC->TS;
  		$tablematches[$allMatches]['LeagueName']=$obj->Value[$j]->LE;
  		$tablematches[$allMatches]['FName']=$obj->Value[$j]->O1E;
  		$tablematches[$allMatches]['SName']=$obj->Value[$j]->O2E;
  		$tablematches[$allMatches]['Score1']=$obj->Value[$j]->SC->FS->S1 == null ? 0 : $obj->Value[$j]->SC->FS->S1;
  		$tablematches[$allMatches]['Score2']=$obj->Value[$j]->SC->FS->S2 == null ? 0 : $obj->Value[$j]->SC->FS->S2;
    	$tablematches[$allMatches]['MatchId']=$obj->Value[$j]->I;
    	for($k=0;$k<count($obj->Value[$j]->E);$k++){
    		if ($obj->Value[$j]->E[$k]->T == '1')
    			$tablematches[$allMatches]['C1'] = $obj->Value[$j]->E[$k]->C;
    		else if ($obj->Value[$j]->E[$k]->T == '2')
    			$tablematches[$allMatches]['C2'] = $obj->Value[$j]->E[$k]->C;
    		else if ($obj->Value[$j]->E[$k]->T == '3')
    			$tablematches[$allMatches]['C3'] = $obj->Value[$j]->E[$k]->C;
    	}	
  		$urls[$allMatches]='https://1xbet.com/LiveFeed/GetGameZip?id='.$obj->Value[$j]->I.'&lng=en';
		 // $k = floor($allMatches/50);
		 $allMatches++;
		
 }
 $result = array();
 for ($j=0;$j<=floor($allMatches/50); $j++){
 	$temp = array();
 	for($k=0;$k<min(50, $allMatches - $j*50); $k++){
 		 array_push($temp, $urls[$j*50 + $k]);
 	}
 	$tempU = getMultiRequest($temp);
 	for($k=0;$k<min(50, $allMatches - $j*50); $k++){
 		 $result[$j*50 + $k] = $tempU[$k];
 	}
 }
 // $result = getMultiRequest($urls);
 for ($iter =0; $iter<$allMatches; $iter++){
 	// var_dump($result[$iter]);
 	// break;

 	$objM = json_decode($result[$iter]);
 	// var_dump($result);
 	// echo $tablematches[$iter]['LeagueName'] == "Alternative Matches";
 	$tablematches[$iter]['C'] = $objM->Value->CN;
 	// var_dump($objM->Value->SC->S);
 	// echo count($objM->Value->SC->S);
  if (is_array($objM->Value->SC->S)){
 	$counter = count($objM->Value->SC->S);
 	 for ($l=0;$l<$counter;$l++){
			 if ($objM->Value->SC->S[$l]->Key=='Attacks1')$tablematches[$iter]['Attacks1']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key=='Attacks2')$tablematches[$iter]['Attacks2']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key=='DanAttacks1')$tablematches[$iter]['DanAttacks1']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'DanAttacks2')$tablematches[$iter]['DanAttacks2']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOn1')$tablematches[$iter]['ShotsOn1']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOn2')$tablematches[$iter]['ShotsOn2']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOff1')$tablematches[$iter]['ShotsOff1']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ShotsOff2')$tablematches[$iter]['ShotsOff2']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IPenalty1')$tablematches[$iter]['Penalty1']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IPenalty2')$tablematches[$iter]['Penalty2']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ICorner1')$tablematches[$iter]['Corner1']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'ICorner2')$tablematches[$iter]['Corner2']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IYellowCard1')$tablematches[$iter]['YellowCard1']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IYellowCard2')$tablematches[$iter]['YellowCard2']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IRedCard1')$tablematches[$iter]['RedCard1']=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'IRedCard2') $tablematches[$iter]['RedCard2']=$objM->Value->SC->S[$l]->Value;
		 }

  }
 }
 echo json_encode($tablematches);
}
  ?>