<?php
session_start();

$_SESSION["checkoutProducts"];
?>

<!DOCTYPE html>
<html>
	<?php
   	include ('includes/header.php');
   	include ('includes/title.php');
   	?>
    <body onload="focusOnForm()">
        <div>
            <form name="form" onreset="focusOnForm()" action="confirmation.php" id="reviewForm" method="post">
		       <div id="personal_info">
		       	<h2>Checkout:</h2>
		         <!-- Name -->
		         <h3>Name:</h3>
		         <p><i>Please provide your first and last name</i></p>
		         <div>
		           <label>First Name</label>
		           <span class="fname-info" style="color:blue"></span>
		           <span class="fname" style="color:red">Invalid</span>
		           <input type="text" name="first" placeholder="First name.." oninput="validateName(this.value, 'fname');" onclick="tip('fname-info')" onblur="hide('fname-info')"/>
		         </div>
		         <div>
		           <label>Last Name</label>
		           <span class="lname-info" style="color:blue"></span>
		           <span class="lname" style="color:red">Invalid</span>
		           <input type="text" name="last" placeholder="Last name.." oninput="validateName(this.value, 'lname');" onclick="tip('lname-info')" onblur="hide('lname-info')"/>
		         </div>

		         <!-- Address -->
		         <h3>Address:</h3>
		         <p><i>Please provide your address</i></p>
		         <div>
		           <label>Street address</label>
		           <span class="stAddress-info" style="color:blue"></span>
		           <span class="stAddress" style="color:red">Invalid</span>
		           <input type="text" name="street" placeholder="Street address.." oninput="validateStAddress(this.value, 'stAddress');" onclick="tip('stAddress-info')" onblur="hide('stAddress-info')"/>
		         </div>
		         <div>
		           <label>City</label>
		           <span class="city-info" style="color:blue"></span>
		           <span class="city" style="color:red">Invalid</span>
		           <input type="text" name="city" placeholder="City.." oninput="validateName(this.value, 'city');" onclick="tip('city-info')" onblur="hide('city-info')"/>
		         </div>
		         <div>
		           <label>State</label>
		           <span class="state-info" style="color:blue"></span>
		           <span class="state" style="color:red">Invalid</span>
		           <input type="text" name="state" placeholder="State abbreviation.." oninput="validateState(this.value, 'state');" onclick="tip('state-info')" onblur="hide('state-info')"/>
		         </div>
		         <div>
		           <label>ZIP/Postal Code</label>
		           <span class="zip-info" style="color:blue"></span>
		           <span class="zip" style="color:red">Invalid</span>
		           <input type="text" name="zip" placeholder="ZIP code.."  oninput="validateZip(this.value, 'zip');" onclick="tip('zip-info')" onblur="hide('zip-info')"/>
		         </div>
		         <div>
		           <label>Country</label>
		           <span style="color:blue">We only ship within USA</span>
		           <input type="text" name="country" value="USA" disabled="disabled"/>
		         </div>

		         <!-- Phone -->
		         <h3>Phone:</h3>
		         <p><i>Please provide your phone number</i></p>
		         <div>
		           <label>Phone number</label>
		           <span class="phone-info" style="color:blue"></span>
		           <span class="phone" style="color:red">Invalid</span>
		           <input type="text" name="phone" placeholder="Phone number.." oninput="validatePhone(this.value, 'phone');" onclick="tip('phone-info')" onblur="hide('phone-info')"/>
		         </div>

	        	<input class="submit" name="confirm" type="submit" value="Confirm">
    			<input class="submit" name="cancel" type="submit" value="Cancel">
    			<input class="submit" type="submit" formaction="./update.php" value="Go Back">
	        </form>        
        </div>

        <?php
	      include ('includes/footer.php');
      	?>
    </body>
</html>