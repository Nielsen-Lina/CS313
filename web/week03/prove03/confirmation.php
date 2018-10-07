<?php
session_start();

$firstName = htmlspecialchars($_POST['first']);
$lastName = htmlspecialchars($_POST['last']);
$street = htmlspecialchars($_POST['street']);
$city = htmlspecialchars($_POST['city']);
$state = htmlspecialchars($_POST['state']);
$zip = htmlspecialchars($_POST['zip']);
$phone = htmlspecialchars($_POST['phone']);

$_SESSION["checkoutProducts"];
?>

<!DOCTYPE html>
<html>
	<?php
   	include ('includes/header.php');
   	include ('includes/title.php');
   	?>
    <body>
        <div id="cart">
        	<?php
		       if (isset($_POST["confirm"])) : ?> 
		       <?php 
		       echo "<h2>Order Confirmation:</h2>";
		       echo "<p><b>Your name:</b> $firstName $lastName</p>"; 
	            echo "<p><b>Your address:</b> $street, $city $state, $zip</p>";
	            echo "<p><b>Your phone number:</b> $phone</p>";
	        ?>
            <p><b>Your order is:</b></p>
	            <?php foreach ($_SESSION["checkoutProducts"] as $value) : ?>
	            	<?php if ($value == "kong") : ?>
	            		<label class="container"><img src="kong.png" alt="Kong Dog Toy"> <?= $value; ?></label>
	            	<?php elseif ($value == "duck") : ?>
	            		<label class="container"><img src="duck.jpg" alt="Duck Dog Toy"> <?= $value; ?></label>
	            	<?php elseif ($value == "dentastix") : ?>
	            		<label class="container"><img src="dentastix.jpg" alt="Pedigree Dentastix"> <?= $value; ?></label>
	            	<?php elseif ($value == "groom") : ?>
	            		<label class="container"><img src="brush.jpg" alt="Dog Grooming Toy"> <?= $value; ?></label>
	            	<?php endif; ?>
	            <?php endforeach; ?>  
	        <h2>Thank you for your purchase!</h2>
		        <?php elseif (isset($_POST["cancel"])) : ?> 
		       <?php
		       echo "<h2>Order Cancelation</h2>";
		       echo "<p>Your order has been canceled.</p>";
		       ?>		    		
		    <?php endif; ?>
            
	        <button class="submit"><a href="./index.php">Shop Again</a></button>      
        </div>

        <?php
	      include ('includes/footer.php');
      	?>
    </body>
</html>