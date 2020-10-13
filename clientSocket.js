 const socket = io('ws://localhost:3000');

 socket.on('connect', () => {
  console.log('Connected to server');
 });

 socket.on('LiveStats', data => {
  // console.log(data);
  // console.log('received');
  var le = document.querySelector(`[data-row-id="${data.I}"`);
  if (le !==undefined)
    le.innerHTML = ctTdM(data).innerHTML;
});




var tTd=(x,y)=>{
  return '<b>'+x+'<br>'+y+'</b>';
}
var nf = (x) =>{
  if (x === null || x===undefined ) return 0;
  else return x;
}
var ctTdM = (json_row) =>{
  let tt = document.createElement("tr");
  let td0 = document.createElement("td");
  td0.innerHTML='<span class="custom-checkbox"><input type="checkbox" id="checkbox1" name="options[]" value="1"><label for="checkbox1"></label></span>';
  tt.appendChild(td0);
  let td1=document.createElement("td");
  td1.innerHTML = '<b>' + Math.floor(json_row.T/60)+"'</b>";
  tt.appendChild(td1);
  let td3=document.createElement("td");
  td3.innerHTML = '<img src="images/16/' + json_row.CN + '-flag.png"><b> '+json_row.L+'</b>';
  tt.appendChild(td3);
  let td2 = document.createElement("td");
  td2.innerHTML='<b>1.'+json_row.O1+'<br>2.'+json_row.O2+'</b>';
  tt.appendChild(td2);
  let td4 = document.createElement("td");
  td4.innerHTML = tTd(json_row.S1,json_row.S2);
  tt.appendChild(td4);
  let td6=document.createElement("td");
  td6.innerHTML=tTd(nf(json_row.Attacks1),nf(json_row.Attacks2));
  tt.appendChild(td6);
  let td5=document.createElement("td");
  td5.innerHTML = tTd(nf(json_row.DanAttacks1),nf(json_row.DanAttacks2));
  tt.appendChild(td5);
  let td7=document.createElement("td");
  td7.innerHTML=tTd(nf(json_row.ShotsOn1),nf(json_row.ShotsOn2));
  tt.appendChild(td7);
  let td8=document.createElement("td");
  td8.innerHTML=tTd(nf(json_row.ShotsOff1),nf(json_row.ShotsOff2));
  tt.appendChild(td8);
  let td9=document.createElement("td");
  td9.innerHTML=tTd(nf(json_row.IPenalty1),nf(json_row.IPenalty2));
  tt.appendChild(td9);
  let td10=document.createElement("td");
  td10.innerHTML=tTd(nf(json_row.ICorner1),nf(json_row.ICorner2));
  tt.appendChild(td10);
  let td11=document.createElement("td");
  td11.innerHTML=tTd(nf(json_row.IYellowCard1),nf(json_row.IYellowCard2));
  tt.appendChild(td11);
  let td12=document.createElement("td");
  td12.innerHTML=tTd(nf(json_row.IRedCard1),nf(json_row.IRedCard2));
  tt.appendChild(td12);
  let td13=document.createElement("td");
  td13.innerHTML='<b>'+parseInt(100*Math.max(nf(json_row.DanAttacks1), nf(json_row.DanAttacks2))/Math.max(parseInt(nf(json_row.DanAttacks1)) + parseInt(nf(json_row.DanAttacks2)),1)) +'</b>';
  tt.appendChild(td13);
  let td14=document.createElement("td");
  td14.innerHTML= '<a href="getGraphCoefs.php?id=' + json_row.I + '" target="_blank"><span class="material-icons">timeline</span></a>';
  tt.appendChild(td14); 
  return tt;
}
var connectMatch = (json_row)=>{
  let tt=document.createElement("tr");
  tt.setAttribute("data-row-id", json_row.MatchId);
  let td0 = document.createElement("td");
  td0.innerHTML='<span class="custom-checkbox"><input type="checkbox" id="checkbox1" name="options[]" value="1"><label for="checkbox1"></label></span>';
  tt.appendChild(td0);
  let td1=document.createElement("td");
  td1.innerHTML = '<b>' + Math.floor(json_row.Time/60)+"'</b>";
  tt.appendChild(td1);
  let td3=document.createElement("td");
  td3.innerHTML = '<img src="images/16/' + json_row.C + '-flag.png"><b> '+json_row.LeagueName+'</b>';
  tt.appendChild(td3);
  let td2 = document.createElement("td");
  td2.innerHTML='<b>1.'+json_row.FName+'<br>2.'+json_row.SName+'</b>';
  tt.appendChild(td2);
  let td4 = document.createElement("td");
  td4.innerHTML = tTd(json_row.Score1,json_row.Score2);
  tt.appendChild(td4);
  let td6=document.createElement("td");
  td6.innerHTML=tTd(nf(json_row.Attacks1),nf(json_row.Attacks2));
  tt.appendChild(td6);
  let td5=document.createElement("td");
  td5.innerHTML = tTd(nf(json_row.DanAttacks1),nf(json_row.DanAttacks2));
  tt.appendChild(td5);
  let td7=document.createElement("td");
  td7.innerHTML=tTd(nf(json_row.ShotsOn1),nf(json_row.ShotsOn2));
  tt.appendChild(td7);
  let td8=document.createElement("td");
  td8.innerHTML=tTd(nf(json_row.ShotsOff1),nf(json_row.ShotsOff2));
  tt.appendChild(td8);
  let td9=document.createElement("td");
  td9.innerHTML=tTd(nf(json_row.Penalty1),nf(json_row.Penalty2));
  tt.appendChild(td9);
  let td10=document.createElement("td");
  td10.innerHTML=tTd(nf(json_row.Corner1),nf(json_row.Corner2));
  tt.appendChild(td10);
  let td11=document.createElement("td");
  td11.innerHTML=tTd(nf(json_row.YellowCard1),nf(json_row.YellowCard2));
  tt.appendChild(td11);
  let td12=document.createElement("td");
  td12.innerHTML=tTd(nf(json_row.RedCard1),nf(json_row.RedCard2));
  tt.appendChild(td12);
  let td13=document.createElement("td");
  td13.innerHTML='<b>'+parseInt(100*Math.max(nf(json_row.DanAttacks1), nf(json_row.DanAttacks2))/Math.max(parseInt(nf(json_row.DanAttacks1)) + parseInt(nf(json_row.DanAttacks2)),1)) +'</b>';
  tt.appendChild(td13);
  let td14=document.createElement("td");
  td14.innerHTML= '<a href="getGraphCoefs.php?id=' + json_row.MatchId + '" target="_blank"><span class="material-icons">timeline</span></a>';
  tt.appendChild(td14); 
  document.querySelector('#tStats').appendChild(tt);
}