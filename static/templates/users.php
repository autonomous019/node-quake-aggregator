<div id="list">


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css">

<script src="js/jquery.min.js"></script>

 <!-- Bootstrap 3.3.5 -->
 <!-- Latest compiled and minified JavaScript -->
 <script src="bootstrap3/js/bootstrap.min.js"></script>


	
	<?php
	require_once("../config.inc.php");
		
	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();

		
	?>
	
	




<hr>
<button type="button" id="add_user" class="btn btn-primary">Create User</button>


	

	
	
	
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
					    url: "../fsi_beta/actions/user_updater.php",
 
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
	
	
	

	<!-- MODALS HERE MODALS HERE MODALS HERE -->

	<!-- DELETE MODAL -->

			<div class="modal" id="myModalUserDelete" name="myModalUserDelete">
				<div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			          <h4 class="modal-title">WARNING!</h4>
			        </div>
			        <div class="modal-body" style="min-height: fill-available;">
					
			        <div id="delete_container">
				
					 <form role="form" id="deleter" name="deleter" action="" method="post" class="form-horizontal">
					
					Are you sure you want to delete that? <br /><br />
							  <button type="submit" id="delete_button" class="btn btn-danger">DELETE</button>
				              <input type="hidden" name="uid" id="delete_uid" value="" />
							  <input type="hidden" name="mode" id="mode" value="users" />
						  
				  </form>
				  <div id="delete_message"></div>
			  
			     </div>
			  
			  
					 <!-- no more content and stuff --> 
			        </div>
			        <div class="modal-footer">
			          <a href="#" data-dismiss="modal" id="overlay_delete_close" class="btn btn-primary">Close</a>
	          
			        </div>
			      </div>
			    </div>
			</div>


	<script>
		
			$( document ).ready(function(e) {
	
				$("#deleter").on('submit',(function(e) {
					//alert("delete");
					e.preventDefault();

					var delete_data = {};
					var delete_data = new FormData(this);
					var data = delete_data;
				
					$.ajax({
			        	url: "../fsi_beta/actions/deleter.php",   	// Url to which the request is send
						type: "POST",      				// Type of request to be send, called as method
						data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
						contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
			    	    cache: false,					// To unable request pages to be cached
						processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
						success: function(data)  		// A function to be called if request succeeds
					    {
							//$("#delete_container").text("Success!");
							$("#"+my_edit_id).hide();
							//$('#deleter').reset();
							//$("#"+my_edit_id).hide();
						
							$('#delete_message').html("<b>Item Deleted</b>");
						
					    }	        
				   });
				}));
			});
		
	</script>



	<!-- ENDS DELETE MODAL -->
	<?php 
	
        if(!empty($_REQUEST['page_start'])){
            $page_start = $_REQUEST['page_start'];
        } else {
            $page_start = "0";

        }

        if(!empty($_REQUEST['page_range'])){
            $page_range = $_REQUEST['page_range'];
        } else {
            $page_range = PAGING_RANGE;
        }
	
        $u = new Users('unknown', BASE_DOMAIN);
        $users = $u->get_users($page_start, $page_range);
		$users_count = $u->users_count();
	
			$pager_count = $users_count;  //total records for query
			$pager_range = PAGING_RANGE;  //total currently displayed
			$pager_end = $page_start + $pager_range;
			$pager_pos = $page_start;
			$next_pos = ($pager_range + 1);
			$back_pos = $pager_pos; 
			$next_button = "";
			$back_button = "";
			$display_range = PAGING_RANGE;

			if( ($pager_pos + $pager_range) < $pager_count ){
		
				$next_button = "<a href=\"\" id=\"next_button\" ><span class=\"glyphicon glyphicon-menu-right\"  style=\"font-weight: bold;\"></span>";
			} 
	
			if( ($pager_pos + $display_range) > $pager_count ){
		
				$back_button = "<a href=\"\" id=\"back_button\" ><span class=\"glyphicon glyphicon-menu-left\"  style=\"font-weight: bold;\"></span>";
			} 
	
			if($pager_count === $pager_range || $pager_count < $pager_range){
				$next_button = "";
				$back_button = "";
			}
	
	
			?>
	<br /><br />
		<!-- Paging Nav-->	
		<!-- hidden divs to hold paging data -->

			<div id="paging_start" style="display:none;"><?=$page_start;?></div>
			<div id="paging_range" style="display:none;"><?=$page_range;?></div>	
	
	
	
		<b>Users in system:</b><?=$users_count;?><br />
		<!-- paging table -->	
		<table style="width: 100%">
			<tr><td>
		<?= $back_button; ?>
		<td>
			<td style="width: 80%;">&nbsp;</td>
		</td>
		<td>
		<?= $next_button; ?>
		</td>
		</tr>
		</table>


	
	
		<script>
	
	
			$( document ).ready(function(e) {
		
	
				$( "#back_button" ).click(function(e) {
					e.preventDefault();

					var paging_start = $("#paging_start").text();
					var paging_range = $("#paging_range").text();
					paging_start = (paging_start - <?=PAGING_RANGE; ?>);

					$("#list").fadeIn("slow").load( "templates/users.php?page_start="+parseInt(paging_start)+"&page_range="+parseInt(paging_range) ); //ajaxy production live version paradox don't exist nor can you create one, see regrets clause of book. 
					return false;
				});
				
				
		
				$( "#next_button" ).click(function(e) {
					e.preventDefault();
					var paging_start = $("#paging_start").text();
					var paging_range = $("#paging_range").text();
					paging_start = (paging_start + <?=PAGING_RANGE; ?>);

				    $("#list").fadeIn("slow").load( "templates/users.php?page_start="+parseInt(paging_start)+"&page_range="+parseInt(paging_range) ); //ajaxy production live version
					return false;
				});

			});
	
		</script>
		<!-- ends paging nav -->
	
	
	
	
	
    <table class="table table-striped">
        <thead>
            <tr>
               
				
                <th>Name</th>
				 <th>Email</th>
                <th>Role</th>
				<th>File</th>
				<th>Delete</th>
            </tr>
        </thead>
		
	    <tbody>
	         

	<?php



    
	
	for ($i = 0; $i < count($users); $i++) {
		$id = $users[$i]['id'];
		$first = $users[$i]['first'];
		$last = $users[$i]['last'];
		$email = $users[$i]['email'];
		$avatar = $users[$i]['avatar'];
		$role = $users[$i]['user_type_id'];
		$active = $users[$i]['active'];
		

		
		echo "<tr id=\"".$id."\">";
		
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
					
                    if(!empty($avatar)){
                    	$avatar = "<img src=\"avatars/".$avatar."\" width=\"30\" />";
                    } else {
                    	$avatar = "<img src=\"img/generic.png\" width=\"30\" />";
                    }
		
					echo "<div id=\"edit_avatar_".$users[$i]['id']."\" >
			     
						     <div id=\"avatar_".$id."\" style=>".$avatar."</div>
					          
						</div>
			
						";
					
						echo "<form><input type=\"hidden\" id=\"fileinfo_id\" value=\"".$id."\" /></form>";
						echo "<a href=\"#\" id=\"add_image_".$id."\">Image Upload</a>  <img src=\"img/image-icon.gif\" width=\"14\" />";
						echo "</td>";
						echo "<script>
						$('#add_image_".$id."').click(function(){
			                 $('#myModal').modal({show:true});
							 //need functionality in each field to handle updating appropriate divs
							 my_edit_id = '".$id."';
							 
							 
		                });
		</script>";
		echo "</td>";
		
		
		
		
		echo "<td>";
		echo "<button  id=\"delete_".$id."\" class=\"btn btn-danger\"><b>[X]</b></button>";
			echo "</td>";
	
				echo "<script>
				$('#delete_".$id."').click(function(){
	                 $('#myModalUserDelete').modal({show:true});
					 //need functionality in each field to handle updating appropriate divs
					 my_edit_id = '".$id."';
					 $('#delete_uid').val(my_edit_id);
					 
					 
                });
</script>";
			
	
			echo "</tr>";
	}
		
			
	
	?>

