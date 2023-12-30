	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div ">

				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="{{ asset('assets/images/user/avatar-2.jpg')}}" alt="User-Profile-Image">
						<div class="user-details">
							<span>John Doe</span>
							<div id="more-details">UX Designer</div>
						</div>
					</div>
				</div>

				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Navigation</label>
					</li>
					<li class="nav-item">
						<a href="{{route('dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item pcoded-menu-caption">
						<label>Forms &amp; table</label>
					</li>
					<li class="nav-item">
						<a href="{{route('form')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Forms</span></a>
					</li>
					<li class="nav-item">
						<a href="{{route('bootstrap_table')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Bootstrap table</span></a>
					</li>

					<li class="nav-item pcoded-menu-caption">
						<label>Pages</label>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-lock"></i></span><span class="pcoded-mtext">Authentication</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{route('sign_up')}}" target="_blank">Sign up</a></li>
							<li><a href="{{route('sign_in')}}" target="_blank">Sign in</a></li>
						</ul>
					</li>
					<li class="nav-item"><a href="{{route('sample_page')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Sample page</span></a></li>

				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->