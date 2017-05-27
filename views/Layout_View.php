<?php
/**
 * This file has the main view of the project
 *
 * @package    Reservation System
 * @subpackage Klipon Adds
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Raul Castro <rd.castro.silva@gmail.com>
 */

$root = $_SERVER['DOCUMENT_ROOT'];
/**
 * Includes the file /Framework/Tools.php which contains a 
 * serie of useful snippets used along the code
 */
require_once $root.'/Framework/Tools.php';

/**
 * 
 * Is the main class, almost everything is printed from here
 * 
 * @package 	Reservation System
 * @subpackage 	Klipon Adds
 * @author 		Raul Castro <rd.castro.silva@gmail.com>
 * 
 */
class Layout_View
{
	/**
	 * @property string $data a big array cotaining info for especified sections
	 */
	private $data;
	
	/**
	 * get's the data *ARRAY* and the title of the document
	 * 
	 * @param array $data Is a big array with the whole info of the document 
	 * @param string $title The title that will be printed in <title></title>
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}
	
	/**
	 * function printHTMLPage
	 * 
	 * Prints the content of the whole website
	 * 
	 * @param int $this->data['section'] the section that define what will be printed
	 * 
	 */
	
	public function printHTMLPage()
    {
    ?>
	<!DOCTYPE html>
	<html class='no-js' lang='<?php echo $this->data['appInfo']['lang']; ?>'>
		<head>
			<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="shortcut icon" href="favicon.ico" />
			<link rel="icon" type="image/gif" href="favicon.ico" />
			<title><?php echo $this->data['title']; ?> - <?php echo $this->data['appInfo']['title']; ?></title>
			<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
			<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
			<meta property="og:type" content="website" /> 
			<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
			<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
			<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
			<?php echo self::getCommonStyleDocuments(); ?>			
			<?php 
			switch ($this->data['section']) 
			{
				case 'log-in':
 					echo self :: getLogInHead();
				break;

				case 'dashboard':
					# code...
				break;
				
				case 'settings':
					echo self :: getSettingsHead();
				break;
				
				case 'inventory-category':
					echo self::getCategoryHead();
 				break;
				
				case 'add-store':
					echo self::getAddStoreHead();
				break;
				
				case 'store':
					echo self::getStoreHead();
				break;
				
				case 'distribuidores':
					echo self::getDistribuidoresHead();
				break;
			}
			?>
		</head>
		<body id="<?php echo $this->data['section']; ?>" class="hold-transition <?php echo $this->data['template-class']; ?> fixed  skin-black sidebar-mini">
			<?php 
			if ($this->data['section'] != 'log-in' && $this->data['section'] != 'log-out')
			{
			?>
			<div class="wrapper">
				<?php echo self :: getHeader(); ?>
				<?php echo self :: getSidebar(); ?>
				<!-- Content Wrapper. Contains page content -->
		        <div class="content-wrapper">
		            <!-- Content Header (Page header) -->
		            <section class="content-header">
		                <h1><?php echo $this->data['title']; ?></h1>
		                <ol class="breadcrumb">
		                    <li><a href="#"><i class="fa <?php echo $this->data['icon']; ?>"></i><?php echo $this->data['title']; ?></a></li>
		                </ol>
		            </section>
		            <!-- Main content -->
            		<section class="content">
						<?php 
						switch ($this->data['section']) {

							case 'dashboard':
// 								echo self::getDashboardIcons();
								echo self::getStoreList();
							break;
							
							case 'add-store':
								echo self::getAddStoreContent();
							break;
							
							case 'store':
								echo self::getStoreContent();
 							break;
							
							case 'settings':
								echo self::getSettingsContent();
							break;
							
							case 'members':
								echo self::getAllMembers();
							break;
							
							case 'profile':
								echo self :: getProfileContent();
							break;
							
							case 'distribuidores':
								echo self::getDistribuidoresContent();
							break;

							default :
								# code...
							break;
						}
						?>
					</section>
				</div>
			</div>
			<?php
				echo self::getFooter();
			}
			else
			{
				switch ($this->data['section']) 
				{
					case 'log-in':
						echo self::getLogInContent();
					break;
				
					case 'log-out':
						echo self::getSignOutContent();
					break;
					
					default:
					break;
				}
			}
			
			echo self::getCommonScriptDocuments();
			
			switch ($this->data['section'])
			{
				case 'log-in':
					echo self::getLogInScripts();
				break;
				
				case 'add-store':
					echo self::getAddStoreScripts();
				break;
				
				case 'store':
					echo self::getStoreScripts();
				break;
				
				case 'distribuidores':
					echo self::getDistribuidoresScripts();
				break;
			}
			?>
		</body>
	</html>
    <?php
    }
    
