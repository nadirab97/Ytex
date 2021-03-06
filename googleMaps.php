<!DOCTYPE html>
<html lang="en">
<head>
 <title>Location-Ytex</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="css/t6.css">
 <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" href="css/TOindex.css">
 <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
	<header class="header">
        	    <?php 
          session_start(); 
          if (isset($_GET['logout'])) {
          	session_destroy();
          	unset($_SESSION['username']);
          	header("location: home.php");
          }
          require_once('initialize.php');
        
                ?>

	    <!-- Modal --> 
                   <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                         <div class="modal-content">
                            <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                               <h4 align="right" class="modal-title" id="myModalLabel">הסל שלי</h4>
                            </div>
                            <div class="modal-body">
                               	<h3 style="text-align:center;">עגלת הקניות</h3>
                			<div class="table-responsive">
                				<table class="table table-bordered" style="direction: rtl;">
                					<tr>
                						<th style="text-align:right;" width="40%">שם הפריט</th>
                						<th style="text-align:right;" width="10%">כמות</th>
                						<th style="text-align:right;" width="20%">מחיר</th>
                						<th style="text-align:right;" width="15%">סה"כ</th>
                						<th style="text-align:right;" width="5%">להסרה</th>
                					</tr>
                					<?php
                					if(!empty($_SESSION["shopping_cart"]))
                					{
                						$total = 0;
                						foreach($_SESSION["shopping_cart"] as $keys => $values)
                						{
                					?>
                					<tr>
                						<td><?php echo $values["item_name"]; ?></td>
                						<td><?php echo $values["item_quantity"]; ?></td>
                						<td>₪ <?php echo $values["item_price"]; ?></td>
                						<td>₪ <?php echo ($values["item_quantity"] * $values["item_price"]);?></td>
                						<td><a href="categories1.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">הסר מהסל</span></a></td>
                					</tr>
                					<?php
                							$total = $total + ($values["item_quantity"] * $values["item_price"]);
                						}
                					?>
                					<tr>
                						<td colspan="3" align="right">הנחה חבר מעדון</td>
                						<td align="right">% 
                						<?php if (isset($_SESSION['username'])) : ?>
                                        <?php echo number_format("10"); ?> <?php else : ?>
                                        <?php echo number_format("0"); ?> <?php endif ?>
                                        </td>
                						<td></td>
                					</tr>
                					<tr>
                						<td colspan="3" align="right">סה"כ</td>
                						<td align="right">₪ <?php if (isset($_SESSION['username'])) : ?>
                                        <?php $total=($total-0.1*$total);?> <?php else : ?>
                                        <?php $total=($total)?> <?php endif ?>
                						
                						<?php echo ($total); ?></td>
                						<td><a href="categories1.php?action=delete2&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">הסר הכל</span></a></td>

                					</tr>
                					<?php
                					}
                					?>
                						
                				</table>
                			</div>
                            </div>
                            <div class="modal-footer">
                               <button type="button" class="btn btn-default"  style="float:left; background-color:#FF2828;" data-dismiss="modal">סגור</button>
                               <button type="button" onclick="window.location.href='payment.php'" class="btn btn-default"  style="float:left; background-color:#50D050;" data-dismiss="modal">לתשלום</button>
                               
                               
                            </div>
                         </div>
                      </div>
                   </div>
                   
		<div class="container-fluid w3-container w3-teal">
		 <nav class="col-sm-12 navbar-light catgory navbar navbar-fixed-top" id="salim1">
			  <ul class="nav navbar-nav">
			   <li style="font-size:15px; font-weight: bold;"><a href="home.php">בית</a></li>
			   <li style="font-size:13px; border-right: solid 2px #ffeebf; border-left: solid 2px #ffeebf;"><a href="home.php#band">המותג</a></li>
			   <li style="font-size:13px; border-right: solid 2px #ffeebf;"><a href="home.php#footer">צור קשר</a></li>

			   <li class="dropdown">
				 <a class="dropdown-toggle" style="font-size:13px;" data-toggle="dropdown" href="categories1.php">קטגורית מוצרים<span class="caret"></span></a>
				  <ul class="dropdown-menu" style="font-size:13px;">
				      
				    <li><a href="categories1.php">לכל המוצרים </a></li>
				    <li><a href="categories2.php">לכל הקטגוריות </a></li>
				     
				     
				     <?php
				    $category=array();
                    $category=Product::find_all_category();
                     for($j=0; $j<sizeof($category);$j++) {
				        echo '<li><a href="categories.php?page='.$category[$j]->get_category().'">'.$category[$j]->get_category().'</a></li>';
                     }
                     
				    ?>
				    
				  </ul>
				</li>
			  </ul>
			 
                   <button class="shop" data-toggle="modal" data-target="#cartModal"><img class="fbtwin" src="img\cart.png"></button>
                   <button style="family-font:verdana;"id="mycart" data-toggle="modal" data-target="#cartModal" class="shop">הסל שלי</button>
		 </nav>

		<nav class="col-sm-12 navbar-light catgory navbar" id="salim2">
			  <ul class="nav navbar-nav">
			   <li style="font-size:15px; font-weight: bold;"><a href="home.php">בית</a></li>
			   <li style="font-size:13px; border-right: solid 2px #ffeebf; border-left: solid 2px #ffeebf;"><a href="home.php#band">המותג</a></li>
			   <li style="font-size:13px; border-right: solid 2px #ffeebf;"><a href="home.php#footer">צור קשר</a></li>

			   <li class="dropdown">
				 <a class="dropdown-toggle" style="font-size:13px;" data-toggle="dropdown" href="categories1.php">קטגורית מוצרים<span class="caret"></span></a>
				  <ul class="dropdown-menu" style="font-size:13px;">
				      
				    <li><a href="categories1.php">לכל המוצרים </a></li>
				    <li><a href="categories2.php">לכל הקטגוריות </a></li>
				     
				     
				     <?php
				    $category=array();
                    $category=Product::find_all_category();
                     for($j=0; $j<sizeof($category);$j++) {
				        echo '<li><a href="categories.php?page='.$category[$j]->get_category().'">'.$category[$j]->get_category().'</a></li>';
                     }
                     
				    ?>
				    
				  </ul>
				</li>
			  </ul>
			 
                   <button class="shop" data-toggle="modal" data-target="#cartModal"><img class="fbtwin" src="img\cart.png"></button>
                   <button style="family-font:verdana;"id="mycart" data-toggle="modal" data-target="#cartModal" class="shop">הסל שלי</button>
		 </nav>
		 </div>

