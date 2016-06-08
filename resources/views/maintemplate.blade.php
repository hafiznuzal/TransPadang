<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - Ace Admin</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}"/>
		<link rel="stylesheet" href="{{ url('font-awesome/4.2.0/css/font-awesome.min.css') }}"/>

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ url('fonts/fonts.googleapis.com.css') }}"/>

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ url('css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{{ url('css/map-resopnsive.css') }}">

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->
		@yield('css')

		<!-- ace settings handler -->
		<script src="{{ url('js/ace-extra.min.js') }}"></script>
		
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default">

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Sistem Informasi Trans Padang
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						
					
<!-- 
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									Jason
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="#">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li> -->
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">

			<div id="sidebar" class="sidebar responsive">

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-location-arrow"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-info"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-clock-o"></i>
						</button>

						<!-- <button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button> -->
					</div>

					<!-- <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div> -->
				</div><!-- /.sidebar-shortcuts -->
					<div class="setActive">
				<ul class="nav nav-list">
					<li {{Request::is('/index*') ? 'class="active"' : '' }}>
						<a href="{{ URL::to('/halte_form') }}">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<!-- <li {{ Request::is('/koridor*') ? 'class="active"' : '' }}>
						<a href="{{ URL::to('/koridor') }}">
							<i class="menu-icon fa fa-info"></i>
							<span class="menu-text"> Informasi Koridor </span>
						</a>

						<b class="arrow"></b>

					</li> -->

					<li {{Request::is('/index*') ? 'class="active"' : '' }}>
						<a href="{{ URL::to('/index') }}" class="dropdown-toggle">
							<i class="menu-icon fa fa-info"></i>
							<span class="menu-text"> Informasi Koridor </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="{{ URL::to('/k_all') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Semua Koridor
								</a>

								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="{{ URL::to('/k1') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Koridor 1
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{ URL::to('/k2') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Koridor 2
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{ URL::to('/k3') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Koridor 3
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{ URL::to('/k5') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Koridor 5
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="{{ URL::to('/k6') }}">
									<i class="menu-icon fa fa-caret-right"></i>
									Koridor 6
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>

					<!-- <li {{ Request::is('/jadwal*') ? 'class="active"' : '' }}>
						<a href="{{ URL::to('/jadwal') }}">
							<i class="menu-icon fa fa-clock-o"></i>
							<span class="menu-text"> Jadwal </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li {{ Request::is('/test*') ? 'class="active"' : '' }}>
						<a href="{{ URL::to('/test') }}">
							<i class="menu-icon fa fa-clock-o"></i>
							<span class="menu-text"> Test </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li {{ Request::is('/ungroup*') ? 'class="active"' : '' }}>
						<a href="{{ URL::to('/ungroup') }}">
							<i class="menu-icon fa fa-clock-o"></i>
							<span class="menu-text"> Ungroup </span>
						</a>

						<b class="arrow"></b>
					</li> -->

</div>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							@yield('breadcrumb')
						</ul><!-- /.breadcrumb -->

					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								@yield('page-header')
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								@yield('content')
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{url('js/jquery.2.1.1.min.js')}}"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='{{ url('js/jquery.min.js')}}'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{ url('js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
		</script>
		<script src="{{ url('js/bootstrap.min.js')}}"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="{{ url('js/jquery-ui.custom.min.js')}}"></script>
		<script src="{{ url('js/jquery.ui.touch-punch.min.js')}}"></script>
		<script src="{{ url('js/jquery.easypiechart.min.js')}}"></script>
		<script src="{{ url('js/jquery.sparkline.min.js')}}"></script>
		<script src="{{ url('js/jquery.flot.min.js')}}"></script>
		<script src="{{ url('js/jquery.flot.pie.min.js')}}"></script>
		<script src="{{ url('js/jquery.flot.resize.min.js')}}"></script>

		<!-- ace scripts -->
		<script src="{{ url('js/ace-elements.min.js')}}"></script>
		<script src="{{ url('js/ace.min.js')}}"></script>

		<script>
	  $(document).ready(function () {
    $('.nav li').click(function(e) {

        $('.nav li').removeClass('active');

        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
       // e.preventDefault();
    });
});

		</script>

		@yield('js')
	</body>
</html>
