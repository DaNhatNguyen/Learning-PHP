<?php 
	session_start();
	require("connect.php");
	$username = $_POST["txtUsername"];
	$password = md5($_POST["txtPassword"]);
	$sql ="select * from `User` where u_name='".$username."' and u_pass='".$password."' and lv_id=3 and u_status=1";
	$result = $conn->query($sql) or die($conn->error);
	
	if ($result->num_rows>0){
        // pass: 1234
		$_SESSION["loginuser"] = true;
		$_SESSION["login_error"] = "";
	} else {
		$_SESSION["loginuser"] = false;
		$_SESSION["login_error"] = "Incorrect username or password";
	}
	if ($_SESSION["loginuser"] == true){
		header("Location:home.php");
	} else {
		header("Location:login_user.php");
	}
	
?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		
	</body>
</html>