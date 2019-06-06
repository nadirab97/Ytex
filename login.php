<?php include('server.php') ?>
<!DOCTYPE html>

<html>
<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="t7.css">
</head>
<body class="bg">
  <main>
      
    <button class="b1 button2" onclick="window.location.href='home.php'"><span>לדף הבית</span></button><br><br><br><br> 
    <center class="header2">
	<div class="container row header3" id="color">
     <div class="container-fluid w3-container w3-teal ">
  	  <p style="font-size:30px;">התחברות</p>
  	  <center>
  	   <div>
		<a  href="home.php">  <img class="go img-responsive" src="img\ytex.jpg"></a>
	   </div>
	  </center>
  	  <p>ברוכים הבאים<br>!פשוט תהנה מההנחות</p><br>
     
     <form  action="login.php" method="post">
    	<?php include('errors.php'); ?>
    	<div class="input-group">
  	     <label>שם משתמש</label><br>
  	     <input class="form-control" type="text" name="username" placeholder="הזן שם משתמש" size="35" style="padding: 8px 15px; direction: rtl;" required>
     	</div>
    <br>
      	<div class="input-group">
      	  <label>סיסמא</label><br>
      	  <input class="form-control" type="password" name="password" placeholder="הזן סיסמא"  size="35" style="padding: 8px 15px; direction: rtl;" required>
      	</div>
  	<br>
     <center>
         <div class="input-group">
      	  <button type="submit" class="b1" id="b2" name="login_user"><span>התחבר</span></button>
      	 </div>
      	 <br>
     </center>
      	<p>לא רשום? <a href="register.php">להרשמה</a></p>
      </form>
     </div>
	 </div>
     </center>   
  </main>
</body>
<script src="JS/script.js"></script>
</html>
