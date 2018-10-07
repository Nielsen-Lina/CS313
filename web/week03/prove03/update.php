<?php
session_start();

$checkedProducts = !empty($_POST['updateProducts']) ? $_POST['updateProducts'] : [];
$finalProducts = [];
foreach ($checkedProducts as $product) {
	$finalProducts[] = $product;
}
if (empty($finalProducts)) {
    $finalProducts[] = "empty";
}

$_SESSION["checkoutProducts"] = $finalProducts;
?>

<!DOCTYPE html>
<html>
	<?php
   	include ('includes/header.php');
   	include ('includes/title.php');
   	?>
    <body>
        <div id="cart">
            <h2>Your Shopping Cart Items:</h2>
            <form method="post" action="update.php">
	            <?php if ($finalProducts[0] == "empty") : ?>
	            	<label class="container"> The cart is empty. Go back and select your items. </label>
			        <button class="submit"><a href="./index.php">Go Back</a></button>
		        <?php else: ?> 
		            <ul>
			            <?php foreach ($finalProducts as $value) : ?>
			            	<?php if ($value == "kong") : ?>
			            		<label class="container"><img src="kong.png" alt="Kong Dog Toy"> <?= $value; ?>            
						         	<input type="checkbox" name="updateProducts[]" value="kong">            
						            <span class="checkmark"></span>
						        </label>
			            	<?php elseif ($value == "duck") : ?>
			            		<label class="container"><img src="duck.jpg" alt="Duck Dog Toy"> <?= $value; ?>            
						         	<input type="checkbox" name="updateProducts[]" value="duck">            
						            <span class="checkmark"></span>
						        </label>
			            	<?php elseif ($value == "dentastix") : ?>
			            		<label class="container"><img src="dentastix.jpg" alt="Pedigree Dentastix"> <?= $value; ?>            
						         	<input type="checkbox" name="updateProducts[]" value="dentasix">            
						            <span class="checkmark"></span>
						        </label>
			            	<?php elseif ($value == "groom") : ?>
			            		<label class="container"><img src="brush.jpg" alt="Dog Grooming Toy"> <?= $value; ?>            
						         	<input type="checkbox" name="updateProducts[]" value="groom">            
						            <span class="checkmark"></span>
						        </label>
			            	<?php endif; ?>
			            <?php endforeach; ?>	                   
			        </ul>   
			        <input type="submit" value="Update"> 
			        <input type="submit" formaction="./checkout.php" value="Checkout">
			        <button class="submit"><a href="./index.php">Go Back</a></button>
		         <?php endif; ?>
	        </form>        
        </div>
    </body>
</html>