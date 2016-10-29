<div id="search_list">



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

//print_r($_REQUEST);

?>

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
					    url: "../fsi_beta/actions/reports_updater.php",
 
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
	


	<?php
	
	if(!empty($_REQUEST['keyword'])){
		$keyword = $_REQUEST['keyword'];
	} else {
		$keyword = "";
	
	}

	if(!empty($_REQUEST['field'])){
		$field = $_REQUEST['field'];
	} else {
		$field = "";
	}

	if(!empty($_REQUEST['page_start'])){
		$page_start = $_REQUEST['page_start'];
	} else {
		$page_start = "0";
	
	}

	if(!empty($_REQUEST['page_end'])){
		//page end is actually the range to show 5 rec, 10 recs, etc. 
		$page_end = $_REQUEST['page_end'];
	} else {
		$page_end = "10";
	}

	if(!empty($_REQUEST['client_id'])){
		$keyword = $_REQUEST['client_id'];
		$field = 'client_id';
	} else {
		$client_id = "";
	}

    $r = new Reports('unknown', BASE_DOMAIN);

    if(!empty($_REQUEST['keyword'])){
		
	    $reports = $r->search($keyword, $field, $page_start, $page_end);  //returns paged results
		$reports_count = $r->search_counter($keyword, $field); //get search result count
		echo "<b>Result(s): ".($reports_count)."</b><br /><hr>";
		
	} elseif (!empty($_REQUEST['uid'])) {
		
		//get one report from search results
		$uid = $_REQUEST['uid'];
		$reports = $r->getReport($uid);
		
	} else {
		echo "Sorry, No Results Found <br /><br />";
		die();
	}
   
	$pager_count = $reports_count;  //total records for query
	$pager_range = count($reports);  //total currently displayed
	$pager_end = $page_start + $pager_range;
	$pager_pos = $page_start;
	$next_pos = ($pager_range + 1);
	$back_pos = $pager_pos; 
	$next_button = "";
	$back_button = "";
	$display_range = 10;
	

	
	//print_r($_REQUEST);
    //if pager_count is less then start_pos + pager_range don't show next
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
	
<!-- Paging Nav-->	
<!-- hidden divs to hold paging data -->
	<div id="paging_field" style="display:none;"><?=$field;?></div>
	<div id="paging_keyword" style="display:none;"><?=$keyword;?></div>
	<div id="paging_start" style="display:none;"><?=$page_start;?></div>
	<div id="paging_range" style="display:none;"><?=$page_end;?></div>	
	
	
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
			//getting current or default paging values
			var paging_field = $("#paging_field").text();
			var paging_keyword = $("#paging_keyword").text();
			var paging_start = $("#paging_start").text();
			var paging_range = $("#paging_range").text();
			paging_start = (paging_start - 10);
			
			//conditional start logic here
			//alert("templates/search_results.php?keyword="+paging_keyword+"&field="+paging_field+"&page_start="+parseInt(paging_start)+"&page_end="+parseInt(paging_range) );
			
		    //$("#search_results").fadeIn("slow").load( "search_results.php?keyword="+my_keyword+"&field="+my_field+"&page_start=0&page_end=10" );  //standalong testing
			$("#search_list").fadeIn("slow").load( "templates/search_results.php?keyword="+paging_keyword+"&field="+paging_field+"&page_start="+parseInt(paging_start)+"&page_end="+parseInt(paging_range) ); //ajaxy production live version paradox don't exist nor can you create one, see regrets clause of book. 
			return false;
		});
		
		$( "#next_button" ).click(function(e) {
			e.preventDefault();
			var paging_field = $("#paging_field").text();
			var paging_keyword = $("#paging_keyword").text();
			var paging_start = $("#paging_start").text();
			var paging_range = $("#paging_range").text();
			paging_start = (paging_start + 10);
			
			//conditional start logic here
			//alert("templates/search_results.php?keyword="+paging_keyword+"&field="+paging_field+"&page_start="+parseInt(paging_start)+"&page_end="+parseInt(paging_range)  );
		    $("#search_list").fadeIn("slow").load( "templates/search_results.php?keyword="+paging_keyword+"&field="+paging_field+"&page_start="+parseInt(paging_start)+"&page_end="+parseInt(paging_range) ); //ajaxy production live version
			return false;
		});

	});
	