<div class="container-fluid w3-container w3-teal">
		 <br>
		 <br>
			  <div class="row">
				<button class="b1 button2" onclick="window.location.href='register.php'"><span>להצטרפות</span></button>
				<button class="b1 button2" onclick="window.location.href='login.php'"><span>&nbsp; כניסת לקוח</span></button>
			  </div>
              
              <div class="content" align="right">
              	<!-- notification message -->
              	<?php if (isset($_SESSION['success'])) : ?>
                  <div class="error success" >
                  	<h3>
                      <?php 
                      	echo $_SESSION['success']; 
                      	unset($_SESSION['success']);
                      ?>
                  	</h3>
                  </div>
              	<?php endif ?>
            
                <!-- logged in user information -->
                <?php  if (isset($_SESSION['username'])) : ?>
                	<p> <strong><?php echo $_SESSION['username']; ?></strong>&nbsp;<i class="glyphicon glyphicon-user"></i></p>
                	<p> <a href="home.php?logout='1'" style="color: red;">התנתק</a> </p>
                <?php endif ?>
              </div>
              
			   
			   <div class="col-sm-1">
				<a  href="home.php">  <img class="go" src="img\ytex.jpg"></a>
			   </div>
			   
			   <div class="col-sm-9">
				<a  href="home.php"><img class="logo1" src="img\logo.jpeg"></a>		 
			   </div>				      
		</div>

		<div class="container-fluid w3-container w3-teal">
		 <p class="text-center first">Ytex</p>
		</div>
	 </header>
<main>

  <div class="container1">
    <div class="row">
        <center><h1 class="slogen2">?איפה אנחנו</h1></center>
            <div id="map"></div>
      </div>
    </div>
  </div>
 
  <!-- Bootstrap scripts. -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
  <!-- Google Maps scripts. -->
  <script src="scrTry.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlUs2vP0ogqlurKeDRpedhCQGm-h8YB7g&callback=createMap&libraries=places" async defer></script>
</main>


	<footer id="footer">
		 <div class="container-fluid w3-container w3-teal">
		  <div  class="container">
		   <h3 class="text-center cont">צור קשר</h3>
		   <p class="text-center"><em> הכי טוב לביתך Ytex </em></p>

			
			<div class="row">
			 <div class="col-md-4">
			  <span class="glyphicon glyphicon-map-marker" style="font-size:20px;"><a href="googleMaps.php">עולי ציון 13, תל אביב-יפו</a></span><br>
			  <span class="glyphicon glyphicon-phone" style="font-size:20px;"><a href="tel:03-6819124">Phone: 03-6819124</a></span><br>
			  <span class="glyphicon glyphicon-envelope" style="font-size:20px;"><a href="mailto:Email: ytex@gmail.com" target="_top">Email: ytex@gmail.com</a></span>
			 </div>
			</div>
			
			<div  align="middle" class="social">
			  <a  target="_blank" href="https://www.facebook.com/Ytexshop/">  <img class="zoom" src="img\facebook.jpg"></a>
			  <a  href="googleMaps.php">  <img class="zoom" src="img\waze.jpg"></a>
			  <a  target="_blank" href="https://instagram.com/ytex_shop?utm_source=ig_profile_share&igshid=19pkvbil0w2r7">  <img class="zoom" src="img\insta.jpg"></a><br>
			</div>
			<div class="copyright">
			!Ytex תודה שביקרתם באתר של 
			</div>
			 
			 <br>
			 
			<div align="middle">
				<a  href="home.php">  <img class="logoend" src="img\ytex.jpg"></a>
			</div>

		  </div>
		 </div>
		 <div class="info container2 clearfix">
        <div class="container">
            <div class="row-fluid">
                <div class="span4">
					<p><b></b></p><div style="text-align:center;">
					<span style="font-size:small;">Copyright © 2019 - Developed by NSZ. Powered by</span>
					<span style="font-size:small;">&nbsp;</span><a href="home.php"><span style="font-size:small;">NSZ</span></a><br>
					</div><p style="text-align:center;"><br></p><p></p> 
				</div>
                <div class="span4 helplink">
                </div>
            </div>
        </div>
    </div>
    </footer>

	<script src="JS/script.js"></script>
	

</body>
</html>
