<a href="/" class="logo">iSILK</a>

<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i>
                    <span>{{ Auth::user()->name }} <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header bg-navy">
                        {{ HTML::image('assets/img/avatar3.png', 'User Avatar', array('class' => 'img-circle')) }}
                        <p>
                            {{ Auth::user()->employee->name }}
                            @if(Auth::user()->role == 'Admin')
                                <small>Super User</small>
                            @else
                                <small>User</small>
                            @endif
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            
                        </div>
                        <div class="pull-right">
                            <a href="{{ URL::to('logout') }}" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>