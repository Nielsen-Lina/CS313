<?php
session_start();

$checkedProducts = !empty($_POST['products']) ? $_POST['products'] : [];
$finalProducts = [];
foreach ($checkedProducts as $product) {
	$finalProducts[] = $product;
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
            <form method="post" action="checkout.php">
	            <?php if (empty($finalProducts)) : ?>
	            	<label class="container"> No items have been selected. Go back and select your items. </label>
		            <input class="submit" type="submit" formaction="./index.php" value="Go Back">
		        <?php else: ?> 
		        	<h2>Your Shopping Cart Review:</h2>
		            <p>Select the items you would like to DELETE from your cart.</p>
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
					         	<input type="checkbox" name="updateProducts[]" value="dentastix">            
					            <span class="checkmark"></span>
					        </label>
		            	<?php elseif ($value == "groom") : ?>
		            		<label class="container"><img src="brush.jpg" alt="Dog Grooming Toy"> <?= $value; ?>            
					         	<input type="checkbox" name="updateProducts[]" value="groom">            
					            <span class="checkmark"></span>
					        </label>
		            	<?php endif; ?>
		            <?php endforeach; ?>  
		        <input class="submit" type="submit" formaction="update.php" value="Update">
		        <input class="submit" type="submit" value="Checkout"> 
		        <input class="submit" type="submit" formaction="./index.php" value="Go Back">	
	         <?php endif; ?>
		        
	        </form>        
        </div>

        <?php
	      include ('includes/footer.php');
      	?>
    </body>
</html>