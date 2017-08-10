<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />

<?php require_once("/external_includes/mysql_pw.php");?>

<!-- Latest compiled and minified CSS -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.navbar {
	margin-bottom: 0;
}

.navbar-inverse {
	background-color: #222222
}

.navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>li>a:hover,
	.navbar-inverse .navbar-nav>li>a:focus {
	background-color: #045FB4
}

.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.open>a,
	.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover,
	.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover,
	.navbar-inverse .navbar-nav>.open>a:focus {
	background-color: #222222
}

.dropdown-menu {
	background-color: #222222
}

.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
	background-color: #045FB4
}

.navbar-inverse {
	background-image: none;
}

.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
	background-image: none;
}

.navbar-inverse {
	border-color: #080808
}

.navbar-inverse .navbar-brand {
	color: #999999
}

.navbar-inverse .navbar-brand:hover {
	color: #FFFFFF
}

.navbar-inverse .navbar-nav>li>a {
	color: #999999
}

.navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:focus
	{
	color: #FFFFFF
}

.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.open>a,
	.navbar-inverse .navbar-nav>.open>a:hover, .navbar-inverse .navbar-nav>.open>a:focus
	{
	color: #FFFFFF
}

.navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>.active>a:focus
	{
	color: #FFFFFF
}

.dropdown-menu>li>a {
	color: #FFFFFF
}

.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
	color: #FFFFFF
}

.navbar-inverse .navbar-nav>.dropdown>a .caret {
	border-top-color: #999999
}

.navbar-inverse .navbar-nav>.dropdown>a:hover .caret {
	border-top-color: #FFFFFF
}

.navbar-inverse .navbar-nav>.dropdown>a .caret {
	border-bottom-color: #999999
}

.navbar-inverse .navbar-nav>.dropdown>a:hover .caret {
	border-bottom-color: #FFFFFF
}

.jumbotron {
	background-color: #045FB4;
	color: #fff;
	padding: 50px 25px;
	font-family: Montserrat, sans-serif;
}

th {
	font-family: Arial;
	font-size: 20px;
}
</style>

<title>memory1</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="main.html">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Train <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="train1.html">Training Method 1</a></li>
            <li><a href="train2.html">Training Method 2</a></li>
            <li><a href="train3.html">Training Method 3</a></li>
            <li><a href="mnemonic.html">Setup Mnemonic</a></li>
            <li><a href="trainHistory.html">Train History</a></li>
          </ul>
        </li>
        <li><a href="test.html">Test</a></li>
        <li class="active"><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="account.html">Account</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.html" onclick="signOut();">Sign out</a></li>
      </ul>
    </div>
  </div>
</nav>



	<div class="jumbotron text-center">
		<h1>Score Board</h1>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col" style="text-align: center" class="rank">Rank</th>
				<th scope="col" style="text-align: center" class="user_name">UserName</th>
				<th scope="col" style="text-align: center" class="user_score">Score</th>
				<th scope="col" style="text-align: center" class="user_time">Date</th>
			</tr>
		</thead>
		<tbody>
				<?php
				// connection //
    			$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
				$sql = 'SELECT u.Alias as Alias, m.Score as Score, Date(m.TimeStamp) as TimeStamp FROM 
							(SELECT t.UserId, t.Score, t.TimeStamp  
		    				FROM   Scores t
		    				LEFT JOIN Scores better_row
		         			ON better_row.UserId = t.UserId
		          				AND (better_row.Score > t.Score
		               			OR (better_row.Score = t.Score AND better_row.TimeStamp < t.TimeStamp)
		               		)
	    				WHERE better_row.UserId IS NULL AND t.UserId <> "null") as m
						INNER JOIN Users as u
						ON u.UserId = m.UserId
						ORDER BY Score DESC, TimeStamp ASC LIMIT 25';

				$result = $conn->query ( $sql );
				
				// display //
				$count = 0;
				while ( $row = $result->fetch_assoc () ) {
					$username = htmlspecialchars($row['Alias']);
					$score = $row ['Score'];
					$time = $row ['TimeStamp'];
					$count ++;
					?>
				<tr>
				<td class="rank" style="text-align: center"><?php echo $count ?></td>
				<td class="username" style="text-align: center"><?php echo $username ?></td>
				<td class="score" style="text-align: center"><?php echo $score?></td>
				<td class="time" style="text-align: center"><?php echo $time ?></td>
			</tr>
					<?php
				}
				?>

			</tbody>
	</table>
	</article>
</body>
</html>
