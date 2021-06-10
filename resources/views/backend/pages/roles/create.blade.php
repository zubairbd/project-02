@extends('layouts.backend-master')
@push('styles')
<link rel="stylesheet" href="{{asset('backend')}}/assets/css/lib/chosen/chosen.min.css">
@endpush
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
                            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li><a href="#">Roles</a></li>
                            <li class="active">Roles Create</li>
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
            <div class="col-lg-8 col-md-offset-2">
                @include('backend.partials.messages')
                <div class="card">
                    <div class="card-header">
                        <strong>Roles Create</strong> Form
                    </div>
                    <form action="{{route('roles.store')}}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="has-success form-group">
                                <label for="inputSuccess2i" class=" form-control-label">Role Name</label>
                                <input type="text" name="name" id="name" class="form-control-success form-control">
                            </div>
                    
                            <div class="row form-group">
                                <label class=" form-control-label">Permissions</label>
                                <div class="col col-md-3">
                                   
                                </div>
                                
                                <div class="col col-md-9">
                                    <div class="form-check">
                                                                               
                                        @foreach ($permission_groups as $group)
                                            
                                        @endforeach

                                        @foreach ($permissions as $permission)
                                        <div class="checkbox">
                                            <label for="checkbox{{$permission->id}}" class="form-check-label ">
                                                <input type="checkbox" id="checkbox{{$permission->id}}" name="permissions[]" value="{{$permission->name}}" class="form-check-input">{{$permission->name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label">Permissions</label>
                                </div>
                                
                                <div class="col col-md-9">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <input type="checkbox" name="permissions[]" id="checkPermissionAll" value="1" class="form-check-input">  
                                            <label for="checkPermissionAll" class="form-check-label "> All</label>
                                    </div>
                                    <hr>                                 
                                        @foreach ($permission_groups as $group)
                                            
                                        @endforeach

                                        @foreach ($permissions as $permission)
                                        <div class="checkbox">
                                            <label for="checkbox{{$permission->id}}" class="form-check-label ">
                                                <input type="checkbox" id="checkbox{{$permission->id}}" name="permissions[]" value="{{$permission->name}}" class="form-check-input">{{$permission->name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
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
@push('scripts')
{{-- <script src="{{asset('backend')}}/assets/js/lib/chosen/chosen.jquery.min.js"></script> --}}
<script>
    $("#checkPermissionAll").click(function() { 
        if($(this).is(':checked')){
            //check all the check box
            $('input[type=checkbox]').prop('checked', true);
        }else{
            // un check all the check box
            $('input[type=checkbox]').prop('checked', false);
        }
        
    });
</script>
    
@endpush


