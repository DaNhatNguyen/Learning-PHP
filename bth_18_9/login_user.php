<?php 
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form name=f action="login_user_action.php" method=POST>
			<h1 align=center>Login</h1>
			<table border = 0 align=center width=500>
				<tr>
					<td colspan=2 align=center>
						<font color=red><?php echo $_SESSION["login_error"];?></font>
					</td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input type=text name=txtUsername></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type=password name=txtPassword></td>
				</tr>
				<tr>
					<td align=right><input type=submit name=cmdGuiDi value="Login"></td>
					<td><input type=reset value="Reset">
						<input type=hidden name=cmdKey value="3323535335325">
					</td>
					
				</tr>
			</table>
		</form>
	</body>
</html>