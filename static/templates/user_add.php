<div id="list">
	
	<?php
	require_once("../config.inc.php");
		
	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
    $u = new Users('unknown', BASE_DOMAIN);
    $users = $u->get_users();
	//print_r($users);
	/*
	Array ( [id] => 86 [user_type_id] => 4 [user_status_id] => 0 [first] => tweetie [last] => bird [email] => tweetie@bird.com [password] => $2y$14$Q2GjFB.VbODAYCOfIrSsyudtm5VTXlJPsOP2UppKxqDkx12WoBmxa [avatar] => [pwd_reset_code] => [pwd_reset_redirect] => [last_login] => [total_logins] => 0 [created] => 2015-08-30 19:07:21 [modified] => 2015-08-30 19:07:21 [modified_by] => [deleted] => [active] => 0 [hasher] => ) 
	*/
	
	for ($i = 0; $i < count($users); $i++) {
			    //echo "<a href=\"http://".BASE_DOMAIN.PATH_TO_SITE."?view=editor&model=users&id=".$users[$i]['id']."\">".$users[$i]['email']."</a><br /><br />";
	    
	}
		
	?>
	
	
</div><!-- ends list-->



<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

 <!-- Bootstrap 3.3.5 -->
 <!-- Latest compiled and minified JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div id="list">
	
	
	
	<script>
    var my_edit_id = "";

	$.fn.inlineEdit = function(replaceWith, connectWith, my_id, field_name) {

	    $(this).hover(function() {
	        $(this).addClass('hover');
	    }, function() {
	        $(this).removeClass('hover');
	    });

	    $(this).click(function() {

	        var elem = $(this);
	        elem.hide();
	        elem.after(replaceWith);
	        replaceWith.focus();

	        replaceWith.blur(function() {

	            if ($(this).val() != "") {
					
					connectWith.val($(this).val()).change();
					var info = $(this).val();
	                elem.text($(this).val());
					
					$.ajax({
 
					    // The URL for the request, when testing in standalone change this path, remove fsi_beta/
					    url: "../fsi_beta/actions/users_updater.php",
 
					    // The data to send (will be converted to a query string)
					    data: {
					        id: my_id,
							info: info,
							field_name: field_name
					    },
 
					    // Whether this is a POST or GET request
					    type: "POST",
 
					    // The type of data we expect back
					    dataType : "text",
 
					    // Code to run if the request succeeds;
					    // the response is passed to the function
					    success: function( json ) {
					        //$( "<h1>" ).text( json.title ).appendTo( "body" );
					        //$( "<div class=\"content\">").html( json.html ).appendTo( "body" );
					    },
 
					    // Code to run if the request fails; the raw request and
					    // status codes are passed to the function
					    error: function( xhr, status, errorThrown ) {
					        alert( "Sorry, there was a problem!" );
					        console.log( "Error: " + errorThrown );
					        console.log( "Status: " + status );
					        console.dir( xhr );
					    },
 
					    // Code to run regardless of success or failure
					    complete: function( xhr, status ) {

							//update div with updated information
					    }
					});
					
					
					
	            }

	            $(this).remove();
	            elem.show();
	        });
	    });
	};

	</script>
	
	
	
	
	
	

	
	
	
	
    <table class="table table-striped">
        <thead>
            <tr>
               
				
                <th>User Name</th>
				 <th>Email</th>
                <th>Role</th>
				<th>File</th>
            </tr>
        </thead>
		
	    <tbody>
	         

	<?php


    $r = new Users('unknown', BASE_DOMAIN);
    $users = $r->get_users();
	//print_r($users); 
    
	
	for ($i = 0; $i < count($users); $i++) {
		$id = $users[$i]['id'];
		$first = $users[$i]['first'];
		$last = $users[$i]['last'];
		$email = $users[$i]['email'];
		$avatar = $users[$i]['avatar'];
		$role = $users[$i]['user_type_id'];
		$active = $users[$i]['active'];
		

		
		
		
		//next field first name
		echo "<td>";
		echo "<style>
                 #first_".$id.":hover { background: #fffbe1; }
             </style>";

		
		echo "<div id=\"edit_".$users[$i]['id']."\" >
			     
			     <div id=\"first_".$id."\" style=>".$first."<small> (click to edit) </small></div>
		             <form>
		                <input type=\"hidden\" name=\"hiddenField_first_".$id."\" value=\"".$first."\"/> 
						
		             </form>
			</div>
			
			";
		echo "<script>
			var replaceWith = $('<input name=\"temp_first_".$id."\" type=\"text\" />'),
			    connectWith = $('input[name=\"hiddenField_first_".$id."\"]'),
				field_name = 'first';
				my_id = ".$id.";

			$('#edit_".$id."').inlineEdit(replaceWith, connectWith, my_id, field_name);
			
			</script>";
			echo "</td>";
			
			
			
			
			// next field email
	        echo "<td>";
			echo "<style>
	                 #email_".$id.":hover { background: #fffbe1; }
	             </style>";

		
			echo "<div id=\"edit_email_".$users[$i]['id']."\" >
			     
				     <div id=\"email_".$id."\" style=>".$email."<small> (click to edit) </small></div>
			             <form>
			                <input type=\"hidden\" name=\"hiddenField_email_".$id."\" value=\"".$email."\"/> 
						
			             </form>
				</div>
			
				";
			echo "<script>
				var replaceWith = $('<input name=\"temp_email_".$id."\" type=\"text\" />'),
				    connectWith = $('input[name=\"hiddenField_email_".$id."\"]'),
					field_name = 'email';
					my_id = ".$id.";

				$('#edit_email_".$id."').inlineEdit(replaceWith, connectWith, my_id, field_name);
			
				</script>";
				echo "</td>";
			
			
			
			
				
				// next field description
		        echo "<td>";
				echo "<style>
		                 #role_".$id.":hover { background: #fffbe1; }
		             </style>";

		
				echo "<div id=\"edit_role_".$users[$i]['id']."\" >
			     
					     <div id=\"role_".$id."\" style=>".$role."<small> (click to edit) </small></div>
				             <form>
				                <input type=\"hidden\" name=\"hiddenField_role_".$id."\" value=\"".$role."\"/> 
						
				             </form>
					</div>
			
					";
				echo "<script>
					var replaceWith = $('<input name=\"temp_role_".$id."\" type=\"text\" />'),
					    connectWith = $('input[name=\"hiddenField_role_".$id."\"]'),
						field_name = 'user_type_id';
						my_id = ".$id.";

					$('#edit_role_".$id."').inlineEdit(replaceWith, connectWith, my_id, field_name);
			
					</script>";
					echo "</td>";
			
			
			
			
			
			
					// next field avatar
			        echo "<td>";
					echo "<style>
			                 #avatar_".$id.":hover { background: #fffbe1; }
			             </style>";

		
					echo "<div id=\"edit_avatar_".$users[$i]['id']."\" >
			     
						     <div id=\"avatar_".$id."\" style=>".$avatar."<small> (click to edit) </small></div>
					             <form>
					                <input type=\"hidden\" name=\"hiddenField_avatar_".$id."\" value=\"".$avatar."\"/> 
						
					             </form>
						</div>
			
						";
					echo "<script>
						var replaceWith = $('<input name=\"temp_avatar_".$id."\" type=\"text\" />'),
						    connectWith = $('input[name=\"hiddenField_avatar_".$id."\"]'),
							field_name = 'avatar';
							my_id = ".$id.";

						$('#edit_avatar_".$id."').inlineEdit(replaceWith, connectWith, my_id, field_name);
			
						</script>";
						echo "<form><input type=\"hidden\" id=\"fileinfo_id\" value=\"".$id."\" /></form>";
						echo "<a href=\"#\" id=\"add_image_".$id."\">Image Upload</a><img src=\"img/pdf-icon.png\" width=\"14\" />";
						echo "</td>";
						echo "<script>
						$('#add_image_".$id."').click(function(){
			                 $('#myModal').modal({show:true});
							 //need functionality in each field to handle updating appropriate divs
							 my_edit_id = '".$id."';
							 
							 
		                });
		</script>";
			
		
			echo "</tr>";
	}
		
	?>

