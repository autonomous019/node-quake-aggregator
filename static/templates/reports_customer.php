<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

 <!-- Bootstrap 3.3.5 -->
 <!-- Latest compiled and minified JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div id="list">

<script>

	var my_edit_id = "";
	var my_file = "";

</script>


    <table class="table table-striped">
        <thead>
            <tr>
               
				
                <th>Report Name</th>
				 <th>Location</th>
                <th>Description</th>
				<th>File</th>
            </tr>
        </thead>
		
	    <tbody>
	         

	<?php
	require_once("../config.inc.php");
		
	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
    $r = new Reports('unknown', BASE_DOMAIN);
	//get reports that belong to me. 
	
    $reports = $r->get_reports();

	echo "My frickin ID ".$_REQUEST['id'];
	
	
	
	for ($i = 0; $i < count($reports); $i++) {
		$id = $reports[$i]['id'];
		$name = $reports[$i]['name'];
		$location = $reports[$i]['location'];
		$file_info = $reports[$i]['file_info'];
		$description = $reports[$i]['description'];
		$client_id = $reports[$i]['client_id'];
		
		echo "<tr>";
        
		
		
	
		/*  not needed in customers view 
		// next field client_id
		//not editable
        echo "<td>";
		echo $client_id;
			echo "</td>";
	
		
		*/
		
		
		
		
		//next field name
		echo "<td>";
	

		
		echo "<div id=\"edit_".$reports[$i]['id']."\" >
			     
			     <div id=\"name_".$id."\" style=>".$name."<small>  </small></div>
		            
			</div>
			
			";
		
			echo "</td>";
			
			
			
			
			
			
			// next field location
	        echo "<td>";
			
			echo "<div id=\"edit_location_".$reports[$i]['id']."\" >
			     
				     <div id=\"location_".$id."\" style=>".$location."<small>  </small></div>
			            
				</div>
			
				";
			
				echo "</td>";
			
			
			
			
				
				// next field description
		        echo "<td>";
				
				echo "<div id=\"edit_description_".$reports[$i]['id']."\" >
			     
					     <div id=\"description_".$id."\" style=>".$description."<small>  </small></div>
				             
					</div>
			
					";
				
					echo "</td>";
			
			
			
			
			
			
					// next field file_info
					
					
					?>

					<div class="modal" id="myModal<?= $id; ?>">
						<div class="modal-dialog modal-lg">
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					          <h4 class="modal-title">PDF Viewer</h4>
					        </div>
					        <div class="modal-body" style="min-height: fill-available;">
					          <!-- content and stuff -->
				  
				  
				               <embed src="reports/<?= $file_info; ?>" id="pdf_view_file" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
				 
				 
				 
							 <!-- no more content and stuff --> 
				 
				 
					        </div>
					        <div class="modal-footer">
					          <a href="#" data-dismiss="modal" id="overlay_close" class="btn btn-primary">All Done</a>
	          
					        </div>
					      </div>
					    </div>
					</div>
	
	
			
					<?php 
					
					
					
					
			        echo "<td>";
					
		
					echo "<div id=\"edit_fileinfo_".$reports[$i]['id']."\" >
			     
						     <div id=\"fileinfo_".$id."\" style=>".$file_info."<small>  </small></div>
					             
						</div>
			
						";
					
						
						echo "<a href=\"#\" id=\"add_image_".$id."\">View</a><img src=\"img/pdf-icon.png\" width=\"14\" />";
						echo "</td>";
						echo "<script>
						$('#add_image_".$id."').click(function(){
			                 $('#myModal".$id."').modal({show:true});
							 //need functionality in each field to handle updating appropriate divs
							 my_edit_id = '".$id."';
							 my_file = 'reports/".$file_info."';
							
							 $('#pdf_view_file').attr('src', my_file);
							 
							 
		                });
		</script>";
			
		
			echo "</tr>";

	}
		
	?>

</tbody>
</table>
	
</div><!-- ends list-->





	

	