    /**
     * returns the common css and js that are in all the web documents
     * 
     * @return string $documents css & js files used in all the files
     */
    public function getCommonStyleDocuments()
    {
    	ob_start();
    	?>
    	<!-- Bootstrap 3.3.5 -->
	    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="/dist/font-awesome-4.5.0/css/font-awesome.min.css">
	    <!-- Ionicons -->
	    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
	    <!-- Theme style -->
	    <link rel="stylesheet" href="/dist/css/AdminLTE.css">
	    <!-- iCheck -->
	    <!-- iCheck for checkboxes and radio inputs -->
    	<link rel="stylesheet" href="/plugins/iCheck/all.css">
	
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    <link rel="stylesheet" href="/dist/css/skins/skin-black.min.css">
       	<link href="/css/style.css" media="screen" rel="stylesheet" type="text/css" />
    	
       	<?php 
       	$documents = ob_get_contents();
       	ob_end_clean();
       	return $documents; 
    }
    
    /**
     * returns the common css and js that are in all the web documents
     * 
     * @return string $documents css & js files used in all the files
     */
    public function getCommonScriptDocuments()
    {
    	ob_start();
    	?>
    	<!-- jQuery 2.1.4 -->
    	<script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    	<!-- Bootstrap 3.3.5 -->
    	<script src="/bootstrap/js/bootstrap.min.js"></script>
    	<!-- AdminLTE App -->
    	<script src="/dist/js/app.min.js"></script>
    	<!-- SlimScroll -->
    	<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    	<script src="/js/bootbox.js"></script>
       	<?php 
       	$documents = ob_get_contents();
       	ob_end_clean();
       	return $documents; 
    }
    
    /**
     * The main menu
     *
     * it's the top and main navigation menu
     * if is logged shows a sign-in | sign-up links
     * but if is logged it shows other menus included the sign-out
     *
     * @return string HTML Code of the main menu 
     */
    public function getHeader()
    {
    	ob_start();
    	$active='class="active"';
    	
    	$img = "/dist/img/user2-160x160.jpg";
    	 
    	if ($this->data['userInfo']['avatar'])
    	{
    		$img = "/images/owners-profile/avatar/".$this->data['userInfo']['avatar'];
    	}
    	
    	?>  		
		<!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="/dashboard/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b><?php echo $this->data['appInfo']['title']; ?></b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?php echo $this->data['appInfo']['title']; ?></span>
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
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?php echo $img; ?>" class="user-image" alt="User Image" id="avatarUp">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo $this->data['userInfo']['name']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?php echo $img; ?>" class="img-circle" alt="User Image" id="avatarUpLittle">
                                    <p>
                                        <?php echo $this->data['userInfo']['name']; ?> - Administrator
                                        <!-- <small>Member since Nov. 2012</small> -->
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                	<div class="pull-left">
                  						<a href="/profile/" class="btn btn-default btn-flat">Profile</a>
                					</div>
                                    <div class="pull-right">
                                        <a href="/" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
							<a href="/settings/" ><i class="fa fa-gears"></i></a>
						</li>
                    </ul>
                </div>
            </nav>
        </header>
    	<?php
    	$header = ob_get_contents();
    	ob_end_clean();
    	return $header;
    }
    
