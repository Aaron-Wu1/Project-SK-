$(document).ready(function(){
  var ServerText = [""];
  var ServerLogMsg = [""];
  var ServerLogUser = [""];
  var CurrentUserText = [""];
  var CurrentUser = [""];
  var CurrentUserOnline = [""];
  $("#chatInput").hide();
  $("#SignOut").hide();
  $("#Send").hide();
  $("#text").hide();
  $("#enter").click(() =>{
    $("#heading").hide();
    $("#welcome").hide();
    $("#enter").hide();
    $("#chatInput").show();
    $("#SignOut").show();
    $("#Send").show();
    $("#text").show();
    $OnChat = true;
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "EnterServer.php", true);
    xmlhttp.send();


  });
  $("#Send").click(function(){
   console.log("sent");
   var msg = $('#chatInput').val();
   $("#chatInput").val(""); 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "sendChat.php?msg=" + msg, true);
   xmlhttp.send();

 }); 


  $(document).keydown(function(e){
   if(e.keyCode == 13 ){  
    console.log("sent");
    var msg = $('#chatInput').val();
    $("#chatInput").val("");  
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "sendChat.php?msg=" + msg, true);
    xmlhttp.send();


  }
});



  $("#SignOut").click(() =>{
   console.log("signed out");

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "sessionQuit.php", true);
  xmlhttp.send();
     var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "LeaveServer.php", true);
  xmlhttp.send();
  window.location.href = 'index.php';

});


  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      DisplayMsg = JSON.parse(this.responseText);
      ServerLogMsg = DisplayMsg.getServerLogMsg;
      ServerLogUser = DisplayMsg.getServerLogUser;
      ServerText = DisplayMsg.getServerLog;
      //console.log(ServerLogMsg);
      ServerLogUser.forEach(function (item, index){ 
       $('#text > tbody:first-child').prepend('<tr><td>'+ ServerLogUser[index].username +': </td><td>'+ ServerLogMsg[index].msg +'</td> </tr>');
     });
    }
  };
  xmlhttp.open("GET", "getChat.php", true);
  xmlhttp.send();


  $OnChat = false;
  var chatUpdate = setInterval(chatUpdate, 50);

  function chatUpdate(){
   if($OnChat == true){
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        DisplayMsg = JSON.parse(this.responseText);
        msg = DisplayMsg.getMessage;
        username = DisplayMsg.getUsername;
        id = DisplayMsg.getID;
       // console.log(id);
    		//console.log(DisplayMsg.getStop);

      //  console.log(ServerText);
      if(DisplayMsg.getStop == "false"){

//console.log(ServerText);
   //   console.log(ServerText[3]);
  //  console.log("ST Length: " + ServerText.length);
  if (ServerText.length != id){
           //console.log("index[" + index + "]: " + item + "<br>");
           $('#text > tbody:first-child').prepend('<tr><td>'+ username +': </td><td>'+ msg +'</td> </tr>');
            console.log("test")
           ServerText.push(id);


         }
         

    		//console.log(msg);
    		
    		//document.getElementById('text').innerHTML = document.getElementById('text').innerHTML + msg;
     }
   }

 };
 xmlhttp.open("GET", "getChat.php", true);
 xmlhttp.send();

	//console.log("test");
}
}



/*//var onlineUpdate = setInterval(onlineUpdate, 1000);

function onlineUpdate(){
  if($OnChat == true){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        Users = JSON.parse(this.responseText);
        CurrentUser = Users.currentUsers;
        CurrentUserOnline = Users.online;
        CurrentUser.forEach(function (item, index){ 
          console.log(CurrentUserText);
          var shouldPush = false;

          if(CurrentUserOnline[index].online == "true"){

function isOnline(online) {
  //console.log(online);
 return online == item.username;
}
            if(!CurrentUserText.some(isOnline)){
             $('#OnlineList > tbody:first-child').prepend('<tr><td>'+ CurrentUser[index].username +': </td><td>Online</td> </tr>');
             CurrentUserText.push(item.username);
           }
         }
       });


      }

    };
    xmlhttp.open("GET", "getOnline.php", true);
    xmlhttp.send();

  //console.log("test");
}
//console.log(CurrentUserText);
}

*/
});