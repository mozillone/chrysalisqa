@extends('admin.app')

{{-- Web site Title --}}
@section('title') @parent

@endsection

{{-- page level styles --}}
@section('header_styles')




<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">



       
@stop

{{-- Page content --}}
@section('content')
<style>
.fileupload-new .btn-file {
   margin: 10px 0 0 20px;
}
</style>

<section class="content-header">
    <h1>Add Press Post</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            Press
        </li>
        <li class="active">Add Press Post</li>
    </ol>
    
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box box-primary">
                
                <div class="box-body">
                
                
                

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
                    <form id="customer_edit" class="form-horizontal defult-form" name="userForm" action="{{ route('insert-events') }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <div class="col-md-7">
                            <h2 class="heading-agent">Post Information</h2>
                                <div class="col-md-12">
                                    <div class="form-group has-feedback" >
                                        <label for="inputEmail3" class="control-label">Post Title<span class="req-field" >*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter Post Title"  name="postTitle" id="postTitle">
                                        <p class="error">{{ $errors->first('postTitle') }}</p> 
                                    </div>
                               
                                    
                                <div class="clearfix"></div>
                                    
                                <div>
                                <label for="inputEmail3" class="control-label">Post Description
        <span class="req-field" >*</span>
        </label>
                    <textarea id="summernote" name=postDesc></textarea>
                        <p class="error">{{ $errors->first('postDesc') }}</p> 
                                </div>


                                   

                                
                                      
                                </div>
                                </div>         
                                
                                <div class="col-md-3">
                            <h2 class="heading-agent">Settings</h2>
                                
                                <div class="col-md-12">
                              
                                <div class="form-group has-feedback" >
                                    <label for="inputEmail3" class="control-label">Status<span class="req-field" >*</span></label>
                                        <select class="form-control" id="sel1" name="state">
                                        <option value="Draft">Draft</option>
                                        
                                        <option value="Publish">Publish</option>
                                      
                                       </select>
                                    <p class="error">{{ $errors->first('state') }}</p> 
                                </div>
                                <div>
                                    Categories<br>
                                    <input type="checkbox" name="Categories[]" value="Category 1">Category 1<br>
                                    <input type="checkbox" name="Categories[]" value="Category 2">Category 2<br>
                                    <input type="checkbox" name="Categories[]" value="Category 3">Category 3<br>
                                    <input type="checkbox" name="Categories[]" value="Category 4">Category 4<br>
                                </div>

                            </div>
                        </div>
                         </div>   
                        
                       
                       
                        </div>
                        </div>
                   

                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>

                            <a href="/press-posts" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Cancel</a>
                        </div>
                    </div>
                     </div>

                </form>

            </div>
        </div>
    </div>
</section>





    @stop
    {{-- page level scripts --}}
    @section('footer_scripts')
    


<script src="{{ asset('/assets/admin/js/clockpicker.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
    


    
    

<script>
  $( function() {
    $( ".datepicker" ).datepicker({
      showOn: "button",
      buttonImage: "{{ asset('img/calendar.png') }}",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
  } );
  </script>

<!-- Time Picker -->
<script>
$('.clockpicker').clockpicker();
</script>


<!-- Summernote -->

<script type="text/javascript">
$(document).ready(function() {
$('#summernote').summernote({
height:300,
});
});
</script>


<!-- Google AutoComplete Places -->
<script>
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name',
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD7L6zG6Z8ws4mRa1l2eAhVPDViUX6id0&libraries=places&callback=initAutocomplete"
        async defer></script>


    <script type="text/javascript">
    $("#heightft,#heightin,#weightlbs,#chestin,#waistlbs,#dimensions").on("keyup", function(){
        var valid = /^\d{0,4}(\.\d{0,4})?$/.test(this.value),
            val = this.value;

        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#price,#charity_amount").on("keyup", function(){
        var valid = /^\d{0,20}(\.\d{0,20})?$/.test(this.value),
            val = this.value;

        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    </script>


    @stop
