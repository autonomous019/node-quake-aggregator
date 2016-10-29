<div id="project_container">

<?php
//get data from projects objects, then create a atomized view for each page. 
require_once("config.inc.php");



if(!empty($_REQUEST['project'])){
	$project = $_REQUEST['project'];
} else {
	$project = "";
	
}

	
	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();

		$p = new Projects('member', BASE_DOMAIN);

	    $results = $p->get_project($project);
		
		if(empty($results)){
			echo "<b>DATA ERROR</b><br /><br />";
		}

	    //print_r($results);  
		for ($x = 0; $x < count($results); $x++) {
		    $id = $results[$x]['id'];
			$project_category_id = $results[$x]['project_category_id'];
			$name = $results[$x]['name'];
			$description = $results[$x]['description'];
			$other = $results[$x]['other'];
		    $bg_img = $results[$x]['bg_img'];
			$vertical_img = $results[$x]['vertical_img'];
			$project_vertical_img = $vertical_img;
			$project_bg_img = $bg_img;
		
			$project_category_name = $p->get_category_name($project_category_id);
			$project_category_name = $project_category_name['name'];
			
			$project_link = preg_replace('/\s+/', '_', $project_category_name);
			$project_link = str_replace('-', '_', $project_link);
			$project_category_icon = $p->get_category_icon($project_category_id);
			//$project_category_icon = $project_category_name['icon'];
		
			if (isset($project_category_icon['icon'])) {
			    $project_category_icon = $project_category_icon['icon'];
			} else {
				$project_category_icon = "";
			}

			//echo "<a href=\"?view=".strtolower($project_category_name)."\" class=\"project-icon\"><span>".$project_category_name."</span><img src=\"img/".$project_category_icon."\" alt=\"\"/></a>";


	}	
		?>



<style type="text/css" media="screen">

.projectImage {
	background-image: url('projects_img/<?= $project_vertical_img; ?>') !important;
}

.wrap { 
	background-image:url('projects_img/<?= $project_bg_img; ?>') !important;
}
</style>





<section class="main">

<div style="color: #000;">
</small>
</div>
<div class="projectImage" >
	
	</div>
<div class="projectContainer" style="margin-top: -400px;">
	
	
	<img src="img/<?=$project_category_icon; ?>" class="icon" alt=""  />
	

	
 <h2><small><?= $project_category_name; ?></small><?= $name; ?></h2>
<p><?= $description; ?></p>
<p class="small">

Other <?= $project_category_name; ?> Projects:<br>
<?= $other; ?>




<div class="projectIcons">
<?php 

	$p = new Projects('member', BASE_DOMAIN);
    $results = $p->get_projects();
  
	for ($x = 0; $x < count($results); $x++) {
	    $id = $results[$x]['id'];
		$project_category_id = $results[$x]['project_category_id'];
		$name = $results[$x]['name'];
		$description = $results[$x]['description'];
		$other = $results[$x]['other'];
	    $bg_img = $results[$x]['bg_img'];
		$vertical_img = $results[$x]['vertical_img'];
		
		$project_category_name = $p->get_category_name($project_category_id);
		$project_category_name = $project_category_name['name'];
		$project_link = preg_replace('/\s+/', '_', $project_category_name);
		$project_link = str_replace('-', '_', $project_link);
		$project_category_icon = $p->get_category_icon($project_category_id);
		//$project_category_icon = $project_category_name['icon'];
		
		if (isset($project_category_icon['icon'])) {
		    $project_category_icon = $project_category_icon['icon'];
		} else {
			$project_category_icon = "";
		}

		//echo html here 
		echo "<a href=\"?view=pages&project=".strtolower($project_category_name)."\" class=\"project-icon\"><span>".$project_category_name."</span><img src=\"img/".$project_category_icon."\" alt=\"\" style=\"width: 70px; display: inline; margin-top: -40px; \" /></a>";

}	
	?>

</div>

</div>

</section>

</div> <!-- ends project_container at head of page -->





<script>
$(document).ready(function() {
	
	
	//$( "body" ).css( "background-image", "url(http://www.afxcreates.com/review/fsi_beta/projects_img/residential_bg.jpg) no-repeat");
		//var n = $(".wrap .projects_pages").css("background-image");
		var n = $(".projectImage").css("background-image"); //works to retrieve url of css property
		//alert(n);
		
	//.css("background", "url(/images/r-srchbg_white.png) no-repeat");
	//use add class to write the necessary css dynamicly by adding .project_name to wrap class.  then create css in the page inline
	//$( ".wrap" ).removeClass();
	//$( ".wrap" ).addClass( "wrap residential" );
	
	$('a.project-icon').hover(function() {
		$(this).find('span').removeClass('fadeOut').addClass('fast fadeInUp animated');
	},function() {
		$(this).find('span').removeClass('fadeInUp').addClass('fadeOut');
	});
});
</script>
 
 
 