</script>
<!-- ends paging nav -->				
				




<!-- display results in table -->


    <table class="table table-striped">
        <thead>
            <tr>
           
				<th>Client</th>
                <th>Report Name</th>
				 <th>Location</th>
                <th>Description</th>
				<th>File</th>
				<th>Delete</th>
            </tr>
        </thead>
	
	    <tbody>
	
	
	
	
	
	
	
	
	<?php 

	for ($i = 0; $i < count($reports); $i++) {
		$id = $reports[$i]['id'];
		$name = $reports[$i]['name'];
		$location = $reports[$i]['location'];
		$file_info = $reports[$i]['file_info'];
		$description = $reports[$i]['description'];
		$client_id = $reports[$i]['client_id'];
		
		//get first and last from users where client_id = id
		$u = new Users('unkown', BASE_DOMAIN);
		$user_info = $u->getUserInfo($client_id);
		//print_r($user_info);
		if(!empty($user_info)){
			$first = $user_info[0]['first'];
			$last = $user_info[0]['last'];
			$email = $user_info[0]['email'];
			
		} else {
			
			$first = "";
			$last = "";
			$email = "";
		}
		
		
		?>
		
		
		
	
	

		
		
		
		<?php 
		
		
		
		
		echo "<tr id=\"".$id."\">";
        
		// next field client_id
		//not editable
        echo "<td>";
		echo $first." ".$last."<br /> (".$email.")";
			echo "</td>";
	
		
		
		
		
		
		
		
		//next field name
		echo "<td>";
		echo "<style>
                 #name_".$id.":hover { background: #fffbe1; }
             </style>";

		
		echo "<div id=\"edit_".$reports[$i]['id']."\" >
			     
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
	                 #location_".$id.":hover { background: #fffbe1; }
	             </style>";

		
			echo "<div id=\"edit_location_".$reports[$i]['id']."\" >
			     
				     <div id=\"location_".$id."\" style=>".$location."<small> (click to edit) </small></div>
			             <form>
			                <input type=\"hidden\" name=\"hiddenField_location_".$id."\" value=\"".$location."\"/> 
						
			             </form>
				</div>
			
				";
			echo "<script>
				var replaceWith = $('<input name=\"temp_location_".$id."\" type=\"text\" />'),
				    connectWith = $('input[name=\"hiddenField_location_".$id."\"]'),
					field_name = 'location';
					my_id = ".$id.";

				$('#edit_location_".$id."').inlineEdit(replaceWith, connectWith, my_id, field_name);
			
				</script>";
				echo "</td>";
			
			
			
			
				
				// next field description
		        echo "<td>";
				echo "<style>
		                 #description_".$id.":hover { background: #fffbe1; }
		             </style>";

		
				echo "<div id=\"edit_description_".$reports[$i]['id']."\" >
			     
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
			
			
			
			
			
			
					// next field file_info
			        echo "<td>";
			

		
					echo "<div id=\"edit_fileinfo_".$reports[$i]['id']."\" >
			     
						     <div id=\"fileinfo_".$id."\" style=>".$file_info."</div>
					          
						</div>
			
						";
				
						echo "<form><input type=\"hidden\" id=\"fileinfo_id\" value=\"".$id."\" /></form>";
						echo "<a href=\"#\" id=\"add_image_".$id."\">File Upload</a><img src=\"img/pdf-icon.png\" width=\"14\" />";
						echo "</td>";
						echo "<script>
						$('#add_image_".$id."').click(function(){
			                 $('#myModal').modal({show:true});
							 //need functionality in each field to handle updating appropriate divs
							 my_edit_id = '".$id."'; 
		                });
		</script>";
			
			
			
			
		// next field client_id
		//not editable
        echo "<td>";
		
		echo "<button  id=\"delete_".$id."\" class=\"btn btn-danger\"><b>[X]</b></button>";
			echo "</td>";
	
				echo "<script>
				$('#delete_".$id."').click(function(){
	                 $('#myModalDelete').modal({show:true});
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
				
				 <form role="form" id="deleter" name="deleter" action="" method="post" class="form-horizontal">
					
				Are you sure you want to delete that? <br /><br />
						  <button type="submit" id="delete_button" class="btn btn-danger">DELETE</button>
			              <input type="hidden" name="uid" id="delete_uid" value="" />
						  <input type="hidden" name="mode" id="mode" value="reports" />
						  
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
		          <h4 class="modal-title">Add Report</h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
		          <!-- content and stuff -->
	
		            <!-- need dropdown of clients give us client_id-->
		  		
					<div id="add_container">	
						
						<form role="form" id="report_add" name="report_add" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
							
						<div class="form-group">


							<?php
							//get list of clients for creating a report
							//require_once("../config.inc.php");
							//$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
							//$db->connect();
							$u = new Users('member', BASE_DOMAIN);	
							$customers = $u->get_user_roles('4');  //4 is customers, 3 is employee 2 is admin
	
							//print_r($customers);
							echo "<select class=\"selectpicker\" data-style=\"btn-primary\" name=\"client_id\" id=\"client_id\" >";

							for ($x = 0; $x < count($customers); $x++) {
	
								$customer_email = $customers[$x]['email'];
								$customer_first = $customers[$x]['first'];
								$customer_last = $customers[$x]['last'];
								$customer_uid = $customers[$x]['id'];
								?>
	
    
							       <option value="<?= $customer_uid; ?>"><?= $customer_first;?> <?= $customer_last; ?></option>

								<?php 
	
    
							} 


	
							?>
							</select>
						</div>	
							
							
							
						  <div class="form-group">
						    <label for="text">Name:</label>
						    <input type="text" class="form-control" id="name" name="name">
						  </div>
						  <div class="form-group">
						    <label for="text">Location:</label>
						    <input type="text" class="form-control" id="location" name="location">
						  </div>
						  <div class="form-group">
						    <label for="text">Description:</label>
						    <textarea id="description" name="description" class="form-control"></textarea>
						  </div>
						  
						  <div class="form-group">
						    <input type="file" name="file" id="user_file"  />
					      </div>
						  
						  
						  <input type="hidden" id="creator_id" name="creator_id" value="" />
						   
						  
						  <button type="submit" id="add_report_button" class="btn btn-default">Submit</button>
					                   
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
		
				$('#add_report').click(function(){
		             $('#myModalAdd').modal({show:true});
					 $('#message_add').text(" ");
					 
		        });
		
				$( document ).ready(function(e) {
					
					$("#report_add").on('submit',(function(e) {
						//alert("adding");
						//$('input[type=file]')[0].files[0]); 
						
						e.preventDefault();

						var add_data = {};
						var add_data = new FormData(this);
						var data = add_data;
						
						$.ajax({
				        	url: "../fsi_beta/actions/reports_add.php",   	// Url to which the request is send
							type: "POST",      				// Type of request to be send, called as method
							data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
							contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
				    	    cache: false,					// To unable request pages to be cached
							processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
							success: function(data)  		// A function to be called if request succeeds
						    {
								$("#message_add").html("<B>Item Added</b>");
								$('#report_add').empty();
								$("#list").fadeIn("slow").load( "templates/reports.php" );
							     
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
						   <input type="hidden" id="mode" name="mode" value="reports" />
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

				    $("#fileinfo_"+my_edit_id).text(selectedFile);
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
	



















</div><!-- ends search_list -->

