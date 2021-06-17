@extends('layouts.backend-master')

@section('title')
Role Edit - Admin Panel
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend')}}/assets/css/lib/chosen/chosen.min.css">
@endpush
@section('styles')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
    .col {
	margin-bottom: 15px;
    }
    .ml-10{
        margin-left: 10%;
    }
</style>
@endsection

@section('backend-content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Role Edit</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li><a href="{{route('admin.roles.index')}}">All Roles</a></li>
                            <li class="active">Role Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">


        <div class="row">
            <div class="col-lg-10 ml-10">
                @include('backend.partials.messages')
                <div class="card">
                    <div class="card-header">
                        <strong>Roles Create</strong> Form
                        <p class="float-right m-0">
                            <a href="{{route('admin.roles.index')}}" class="btn btn-primary btn-sm"><i class="fa fas-"></i>&nbsp; All Role</a>
                        </p>
                    </div>
                    <form action="{{route('admin.roles.update', $role->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body card-block">
                            <div class="has-success form-group">
                                <label for="inputSuccess2i" class=" form-control-label">Role Name</label>
                                <input type="text" name="name" value="{{$role->name}}" id="name" class="form-control-success form-control">
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Permissions</label>
                                <div class="form-check">
                                    <div class="checkbox">
                                        <input type="checkbox" name="permissions[]" id="checkPermissionAll" value="1" class="form-check-input" {{ App\Models\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>  
                                        <label for="checkPermissionAll" class="form-check-label "> All</label>
                                </div>
                            </div>
                            <hr> 
                            
                            <div class="row">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($permission_groups as $group)
                                @php
                                $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                
                                $j = 1;
                                @endphp
                                <div class="col col-md-3">
                                    <div class="form-check">
                                   
                                        <input type="checkbox" id="{{ $i }}Management" value="{{$group->name}}" class="form-check-input" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                        <label for="checkPermission" class="form-check-label ">{{$group->name}}</label>
                                    
                                </div>
                                </div>
                                <div class="col col-md-9 role-{{$i}}-management-checkbox">
                                   
                                    @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <label for="checkPermission{{$permission->id}}" class="form-check-label ">
                                                <input type="checkbox" id="checkPermission{{$permission->id}}" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}} value="{{$permission->name}}" class="form-check-input">{{$permission->name}}
                                            </label>
                                        </div>
                                    </div>
                                         @php  $j++; @endphp
                                    @endforeach
                                </div>
                                    @php $i++; @endphp
                                @endforeach
                                
                            </div>
                               
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>


</div><!-- .animated -->

@endsection

@section('scripts')
{{-- <script src="{{asset('backend')}}/assets/js/lib/chosen/chosen.jquery.min.js"></script> --}}
@include('backend.pages.partials.scripts')
    
@endsection


