@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent
@endsection

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('/assets/admin/vendors/AdminLTE-master/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/vendors/sweetalert/dist/sweetalert.css')}}">
@stop

{{-- Page content --}}
@section('content')
 <section class="content-header">
    <h1>Specialty Theme Categories</h1>
    <ol class="breadcrumb">
    <li>
        <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    <li class="active">Speciality Theme Categories</li>
  </ol>
</section>
<section class="content">
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
                    <h3 class="box-title">Specialty Themes Settings</h3>
                </div>
                
                 
                <div class="box-body">
        <div class="table-responsive">
               
               
        </div>
     
          <div class="table-responsive">
          <!-- <table datatable dt-options="dtOptions" dt-columns="dtColumns"
                        class="table table-bordered table-hover table-striped" id="dtTable">
          </table> -->
           <form name="update_priority_new" id="update_priority_new" method="post" action="/update_priority" >
              {{csrf_field()}}
          <table class="table table-bordered table-hover" id="tickets-table">
              <thead>
                  <tr>
                      <th>Category Name</th>
                      <th>Priority </th>
                    
                      
                     
                 </tr>
          </thead>
              <tbody>
                @foreach($categories as $category)
                 <tr>
                      <td>{{$category->name}}</td>
                     <input type="hidden" name="categoryid[]"   id="categoryid" class="form-control" style="width:30%" value="{{$category->id}}">
                      <td><input type="text" name="priority[]" id="priority" class="form-control priorities" style="width:30%" value="{{$category->priority}}"></td>
                     
                    
                     
                 </tr>
                 @endforeach
                 <tr>
                  <td></td>
                  <td  colspan="3"><input type="submit" name="submit" id="submit" value="Update Priority" class="btn btn-primary "></td>
                  </tr>
          </tbody>
        </table>
      </form>
          </div>
                </div>
            </div>
        </div>
    </div>
</section>


@stop


{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('/vendors/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/admin/js/pages/speciality_theme.js') }}"></script>
@stop