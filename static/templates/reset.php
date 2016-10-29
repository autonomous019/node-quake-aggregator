

<section class="main">
 
<div style="color: #000;">
	
<h2 style="color: #000; margin-left: 10px;">Password Reset</h2>

<form  role="form" name="reset_form" action="" id="reset_form" method="post" class="form-horizontal" style="width: 400px;">

<div class="form-group" style="margin-left: 40px;">
<label for="text"></label>


</div>


<div class="form-group" style="margin-left: 40px;">
<label for="text">Email</label>
<input type="text" id="email" name="email"   class="form-control" /><br />
<span id="email_error"></span>

</div>


<input type="hidden" name="reset" id="reset" value="reset" />


 <button type="submit" id="reset_submit" name="reset_submit" class="btn btn-default" style="margin-left: 80px;">Email Me Reset Code</button>


<br />

<br />

</form>	
	
	<div id="reset_message" style="color: #000;"></div>




</div> </section>



<script>


function validateEmail(email) { 
            var expr = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return expr.test(email);
        }

function isEmail(email){
            
            var color = "red";
            var text = " is invalid";
            if (validateEmail(email)) {
				$( "#email_error" ).text( "Okay, Cool Valid Email." );
				//check to see if it really exists in the system
		
				$("#reset_submit").show().fadeIn("slow");
	            
	           
            }    else {
	            $( "#email_error" ).text( "Invalid Email" );
	            //return false;
				
            }
           
        }



//JS Driver section
$("#reset_submit").hide();



$( "#email" ).keyup(function() {
	var email = $( "#email" ).val();
   isEmail(email);
});

</script>


		
		<script>
		
	
		
				$( document ).ready(function(e) {
					
					
					$('#reset_submit').click(function(e){
						
						 //$('#reset_button').hide();
						 
						 var my_email = $("#email").val();
						 
						 $('#reset_message').html("<h4 id='new_pass'>New Password Emailed!</h4>");
						 e.preventDefault();
					     $.post( "../fsi_beta/actions/reset_notlogged.php",  { email: my_email })
					     .done(function( data ) {
					       alert( " " + data );
						   
					     });
						 
						
					 
			        });
					
		
				});
		
		</script>

