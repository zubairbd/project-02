@extends('layouts.backend-master')

@section('title')
Role All - Admin Panel
@endsection
@push('styles')
<link rel="stylesheet" href="{{asset('backend')}}/assets/css/lib/datatable/dataTables.bootstrap.min.css">  
@endpush

@section('backend-content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>All Roles</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="active">All Roles</li>
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

            <div class="col-md-12">
                @include('backend.partials.messages')
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Roles List</strong>
                        <p class="float-right m-0">
                            <a href="{{route('admin.roles.create')}}" class="btn btn-primary btn-sm"><i class="fa fas-"></i>&nbsp; Add Role</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Role Name</th>
                                    <th width="70%">Permissions</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @foreach ($role->permissions as $perm)
                                            <span class="badge badge-info mr-1">
                                                {{$perm->name}}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                        <a class="btn btn-danger btn-sm" href="{{ route('admin.roles.destroy', $role->id) }}"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                                Delete
                                            </a>
    
                                            <form id="delete-form-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                    
                                    </td>
                                </tr>
                                @endforeach                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->


@endsection

@section('scripts')

<script src="{{asset('backend')}}/assets/js/lib/data-table/datatables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="{{asset('backend')}}/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="{{asset('backend')}}/assets/js/lib/data-table/jszip.min.js"></script>
<script src="{{asset('backend')}}/assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="{{asset('backend')}}/assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="{{asset('backend')}}/assets/js/init/datatables-init.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
  } );
</script>
@endsection