</tbody>
</table>
	











<!-- add modal-->

		<div class="modal" id="myModalAdd" name="myModalAdd">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">Add User</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
		          <!-- content and stuff -->
	
		            <!-- need dropdown of clients give us client_id-->
		  		
					<div id="add_container">	
						
						<form role="form" id="user_add" name="user_add" action="../actions/users_add.php" method="post" class="form-horizontal" enctype="multipart/form-data">
							
						<div class="form-group">
							<label for="text">Role:</label>


							<?php
						
							$u = new Users('member', BASE_DOMAIN);	
							$roles = $u->get_roles();  //4 is customers, 3 is employee 2 is admin
	
							//print_r($roles);
							echo "<select class=\"selectpicker\" data-style=\"btn-primary\" name=\"user_type_id\" id=\"user_type_id\" >";

							for ($x = 0; $x < count($roles); $x++) {
	
								$roles_uid = $roles[$x]['id'];
								$roles_name = $roles[$x]['name'];
							
								?>
	
    
							       <option value="<?= $roles_uid; ?>"><?= $roles_name; ?></option>

								<?php 
	
    
							} 


	
							?>
							</select>
						</div>
							
							
							
						  <div class="form-group">
						    <label for="text">First:</label>
						    <input type="text" class="form-control" id="first" name="first"  class="form-control">
						  </div>
						  <div class="form-group">
						    <label for="text">Last:</label>
						    <input type="text" class="form-control" id="last" name="last"  class="form-control">
						  </div>
						  <div class="form-group">
						    <label for="text">Email:</label>
						    <input type="text" id="email" name="email" class="form-control"></textarea>
						  </div>
						  
						  <div class="form-group">
							  <label for="text">Avatar:</label>
						    <input type="file" name="file" id="user_file"  />
					      </div>
						  
						  
						  <input type="hidden" id="creator_id" name="creator_id" value="" />
						   
						  
						  <button type="submit" id="add_user_button" class="btn btn-default">Submit</button>
					                   
		  			   </form>		
		  		
		  		   </div><!-- ends add_container -->
				
				
		  		 <div id="message_add"> </div> 
			  
			  
				 <!-- no more content and stuff --> 
		        </div>
		        <div class="modal-footer">
		          <a href="#" data-dismiss="modal" id="overlay_add_close" class="btn btn-primary">Cancel</a>
	          
		        </div>
		      </div>
		    </div>
		</div>

				

		
		
		<script>
		
				$('#add_user').click(function(){
		             $('#myModalAdd').modal({show:true});
					 $('#message_add').text(" ");
					 
		        });
		
				$( document ).ready(function(e) {
					
					$("#user_add").on('submit',(function(e) {
						//alert("adding");
						//$('input[type=file]')[0].files[0]); 
						
						e.preventDefault();

						var add_data = {};
						var add_data = new FormData(this);
						var data = add_data;
						
						$.ajax({
				        	url: "../fsi_beta/actions/users_add.php",   	// Url to which the request is send
							type: "POST",      				// Type of request to be send, called as method
							data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
							contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
				    	    cache: false,					// To unable request pages to be cached
							processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
							success: function(data)  		// A function to be called if request succeeds
						    {
								$("#message_add").html("<B>Item Added</b>");
								$('#user_add').empty();
								$("#list").fadeIn("slow").load( "templates/users.php" );
							     
								//add new record to interface by calling load on reports.php 
								//get back the id to add an image.  then show image modal. 
						    }	        
					   });
					}));
			
				});
		
		</script>
		
		
		
		
		
		
				
<!-- ends add modal-->



	
	
	
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


		

		<div class="modal" id="myModal" name="myModal">
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
				    //alert(data.file.name);
				    $("#message").html("File Saved");
				    var file_name = $("#file").val();
					var selectedFile = document.getElementById('file').files[0].name;

				    //var real_file_name = file_name.split("\\");
				    //var text = real_file_name.length-1;
				    //var final_pos = real_file_name.length-1;
				    //var file_text = real_file_name[final_pos]; 

				    $("#avatar_"+my_edit_id).text(selectedFile);
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
	




</div><!-- ends list-->
















