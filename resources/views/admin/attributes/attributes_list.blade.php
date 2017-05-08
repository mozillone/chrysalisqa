@extends('admin.app')

{{-- Web site Title --}}
@section('title')
Attributes List@parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
@stop

{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>Attributes</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Attributes List</li>
  </ol>
</section>
<section class="content" ng-controller="AttributesController">
    <div class="row">
        <div class="col-md-12">
         @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ Session::get('error') }}
                </div>
                @elseif(Session::has('success'))
                 <div class="alert alert-success alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{ Session::get('success') }}
                </div>
         @endif
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Attributes List</h3>
                    <div class="box-tools pull-right" style="display:inline-flex">
                    <a href="{{route('attributes-create')}}" class="btn btn-block btn-success btn-xs"><i class="fa fa-plus"></i> Add Attributes</a>
                    </div>
                </div>
                <div class="box-body">
			           <div class="table-responsive">
          					<table datatable dt-options="dtOptions" dt-columns="dtColumns"
                           				class="table table-bordered table-hover table-striped" id="dtTable">
          					</table>
					       </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
{{-- page level scripts --}}
@section('footer_scripts') 
<script src="{{ asset('/angular/Admin/Attributes/Controllers/attributes-lists.js') }}"></script>
<script src="{{ asset('/angular/Admin/Attributes/Services/attributes.js') }}"></script>
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
@stop
