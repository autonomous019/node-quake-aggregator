<section class="main">
<div class="projectImage"></div>
<div class="projectContainer">
<img src="img/in_prog_icon.png" class="icon" alt=""/> <h2><small>In Progress</small>Super Walmart</h2>
<p>Design - Build - Install / 85,500 Sq. Ft. / Olympia, WA / 2016</p>
<p class="small">
Other In Progress Projects:<br>
Microsoft Bldg. 12345 / Redmond, WA / 2017<br/>
The Ivory Tower / Seattle, WA / 2015 </p>
<div class="projectIcons">
<a href="?view=in_progress" class="project-icon"><span>In Progress</span><img src="img/in_prog_icon.png" alt=""/></a><a href="?view=commercial" class="project-icon"><span>Commercial</span><img src="img/comm_icon.png" alt=""/></a><a href="?view=education" class="project-icon"><span>Education</span><img src="img/edu_icon.png" alt=""/></a><a href="?view=remediation" class="project-icon"><span>Remediation</span><img src="img/rem_icon.png" alt=""/></a><a href="?view=multi_unit" class="project-icon"><span>Multi-Unit</span><img src="img/multi_icon.png" alt=""/></a> </div>
</div>

</section>


<style type="text/css" media="screen">.wrap.in-progress{background-image:url(img/in_prog_bg.jpg);}.wrap.in-progress .projectImage{background-image:url(img/in_prog_vert.jpg);}</style>
<script>
$(document).ready(function() {
	$('a.project-icon').hover(function() {
		$(this).find('span').removeClass('fadeOut').addClass('fast fadeInUp animated');
	},function() {
		$(this).find('span').removeClass('fadeInUp').addClass('fadeOut');
	});
});
</script>