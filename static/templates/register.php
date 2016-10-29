

<section class="main">
 
<div style="color: #000;">

<h2 style="color: #000; margin-left: 10px;">Register</h2>

<form  role="form" name="register_form" action="index.php?view=admin" id="register_form" method="post" class="form-horizontal" style="width: 400px;">

<div class="form-group" style="margin-left: 40px;">
<label for="text"></label>


</div>

<div class="form-group" style="margin-left: 40px;">
<label for="text">First Name</label>
<input type="text" id="first" name="first"  class="form-control" />

</div>

<div class="form-group" style="margin-left: 40px;">
<label for="text">Last Name</label>
<input type="text" id="last" name="last"   class="form-control" />

</div>

<div class="form-group" style="margin-left: 40px;">
<label for="text">Email</label>
<input type="text" id="email" name="email"   class="form-control" />


</div>

<div class="form-group" style="margin-left: 40px;">
<label for="text">Password</label>
<input type="password" id="password" name="password"   class="form-control" />


</div>

<div class="form-group" style="margin-left: 40px;">
<label for="text">Password Verify</label>
<input type="password" id="password_verify" name="password_verify"  class="form-control" />
<div id="password_error" name="password_error"></div>
<input type="hidden" name="register" id="register" value="register" />

</div>

 <button type="submit" id="register_submit" class="btn btn-default" style="margin-left: 80px;">Register</button>




</form>
<!-- 
First Name: <input type="text" id="first" name="first" /><br />
Last Name: <input type="text" id="last" name="last" /><br />
Email: <input type="text" id="email" name="email" /><br />
<div id="email_error"></div>
Password: <input type="password" id="password" name="password" /><br />
Verify Password: <input type="password" id="password_verify" name="password_verify" /><br />
<div id="password_error" name="password_error"></div>
<input type="hidden" name="register" id="register" value="register" />

<input type="Submit" value="Register" id="register_submit"/>


 
 -->
 
 
</div>

 
</section>

<script>
function verify_password(){
	
	var password = $( "#password" ).val();
	var verify_password = $( "#password_verify" ).val();
	
	if(password != verify_password){
		$( "#password_error" ).text( "Passwords do not match" );
		
		
	} else {
		$( "#password_error" ).text( "Okay, Cool..." );
		
		$("#register_submit").show().fadeIn("slow");
		
		
	}
	
	
}

function validateEmail(email) { 
            var expr = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return expr.test(email);
        }

function isEmail(email){
            
            var color = "red";
            var text = " is invalid";
            if (validateEmail(email)) {
	            $( "#email_error" ).text( "Okay, Cool..." );
	           
            }    else {
	            $( "#email_error" ).text( "Invalid Email" );
	            //return false;
				
            }
           
        }



//JS Driver section
$("#register_submit").hide();

$( "#password_verify" ).keyup(function() {
  verify_password();
});

$( "#email" ).keyup(function() {
	var email = $( "#email" ).val();
   isEmail(email);
});




</script>