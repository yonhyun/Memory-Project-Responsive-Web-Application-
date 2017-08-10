<?php
require_once("/external_includes/mysql_pw.php");

$t = $_REQUEST["type"];

if($t == "addUser" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["username"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $userName = $_REQUEST["username"];
    $firstLast = "";

    if (strpos($userName," ") !== false){
    	$firstLast = substr($userName, 0,strpos($userName," ")+2);
    }else{
    	$firstLast = $userName;
    }

    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    // Check connection
    if (!$conn) {
        exitWithError("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"INSERT INTO Users (UserId,UserName,Alias) VALUES (?,?,?) ON DUPLICATE KEY UPDATE UserName = ?" )){
        mysqli_stmt_bind_param($sql,"ssss",$userId,$userName,$firstLast,$userName);
        if(mysqli_execute($sql)){
            echo json_encode(array('message' => "success"));
        }
        mysqli_stmt_close($sql);
    }
    
    mysqli_close($conn);

}


if($t == "addScore" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["score"]) && isSet($_REQUEST["timeremaining"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $score = (float)$_REQUEST["score"];
    $timeRemaining = (float)$_REQUEST["timeremaining"];
    $sessionToken = $_REQUEST["sessiontoken"];

    $scoreCalc = (int)(  (100*$score) + ($score*$timeRemaining) );

	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        exitWithError("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"INSERT INTO Scores (UserId, Score) VALUES (?,?)" )){
        mysqli_stmt_bind_param($sql,"ss",$userId,$scoreCalc);
        if(mysqli_execute($sql)){
            echo json_encode(array('message' => "success"));
        }
        mysqli_stmt_close($sql);
    }
    
    mysqli_close($conn);

}


if($t == "getScore" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        exitWithError("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"SELECT * FROM Scores WHERE UserId=?")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    
    mysqli_close($conn);
}


if($t == "setMap" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["map"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $map = $_REQUEST["map"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        exitWithError("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"INSERT INTO Maps VALUES (?,?) ON DUPLICATE KEY UPDATE Map = ?")){
        mysqli_stmt_bind_param($sql,"sss",$userId,$map,$map);
        if(mysqli_execute($sql)){
            echo json_encode(array('message' => "success"));
        }
        mysqli_stmt_close($sql);
    }
    
    mysqli_close($conn);

}


if($t == "getMap" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        exitWithError("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"SELECT * FROM Maps WHERE UserId=?")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    
    mysqli_close($conn);
}

if($t == "addTrainAttempt" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["map"]) && isSet($_REQUEST["trainmod"]) && isSet($_REQUEST["time"]) && isSet($_REQUEST["sessiontoken"]) ){
    $userId = $_REQUEST["userid"];
    $map = $_REQUEST["map"];
    $trainmod = $_REQUEST["trainmod"];
    $time = $_REQUEST["time"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        exitWithError("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"INSERT INTO UserTraining (UserId, Map, TrainMod, Time) VALUES(?,?,?,?)")){
        mysqli_stmt_bind_param($sql,"sssd",$userId,$map,$trainmod,$time);
        if(mysqli_execute($sql)){
            echo json_encode(array('message' => "success"));
        }
        mysqli_stmt_close($sql);
    }
    
    mysqli_close($conn); 
}

if($t == "getBadge" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        exitWithError("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"SELECT BadgeName FROM UserBadges WHERE UserId=?")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "getTrainHistory" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"SELECT UserId, Map, TrainMod, Time, TimeStamp FROM UserTraining WHERE UserId=? ORDER BY Map, TimeStamp")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "setAlias" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["alias"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $alias = $_REQUEST["alias"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"UPDATE Users SET Alias=? WHERE UserId=?")){
        mysqli_stmt_bind_param($sql,"ss",$alias,$userId);
        if(mysqli_execute($sql)){
            echo json_encode(array('message' => "success"));
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "setMnemonic" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["mnemonic"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $mnemonic = $_REQUEST["mnemonic"];
    $sessionToken = $_REQUEST["sessiontoken"];
    if (!check($userId,$sessionToken)){
        exitWithError("Invalid token");
    }
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"INSERT INTO Mnemonic VALUES (?,?) ON DUPLICATE KEY UPDATE Mnemonic = ?")){
        mysqli_stmt_bind_param($sql,"sss",$userId,$mnemonic,$mnemonic);
        if(mysqli_execute($sql)){
            echo json_encode(array('message' => "success"));
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "getMnemonic" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
    if (!check($userId,$sessionToken)){
        exitWithError("Invalid token");
    }
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"SELECT * FROM Mnemonic WHERE UserId=?")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "getAlias" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"SELECT * FROM Users WHERE UserId=?")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
        	$result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "setSessionToken" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) && isSet($_REQUEST["idtoken"]) ){

    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
    $idToken = $_REQUEST["idtoken"];
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    //validate idToken

    $url = "https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=" . $idToken;

    $response = file_get_contents($url);

    if(!$response){
    	exitWithError("Invalid token");
    }

    $jr = json_decode($response);



    $audience = $jr->aud;
    $issuer = $jr->iss;
    $expiration = $jr->exp;

    $audienceb = ($audience == "833283724043-60mn1u2ekeacj2fmpupmtvpq6rd37eab.apps.googleusercontent.com");
    $issuerb = ($issuer == "accounts.google.com" || $issuer == "https://accounts.google.com" );
    $expirationb = (time() < $expiration);

    if (!$audienceb || !$issuerb || !$expirationb){
    	exitWithError("Invalid token");
    }
    else{
	    // Check connection
	    if (!$conn) {
	        exitWithError("Connection failed: " . mysqli_connect_error());
	    }

	    $sql = mysqli_stmt_init($conn);
	    if (mysqli_stmt_prepare($sql,"INSERT INTO SessionTokens VALUES (?,?) ON DUPLICATE KEY UPDATE SessionToken = ?" )){
	        mysqli_stmt_bind_param($sql,"sss",$userId,$sessionToken,$sessionToken);
	        if(mysqli_execute($sql)){
	            echo json_encode(array('message' => "success"));
	        }
	        mysqli_stmt_close($sql);
	    }
	    
	    mysqli_close($conn);
	}

}

function check($userId,$sessionToken){
	$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	if (!$conn) {
	    return false;
	}

	$sql = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($sql,"SELECT SessionToken FROM SessionTokens WHERE UserId = ?" )){
	    mysqli_stmt_bind_param($sql,"s",$userId);
	    if(mysqli_execute($sql)){
	        $result = mysqli_stmt_get_result($sql);
	        $row = mysqli_fetch_array($result);
	        $count = $row[0];
	        if ($count != (string) $sessionToken){
	        	return false;
	        }else{
	        	return true;
	        }
	    }else{
	    	return false;
	    }
	    mysqli_stmt_close($sql);
	}else{
	    return false;
	}

	mysqli_close($conn);
	return false;
}

function exitWithError($error){
	 die(json_encode(array('error' => $error)));
}

if($t == "trainMod1Badge" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"insert into UserBadges (UserId, BadgeName) select IDCnt.UserId, \"Train1.png\" from (select UserId, count(UserId) as cnt from UserTraining Where UserId=? and TrainMod = \"1\") as IDCnt left join UserBadges UB on IDCnt.UserId = UB.UserID AND BadgeName = \"Train1.png\" WHERE UB.UserId is null AND IDCnt.cnt >= 5")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "trainMod2Badge" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"insert into UserBadges (UserId, BadgeName) select IDCnt.UserId, \"Train2.png\" from (select UserId, Time from UserTraining Where UserId=? and TrainMod = \"2\" Order By Time DESC limit 1) as IDCnt left join UserBadges UB on IDCnt.UserId = UB.UserID AND BadgeName = \"Train2.png\" WHERE UB.UserId is null AND (IDCnt.Time + 0) >= 20")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "trainMod3Badge" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"insert into UserBadges (UserId, BadgeName) select IDCnt.UserId, \"Train3.png\" from (select UserId, Time from UserTraining Where UserId=? and TrainMod = \"3\") as IDCnt left join UserBadges UB on IDCnt.UserId = UB.UserID AND BadgeName = \"Train3.png\" WHERE UB.UserId is null AND (IDCnt.Time + 0) >= 20 limit 1")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "googleBadge" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"insert into UserBadges (UserId, BadgeName) select IDCnt.UserId, \"Google.png\" from (select UserId from Users Where UserId=?) as IDCnt left join UserBadges UB on IDCnt.UserId = UB.UserID AND BadgeName = \"Google.png\" WHERE UB.UserId is null")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "scoreBoardBadge" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($sql,"insert into UserBadges (UserId, BadgeName) select IDCnt.UserId, \"LeaderBoard.png\" from (select UserId from Scores Order By Score desc limit 1) as IDCnt left join UserBadges UB on IDCnt.UserId = UB.UserID AND BadgeName = \"LeaderBoard.png\" WHERE UB.UserId is null AND IDCnt.UserId =?")){
        mysqli_stmt_bind_param($sql,"s",$userId);
        if(mysqli_execute($sql)){
            $result = mysqli_stmt_get_result($sql);
            while($row = mysqli_fetch_array($result)){
                $myArray[] = $row;
            }
            echo json_encode($myArray);
        }
        mysqli_stmt_close($sql);
    }
    mysqli_close($conn);
}

if($t == "allRightOrWrongBadge" && isSet($_REQUEST["userid"]) && isSet($_REQUEST["numcor"]) && isSet($_REQUEST["sessiontoken"]) ){
    // Create connection
    $userId = $_REQUEST["userid"];
    $numCor = $_REQUEST["numcor"];
    $sessionToken = $_REQUEST["sessiontoken"];
	if (!check($userId,$sessionToken)){
		exitWithError("Invalid token");
	}
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if($numCor == 26){
        $sql = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($sql,"insert into UserBadges (UserId, BadgeName) select IDCnt.UserId, \"AllCorrect.png\" from (select UserId from Users) as IDCnt left join UserBadges UB on IDCnt.UserId = UB.UserID AND BadgeName = \"AllCorrect.png\" WHERE UB.UserId is null AND IDCnt.UserId=?")){
            mysqli_stmt_bind_param($sql,"s",$userId);
            if(mysqli_execute($sql)){
                $result = mysqli_stmt_get_result($sql);
                while($row = mysqli_fetch_array($result)){
                    $myArray[] = $row;
                }
                echo json_encode($myArray);
            }
            mysqli_stmt_close($sql);
        }
    }
    if($numCor == 0){
       $sql = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($sql,"insert into UserBadges (UserId, BadgeName) select IDCnt.UserId, \"AllWrong.png\" from (select UserId from Users) as IDCnt left join UserBadges UB on IDCnt.UserId = UB.UserID AND BadgeName = \"AllWrong.png\" WHERE UB.UserId is null AND IDCnt.UserId=?")){
            mysqli_stmt_bind_param($sql,"s",$userId);
            if(mysqli_execute($sql)){
                $result = mysqli_stmt_get_result($sql);
                while($row = mysqli_fetch_array($result)){
                    $myArray[] = $row;
                }
                echo json_encode($myArray);
            }
            mysqli_stmt_close($sql);
        } 
    }
    mysqli_close($conn);
}


?>