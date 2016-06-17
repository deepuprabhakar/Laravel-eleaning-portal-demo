<header class="main-header">
  <!-- Logo -->
  <a href="{{ url('/') }}" class="logo">
    <span class="logo-mini"><b>CEL</b></span>
    <span class="logo-lg"><b>E-LEARNING</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            @if($count != 0)
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">{{ $count }}</span>
           @else
            <i class="fa fa-envelope-o"></i>
           @endif
            
          </a>
          <ul class="dropdown-menu">
            @if($count != 0)
            <li class="header">You have {{ $count }} new messages</li>
            @else
            <li class="header">No new messages</li>
            @endif
            <li>
              <!-- inner menu: contains the actual data -->
            @include('includes.topMessages')
            </li>
            @if($latest)

            @if(Sentinel::inRole('admin'))
             <li class="footer"><a href="{{ route('admin.messages.index') }}">See All Messages</a></li>
           @else
              <li class="footer"><a href="{{ route('messages.index') }}">See All Messages</a></li>
            @endif
            @else
            <li class="footer"></li>
            @endif
          </ul>
        </li>
        <!-- Notifications: style can be found in dropdown.less -->
        <!--<li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <!--<ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-users text-red"></i> 5 new members joined
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-user text-red"></i> You changed your username
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>-->
        <!-- Tasks: style can be found in dropdown.less -->
        <!--<li class="dropdown tasks-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-flag-o"></i>
            <span class="label label-danger">9</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 9 tasks</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <!--<ul class="menu">
                <li><!-- Task item -->
                  <!---<a href="#">
                    <h3>
                      Design some buttons
                      <small class="pull-right">20%</small>
                    </h3>
                    <div class="progress xs">
                      <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">20% Complete</span>
                      </div>
                    </div>
                  </a>
                </li><!-- end task item -->
                <!--<li><!-- Task item -->
                  <!--<a href="#">
                    <h3>
                      Create a nice theme
                      <small class="pull-right">40%</small>
                    </h3>
                    <div class="progress xs">
                      <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">40% Complete</span>
                      </div>
                    </div>
                  </a>
                </li><!-- end task item -->
                <!--<li><!-- Task item -->
                  <!--<a href="#">
                    <h3>
                      Some task I need to do
                      <small class="pull-right">60%</small>
                    </h3>
                    <div class="progress xs">
                      <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </a>
                </li><!-- end task item -->
                <!--<li><!-- Task item -->
                  <!--<a href="#">
                    <h3>
                      Make beautiful transitions
                      <small class="pull-right">80%</small>
                    </h3>
                    <div class="progress xs">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">80% Complete</span>
                      </div>
                    </div>
                  </a>
                </li><!-- end task item -->
              <!-- </ul>
            </li>
            <li class="footer">
              <a href="#">View all tasks</a>
            </li>
          </ul>
        </li>-->
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          
          @if(Sentinel::inRole('admin'))
            <img src="{{ asset('dist/img/default-160x160.jpg') }}" class="user-image header-profile-image" alt="User Image">
          
          @elseif(Sentinel::inRole('user'))
          
            @if($student->image != "")
              <img src="{{ asset('uploads/profile/'.$student->image) }}" class="user-image header-profile-image" alt="User Image">
            @else
              <img src="{{ asset('dist/img/default-160x160.jpg') }}" class="user-image header-profile-image" alt="User Image">
            @endif
          
          @endif

            <span class="hidden-xs">
              {{ ucwords(Sentinel::getUser()->first_name)}}
            </span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              @if(Sentinel::inRole('admin'))
                <img src="{{ asset('dist/img/default-160x160.jpg') }}" class="img-circle header-profile-image" alt="User Image">
              
              @elseif(Sentinel::inRole('user'))
              
                @if($student->image != "")
                  <img src="{{ asset('uploads/profile/'.$student->image) }}" class="img-circle header-profile-image" alt="User Image">
                @else
                  <img src="{{ asset('dist/img/default-160x160.jpg') }}" class="img-circle header-profile-image" alt="User Image">
                @endif
              
              @endif
              
              <p>
                {{ Sentinel::getUser()->first_name }}
                <small>Member since {{ Sentinel::getUser()->created_at->format('F, Y') }}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
            @if(Sentinel::inRole('user'))
              <div class="pull-left">
                <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
              </div>
            @else
              <div class="pull-right">
                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat btn-sx">Sign out</a>
              </div>
            @endif
              
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="/" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>