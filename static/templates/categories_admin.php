<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

 <!-- Bootstrap 3.3.5 -->
 <!-- Latest compiled and minified JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- <a href="#" id="add_project" name="add_project">Add Project</a> -->
<hr>

<button type="button" id="add_category" class="btn btn-primary">Create Category</button>

<div id="list_categories">
	
	
	
	<script>
    var cat_my_edit_id = "";


    


	$.fn.inlineCatEdit = function(replaceWith, connectWith, my_id, field_name) {

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
					    url: "../fsi_beta/actions/categories_updater.php",
 
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
                <th>Category Name</th>
				 <th>Slug</th>
                <th>Icon</th>
				<th>Delete</th>
            </tr>
        </thead>
		
	    <tbody>
	         

	<?php
	require_once("../config.inc.php");
		
	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
    $r = new Projects('unknown', BASE_DOMAIN);
    $categories = $r->get_categories();
	//print_r($projects); 
    
	
	for ($i = 0; $i < count($categories); $i++) {
		
		$id = $categories[$i]['id'];
		$name = $categories[$i]['name'];
		$icon = $categories[$i]['icon'];
		$slug = $categories[$i]['slug'];

		
		
		echo "<tr id=\"cat_".$id."\">";
        
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

		
		echo "<div id=\"edit_".$categories[$i]['id']."\" >
			     
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
				cat_my_edit_id = ".$id.";
				my_id = ".$id.";

			$('#edit_".$id."').inlineCatEdit(replaceWith, connectWith, my_id, field_name);
			
			</script>";
			echo "</td>";
			
			
			

			
			
			
				
				// next field slug
		        echo "<td>";
				echo "<style>
		                 #slug_".$id.":hover { background: #fffbe1; }
		             </style>";

		
				echo "<div id=\"edit_slug_".$categories[$i]['id']."\" >
			     
					     <div id=\"slug_".$id."\" style=>".$slug."<small> (click to edit) </small></div>
				             <form>
				                <input type=\"hidden\" name=\"hiddenField_slug_".$id."\" value=\"".$slug."\"/> 
						
				             </form>
					</div>
			
					";
				echo "<script>
					var replaceWith = $('<input name=\"temp_slug_".$id."\" type=\"text\" />'),
					    connectWith = $('input[name=\"hiddenField_slug_".$id."\"]'),
						field_name = 'slug';
						cat_my_edit_id = ".$id."; 
						my_id = ".$id.";

					$('#edit_slug_".$id."').inlineCatEdit(replaceWith, connectWith, my_id, field_name);
			
					</script>";
					echo "</td>";
			
			
			
			
			
			
					// next field icon
			        echo "<td>";
			

		
					echo "<div id=\"edit_icon_".$categories[$i]['id']."\" >
			     
						     <div id=\"icon_".$id."\" style=>".$icon."</div>
					          
						</div>
			
						";
				
						echo "<form><input type=\"hidden\" id=\"icon_id\" value=\"".$id."\" /></form>";
						echo "<a href=\"#\" id=\"cat_add_image_".$id."\">File Upload</a><img src=\"img/pdf-icon.png\" width=\"14\" />";
						echo "</td>";
						echo "<script>
						$('#cat_add_image_".$id."').click(function(){
			                 $('#myCatModal').modal({show:true});
							 //need functionality in each field to handle updating appropriate divs
							 cat_my_edit_id = '".$id."'; 
		                });
		</script>";
			
	
	
	
			
		// next field delete
		//not editable
        echo "<td>";
		
		echo "<button  id=\"cat_delete_".$id."\" class=\"btn btn-danger\"><b>[X]</b></button>";
			echo "</td>";
	
				echo "<script>
				$('#cat_delete_".$id."').click(function(){
	                 $('#myModalCatDelete').modal({show:true});
					 //need functionality in each field to handle updating appropriate divs
					 cat_my_edit_id = '".$id."';
					 $('#cat_delete_uid').val(cat_my_edit_id);
					 
					 
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

		<div class="modal" id="myModalCatDelete" name="myModalDelete">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">WARNING!</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
					
		        <div id="delete_container">
				
				 <form role="form" id="cat_deleter" name="cat_deleter" action="" method="post" class="form-horizontal">
					
				Are you sure you want to delete that? <br /><br />
						  <button type="submit" id="cat_delete_button" name="cat_delete_button" class="btn btn-danger">DELETE</button>
			              <input type="hidden" name="cat_delete_uid" id="cat_delete_uid" value="" />
						  <input type="hidden" name="mode" id="mode" value="categories" />
						  
			  </form>
			  <div id="cat_delete_message"></div>
			  
		     </div>
			  
			  
				 <!-- no more content and stuff --> 
		        </div>
		        <div class="modal-footer">
		          <a href="#" data-dismiss="modal" id="cat_overlay_delete_close" class="btn btn-primary">Close</a>
	          
		        </div>
		      </div>
		    </div>
		</div>


<script>
		
		$( document ).ready(function(e) {
	
			$("#cat_deleter").on('submit',(function(e) {
				//alert("delete");
				e.preventDefault();

				var cat_delete_data = {};
				var cat_delete_data = new FormData(this);
				var data = cat_delete_data;
				
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
						$("#cat_"+cat_my_edit_id).hide();
						//$('#deleter').reset();
						
						$('#cat_delete_message').html("<b>Item Deleted</b>");
						
				    }	        
			   });
			}));
		});
		
</script>



<!-- ENDS DELETE MODAL -->









<!-- add modal-->

		<div class="modal" id="myModalCatAdd" name="myModalCatAdd">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">Add Category</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
		          <!-- content and stuff -->
	
		            <!-- need dropdown of clients give us client_id-->
		  		
					<div id="cat_add_container">	
						
						<form role="form" id="category_add" name="category_add" action="" method="post" class="form-horizontal" enctype="multipart/form-data">

							
						  <div class="form-group">
						    <label for="text">Name:</label>
						    <input type="text" class="form-control" id="cat_name" name="cat_name">
						  </div>
						  <div class="form-group">
						    <label for="text">Slug:</label>
						    <input type="text" class="form-control" id="cat_slug" name="cat_slug">
						  </div>
	
						  
						  <div class="form-group">
							  <label for="text">Icon Image:</label>
						    <input type="file" name="cat_file" id="cat_file"  />
					      </div>
						  
						  
			
						  
						  
						  <button type="submit" id="add_cat_button" class="btn btn-default">Submit</button>
					                   
		  			   </form>		
		  		
		  		   </div><!-- ends add_container -->
				
				
		  		 <div id="cat_message_add"> </div> 
			  
			  
				 <!-- no more content and stuff --> 
		        </div>
		        <div class="modal-footer">
		          <a href="#" data-dismiss="modal" id="overlay_add_close" class="btn btn-primary">Cancel</a>
	          
		        </div>
		      </div>
		    </div>
		</div>

				

		
		
		<script>
		
				$('#add_category').click(function(){
		             $('#myModalCatAdd').modal({show:true});
					 $('#cat_message_add').text(" ");
					 
		        });
		
				$( document ).ready(function(e) {
					
					$("#category_add").on('submit',(function(e) {
						
						e.preventDefault();

						var add_data = {};
						var add_data = new FormData(this);
						var data = add_data;
						
						$.ajax({
				        	url: "../fsi_beta/actions/categories_add.php",   	// Url to which the request is send
							type: "POST",      				// Type of request to be send, called as method
							data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
							contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
				    	    cache: false,					// To unable request pages to be cached
							processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
							success: function(data)  		// A function to be called if request succeeds
						    {
								$("#cat_message_add").html("<B>Item Added</b>");
								//$('#category_add').empty();
							     
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



	#cat_image_preview{

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
	#cat_selectImage{
	padding: 22px 21px 14px 15px;

	bottom: 0px;
	width: 414px;

	border-radius: 10px;
	}


	</style>


		

		<div class="modal" id="myCatModal" name="myCatModal">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">Add PDF</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
		          <!-- content and stuff -->
	
		              <form id="cat_uploadimage" action="" method="post" enctype="multipart/form-data">
		  				<div id="cat_image_preview"><img id="cat_previewing" src="img/noimage.png" /></div>	
		          <hr id="cat_line">    
			  
				  <div id="cat_message"> </div>
		  			<div id="cat_selectImage">
		  				<label>Select Your File</label><br/>
		                  <input type="file" name="cat_file" id="cat_file" required />
						  <input type="hidden" id="cat_upload_file_id" name="cat_upload_file_id" value="" />
						   <input type="hidden" id="mode" name="mode" value="categories" />
						  <input type="hidden" name="cat_uid" id="cat_uid" value="" />
		  				<input type="submit" value="Save" class="submit" class="btn btn-primary" />
						
		              </div>                   
		  			</form>		
		  		
		  		<h4 id='cat_loading' ><img src="img/loading_circle.gif"/>&nbsp;&nbsp;Loading...</h4>
		  		 <div id="cat_message"> </div> 
			  
			  
				 <!-- no more content and stuff --> 
		        </div>
		        <div class="modal-footer">
		          <a href="#" data-dismiss="modal" id="cat_image_overlay_close" class="btn btn-primary">All Done</a>
	          
		        </div>
		      </div>
		    </div>
		</div>
	
	

	<script>
		
		


	$(document).ready(function (e) {
		$( "#cat_uploadimage" ).click(function() {
		  //$("#myModal").modal('show');
		  
		  $( "#cat_image_overlay_close" ).click(function() {
			  //umm. dipshit empty all the previous data
			  
			 
			  
			  
			  //$("#file").empty();
			  //$("#image_preview").empty();
			  //$("#message").empty();
		  });
	
		$("#cat_uploadimage").on('submit',(function(e) {
			e.preventDefault();
			$("#cat_message").empty(); 
            
			$('#cat_loading').show();
			$("#cat_uid").val(cat_my_edit_id);

			var request_data = {};
			var request_data = new FormData(this);
			var data = request_data;

			$.ajax({
	        	url: "../fsi_beta/actions/uploader.php",   	// Url to which the request is send
				type: "POST",      				// Type of request to be send, called as method
				data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
				contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
	    	    cache: false,					// To unable request pages to be cached
				processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
				success: function(data)  		// A function to be called if request succeeds
			    {
				    $('#cat_loading').hide();
				    $("#cat_message").html("File Saved");
					
					//var selectedFile = document.getElementById('cat_uploadimage').files[0].name;
					//alert("changed");
					//var selectedFile = $('#cat_file').get(0).files[0];
					//var selectedFile = $('#cat_file')[0].files[0];
					//alert(selectedFile);
				    $("#icon_"+my_edit_id).text(selectedFile);
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
			$('#previewing').attr('src', 'img/pdf-icon.png');
	        //$('#previewing').attr('src', e.target.result);
			$('#previewing').attr('width', '250px');
			$('#previewing').attr('height', '230px');
			
			
		};
	
	
	
		});
	
	
	});


	</script>
	









