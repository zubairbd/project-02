@extends('layouts.backend-master')

@section('title')
User Create - Admin Panel
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

    .active > a:hover {
	color: #03a9f3;
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
                        <h1>Roles Create</h1>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li><a href="{{route('admin.users.index')}}">All User</a></li>
                            <li class="active">User Create</li>
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
                            <a href="{{route('admin.users.index')}}" class="btn btn-primary btn-sm"><i class="fa fas-"></i>&nbsp; All Users</a>
                        </p>
                    </div>
                    <form action="{{route('admin.users.store')}}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-6">
                                    <label for="name" class=" form-control-label">User Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Your User Name">
                                </div>
                                <div class="col col-md-6">
                                    <label for="email" class=" form-control-label">User Email</label>
                                    <input type="text" name="email" class="form-control"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-6">
                                    <label for="password" class=" form-control-label">Password</label>
                                    <input type="password" name="password" class="form-control"></div>
                                <div class="col col-md-6">
                                    <label for="password_confirmation" class=" form-control-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"></div>
                            </div>
                               

                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="password" class=" form-control-label">Role Asign</label>
                                
                                    <select name="roles[]" id="roles" data-placeholder="Choose a role..." multiple class="standardSelect">
                                        <option value="" label="default"></option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-secondary btn-sm">Save User</button>
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
<script src="{{asset('backend')}}/assets/js/lib/chosen/chosen.jquery.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>
    
@endsection

