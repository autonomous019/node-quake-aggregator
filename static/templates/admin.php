<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FSI: My Account & Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css">
    <!-- Font Awesome 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
-->
	
	<!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
	
	
	 <!-- Bootstrap 3.3.5 -->
	 <!-- Latest compiled and minified JavaScript -->
	 <script src="bootstrap3/js/bootstrap.min.js"></script>
	
	
	
	
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-black.min.css">
	
	

		
		<script src="js/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
	  
	  
	  
  <body class="hold-transition skin-black sidebar-mini">
	  
	<?php
	//print_r($_SESSION);
	
    if(!empty($_REQUEST['register'])){
     
 	    $db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();
	    $password = $_REQUEST['password'];
	    $email = $_REQUEST['email'];
	    $first = $_REQUEST['first'];
	    $last = $_REQUEST['last'];
 	    $u = new Users('unknown', BASE_DOMAIN);
 	    $register = $u->register($email, $password, $first, $last);
	    $avatar = $u->my_avatar($my_id);
		
	  
		

    }
	
	
    if( !empty($_REQUEST['email']) && empty($_REQUEST['register'] )){
        //LOGGING IN 
		//LOGGING IN
		
    	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
        $db->connect();
		
	    $password = $_REQUEST['password'];
	    $email = $_REQUEST['email'];
		
 	    $u = new Users('unknown', BASE_DOMAIN);
 	    $login = $u->login($email, $password);
		//print_r($login);
	    //$avatar = $u->my_avatar($_SESSION['uid']);
		//sessions set in users class on login
		
		//get user data
	    $uid = $_SESSION['uid'];
	    
		
		$u = new Users('member', BASE_DOMAIN);	
		$user_info = $u->getUserInfo($uid);  //4 is customers, 3 is employee 2 is admin
		//print_r($user_info);
		$first = $user_info[0]['first'];
		$last = $user_info[0]['last'];
		$email = $user_info[0]['email'];
		$avatar = $user_info[0]['avatar'];
	
		$pwd_reset_code = $user_info[0]['pwd_reset_code'];
	
	    if($avatar === ""){
			
			$settings_avatar = "<img src=\"img/generic.png\" width=\"50\" class=\"img-circle\" alt=\"User Image\"/>";
			
	    	
	    } else {
	    	$settings_avatar = "<img src=\"avatars/".$avatar."\" width=\"50\" class=\"img-circle\" alt=\"User Image\"/>";
			
	    }
	
	

    }
	

	
	  if(!empty($_SESSION['uid'])){
		     
			 $first = $_SESSION['first'];
			 $email = $_SESSION['email'];
			 $last = $_SESSION['last'];
			 $role = $_SESSION['role'];
			 $my_id = $_SESSION['uid'];
			 $active = $_SESSION['active'];
			 
			 if($active === 0){
	  		  echo "Authorization Denied, please verify your email address.";
	  		  die();
			 }
			 
	} else {
		  echo "Authorization Denied, check your login credentials";
		  die();
	}
	
  
	 
	 if(!empty($_SESSION['role'])){
		 
		 //print_r($_SESSION);
	      if($_SESSION['role'] === 'Administrator'){
		      $panel_view = 'admin';
		  } else if($_SESSION['role'] === 'Employee'){
		      $panel_view = 'employee';
		  } else {
		      $panel_view = 'customer';  
	      }
	 
	 }

	

	if(!empty($_SESSION['uid'])){
	    $uid = $_SESSION['uid'];
		//echo "MY UID IS ".$uid;
		}
	

	if(!empty($_SESSION['uid'])){
	    
	
	}


	
	?>  
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="?view=main" class="logo" style="background-image: url('img/nav_tile.png');">
          <!-- mini logo for sidebar mini 50x50 pixels -->
		  <img src='img/fsi_logo.png' width='100' />
          <span class="logo-mini"><b></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>FSI Admin</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
			  
			  
	

              <!-- Notifications Menu -->
			  <!-- 
              <li class="dropdown notifications-menu">
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                   
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
					  
					  
					  
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
			  
			  -->
			  
			  
			  
              <!-- Tasks Menu -->
              <li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">3</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 3 reports</li>
                  <li>
                    <!-- Inner menu: contains the tasks -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <!-- Task title and progress text -->
                          <h3>
                           
                          </h3>
                          <!-- The progress bar -->
                          <div class="progress xs">
                            <!-- Change the css width attribute to simulate progress -->
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only"><!-- 20% Complete --></span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#"></a>
                  </li>
                </ul>
              </li>
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="avatars/<?= $avatar; ?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?= $first; ?> <?= $last; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                   <?= $settings_avatar; ?>
                    <p>
                      <?= $first; ?> <?= $last; ?><
                      <small></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="avatars/<?= $avatar; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?= $first; ?> <?= $last; ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i></a>
            </div>
          </div>

          <!-- search form (Optional) -->
         <!--  <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">My Account</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="#" id="settings" name="settings"><i class="fa fa-link"></i> <span>Settings</span></a></li>
             <li><a href="?view=logout"><i class="fa fa-link"></i> <span>Logout</span></a></li> 
            <li class="treeview">
				<!-- 
              <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#">Link in level 2</a></li>
                <li><a href="#">Link in level 2</a></li>
              </ul>
				-->
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
         <!--  <h1>
            My Account
            <small>management</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Account</a></li>
            <li class="active">Here</li>
          </ol>
			 -->
			 <?php 
			      include_once("templates/nav_tertiary.php");
			 ?>
        </section>

        <!-- Main content -->
        <section class="content">
			
			
	  	  <?php 
		  
		    

	
			 
			 include_once($panel_view."_panel.php");
	  	  ?>
			
			
			
			
			
			

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Sprinklers Sprinkle
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">FSI</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->







