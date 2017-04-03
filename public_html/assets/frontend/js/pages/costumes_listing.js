$(function() {
	 $( "#price-range" ).slider({
		range: true,
		min: 0,
		max: 1000,
		values: [ 0, 1000],
		slide: function( event, ui ) {
			$( "#amount2" ).val( +ui.values[ 0 ] + "-" +ui.values[ 1 ] );
			$(".price_min").html('$'+ui.values[ 0 ]);$(".price_max").html('$'+ui.values[ 1 ]);
		},
		change: function(event, ui) {
			var search=$('#search_list').serializeArray();
			searching(search);
		}
	});
    

function pagination()
{
  $("ul.holder").jPages({
        containerID  : "itemContainer",
        perPage      : 4,
        startPage    : 1,
        startRange   : 1,
        midRange     : 5,
        endRange     : 1,
        previous    : "Previous",
        next        : "Next",
    });

}
var search=$('#search_list').serializeArray();
searching(search);
$(document).on('change','.search',function(){
	var search=$('#search_list').serializeArray();
	searching(search);
})
$(document).on('click','.gender > li',function(){
	$('.gender li').removeClass('active');
	$(this).addClass('active');
	var gender=$(this).attr('data-gender');
	$('input[name="search[gender]"').val(gender);
	var search=$('#search_list').serializeArray();
	searching(search);
})
$(document).on('click','.sizes > li',function(){
	if(!$(this).hasClass('active')){
		$(this).addClass('active');
	}else{
		$(this).removeClass('active');
	}
	var sizes=[];
	$('.sizes > li' ).each(function( index,value ) {
		if($(this).hasClass('active')){
			sizes.push("'"+$(this).attr('data-size')+"'");			
		}
	});

	$('input[name="search[sizes]"').val(sizes);
	 var search=$('#search_list').serializeArray();
	 searching(search);
})
$(document).on('click','.search',function(){
	var search=$('#search_list').serializeArray();
	searching(search);
})
$(document).on('change','.sort_by',function(){
	var search=$('#search_list').serializeArray();
	searching(search);
})
function searching(search=null){
	var filter=$('#search_list').serializeArray();
	var res="";
	var cat_id=$('input[name="cat_id"]').val();
	var parent_cat_name=$('input[name="parent_cat_name"]').val();
	var sub_cat_name=$('input[name="sub_cat_name"]').val();
	var is_login=$('input[name="is_login"]').val();
	$("#itemContainer").html("");
	$("#itemContainer").addClass("search_icn_load");
	if(search!=null){
		filter=search;
	}else{
		filter="";
	}
		$.ajax({
			type: 'POST',
			url: '/getCostumesData',
			data: filter,
			success: function(response){
				if(response.data.costumes.length!=0){
					　$.each(response.data.costumes,function(index, value) {
						if(value.image!=null){
							var src="/costumers_images/Medium/"+value.image;
						}else{
							var src="/costumers_images/default-placeholder.jpg";
						}
						if(is_login){
							var like='<a href="javascript::void(0)" class="like_costume" data-costume-id='+value.id+'><span><i aria-hidden=true class="fa fa-thumbs-up"></i>'+value.like_count+'</span></a>';
						}else{
							var like='<a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden=true class="fa fa-thumbs-up"></i>'+value.like_count+'</span></a>';
						}
						res+='<div class="col-md-3 col-sm-4 col-xs-6"><div class=prod_box><div class=img_layer><a href="/shop/'+cat_id+'/'+parent_cat_name+'/'+sub_cat_name+'/'+value.name+'"><img class=img-responsive src='+src+'/></a><div class=hover_box><p class=like_fav>'+like+'<span><i aria-hidden=true class="fa fa-heart-o"></i></span><p class=hover_crt><i aria-hidden=true class="fa fa-shopping-cart"></i> Add to Cart</div></div><div class=slider_cnt><h4>'+value.name+'</h4><p>'+value.price+'</div></div></div>';
				    });
					$(".pagination").show();
					$("#itemContainer").append(res);
					pagination();
				}else{
					var list=$('#itemContainer').html().length;
					$("ul.holder").empty();
					$('#counting').html('')
				    res='<div class="col-sm-12 col-md-6"><div class="caption">Sorry, we could not find any coustumes</div></div>';
				    $("#itemContainer").html(res);
				 }
			},
		     complete: function(jqXHR, textStatus) {
		    	 $("#itemContainer").removeClass("search_icn_load");
		      },

		});
}
$(document).on('click','.like_costume',function(){
	var costume_id=$(this).attr('data-costume-id');
	$.ajax({
			type: 'POST',
			url: '/costume/like',
			data: {costume_id:costume_id},
			success: function(response){
				var search=$('#search_list').serializeArray();
				searching(search);
				ohSnap('Oh Snap! You can\'t access this page!', {'color':'red'});
			},
		     complete: function(jqXHR, textStatus) {
		    	 $("#itemContainer").removeClass("search_icn_load");
		      },

		});
})

});
