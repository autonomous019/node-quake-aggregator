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

<script>
var results_data = {};

</script>

<br /><br />

	<div id="search_panel" class="table-responsive">
	
    <table class="table table-striped">
        <thead>
            <tr>
               
				<th>Client Search</th>
                <th>Keyword Search</th>
				
            </tr>
        </thead>
		
	    <tbody>
<tr class="info">
	<td>
						
						<form role="form" id="report_search" name="report_search" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
							<h3>Get All Reports by Client</h3>
						<div class="form-group" style="margin-left: 40px;">

                           <label for="text">Client Name:</label>
							<?php
					
							$u = new Users('member', BASE_DOMAIN);	
							$customers = $u->get_user_roles('4');  //4 is customers, 3 is employee 2 is admin
	
							echo "<select class=\"selectpicker\" data-style=\"btn-primary\" name=\"client_id\" id=\"client_id\" >";
                            echo "<option value=\"\" selected>Select</option>";
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
							
							<br />
							<!--  <button type="submit" id="search_button" class="btn btn-default">Search</button> --> 
						</div>	
					</td><td>
							<h3>Keyword Search</h3>
							
						  <div class="form-group" >
						    <label for="text">Search Reports by Location, Name, or Year</label>
						    <input type="text" class="form-control" id="keyword" name="keyword" style="width: 240px;">
							
							<select class="selectpicker" data-style="btn-primary" name="field" id="field" >
								<option value="" selected>Select Option</option>
								<option value="name">Name</option>
								<option value="location">Location</option>
								<option value="year">Year</option>
							</select>
							
							
						  </div>
						
				
						  
						 <!--  <button type="submit" id="search_button" class="btn btn-default">Search</button> -->
					                   
		  			  
					   
				   </td></tr>
				   
				   <tr class="text-center"><td colspan="2" class="info" style="text-align: center;">
				   <a href="" id="search_link" name="search_link"><h3 style="color: #000;"><button type="button" id="search_button" class="btn btn-default">Search</button></h3></a>
			   </td></tr>
				   
				   
				    </form>	
				   
		  		
			   </tbody>
			   </table>
				
				
				
		 </div><!-- ends search_panel --> 		  
	
	
	
		
	
	
	
	
	<div id="my_data" style="display: none;"></div>
	<div id="search_results"  name="search_results"></div><!-- ends search_Results -->	
	

	
	
	
<script>
	
	
	$( document ).ready(function(e) {
	
		$( "#search_link" ).click(function(e) {
			
			e.preventDefault();
			var my_field = $("#field").val();
			var my_keyword = $("#keyword").val();
			var my_client_id = $("#client_id").val();
			
			if(my_client_id === '' && my_keyword === '' && my_field == ''){
				
				alert("either select a client or the keyword and field must be filled in")
			}
			
			if(my_keyword === '' && client_id === ''){ 
			    alert('keyword is blank');
			}
			
			if(my_field === '' && client_id === ''){ 
			    alert('field is blank');
			}
			
			if(my_client_id === '' && my_keyword === ''){ 
			    alert('client id is blank, are you searching clients or by keyword?');
				
			} else {
				if(my_keyword === '' && my_field === ''){
					my_keyword = my_client_id;
					my_field = 'client_id';
				}
				
			}

			
		    //$("#search_results").fadeIn("slow").load( "search_results.php?keyword="+my_keyword+"&field="+my_field+"&page_start=0&page_end=10" );  //standalong testing
			
			$("#search_results").fadeIn("slow").load( "templates/search_results.php?keyword="+my_keyword+"&field="+my_field+"&page_start=0&page_end=10" ); //ajaxy production live version
			return false;
		});

	});
	
</script>
				
				



































				


		
	