    /**
     * it is the head that works for the sign in section, aparently isn't getting 
     * any parameter, I just left it here for future cases
     *
     * @package 	Reservation System
     * @subpackage 	Sign-in
     * @todo 		Delete it?
     * 
     * @return string
     */
    public function getLogInHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
    	<?php
    	$signIn = ob_get_contents();
    	ob_end_clean();
    	return $signIn;
    }
    
    public function getLogInScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src="/js/log-in.js"></script>
    	<?php
    	$signIn = ob_get_contents();
    	ob_end_clean();
    	return $signIn;
    }
    
    /**
     * getSignInContent
     * 
     * the sign-in box
     * 
     * @package Reservation System
     * @subpackage Sign-in
     * 
     * @return string
     */
    public function getLogInContent()
    {
    	ob_start();
    	?>
		<div class="login-box">
	        <div class="login-logo">
	            <a href="/"><b><?php echo $this->data['appInfo']['siteName']; ?></b></a>
	        </div>
	        <!-- /.login-logo -->
	        <div class="login-box-body">
	            <p class="login-box-msg">Sign in to start your session</p>
	            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="logInForm">
	                <div class="form-group has-feedback">
	                    <input type="email" class="form-control" placeholder="Email" name='loginUser'>
	                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	                </div>
	                <div class="form-group has-feedback">
	                    <input type="password" class="form-control" placeholder="Password" name='loginPassword'>
	                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	                </div>
	                <div class="row">
	                    <div class="col-xs-8">
	                        <!-- <div class="checkbox icheck">
	                            <label>
	                                <input type="checkbox"> Remember Me
	                            </label>
	                        </div>
	                       	 -->
	                    </div>
	                    <!-- /.col -->
	                    <div class="col-xs-4">
	                    	<input type="hidden" name="submitButton" value="1">
	                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="logins">Log In</button>
	                    </div>
	                    <!-- /.col -->
	                </div>
	            </form>
	        </div>
	        <!-- /.login-box-body -->
	    </div>
	    <!-- /.login-box -->
        <?php
        $wideBody = ob_get_contents();
        ob_end_clean();
        return $wideBody;
    }
    
    /**
     * getSignOutContent
     *
     * It finish the session
     *
     * @package 	Reservation System
     * @subpackage 	Sign-in
     *
     * @return string
     */
    public function getSignOutContent()
    {
    	ob_start();
    	?>
       	<div class="row login-box" id="sign-in">
    		<div class="col-md-4 col-md-offset-4">
    			<h3 class="text-center">You've been logged out successfully</h3>
    			<br />
    	    	<div class="panel panel-default">
					<div class="panel-body">
						<a href="/" class="btn btn-lg btn-success btn-block">Login</a>
					</div>
    			</div>
    		</div>
    	</div>
		<?php
		$wideBody = ob_get_contents();
		ob_end_clean();
		return $wideBody;
    }
   	
    /**
     * The side bar of the apliccation
     * 
     * Is the side-bar of the application where the main sections are as links
     * 
     * @return string
     */
   	public function getSidebar()
   	{
   		ob_start();
   		$active = 'class="active"';
   		
   		$img = "/dist/img/user2-160x160.jpg";
   		 
   		if ($this->data['userInfo']['avatar'])
   		{
   			$img = "/images/owners-profile/avatar/".$this->data['userInfo']['avatar'];
   		}
   		
   		?>
   		<!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo $img; ?>" class="img-circle" alt="User Image" id="avatarSide">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $this->data['userInfo']['name']; ?></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header">Menu principal</li>
                    <li class="active">
                        <a href="/dashboard/">
                            <i class="fa fa-users"></i>
                            <span>Sliders</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/distribuidores/">
                            <i class="fa fa-users"></i>
                            <span>Distribuidores</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
   		<?php
   		$sideBar = ob_get_contents();
   		ob_end_clean();
   		return $sideBar;
   	}
   	
   	/**
   	 * the big icons that appear on the top of every section
   	 * 
   	 * @return string
   	 */
   	public function getDashboardIcons() 
   	{
   		ob_start();
   		?>
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<a href="/owners/"><span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span></a>
                	<div class="info-box-content">
						<span class="info-box-text">Owners</span>
						<span class="info-box-number"><?php echo $this->data['totalMembers']; ?></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<a href="/tasks/"><span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span></a>
                	<div class="info-box-content">
						<span class="info-box-text">Tasks</span>
						<span class="info-box-number"><?php echo $this->data['taskInfo']['today']; ?></span>
						<span class="progress-description"><?php echo $this->data['taskInfo']['pending']; ?> pending</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Messages</span>
						<span class="info-box-number">4</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Payments</span>
						<span class="info-box-number">2</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
		</div>
          <!-- =========================================================== -->
   		<?php
   		$dashboardIcons = ob_get_contents();
   		ob_end_clean();
   		return $dashboardIcons;
   	}
   	
   	/**
   	 * Last n members
   	 * 
   	 * Is like a preview, it is printed onthe dashboard
   	 * 
   	 * @return string
   	 */
   	
   	public function getStoreList()
   	{
   		ob_start();
   		?>
   		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Sliders</h3>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
	                  <table class="table table-hover">
	                    <tr>
							<th>Idioma</th>
	                    </tr>
	                    <?php 
						foreach ($this->data['stores'] as $store)
						{
							?>
						<tr>
							<td>
								<a href="/slider/<?php echo $store['store_id']; ?>/<?php echo Tools::slugify($store['store']); ?>/" class="member-link">
									<?php echo $store['store']; ?>
								</a>
							</td>
						</tr>
							<?php
						}
						?>
	                  </table>
                	</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
   		<?php
   		$membersRecent = ob_get_contents();
   		ob_end_clean();
   		return $membersRecent;
   	}
   	
   	public function getAddStoreHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getAddStoreScripts()
    {
    	ob_start();
    	?>
		<!-- InputMask -->
	    <script src="/plugins/input-mask/jquery.inputmask.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	    <!-- SlimScroll 1.3.0 -->
    	<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    	
    	<script type="text/javascript">
    	$(function () {
            //Money Euro
            $("[data-mask]").inputmask();
    	});
		</script>
		<script src="/js/stores.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getAddStoreContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Store info</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Store name</label>
							<input type="text" class="form-control" id="bookTitle" placeholder="store name ...">
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Store URL</label>
							<input type="text" class="form-control" id="bookAuthor" placeholder="store url ...">
						</div>
                        
						<div class="box-footer">
							<div class="progress progress-sm active">
		                    	<div class="progress-bar progress-bar-success progress-bar-striped" id="progressSaveMember" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
		                      		<span class="sr-only">20% Complete</span>
		                    	</div>
		                  	</div>
		                    <button type="submit" class="btn btn-info pull-right" id="addBook">Add Store</button>
		                    <a href="" class="btn btn-success pull-right" id="bookComplete">Next</a>
	                  	</div>
						<!-- /.form group -->
					</div>
				</div>
			</div>
			
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
     	return $content;
    }
    
    public function getStoreScripts()
    {
    	ob_start();
    	?>
		<link href="/css/uploadfile.css" rel="stylesheet">
		<script src="/js/jquery.uploadfile.min.js"></script>
		<script src="/js/stores.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getStoreHead()
    {
    	ob_start();
    	?>
    	<link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
    	<link rel="stylesheet" href="/plugins/select2/select2.min.css">
    	<link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getStoreContent()
    {
    	ob_start();
    	?>
    	<input type="hidden" id="storeId" value="<?php echo $this->data['storeInfo']['store_id']; ?>">
    	
    	<div class="row">
			<div class="col-md-12">
				<!-- Widget: user widget style 1 -->
				<div class="box box-widget widget-user-2">
				
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-aqua-active">
						<h3 class="widget-user-username"><strong><?php echo $this->data['storeInfo']['store']; ?></strong></h3>
						<div class="clearfix"></div>
					</div>
				</div><!-- /.widget-user -->
			</div>
    	</div>
    	
		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs (Pulled to the right) -->
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
						<li class="pull-left header"><i class="fa fa-th"></i>Sliders</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_3-2">
							<div class="row">
								
								<div class="col-sm-12">
									<p>Slider size: 1920 * 670 px</p>
									<div class="col-sm-6" id="uploadSliders">
										Browse
									</div>
								</div>
							</div>
							
							<div class="row sliders-box" id="sliderBox">
							<?php 
							if ($this->data['sliders'])
							{
								foreach ($this->data['sliders'] as $slider)
								{
									?>
								<div class="col-lg-5 col-md-12 slider">
									<div class="marker-img">
										<img src="/images/sliders/medium/<?php echo $slider['slider']; ?>" class="img-responsive" />
									</div>
									<div class="box-body">
										<div class="form-group">
											<label for="exampleInputEmail1">Titulo</label>
											<input type="text" class="form-control" id="title-<?php echo $slider['slider_id']; ?>" placeholder="titulo ..." value="<?php echo $slider['title_slider']; ?>" >
										</div>
										
										<div class="form-group">
											<label for="exampleInputEmail1">Contenido</label>
											<input type="text" class="form-control" id="content-<?php echo $slider['slider_id']; ?>" placeholder="contenido ..." value="<?php echo $slider['content_slider']; ?>" >
										</div>
										
										<div class="form-group">
											<label for="exampleInputEmail1">URL</label>
											<input type="text" class="form-control" id="url-<?php echo $slider['slider_id']; ?>" placeholder="url ..." value="<?php echo $slider['url_slider']; ?>" >
										</div>
										
				                        <div class="box-footer">
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-danger pull-right btn-sm delete-slider" slider-id="<?php echo $slider['slider_id']; ?>">Eliminar</button>
													<button type="submit" class="btn btn-info pull-right btn-sm update-slider" slider-id="<?php echo $slider['slider_id']; ?>">Guardar</button>
												</div>
											</div>
						                    
					                  	</div>
									</div>
								</div>
									<?php
								}
							}
							?>
							</div>
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
			</div><!-- /.col -->
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getDistribuidoresHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getDistribuidoresScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src="/js/places.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getDistribuidoresContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs (Pulled to the right) -->
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
						<li class="pull-left header"><i class="fa fa-th"></i>Lugares</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_3-2">
							<div class="row sliders-box" >
								<div class="col-lg-11 col-md-11 slider">
									<div class="box-body">
										<div class="form-group">
											<input type="text" class="form-control" id="placeName" placeholder="Lugar" value="" >
										</div>
										
				                        <div class="box-footer">
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-info pull-right btn-sm" id="addPlace">Añadir</button>
												</div>
											</div>
						                    
					                  	</div>
									</div>
								</div>
							</div>
							
							<?php 
// 							var_dump($this->data['places']);
							if ($this->data['places'])
							{
								foreach ($this->data['places'] as $place)
								{
									?>
							<div class="row sliders-box">
								<div class="place-name ">
									<h3><?php echo $place['place']; ?> / <a href="#" class="delete-place" place-id="<?php echo $place['place_id']; ?>">eliminar</a></h3>
								</div>
								
								<div class="col-lg-3 col-md-5 slider">
									<div class="box-body">
										<div class="form-group">
											<label for="">Titulo</label>
											<input type="text" class="form-control" placeholder="titulo " value="" id="subTitle-<?php echo $place['place_id']; ?>" >
										</div>
										
										<div class="form-group">
											<textarea class="form-control" rows="7" placeholder="subsecci&oacute;n " id="subContent-<?php echo $place['place_id']; ?>"></textarea>
										</div>

				                        <div class="box-footer">
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-info pull-right btn-sm add-sub" place-id="<?php echo $place['place_id']; ?>">Añadir</button>
												</div>
											</div>
					                  	</div>
									</div>
								</div>
								<!-- Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Edit</h4>
											</div>
											<div class="modal-body" id="subEditInfo">
												
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
												<button type="button" class="btn btn-primary" id="editSubBtn">Guardar</button>
											</div>
										</div>
									</div>
								</div>
								<div id="subBox<?php echo $place['place_id']; ?>">
									<?php 
									if ($place['subs'])
									{
										foreach ($place['subs'] as $sub)
										{
											?>
									<div class="col-lg-3 col-md-5 sub-item" id="sub-item-<?php echo $sub['subplace_id']; ?>">
										<div class="box-body">
											<div class="sub-content-box">
												<div class="form-group">
													<label for="exampleInputEmail1"><?php echo $sub['place_title']; ?></label>
												</div>
												
												<div class="form-group">
													<?php echo nl2br($sub['place_content']); ?>
												</div>
											</div>
					                        <div class="box-footer">
												<div class="row">
													<div class="col-md-12">
														<button type="submit" class="btn btn-danger pull-right btn-xs delete-sub" sub-id="<?php echo $sub['subplace_id']; ?>">Eliminar</button>
														<button type="submit" class="btn btn-info pull-left btn-xs edit-sub" sub-id="<?php echo $sub['subplace_id']; ?>" data-toggle="modal" data-target="#myModal">Editar</button>
													</div>
												</div>
						                  	</div>
										</div>
									</div>
											<?php
											
										}
											
									}
									?>
								</div>
								
						</div><!-- /.tab-pane -->
						<?php
								}
							}
							?>
						
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
			</div><!-- /.col -->
		</div>
		
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getSectionHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getSectionScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src=""></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getSectionContent()
    {
    	ob_start();
    	?>

        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
   	
   	/**
   	 * The very awesome footer!
   	 * 
   	 * <s>useless</s>
   	 * 
   	 * @return string
   	 */
    public function getFooter()
    {
    	ob_start();
    	?>
		<!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                Kliponads
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2016 <a href="#"><?php echo $this->data['appInfo']['siteName']; ?></a>.</strong> All rights reserved.
        </footer>
    	<?php
    	$footer = ob_get_contents();
    	ob_end_clean();
    	return $footer;
	}
}