$("#promotions-create").validate({
            ignore: "input[type='text']:hidden",
            rules: {
                name:{
                        required: true,
                        maxlength: 50
                    },
                code:{
                        maxlength: 50
                    },
                type:{
                      required: true
                  },
                discount:{
                      required: true,
                      number:true,
                      maxlength:10,
                },
                uses_total:{
                   number:true,
                   maxlength:10,
                },
                date_start:{
                    required:true,
                },
                date_end:{
                    required:true,
                }

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
var cats=[];
var products=[];
$('#cats_list option:selected').each(function(i,value){
    var cat_id=$(value).val();
    cats.push(cat_id);
});
$('#costumes option:selected').each(function(i,value){
    var costume_id=$(value).val();
    products.push(costume_id);
});
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
	$('#costumes').append('<option value='+product_id+'>'+sku_no+'-'+product_name+'</option>')
	$('#products_list').val("");
	}
});
$(document).on('click','.remove_cost',function(){
	var product_id=$(this).attr('data-cost-id');
	products.splice( $.inArray(product_id, products), 1 );
	$(this).parent().remove();
})
$('#date_start').datetimepicker({format: 'MM/DD/YYYY'});
$('#date_end').datetimepicker({format: 'MM/DD/YYYY'});

        $("#date_start").on("dp.change", function (e) {
            $('#date_end').data("DateTimePicker").minDate(e.date);
        });
        $("#date_end").on("dp.change", function (e) {
          //$('.from_date').data("DateTimePicker").maxDate(e.date);
        });


$(document).on('click','.remove_product',function(){
  var product_id=$('#costumes option:selected').val();
  products.splice( $.inArray(product_id, products), 1 );
  $('#costumes option:selected').remove();
});
$(document).on('click','.add_cat',function(){
    var cat_id=$('#cats option:selected').val();
    if(jQuery.inArray(cat_id,cats)==-1 || cats.length==0){
       cats.push(cat_id);
    $.ajax({
          url: '/getSelectedCategories/'+cat_id,
          dataType: "json",
          success: function (data) {
            $.each(data,function(i,value){
              cats.push(value.category_id);
              if(value.parent_id!="0"){
                $('#cats_list').append('<option value='+value.category_id+'>'+value.parent_cat+' -> '+value.sub_cat+'</option>');
              }
              else{
               $('#cats_list').append('<option value='+value.category_id+'>'+value.name+'</option>'); 
              }
            })
          },
      });
    }
});
$(document).on('click','.remove_cat',function(){
  var cat_id=$('#cats_list option:selected').val();
  cats.splice( $.inArray(cat_id, cats), 1 );
  $('#cats_list option:selected').remove();
});

$(document).on('click','.submit',function(){
  $('#cats_list option').prop('selected', true);
  $('#costumes option').prop('selected', true);
  $('#promotions-create').submit();
});

$(document).on('change','input[name="type"]',function(){
  var type=$(this).val();
  if(type=="free"){
    $('.disc').hide();
    $('#discount').val(0);
  }else{
    $('.disc').show();
  }
});

