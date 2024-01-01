	<!-- [ navigation menu ] start -->
<?php
    if(Auth::guard('admin')->user()){
        $name = Auth::guard('admin')->user()->name;
        $email = Auth::guard('admin')->user()->email;

        $dashboard = route('admin.dashboard');
        $task = route('employe.task.list');
    }else if(Auth::guard('employe')->user()){
        $name = Auth::guard('employe')->user()->name;
        $email = Auth::guard('employe')->user()->emp_email;

        $dashboard = route('employe.dashboard');
        $task = route('employe.task.list');

    }else{
        $name = '';
        $email = '';
        $dashboard = '';
        $task = '';
    }
    ?>
	<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div ">

				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="{{ asset('assets/images/user/avatar-2.jpg')}}" alt="User-Profile-Image">
						<div class="user-details">
							<span>{{ $name }}</span>
							<div id="more-details">{{ $email }}</div>
						</div>
					</div>
				</div>
				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item">
						<a href="{{ $dashboard }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item">
						<a href="{{route('employee.list')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Employee</span></a>
					</li>
                    <li class="nav-item">
						<a href="{{route('project.list')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Projects</span></a>
					</li>
                    <li class="nav-item">
						<a href="{{ $task }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Task</span></a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.notice') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Notice</span></a>
					</li>

				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
