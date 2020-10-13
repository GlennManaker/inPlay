<?php $date = date_create();
//echo date_format($date, 'U = Y-m-d H:i:s') . "\n";

//date_timestamp_set($date, 1171502725);
//https://1xbet.com/LiveFeed/GetHistoryGraph?GameId=247953985
	$url = "https://1xbet.com/LiveFeed/GetHistoryGraph?GameId=" . $_GET['id'];
  $json_data = file_get_contents($url);
  //file_put_contents("1xbet", $json_data);
  $obj = json_decode($json_data);
  //var_dump($obj->Value[0]->C);
  $size=0;
  $size1=0;
  $size2=0;
  for ($i=0;$i<count($obj->Value[0]->S); $i++)
    {
        $fTeam[0][$i]=$obj->Value[0]->C[$i];
        $fTeam[1][$i]=$obj->Value[0]->S[$i];
        $newStr="";
        for ($j=0;$j<strlen($fTeam[1][$i]);$j++){
            if($fTeam[1][$i][$j]>='0'&&$fTeam[1][$i][$j]<='9')
            $newStr = $newStr . $fTeam[1][$i][$j];
        }
        $fTeam[1][$i] = $newStr;
        //echo $newStr;
        $size++;
    }
      for ($i=0;$i<count($obj->Value[1]->S); $i++)
    {
        $dTeam[0][$i]=$obj->Value[1]->C[$i];
        $dTeam[1][$i]=$obj->Value[1]->S[$i];
        $newStr="";
        for ($j=0;$j<strlen($dTeam[1][$i]);$j++){
            if($dTeam[1][$i][$j]>='0'&&$dTeam[1][$i][$j]<='9')
            $newStr = $newStr . $dTeam[1][$i][$j];
        }
        $dTeam[1][$i] = $newStr;
        //echo $newStr;
        $size1++;
    }
      for ($i=0;$i<count($obj->Value[2]->S); $i++)
    {
        $sTeam[0][$i]=$obj->Value[2]->C[$i];
        $sTeam[1][$i]=$obj->Value[2]->S[$i];
        $newStr="";
        for ($j=0;$j<strlen($sTeam[1][$i]);$j++){
            if($sTeam[1][$i][$j]>='0'&&$sTeam[1][$i][$j]<='9')
            $newStr = $newStr . $sTeam[1][$i][$j];
        }
        $sTeam[1][$i] = $newStr;
        //echo $newStr;
        $size2++;
    }
    
?>
<!doctype html>
<html>

<head>
    <title>Line Chart</title>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
</head>

<body>
    <canvas id="canvas"></canvas>
<script>
    var timeFormat = 'HH:mm';

    var config = {
        type:    'line',
        data:    {
            datasets: [
                {
                    label: "Home Team",
                    data: [


                    <?php 
                    

                    for ($i=0;$i<$size;$i++){
                    	date_timestamp_set($date,intval($fTeam[1][$i])/1000);
                    //date_format($date, 'Y-m-d H:i:s');
                    echo '{ x: new Date(' . "'" .  date_format($date, 'Y-m-d H:i') . "'),";
                    echo 'y: ' . $fTeam[0][$i];
                    echo '},';
                }
                    ?>
                    ],
                    fill: false,
                    borderColor: 'red'
                },
                {
                    label: "Away",
                    data:  [
                     <?php 
                    

                    for ($i=0;$i<$size2;$i++){
                    	date_timestamp_set($date,intval($sTeam[1][$i])/1000);
                    //date_format($date, 'Y-m-d H:i:s');
                    echo '{ x: new Date(' . "'" .  date_format($date, 'Y-m-d H:i:s') . "'),";
                    echo 'y: ' . $sTeam[0][$i];
                    echo '},';
                }
                    ?>
                    ],
                    fill:  false,
                    borderColor: 'blue'
                },
                  {
                    label: "Draw",
                    data:  [
                     <?php 
                    

                    for ($i=0;$i<$size1;$i++){
                    	date_timestamp_set($date,intval($dTeam[1][$i])/1000);
                    //date_format($date, 'Y-m-d H:i:s');
                    echo '{ x: new Date(' . "'" .  date_format($date, 'Y-m-d H:i:s') . "'),";
                    echo 'y: ' . $dTeam[0][$i];
                    echo '},';
                }
                    ?>
                    ],
                    fill:  false,
                    borderColor: 'black'
                }
            ]
        },
        options: {
            responsive: true,
            title:      {
                display: true,
                text:    "Graph of coef's"
            },
            scales:     {
                xAxes: [{
                    type:       "time",
                    
     				distribution: 'series',
                    scaleLabel: {
                        display:     true,
                        labelString: 'Date'
                    }




                }],
                yAxes: [{
                    scaleLabel: {
                        display:     true,
                        labelString: 'value'
                    },
             
                }]
            }
        }
    };

    window.onload = function () {
        var ctx       = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx, config);
    };

</script>

</body>

</html>