</tbody>
</table>
	
</div><!-- ends list-->






	
	
	
	<!-- crazy ass experiment (not literally)-->
	
	
	


	

	<style>



	#image_preview{

	font-size: 30px;
	top: 100px;
	left: 100px;
	width: 250px;
	height: 230px;
	text-align: center;
	line-height: 180px;
	font-weight: bold;
	color: #C0C0C0;
	background-color: #FFFFFF;
	overflow: auto;
	}
	#selectImage{
	padding: 22px 21px 14px 15px;

	bottom: 0px;
	width: 414px;

	border-radius: 10px;
	}


	</style>


		

		<div class="modal" id="myModal">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">Add PDF</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
		          <!-- content and stuff -->
	
		              <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
		  				<div id="image_preview"><img id="previewing" src="img/noimage.png" /></div>	
		          <hr id="line">    
			  
				  <div id="message"> </div>
		  			<div id="selectImage">
		  				<label>Select Your File</label><br/>
		                  <input type="file" name="file" id="file" required />
						  <input type="hidden" id="upload_file_id" value="" />
						  <input type="hidden" id="mode" name="mode" value="users" />
						  <input type="hidden" name="uid" id="uid" value="" />
		  				<input type="submit" value="Save" class="submit" class="btn btn-primary" />
		              </div>                   
		  			</form>		
		  		
		  		<h4 id='loading' ><img src="img/loading_circle.gif"/>&nbsp;&nbsp;Loading...</h4>
		  		 <div id="message"> </div> 
			  
			  
				 <!-- no more content and stuff --> 
		        </div>
		        <div class="modal-footer">
		          <a href="#" data-dismiss="modal" id="overlay_close" class="btn btn-primary">All Done</a>
	          
		        </div>
		      </div>
		    </div>
		</div>
	
	
	


	<script>
		
		


	$(document).ready(function (e) {
		$( "#uploadimage" ).click(function() {
		  //$("#myModal").modal('show');
		  
		  $( "#overlay_close" ).click(function() {
			  //umm. dipshit empty all the previous data
			  
			  //$("#file").empty();
			  //$("#image_preview").empty();
			  //$("#message").empty();
		  });
	
		$("#uploadimage").on('submit',(function(e) {
			e.preventDefault();
			$("#message").empty(); 
            
			$('#loading').show();
			$("#uid").val(my_edit_id);
			
			
			//alert( $("#uid").val() )
			var request_data = {};
			var request_data = new FormData(this);
			var data = request_data;
			//request_data.append("uid", my_edit_id);
			//alert(my_edit_id);

			//need to clear all  after closing overlay
			
			
			//alert(new FormData(this));
			$.ajax({
	        	url: "../fsi_beta/actions/uploader.php",   	// Url to which the request is send
				type: "POST",      				// Type of request to be send, called as method
				data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
				contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
	    	    cache: false,					// To unable request pages to be cached
				processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
				success: function(data)  		// A function to be called if request succeeds
			    {
				$('#loading').hide();
				//$("#message").html(data);
				//alert(this.files);
				$("#message").html("File Saved");
				var file_name = $("#file").val();
				var real_file_name = file_name.split("\\");
				var text = real_file_name.length-1;
				var final_pos = real_file_name.length-1;
				//alert(real_file_name[final_pos]);
				var file_text = real_file_name[final_pos]; 
				//var res = str.split(" ");
				//$("#fileinfo_"+my_edit_id).text($("#file").val()); //update users grid view with updated info.			
				$("#avatar_"+my_edit_id).text(file_text);
			    }	        
		   });
		}));

	// Function to preview image
		$(function() {
	        $("#file").change(function() {
				$("#message").empty();         // To remove the previous error message
				var file = this.files[0];
				
				var imagefile = file.type;
				var match= ["image/jpeg","image/png","image/jpg", "application/pdf"];	
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])  || (imagefile==match[3]) ))
				{
				$('#previewing').attr('src','img/noimage.png');
				$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed or PDF Files</span>");
				return false;
				}
	            else
				{
	                var reader = new FileReader();	
	                reader.onload = imageIsLoaded;
	                reader.readAsDataURL(this.files[0]);
					 
	            }		
	        });
	    });
		function imageIsLoaded(e) { 
			$("#file").css("color","green");
	        $('#image_preview').css("display", "block");
			//$('#previewing').attr('src', 'img/pdf-icon.png');
	        $('#previewing').attr('src', e.target.result);
			$('#previewing').attr('width', '250px');
			$('#previewing').attr('height', '230px');
			
		};
	
	
	
		});
	
	
	});


	</script>
	
	
	
	<!-- end crazy ass experiment-->









