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
                        required: true,
                        extension: "png,jpg"
                    },
                 banner_image:{
                        required: true,
                        extension: "png,jpg"
                    },
                }
 	
        });
$("#category-edit").validate({
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
                       extension: "png,jpg"
                    },
                 banner_image:{
                        extension: "png,jpg"
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
            var sku_no = item.sku_no;
            var price = item.price;
            var cst_name = item.cst_name;
            data = { value: id, label: name, sku_no: sku_no,price: price,cst_name:cst_name };
            items.push(data);
        });
        costumes(items);
    },
    
});
 function costumes(items){
    $( "#products_list" ).autocomplete({
	   source: items,
	   autoFocus:true,
  		select: function(event, ui) {
                event.preventDefault();
              $('input[name="products_list"]').val(ui.item.label);
              $('#cst_name').val(ui.item.cst_name);
              $('#sku_no').val(ui.item.sku_no);
              $('#price').val(ui.item.price);
              $('#products_id').val(ui.item.value);
            }
	});
 }
var products=[];
$('.costume_id').each(function(i,v){
	products.push($(this).val());
});
$('.add-prod').click(function(){
	var product_name=$('#cst_name').val();
	var sku_no=$('#sku_no').val();
	var price=$('#price').val();
	var product_id=$('#products_id').val();
	if(jQuery.inArray(product_id,products)==-1 || products.length==0){
	products.push(product_id);
	$('.assigned-products').append('<tr><td><input type="hidden" value="'+product_id+'" name="costume_list[]"/>'+product_name+'</td><td>'+sku_no+'</td><td>$'+price+'</td><td><a href="javascript::void(0);" class="remove_cost"  data-cost-id='+product_id+'><i class="fa fa-trash-o" aria-hidden="true"></i></a></td></tr>')
	$('#products_list').val("");
	}
});
$(document).on('click','.remove_cost',function(){
	var product_id=$(this).attr('data-cost-id');
	products.splice( $.inArray(product_id, products), 1 );
	$(this).parent().remove();
})
$( "#reorder" ).sortable({
	items: "tr",
    cursor: 'move',
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
// $("#reorder").sortable({items: "tr",
// 	cursor: 'move',
//     opacity: 0.6,
//     start: function(event, ui) {
//         ui.item.startPos = ui.item.index();
//     },
//     stop: function(event, ui) {
//     	var new_position=ui.item.index();
// 	   	var old_position= ui.item.startPos;
// 	   	var task_id=$(ui.item).attr('data-task-id');
// 	   	var limit=$('input[name="type"]').val();
// 		$.ajax({
//            	        url: "/ticket/task/position/update",
//            	        method:"POST",
//            	        data:{new_position:new_position,old_position:old_position,oservice_id:oservice_id,task_id:task_id,limit:limit,_token:_token},
//            	 		async: true,
//            	        success: function( response ) {
//            	        	tasks_success_ajax(response);
//            	        }
//            	});
//       }
// });
$(document).on('change','#parent_id',function(){
	if($(this).val()){
		$('.costumes').removeClass('hide');
	}else{
		$('.costumes').addClass('hide');
	}
});
    