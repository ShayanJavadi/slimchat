// TODO: change this spaghetti to cleaner code

//scroll chatbox all the way down on page load
window.onload = function() {
  updateScroll();

}

//make the chat box go all the way down
function updateScroll(){
    //scroll to the bottom
    var element = document.getElementById("overflowBox");
    element.scrollTop = element.scrollHeight - element.clientHeight;
}



//send chat to log
function send() {
  //create XMLHttpRequest object
  var hr = new XMLHttpRequest();
  var author = document.getElementById('author').value;
  var chatroom = document.getElementById('roomName').innerHTML;
  var url = "sendToLog.php";
  //create some variables we need to send to our php file
  var chat = document.getElementById('chatinput').value;
  //multiple variables would be seperated by &s "name="+name+"&otherthing="+otherthing
  var vars = "chat="+chat+"&chatroom="+chatroom+"&author="+author;
  document.getElementById("chatinput").value = "";
  // POST, thephpfile, async
  hr.open("POST", url, true);
  //tell it that we're passing it url encoded vars
  hr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
  //empty the chatinput
  hr.send(vars);
  //update chat from log
  updatechat();
  //scroll down to the bottom
  setTimeout( updateScroll, 100);
}

//make the enter button send the chat
function handle(e){
        if(e.keyCode === 13){
            send();
        }
    }

//update the chat log
function updatechat() {
  //get the old chatbody height
  var oldHeight = checkDivHeight('chatBody');
  var hr = new XMLHttpRequest();
  var chatroom = document.getElementById('roomName').innerHTML;
  var url = "parseTheJson.php"
  var vars = "chatroom="+chatroom;
  // var chat = document.getElementById('chat').value;
  // var vars = "chat="+chat;
  hr.open("POST", url, true);
  hr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
  hr.onreadystatechange = function() {
    if (hr.readyState == 4 && hr.status == 200) {
      var return_data = hr.responseText;
      document.getElementById("chat").innerHTML = return_data;
      //get the new chatbody height
      var newHeight = checkDivHeight('chatBody');

      //if it's gotten bigger (aka user has gotten a message)
      //scroll down
      if (oldHeight < newHeight) {
        updateScroll();
      }
    }
  }

  hr.send(vars);

}
//keep updating the chat
(function keepUpdatingChat(){
  updatechat();
  setTimeout(keepUpdatingChat, 100);
})();

function checkDivHeight(id){
  var chatBody = document.getElementById(id);
  return chatBody.offsetHeight;
}
