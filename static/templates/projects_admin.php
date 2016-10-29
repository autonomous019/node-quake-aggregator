<div id="list">


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css">

<script src="js/jquery.min.js"></script>

 <!-- Bootstrap 3.3.5 -->
 <!-- Latest compiled and minified JavaScript -->
 <script src="bootstrap3/js/bootstrap.min.js"></script>

<!-- <a href="#" id="add_project" name="add_project">Add Project</a> -->
<hr>
<button type="button" id="category_manager" class="btn btn-primary">Manage Categories</button>
<button type="button" id="add_project" class="btn btn-primary">Create Project</button>


<script>
$( document ).ready(function() {
	$( "#category_manager" ).click(function() {
	    $("#list").fadeIn("slow").load( "templates/categories_admin.php?" );
		return false;
	});
	
	$( "#list_project" ).click(function() {
	    $("#list").fadeIn("slow").load( "templates/projects_admin.php" );
		return false;
	});
	
;
	
	
});

</script>

	
	
	
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
					    url: "../fsi_beta/actions/projects_updater.php",
 
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
               
				<th>Id</th>
                <th>Project Name</th>
				 <th>Category</th>
                <th>Description</th>
				<th>Vertical Image</th>
				<th>Background Image</th>
				<th>Delete</th>
            </tr>
        </thead>
		
	    <tbody>
	         

	<?php
	require_once("../config.inc.php");
		
	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
    $p = new Projects('unknown', BASE_DOMAIN);
    $projects = $p->get_projects();
	
	for ($i = 0; $i < count($projects); $i++) {
		$id = $projects[$i]['id'];
		$cat_id = $projects[$i]['project_category_id'];
		$name = $projects[$i]['name'];
		$other = $projects[$i]['other'];
		$vertical_img = $projects[$i]['vertical_img'];
		$bg_img = $projects[$i]['bg_img'];
		$description = $projects[$i]['description'];
		$active = $projects[$i]['active'];
		$cat_name = $p->get_category_name($cat_id);
		
		
		echo "<tr id=\"".$id."\">";
        
		// next field client_id
		//not editable
        echo "<td>";
		echo $id;
			echo "</td>";
	
		
		
		
		
		
		
		
		//next field name
		echo "<td>";
		echo "<style>
                 #name_".$id.":hover { background: #fffbe1; }
             </style>";

		
		echo "<div id=\"edit_".$projects[$i]['id']."\" >
			     
			     <div id=\"name_".$id."\" style=>".$name."<small> (click to edit) </small></div>
		             <form>
		                <input type=\"hidden\" name=\"hiddenField_name_".$id."\" value=\"".$name."\"/> 
						
		             </form>
			</div>
			
			";
		echo "<script>
			var replaceWith = $('<input name=\"temp_name_".$id."\" type=\"text\" />'),
			    connectWith = $('input[name=\"hiddenField_name_".$id."\"]'),
				field_name = 'name';
				my_id = ".$id.";

			$('#edit_".$id."').inlineEdit(replaceWith, connectWith, my_id, field_name);
			
			</script>";
			echo "</td>";
			
			
			
			
			// next field location
	        echo "<td>";
			echo "<style>
	                 #cat_".$id.":hover { background: #fffbe1; }
	             </style>";

		
			echo "<div id=\"edit_cat_".$projects[$i]['id']."\" >
			     
				     <div id=\"cat_".$id."\" style=>".$cat_id."<small> (click to edit) </small></div>
			             <form>
			                <input type=\"hidden\" name=\"hiddenField_cat_".$id."\" value=\"".$cat_id."\"/> 
						
			             </form>
				</div>
			
				";
			echo "<script>
				var replaceWith = $('<input name=\"temp_cat_".$id."\" type=\"text\" />'),
				    connectWith = $('input[name=\"hiddenField_cat_".$id."\"]'),
					field_name = 'project_category_id';
					my_id = ".$id.";

				$('#edit_cat_".$id."').inlineEdit(replaceWith, connectWith, my_id, field_name);
			
				</script>";
				echo "</td>";
			
			
			
			
				
				// next field description
		        echo "<td>";
				echo "<style>
		                 #description_".$id.":hover { background: #fffbe1; }
		             </style>";

		
				echo "<div id=\"edit_description_".$projects[$i]['id']."\" >
			     
					     <div id=\"description_".$id."\" style=>".$description."<small> (click to edit) </small></div>
				             <form>
				                <input type=\"hidden\" name=\"hiddenField_description_".$id."\" value=\"".$description."\"/> 
						
				             </form>
					</div>
			
					";
				echo "<script>
					var replaceWith = $('<input name=\"temp_description_".$id."\" type=\"text\" />'),
					    connectWith = $('input[name=\"hiddenField_description_".$id."\"]'),
						field_name = 'description';
						my_id = ".$id.";

					$('#edit_description_".$id."').inlineEdit(replaceWith, connectWith, my_id, field_name);
			
					</script>";
					echo "</td>";
			
			
			
			
			
			
					// next field vertical_img
			        echo "<td>";
			

		
					echo "<div id=\"edit_vertical_".$projects[$i]['id']."\" >
			     
						     <div id=\"vertical_".$id."\" style=><a href='projects_img/".$vertical_img."' >".$vertical_img."</a></div>
					          
						</div>
			
						";
				
						echo "<form><input type=\"hidden\" id=\"vertical_id\" value=\"".$id."\" /></form>";
						echo "<a href=\"#\" id=\"add_image_".$id."\">File Upload</a><img src=\"img/pdf-icon.png\" width=\"14\" />";
						echo "</td>";
						echo "<script>
						$('#add_image_".$id."').click(function(){
			                 $('#myModalVertical').modal({show:true});
							
							 my_edit_id = '".$id."'; 
							 
							 
	 		                });
		</script>";
			
	
	
	
	
	
	
			// next field bg_img
	        echo "<td>";
	


			echo "<div id=\"edit_bg_".$projects[$i]['id']."\" >
	     
				     <div id=\"bg_".$id."\" style=><a href='projects_img/".$bg_img."' >".$bg_img."</div>
			          
				</div>
	
				";
		
				echo "<form><input type=\"hidden\" id=\"bg_id\" value=\"".$id."\" /></form>";
				echo "<a href=\"#\" id=\"add_bg_image_".$id."\">File Upload</a><img src=\"img/pdf-icon.png\" width=\"14\" />";
				echo "</td>";
				echo "<script>
				$('#add_bg_image_".$id."').click(function(){
	                 $('#myModal').modal({show:true});
					
					 my_edit_id = '".$id."'; 
					 
						 
						 
	                });  
                
</script>";
	
			
			
		// next field delete
		//not editable
        echo "<td>";
		
		echo "<button  id=\"delete_".$id."\" class=\"btn btn-danger\"><b>[X]</b></button>";
			echo "</td>";
	
				echo "<script>
				$('#delete_".$id."').click(function(){
	                 $('#myModalDelete').modal({show:true});
					 //need functionality in each field to handle updating appropriate divs
					 my_edit_id = '".$id."';
					 $('#proj_delete_uid').val(my_edit_id);
					 
					 
                });
</script>";
			
	
			echo "</tr>";
	}
		
	?>

