function addEmailToDBSuccess(email,name,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=addUser&userid="+email + "&username="+name+"&sessiontoken="+sessiontoken, true);
  xhttp.send();
}

//-------------------------------------------------------

function addScoreToDBSuccess(email,score,timeremaining,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=addScore&userid="+email + "&score="+score + "&timeremaining="+timeremaining + "&sessiontoken="+sessiontoken, true);
  xhttp.send();
}

//-------------------------------------------------------

function getScoreFromDBSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=getScore&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function setMapInDBSuccess(email,map,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=setMap&userid="+email+ "&map=" + map.join()+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function getMapFromDBSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=getMap&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function addTrainAttemptToDBSuccess(email,map,trainmod,time,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=addTrainAttempt&userid="+email+"&map="+map+"&trainmod="+trainmod+"&time="+time+"&sessiontoken="+sessiontoken);
  xhttp.send();

}
//-------------------------------------------------------

function addTrainAttemptToDBSuccessSync(email,map,trainmod,time,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=addTrainAttempt&userid="+email+"&map="+map+"&trainmod="+trainmod+"&time="+time+"&sessiontoken="+sessiontoken,false);
  xhttp.send();
}


//-------------------------------------------------------

function getBadgeFromDBSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=getBadge&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();

}

//-------------------------------------------------------

function addSessionTokenToDBSuccess(email,sessiontoken,idtoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=setSessionToken&userid="+email+"&sessiontoken="+sessiontoken+"&idtoken="+idtoken);
  xhttp.send();
}


//-------------------------------------------------------

function getTrainHistorySuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
      
  };
  xhttp.open("GET", "dbAccess.php?type=getTrainHistory&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function addAliasSuccess(email,alias,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=setAlias&userid="+email+"&alias="+alias+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function getAliasSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=getAlias&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function addTrainMod1BadgeToDBSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=trainMod1Badge&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function addTrainMod2BadgeToDBSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=trainMod2Badge&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function addTrainMod3BadgeToDBSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=trainMod3Badge&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function addGoogleBadgeToDBSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=googleBadge&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function addLeaderBoardBadgeToDBSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=scoreBoardBadge&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function addAllRightOrWrongBadgeToDBSuccess(email,numcor,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=allRightOrWrongBadge&userid="+email+"&numcor="+numcor+"&sessiontoken="+sessiontoken);
  xhttp.send();
}

//-------------------------------------------------------

function setMnemonicSuccess(email,mjson,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=setMnemonic&userid="+email+"&mnemonic="+mjson+"&sessiontoken="+sessiontoken);
  xhttp.send();
}


//-------------------------------------------------------

function getMnemonicSuccess(email,sessiontoken,callback){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      response =  JSON.parse(this.responseText);
      if (response && response.hasOwnProperty("error")){
        signOut(); 
      }else{
        callback.apply(this);
      }
    }
  };
  xhttp.open("GET", "dbAccess.php?type=getMnemonic&userid="+email+"&sessiontoken="+sessiontoken);
  xhttp.send();
}
