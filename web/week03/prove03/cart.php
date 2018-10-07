<?php
session_start();

$checkedProducts = !empty($_POST['products']) ? $_POST['products'] : [];
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
            <h2>Your Shopping Cart Review:</h2>
            <p>Select the items you would like to keep in your cart.<br><b>Unselected</b> items will be deleted.</p>
            <p>Click Checkout to refresh the shopping cart and to continue.</p>
            <form method="post" action="checkout.php">
	            <?php if ($finalProducts[0] == "empty") : ?>
	            	<label class="container"> No items have been selected. Go back and select your items. </label>
		            <button  class="submit"><a href="./index.php">Go Back</a></button>
		        <?php else: ?> 
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
		        <input class="submit" type="submit" value="Checkout"> 
		        <button class="submit"><a href="./index.php">Go Back</a></button>	
	         <?php endif; ?>
		        
	        </form>        
        </div>

        <?php
	      include ('includes/footer.php');
      	?>
    </body>
</html>