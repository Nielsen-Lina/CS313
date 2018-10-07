
<?php
session_start();
?>

<!DOCTYPE html>
<html>
   <?php
   include ('includes/header.php');
   ?>
   <body>
      <?php
      include ('includes/title.php');
      ?>
      <div id="cart">
        <!-- Shopping Cart -->
        
        <h2>Shopping Cart:</h2>
        <form method="post" action="cart.php">
          <label class="container"><img src="kong.png" alt="Kong Dog Toy"> Kong Extreme Dog Toy - Treat Dispensing            
            <input type="checkbox" name="products[]" value="kong">            
            <span class="checkmark"></span>
          </label>
          <label class="container"><img src="duck.jpg" alt="Duck Dog Toy"> Duckworth Dog Toy            
            <input type="checkbox" name="products[]" value="duck">            
            <span class="checkmark"></span>
          </label>
          <label class="container"><img src="dentastix.jpg" alt="Pedigree Dentastix"> Pedigree Dentastix            
            <input type="checkbox" name="products[]" value="dentastix">            
            <span class="checkmark"></span>
          </label>
          <label class="container"><img src="brush.jpg" alt="Dog Grooming Toy"> Kong ZoomGroom, Dog Grooming Toy            
            <input type="checkbox" name="products[]" value="groom">            
            <span class="checkmark"></span>
          </label>

          <input class="submit" type="submit" value="Submit">
        </form>

      </div>

     <?php
      include ('includes/footer.php');
      ?>
</html>
