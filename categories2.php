<?php
require_once('initialize.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <title>Home-Ytex</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="css/t6.css">
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
                						<td>₪ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                						<td><a href="categories1.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">הסר מהסל</span></a></td>
                					</tr>
                					<?php
                							$total = $total + ($values["item_quantity"] * $values["item_price"]);
                						}
                					?>
                					<tr>
                						<td colspan="3" align="right">סה"כ</td>
                						<td align="right">₪ <?php echo number_format($total, 2); ?></td>
                						<td></td>
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
			   <li class="active"><a href="home.php">בית</a></li>
			   <li style="font-size:13px;"><a href="home.php#band">המותג</a></li>
			   <li style="font-size:13px;"><a href="#" title="not active">מבצעים</a></li>
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
			   <li class="active"><a href="home.php">בית</a></li>
			   <li style="font-size:13px;"><a href="home.php#band">המותג</a></li>
			   <li style="font-size:13px;"><a href="#" title="not active">מבצעים</a></li>
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
	    
    <div class="container">
        <h1 class="slogen"> <strong> קטגוריות מוצרים  </strong> </h1> <br><br>
	   <div class="row form-group">
	    

		
        <?php
        	   $category=array();
               $category=Product::find_all_category();
                for($j=0; $j<sizeof($category);$j++) {
                    
                    	echo '<div class="col-md-3">'.
            		        '<form method="post" action="categories.php?page='.$category[$j]->get_category().'">'.
            					'<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">';
            					
            						echo '<img src="img/'.$category[$j]-> get_category().'"jpg" ; class="img-responsive" />'.'<br />';
                                    
                				echo	'<input type="submit" id='.$category[$j]->get_category().'
                					style="margin-top:5px;" class="btn btn-success" value='.$category[$j]->get_category().'>';
                     
                				echo	'</div>'.
                				'</form>'.
                			 '</div>';
                }
        ?>


                        			</div>
                </div>
			<div style="clear:both"></div>
			<br />

		</div>
	<br />
</div>
    </main>

<footer class="footer">
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