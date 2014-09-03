<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body style="background-color: #00010b;">
	<!--Reg Background-->
	<div id="reg-bg">
		<!--Reg Area-->
		<div id="reg-area" class="jumbotron2">
			<label style="font-size:60px; position:relative; LEFT: 220px;">New User Registration</label>
			<form style="font-size:20px; position:relative; LEFT: 330px;" action="Create_User.php" method="get" name="Login" id="Login"><!--This is the new_user.php goes -->
				<label>First Name:</label>
				<input style="position:relative; LEFT: 58px;" type="text" name="fname" /></br>
				<label>Last Name:</label>
				<input style="position:relative; LEFT: 58px;" type="text" name="lname" /></br>
				<label>E-mail:</label>
				<input style="position:relative; LEFT: 89px;" type="text" name="email"  />	</br>		
				<label>Reenter E-mail:</label>
				<input style="position:relative; LEFT: 22px;" type="text" name="emailRE" /></br>
				<label>Password:</label>
				<input style="position:relative; LEFT: 68px;" type="password" name="password" /></br>			
				<label>Reenter Password:</label>
				<input style="position:relative; LEFT: 0px;" type="password" name="passRE" /></br>			
				<input type="radio" name="permission"value="2">I would like to be a Reviewer.<br>				
				<input style="position:relative; LEFT: 120px; WIDTH: 80px; HEIGHT: 40px;" type="image" src="images/sign-up-btn.gif"
				       class="login-btn" alt="Login" title="Login" />
			</form>
		</div>
	</div>
</body>
