<?php

function nf($a){
	return ($a == null ? 0 : $a);
}
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
    curl_setopt($conn[$i], CURLOPT_TIMEOUT, 1000);
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
?>