$("#category-create").validate({
            rules: {
                name:{
                        required: true,
                        maxlength: 50
                    },
                desc:{
                        required: true,
                        maxlength: 200
                    },
                cat_image:{
                        required: true
                    },
                 banner_image:{
                        required: true
                    },
                }
 	
        });
 $.ajax({
    url: '/getCostumesList',
    dataType: "json",
    success: function (data) {
        items = [];
        map = {};
        $.each(data, function (i, item) {
		    var id = item.costume_id;
            var name = item.name;
            data = { value: id, label: name };
            items.push(data);
        });
        console.log(items);
        costumes(items);
    },
    
});
 function costumes(items){
    $( "#products_list" ).autocomplete({
	   source: items,
	   autoFocus:true,
  		select: function(event, ui) {
                event.preventDefault();
                // $("#searchitems").val(ui.item.label);
                // $('#searchitemvalue').val(ui.item.value);
                // window.location="#"; //location to go when you select an item
              //  alert(ui.item.value);
              $('input[name="products_list"]').val(ui.item.label);
              $('#products_id').val(ui.item.value);
            }
	});
 }
// $(function () {
//         $('#products_list').typeahead({
//             hint: true,
//             highlight: true,
//             minLength: 1
//             ,source: function (request, response) {
//             	var assigned_products=$('.assigned-products').val();
//             	console.log(assigned_products);
//                 $.ajax({
//                     url: '/getCostumesList',
//                     data: "{ 'prefix': '" + request + "'}",
//                     dataType: "json",
//                     contentType: "application/json; charset=utf-8",
//                     success: function (data) {
//                         items = [];
//                         map = {};
//                         $.each(data, function (i, item) {
//                 		    var id = item.costume_id;
//                             var name = item.name;
//                             map[name] = { id: id, name: name };
//                             items.push(name);
//                         });
//                         response(items);
//                         $(".dropdown-menu").css("height", "auto");
//                     },
//                     error: function (response) {
//                         alert(response.responseText);
//                     },
//                     failure: function (response) {
//                         alert(response.responseText);
//                     }
//                 });
//             }
//         });
 var products=[];
$('.add-prod').click(function(){
	var product_name=$('input[name="products_list"]').val();
	var product_id=$('#products_id').val();
	if(jQuery.inArray(product_id,products)==-1 || products.length==0){
	products.push(product_id);
	$('.assigned-products').append('<li><input type="hidden" value="'+product_id+'" name="costume_list[]"/>'+product_name+'<a href="javascript::void(0);" class="remove_cost"  data-cost-id='+product_id+'><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>')
	$('#products_list').val("");
	}
});
$(document).on('click','.remove_cost',function(){
	var product_id=$(this).attr('data-cost-id');
	products.splice( $.inArray(product_id, products), 1 );
	$(this).parent().remove();
})
$( "ul.assigned-products" ).sortable({
	cursor: 'move',
    opacity: 0.6,
    start: function(event, ui) {
        ui.item.startPos = ui.item.index();
    },
    stop: function(event, ui) {
    	var new_position=ui.item.index();
	   	var old_position= ui.item.startPos;
	   	var task_id=$(ui.item).attr('data-task-id');
	   	var limit=$('input[name="type"]').val();
		$.ajax({
           	        url: "/ticket/task/position/update",
           	        method:"POST",
           	        data:{new_position:new_position,old_position:old_position,oservice_id:oservice_id,task_id:task_id,limit:limit,_token:_token},
           	 		async: true,
           	        success: function( response ) {
           	        	tasks_success_ajax(response);
           	        }
           	});
      }
});
 // $( "ul.assigned-products" ).sortable({
 //    cursor: 'move',
 //    opacity: 0.6});
           

    