@php
     $usr = Auth::guard('admin')->user();
 @endphp

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{Route::is('admin.dashboard') ? 'active' : ''}}">
                    <a href="{{route('admin.dashboard')}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title">Settings</li><!-- /.menu-title -->

                @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))

                <li class="menu-item-has-children dropdown {{Route::is('admin.roles.index') || Route::is('admin.roles.create') || Route::is('admin.roles.edit') ? 'active show' : ''}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="menu-icon fa fa-cogs"></i>Roles & Permissions</a>
                    
                    <ul class="sub-menu children dropdown-menu {{Route::is('admin.roles.index') || Route::is('admin.roles.create') || Route::is('admin.roles.edit') ? 'in show' : ''}}">
                        
                        @if ($usr->can('role.view'))
                        <li class="{{Route::is('admin.roles.index') || Route::is('admin.roles.edit') ? 'current' : ''}}"><i class="fa fa-puzzle-piece"></i><a href="{{url('admin/roles')}}">All Roles</a></li>
                        @endif
                        
                        @if ($usr->can('role.create'))
                        <li class="{{Route::is('admin.roles.create') ? 'current' : ''}}"><i class="fa fa-id-badge"></i><a href="{{url('admin/roles/create')}}">Roles Create</a></li>
                        @endif
                    </ul>
                </li>
                @endif

                @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    
                <li class="menu-item-has-children dropdown {{Route::is('admins.admins.index') || Route::is('admin.admins.create') || Route::is('admin.admins.edit') ? 'active show' : ''}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="menu-icon fa fa-user-o"></i>Admins</a>
                    <ul class="sub-menu children dropdown-menu {{Route::is('admin.users.index') || Route::is('admin.admins.create') || Route::is('admin.admins.edit') ? 'in show' : ''}}">
                        @if($usr->can('admin.view'))
                            <li class="{{Route::is('admin.admins.index') || Route::is('admin.admins.edit') ? 'current' : ''}}"><i class="fa fa-puzzle-piece"></i><a href="{{url('admin/admins')}}">All Admins</a></li>
                        @endif
                        @if ($usr->can('admin.create'))
                            <li class="{{Route::is('admin.admins.create') ? 'current' : ''}}"><i class="fa fa-id-badge"></i><a href="{{url('admin/admins/create')}}">Admins Create</a></li>
                        @endif
                        </ul>
                </li>
                @endif

                @if ($usr->can('profile.create') || $usr->can('profile.view') ||  $usr->can('profile.edit') ||  $usr->can('profile.delete'))
                  
                <li class="menu-item-has-children dropdown {{Route::is('admin.users.index') || Route::is('admin.users.create') || Route::is('admin.users.edit') ? 'active show' : ''}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="menu-icon fa fa-users"></i>Users</a>
                    <ul class="sub-menu children dropdown-menu {{Route::is('admin.users.index') || Route::is('admin.users.create') || Route::is('admin.users.edit') ? 'in show' : ''}}">
                        
                    @if ($usr->can('profile.view'))
                        <li class="{{Route::is('admin.users.index') || Route::is('admin.users.edit') ? 'current' : ''}}"><i class="fa fa-puzzle-piece"></i><a href="{{url('admin/users')}}">All User</a></li>
                        
                    @endif  
                    @if ($usr->can('profile.create'))
                        <li class="{{Route::is('admin.users.create') ? 'current' : ''}}"><i class="fa fa-id-badge"></i><a href="{{url('admin/users/create')}}">Users Create</a></li>
                        
                    @endif
                       
                    </ul>
                </li>
               
                @endif
                
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>