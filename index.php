<?php require 'lstart.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>INPLAY Predict</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
</head>
<body>
	
  <!-- Then put toasts within -->

    	<!-- <canvas id="myChart" width="5" height="5"></canvas> -->
    	<?php require 'header.php';
      echo '<div class="container">';
	  require 'alerts.php';
?>
</div>
<div class = "container pt-3">
            <table id="myTable" class="table table-hover table-responsive">
                <thead>
                    <tr>
						            <th width="1%">Pick</th>
                        <th width="2%"><span class="material-icons">
alarm
</span></th>
                        <th width="26%">League</th>
						            <th width="25%">Match</th>
                        <th>Score</th>
                        <th width="2%"><img src = "images/attack.png" width = "25" height = "25" title="Attacks"></th>
                        <th width="2%"><img src = "images/dangerous_attack.png" width = "25" height = "25" title="Dangerous Attacks"></th>
                        <!-- <th><img src = "images/possession.png" width = "35" height = "20"></th> -->
                        <th width="3%"><img src = "images/on_target.png" width = "25" height = "25" title = "Shots on target"></th>
                        <th width="3%"><img src = "images/off_target.png" width = "25" height = "25" title = "Shots off target"></th>
                        <th width="3%"><img src = "images/penalty.png" width = "25" height = "25" title = "Penalty"></th>
                        <th width="3%"><img src = "images/corner.png" width = "25" height = "25" title ="Corners"></th>
                        <th width="3%"><img src ="images/yellow_card.png" width="25" height="25" title = "Yellow cards"></th>
                        <th width="3%"><img src ="images/red_card.png" width="25" height="25" title ="Red cards"></th>
                        <th width="3%"><span class="material-icons">
whatshot
</span></th><th width="3%"><span class="material-icons">
list
</span></th>
                    </tr>
                </thead>
                <tbody id="tStats">
				</tbody>
            </table>
            
				<div id = "tabLoading" class="text-center">
				<div class="text-center">
  <div class="spinner-grow text-primary" style="width: 6rem; height: 6rem;" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
</div>
<script type="text/javascript" src="clientSocket.js"></script>
    <script>
      // const socket = io('ws://localhost:3000');

// socket.on('connect', () => {
//  console.log('Connected to server');
// });

// socket.on('LiveStats', data => {
// });
var tTd=(x,y)=>{
  return '<b>'+x+'<br>'+y+'</b>';
}
var nf = (x) =>{
  if (x === null || x===undefined ) return 0;
  else return x;
}
var connectMatch = (json_row)=>{
  let tt=document.createElement("tr");
  tt.setAttribute("data-row-id", json_row.MatchId);
  let td0 = document.createElement("td");
  td0.setAttribute("data-stats-id","check")
  td0.innerHTML='<span class="custom-checkbox"><input type="checkbox" id="checkbox1" name="options[]" value="1"><label for="checkbox1"></label></span>';
  tt.appendChild(td0);
  let td1=document.createElement("td");
  td1.setAttribute("data-stats-id","time");
  td1.innerHTML = '<b>' + Math.floor(json_row.Time/60)+"'</b>";
  tt.appendChild(td1);
  let td3=document.createElement("td");
  td3.setAttribute("data-stats-id","league");
  td3.innerHTML = '<img src="images/16/' + json_row.C + '-flag.png"><b> '+json_row.LeagueName+'</b>';
  tt.appendChild(td3);
  let td2 = document.createElement("td");
  td2.setAttribute("data-stats-id","names");
  td2.innerHTML='<b>1.'+json_row.FName+'<br>2.'+json_row.SName+'</b>';
  tt.appendChild(td2);
  let td4 = document.createElement("td");
  td4.setAttribute("data-stats-id","score");
  td4.innerHTML = tTd(json_row.Score1,json_row.Score2);
  tt.appendChild(td4);
  let td6=document.createElement("td");
  td6.setAttribute("data-stats-id","attacks");
  td6.innerHTML=tTd(nf(json_row.Attacks1),nf(json_row.Attacks2));
  tt.appendChild(td6);

  let td5=document.createElement("td");
  td5.setAttribute("data-stats-id","danattacks");
  td5.innerHTML = tTd(nf(json_row.DanAttacks1),nf(json_row.DanAttacks2));
  tt.appendChild(td5);
  let td7=document.createElement("td");
  td7.setAttribute("data-stats-id","shotson");
  td7.innerHTML=tTd(nf(json_row.ShotsOn1),nf(json_row.ShotsOn2));
  tt.appendChild(td7);
  let td8=document.createElement("td");
  td8.setAttribute("data-stats-id","shotsoff");
  td8.innerHTML=tTd(nf(json_row.ShotsOff1),nf(json_row.ShotsOff2));
  tt.appendChild(td8);
  let td9=document.createElement("td");
  td9.setAttribute("data-stats-id","penalties");
  td9.innerHTML=tTd(nf(json_row.Penalty1),nf(json_row.Penalty2));
  tt.appendChild(td9);
  let td10=document.createElement("td");
  td10.setAttribute("data-stats-id","corners");
  td10.innerHTML=tTd(nf(json_row.Corner1),nf(json_row.Corner2));
  tt.appendChild(td10);
  let td11=document.createElement("td");
  td11.setAttribute("data-stats-id","yellows");
  td11.innerHTML=tTd(nf(json_row.YellowCard1),nf(json_row.YellowCard2));
  tt.appendChild(td11);
  let td12=document.createElement("td");
  td12.setAttribute("data-stats-id","reds");
  td12.innerHTML=tTd(nf(json_row.RedCard1),nf(json_row.RedCard2));
  tt.appendChild(td12);
  let td13=document.createElement("td");
  td13.setAttribute("data-stats-id","hots");
  td13.innerHTML='<b>'+parseInt(100*Math.max(nf(json_row.DanAttacks1), nf(json_row.DanAttacks2))/Math.max(parseInt(nf(json_row.DanAttacks1)) + parseInt(nf(json_row.DanAttacks2)),1)) +'</b>';
  tt.appendChild(td13);
  let td14=document.createElement("td");
  td14.setAttribute("data-stats-id","extend");
  td14.innerHTML= '<a href="getGraphCoefs.php?id=' + json_row.MatchId + '" target="_blank"><span class="material-icons">timeline</span></a>';
  tt.appendChild(td14); 
  document.querySelector('#tStats').appendChild(tt);
}
    	getInfo();
	function getInfo(){
    	var objXMLHttpRequest = new XMLHttpRequest();
   		 objXMLHttpRequest.onreadystatechange = function() {
  if(objXMLHttpRequest.readyState === 4) {
          //console.log(obj.value);
         // document.getElementById('tStats').innerHTML = objXMLHttpRequest.responseText;
         // alert('hello');
        let json = JSON.parse(objXMLHttpRequest.responseText);
         var div = document.getElementById('tabLoading');
          div.parentNode.removeChild(div);
          
          for (i=0;i<json.length;i++)
              connectMatch(json[i]);
          var mTable = $("#myTable").DataTable({
            "iDisplayLength": -1,
            "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
            "scrollY": "600px",
            "scrollCollapse": true,
            "paging": true
          });
          $("tr[data-row-id]").click(function () {
        console.log(this);
    } );
          // getInfo();
          // document.getElementById('tabletitle').innerHTML+="COUNT"
          // var elem = document.getElementById("myBar");
         // elem.style.width=100%
    }
    }
  	// console.log(obj.id);
  	objXMLHttpRequest.open('GET', 'testAPI.php?q=getapi');
  	objXMLHttpRequest.send();	
	}
</script>
</div>

</body>
</html>                                		                            