@extends('layouts.backend-master')
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
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Table</a></li>
                            <li class="active">Data table</li>
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
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        -
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


@stop
@push('scripts')
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
@endpush