</tbody>
</table>
	
</div><!-- ends list-->


<!-- MODALS HERE MODALS HERE MODALS HERE -->

<!-- DELETE MODAL -->

		<div class="modal" id="myModalDelete" name="myModalDelete">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">WARNING!</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
					
		        <div id="delete_container">
				
				 <form role="form" id="deleter" name="deleter" action="../actions/deleter.php" method="post" class="form-horizontal">
					
				Are you sure you want to delete that? <br /><br />
						  <button type="submit" id="delete_button" class="btn btn-danger">DELETE</button>
			              <input type="hidden" name="proj_delete_uid" id="proj_delete_uid" value="" />
						  <input type="hidden" name="mode" id="mode" value="projects" />
						  
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
						
						$('#delete_message').html("<b>Item Deleted</b>");
						
				    }	        
			   });
			}));
		});
		
</script>



<!-- ENDS DELETE MODAL -->









<!-- add modal-->

		<div class="modal" id="myModalAdd" name="myModalAdd">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">Add Project</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
		          <!-- content and stuff -->
	
		            <!-- need dropdown of clients give us client_id-->
		  		
					<div id="add_container">	
						
						<form role="form" id="project_add" name="project_add" action="../actions/projects_add.php" method="post" class="form-horizontal" enctype="multipart/form-data">
							

							
						  <div class="form-group">
						    <label for="text">Name:</label>
						    <input type="text" class="form-control" id="name" name="name">
						  </div>
						  <div class="form-group">
						    <label for="text">Other:</label>
						    <input type="text" class="form-control" id="other" name="other">
						  </div>
						  <div class="form-group">
						    <label for="text">Description:</label>
						    <textarea id="description" name="description" class="form-control"></textarea>
						  </div>
						  
						  <div class="form-group">
							  <label for="text">Background Image:</label>
						    <input type="file" name="bg_file" id="bg_file"  />
					      </div>
						  
						  <div class="form-group">
							  <label for="text">Vertical Image:</label>
						    <input type="file" name="file" id="file"  />
					      </div>
  						
						
						<div class="form-group">
						  <label for="text">Category:</label>
					       <select class="selectpicker" id="cat_id" name="cat_id" data-style="btn-primary">

  							<?php
  							
  							$p = new Projects('member', BASE_DOMAIN);	
  							$cats = $p->get_categories();  
	
  							

  							for ($x = 0; $x < count($cats); $x++) {
	
  								$cats_name = $cats[$x]['name'];
  								$cats_uid = $cats[$x]['id'];
  								
								?>

    
  							       <option value="<?= $cats_uid; ?>"><?= $cats_name;?></option>

  								<?php 
	
    
  							} 


	
  							?>
  							</select>
  						</div>
						  
					
						  
						  <button type="submit" id="add_project_button" class="btn btn-default">Submit</button>
					                   
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
		
				$('#add_project').click(function(){
		             $('#myModalAdd').modal({show:true});
					 $('#message_add').text(" ");
					 
		        });
		
				$( document ).ready(function(e) {
					
					$("#project_add").on('submit',(function(e) {
						//alert("adding");
						//$('input[type=file]')[0].files[0]); 
						
						e.preventDefault();

						var add_data = {};
						var add_data = new FormData(this);
						var data = add_data;
						
						$.ajax({
				        	url: "../fsi_beta/actions/projects_add.php",   	// Url to which the request is send
							type: "POST",      				// Type of request to be send, called as method
							data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
							contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
				    	    cache: false,					// To unable request pages to be cached
							processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
							success: function(data)  		// A function to be called if request succeeds
						    {
								$("#message_add").html("<B>Item Added</b>");
								$('#project_add').empty();
								$("#list").fadeIn("slow").load( "templates/projects_admin.php" );
							     
								//add new record to interface by calling load on projects.php 
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


		<!-- dynamically change name of file input: vertical_img, bg_img --> 

		<div class="modal" id="myModal" name="myModal">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">Image Editor</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
		          <!-- content and stuff -->
	
		              <form id="uploadimage" action="../actions/uploader.php" method="post" enctype="multipart/form-data">
		  				<div id="image_preview"><img id="previewing" src="img/noimage.png" /></div>	
		          <hr id="line">    
			  
				  <div id="message"> </div>
		  			<div id="selectImage">
		  				<label>Select Your File</label><br/>
		                  <input type="file" name="bg_img" id="bg_img" required />
						  <input type="hidden" id="upload_file_id" value="" />
						   <input type="hidden" id="mode" name="mode" value="projects" />
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
				    //alert(data.file.name);
				    $("#message").html("File Saved");
				    var file_name = $("#file").val();
					var selectedFile = document.getElementById('file').files[0].name;

				    //var real_file_name = file_name.split("\\");
				    //var text = real_file_name.length-1;
				    //var final_pos = real_file_name.length-1;
				    //var file_text = real_file_name[final_pos]; 

				    $("#edit_bg_"+my_edit_id).text(selectedFile);
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
	




















<!-- edit vertical image-->
	
	

	<style>



	#vertical_image_preview{

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
	#vertical_selectImage{
	padding: 22px 21px 14px 15px;

	bottom: 0px;
	width: 414px;

	border-radius: 10px;
	}


	</style>


		<!-- dynamically change name of file input: vertical_img, bg_img --> 

		<div class="modal" id="myModalVertical" name="myModalVertical">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">Image Editor</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
		          <!-- content and stuff -->
	
		              <form id="vertical_uploadimage" action="../actions/uploader.php" method="post" enctype="multipart/form-data">
		  				<div id="vertical_image_preview"><img id="previewing" src="img/noimage.png" /></div>	
		          <hr id="line">    
			  
				  <div id="vertical_message"> </div>
		  			<div id="vertical_selectImage">
		  				<label>Select Your File</label><br/>
		                  <input type="file" name="vertical_img" id="vertical_img" required />
						  <input type="hidden" id="upload_file_id" value="" />
						   <input type="hidden" id="mode" name="mode" value="projects" />
						  <input type="hidden" name="uid" id="vertical_uid" value="" />
		  				<input type="submit" value="Save" class="submit" class="btn btn-primary" />
						
		              </div>                   
		  			</form>		
		  		
		  		<h4 id='vertical_loading' ><img src="img/loading_circle.gif"/>&nbsp;&nbsp;Loading...</h4>
		  		 <div id="vertical_message"> </div> 
			  
			  
				 <!-- no more content and stuff --> 
		        </div>
		        <div class="modal-footer">
		          <a href="#" data-dismiss="modal" id="vertical_overlay_close" class="btn btn-primary">All Done</a>
	          
		        </div>
		      </div>
		    </div>
		</div>
	
	

	<script>
		
		


	$(document).ready(function (e) {
		$( "#vertical_uploadimage" ).click(function() {
		  //$("#myModal").modal('show');
		  
		  $( "vertical_#overlay_close" ).click(function() {
			  //umm. dipshit empty all the previous data
			  
			 
			  
			  
			  //$("#file").empty();
			  //$("#image_preview").empty();
			  //$("#message").empty();
		  });
	
		$("#vertical_uploadimage").on('submit',(function(e) {
			e.preventDefault();
			$("#vertical_message").empty(); 
            
			$('#vertical_loading').show();
			$("#vertical_uid").val(my_edit_id);
			
			
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

				    $("#edit_vertical_"+my_edit_id).text(selectedFile);
			    }	        
		   });
		}));

	// Function to preview image
		$(function() {
	        $("#vertical_file").change(function() {
				$("#vertical_message").empty();         // To remove the previous error message
				var file = this.files[0];
				
				var imagefile = file.type;
				var match= ["image/jpeg","image/png","image/jpg", "application/pdf"];	
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])  || (imagefile==match[3]) ))
				{
				$('#vertical_previewing').attr('src','img/noimage.png');
				$("#vertical_message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed or PDF Files</span>");
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
			$("#vertical_file").css("color","green");
	        $('#vertical_image_preview').css("display", "block");
			//$('#vertical_previewing').attr('src', 'img/pdf-icon.png');
	        $('#vertical_previewing').attr('src', e.target.result);
			$('#vertical_previewing').attr('width', '250px');
			$('#vertical_previewing').attr('height', '230px');
			
			
		};
	
	
	
		});
	
	
	});


	</script>
	
	
	
	
	








