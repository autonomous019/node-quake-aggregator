
<section class="main">

<div class="container projectsContainer">
<h1>Projects</h1>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Com sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>




<?php
//get data from projects objects, then create a atomized view for each page. 
require_once("config.inc.php");



if(!empty($_REQUEST['project'])){
	$project = $_REQUEST['project'];
} else {
	$project = "";
	
}

//print_r($_REQUEST);

//echo "word ".$keyword;
//echo "<br /><br /> field ".$field."<br /><br />";


	
	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
	$p = new Projects('member', BASE_DOMAIN);

    $results = $p->get_projects();

    //print_r($results);  
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
		if ($x+1 %3 == 0){
			
			echo "<div class=\"row\">";
		}
	
?>

<div class="col-xs-6 col-sm-4">
<a href="?view=pages&project=<?= strtolower($project_link); ?>" class="project-icon"><img src="img/<?= $project_category_icon; ?>" alt=""/><?= $project_category_name; ?></a>
 </div>

<?php

        if ($x+1 %3 == 0){
	
	         echo "</div><!-- end row -->";
         }


    }

?>



</section>


<!-- >
<section class="main">

<div class="container projectsContainer">
<h1>Projects</h1>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Com sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
<div class="row">
<div class="col-xs-6 col-sm-4">
<a href="?view=in_progress" class="project-icon"><img src="img/in_prog_icon.png" alt=""/>In Progress</a> </div>
<div class="col-xs-6 col-sm-4">
<a href="?view=commercial" class="project-icon"><img src="img/comm_icon.png" alt=""/>Commercial</a> </div>
<div class="col-xs-6 col-sm-4">
<a href="?view=education" class="project-icon"><img src="img/edu_icon.png" alt=""/>Education</a> </div>
<div class="col-xs-6 col-sm-4">
<a href="?view=remediation" class="project-icon"><img src="img/rem_icon.png" alt=""/>Remediation</a> </div>
<div class="col-xs-6 col-sm-4">
<a href="?view=multi_unit" class="project-icon"><img src="img/multi_icon.png" alt=""/>Multi-Unit</a> </div>
<div class="col-xs-6 col-sm-4">
<a href="?view=residential" class="project-icon"><img src="img/res_icon.png" alt=""/>Residential</a> </div>
</div>
</div> 
</section>

-->