<!-- add modal-->

		<div class="modal" id="myModalSettings" name="myModalSettings">
			<div class="modal-dialog">
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		          <h4 class="modal-title">My Settings </h4>
		        </div>
		        <div class="modal-body" style="min-height: fill-available;">
		          <!-- content and stuff -->
	
		            <!-- need dropdown of clients give us client_id-->
		  		
					<div id="settings_container">	
						
						<form role="form" id="settings_form" name="settings_form" action="actions/settings.php" method="post" class="form-horizontal" enctype="multipart/form-data">
							
	  						<span id="reset_message">
	  						<button type="button" id="reset_button" name="reset_button" class="btn btn-danger">Reset Password</button>
					
	  				  
					
	  					</span>
					
					
	  					<hr>
                        
				
						  <div class="form-group">
						    <label for="text">First Name:</label>
						    <input type="text" class="form-control" id="first" name="first" value="<?= $first; ?>">
						  </div>
						  <div class="form-group">
						    <label for="text">Last Name:</label>
						  <input type="text" class="form-control" id="last" name="last" value="<?= $last; ?>">
						  </div>
						  <div class="form-group">
						    <label for="email">Email:</label>
						    <input type="text" class="form-control" id="email" name="email" value="<?= $email; ?>">
						  <div id="email_error"></div>
						  </div>
						  
						  
						  
						  <input type="text" name="avatar_name" id="avatar_name" value="<?= $avatar; ?>" style="display: none;"/>
						  <input type="text" name="my_id" id="my_id" value="<?= $uid; ?>" class="form-control" style="display: none;"/>
	 					<?php 
	 					      if(!empty($pwd_reset_code)){
	 						       ?>
	 		 	  				  <div class="form-group" id="password" style="display: hidden;">
	 		 	  				    <label for="text">Update Password:</label>
	 		 	  				    <input type="password" class="form-control" id="password" name="password" value="">
	 		 	  				  </div>
	 							   <?php
	 						  } else {
							  ?>
							  <input type="hidden" name="password" id="password" value="" />
							  <?php 
							  
							  }
	 					?>
						  
						  
						  
						  <div class="form-group">
							  <label for="text">Avatar:</label>
							  <?= $settings_avatar; ?>
						    <input type="file" name="file" id="user_file"  value="<?= $avatar; ?>" />
							<small>Upload new avatar to change</small><!-- it's just a shell or avatar-->
					      </div>
						  
						
						    <input type="hidden" id="uid" name="uid" value="" />
						  
						  <button type="submit" id="settings_button" class="btn btn-default">Submit</button>
					                   
		  			   </form>		
		  		
		  		   </div><!-- ends add_container -->
				
				
		  		 <div id="message_settings"> </div> 
			  
			  
				 <!-- no more content and stuff --> 
		        </div>
		        <div class="modal-footer">
		          <a href="#" data-dismiss="modal" id="overlay_settings_close" class="btn btn-primary">Dismiss</a>
	          
		        </div>
		      </div>
		    </div>
		</div>

		<script>
		function verify_password(){
	
			var password = $( "#password" ).val();
			var verify_password = $( "#password_verify" ).val();
	
			if(password != verify_password){
				$( "#password_error" ).text( "Passwords do not match" );
		
		
			} else {
				$( "#password_error" ).text( "Okay, Cool..." );
		
				$("#register_submit").show().fadeIn("slow");
		
		
			}
	
	
		}

		function validateEmail(email) { 
		            var expr = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		            return expr.test(email);
		        }

		function isEmail(email){
            
		            var color = "red";
		            var text = " is invalid";
		            if (validateEmail(email)) {
			            $( "#email_error" ).text( "Okay, Cool..." );
	           
		            }    else {
			            $( "#email_error" ).text( "Invalid Email" );
			            //return false;
				
		            }
           
		        }




		$( "#email" ).keyup(function() {
			var email = $( "#email" ).val();
		   isEmail(email);
		});




		</script>		

		
		
		
		<script>
		
				$('#settings').click(function(){
		             $('#myModalSettings').modal({show:true});
					 $('#message_settings').text(" ");
					 
		        });
		
				$( document ).ready(function(e) {
					
					
					$(function(){
					  $("#avatar_name").removeClass('hide');
					});
					
					
					
					
					$('#reset_button').click(function(e){
						
						 $('#reset_button').hide();
						 
						 var my_email = '<?= $email; ?>';
						 var my_id = '<?= $uid; ?>';
						 $('#reset_message').html("<h4 id='new_pass'>New Password Emailed!</h4>");
						 e.preventDefault();
					     $.post( "../fsi_beta/actions/reset.php",  { email: my_email, my_id: my_id })
					     .done(function( data ) {
					       alert( "Data Loaded: " + data );
					     });
						 
						
					 
			        });
					
					
					
					
					
					
					
					
					$("#settings_form").on('submit',(function(e) {
						
						//$('input[type=file]')[0].files[0]); 
						
					    e.preventDefault();

						var settings_data = {};
						var settings_data = new FormData(this);
						var data = settings_data;
						
						$.ajax({
				        	url: "../fsi_beta/actions/settings.php",   	// Url to which the request is send
							type: "POST",      				// Type of request to be send, called as method
							data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
							contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
				    	    cache: false,					// To unable request pages to be cached
							processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
							success: function(data)  		// A function to be called if request succeeds
						    {
								$("#message_settings").html("<B>Item Updated</b>");
								
							     
								//add new record to interface by calling load on reports.php 
								//get back the id to add an image.  then show image modal. 
						    }	        
					   });
					}));
			
				});
		
		</script>
		
		
		
		
		
		
		
		
		
		













    <!-- REQUIRED JS SCRIPTS -->

   
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap3/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
	
	
	
	<script>
	//handle setting overlay here. 
	
	
	
	</script>
	
	
	
	

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
