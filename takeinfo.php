<?php
require 'rb.php';
R::setup('mysql:host=localhost;dbname=matches','root', 'root', false);
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

$url = "https://1xbet.com/LiveFeed/Get1x2_VZip?sports=1&count=500&mode=4&country=1";
  $json_data = file_get_contents($url);
  $obj = json_decode($json_data);
$allMatches=0;
$url = array();
$size=count($obj->Value);
  for($j=0;$j<$size;$j++){
  		$tablematches[$allMatches][0]=$obj->Value[$j]->SC->TS;
  		$tablematches[$allMatches][1]=$obj->Value[$j]->I;
  		$tablematches[$allMatches][2]=$obj->Value[$j]->O1E;
  		$tablematches[$allMatches][3]=$obj->Value[$j]->O2E;
  		$tablematches[$allMatches][4]=$obj->Value[$j]->SC->FS->S1;
  		$tablematches[$allMatches][5]=$obj->Value[$j]->SC->FS->S2;
  		$urls[$allMatches]='https://1xbet.com/LiveFeed/GetGameZip?id='.$obj->Value[$j]->I;
		 $allMatches++;
 }
 $result = getMultiRequest($urls);
 for ($iter =0; $iter<$allMatches; $iter++){
 	// var_dump($result[$iter]);
 	// break;
 	$objM = json_decode($result[$iter]);
 	$counter = count($objM->Value->SC->S);
 	 for ($l=0;$l<$counter;$l++){

			 if ($objM->Value->SC->S[$l]->Key=='DanAttacks1')$tablematches[$iter][8]=$objM->Value->SC->S[$l]->Value;
			 else if ($objM->Value->SC->S[$l]->Key == 'DanAttacks2')$tablematches[$iter][9]=$objM->Value->SC->S[$l]->Value;
		 }
		 $match = R::dispense('stats');
		 $match->matchId = $tablematches[$iter][1];
		 $match->dang1 = $tablematches[$iter][8];
		 $match->dang2 = $tablematches[$iter][9];
		 $match->score1 = $tablematches[$iter][4];
		 $match->score2  = $tablematches[$iter][5];
		 $match->time = $tablematches[$iter][0];
		 R::store($match);
 	}

?>