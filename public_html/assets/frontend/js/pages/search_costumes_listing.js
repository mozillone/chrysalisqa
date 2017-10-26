function openNav() {
    document.getElementById("myfilter-sidenav").style.width = "80%";
    document.getElementById("main").style.marginLeft = "0px";
}

function closeNav() {
    document.getElementById("myfilter-sidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
$(document).on('change','#theams',function(){
	window.location.href = $(this).val();
});
$('.collapse').on('shown.bs.collapse', function(){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});	
$(function() {
	 $( "div#price-range" ).slider({
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
        perPage      : 12,
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
$(document).on('click','.mbl_sort',function(){
	if($(this).find('i').hasClass('fa-sort-amount-asc')){
		$(this).find('i').removeClass('fa-sort-amount-asc');
		$(this).find('i').addClass('fa-sort-amount-desc');
		$('input[name="search[mbl_sort]"').val('DESC');
	 	var search=$('#search_list').serializeArray();
	 	searching(search);
	}else{
		$(this).find('i').addClass('fa-sort-amount-asc');
		$(this).find('i').removeClass('fa-sort-amount-desc');
		$('input[name="search[mbl_sort]"').val('ASC');
	 	var search=$('#search_list').serializeArray();
	 	searching(search);
	}
})
function searching(search){
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
			url: '/getSearchCostumesData',
			data: filter,
			success: function(response){
				if(response.data.costumes.length!=0){
					　$.each(response.data.costumes,function(index, value) {
						var cst_len="";
						if(value.image!=null){
							var path='/costumers_images/Medium/'+value.image;
							if(fileExists(path)){
								var src=path;
							}else{
								var src="/costumers_images/default-placeholder.jpg";
							}
						}else{
							var src="/costumers_images/default-placeholder.jpg";
						}
						if(value.url_key!=null){
							var link=value.url_key;
						}else{
							var link="";
						}
						if(value.is_like=="1"){
							var is_like='class="active"';
						}else{
							var is_like=' ';
						}
						if(value.is_fav=="1"){
							var is_fav='class="active"';
							var icon='<i aria-hidden=true class="fa fa-heart"></i>';
						}else{
							var is_fav=' ';
							var icon='<i aria-hidden=true class="fa fa-heart-o"></i>';
						}
						if (value.created_user_group=="admin") {
							var cc_cos = '<img src="/img/chrysalis_brand.png"></span>';
						}else{
							var cc_cos = '';
							cst_len="no_brand";
						}
						if(value.created_user_group=="admin" && value.discount!=null && value.uses_customer<value.uses_total && now()>=value.date_start && now()<=value.date_end){
							var discount=(value.price/100)*value.discount;
							var new_price=value.price-discount;
							var price='<p><span class="old-price"><strike>$'+addCommas(value.price)+'</strike></span> <span class="new-price">$'+addCommas(new_price)+'</span></p>';
					
						}else{
							var price='<p><span class="new-price">$'+addCommas(value.price)+'</span></p>';
						}
						if(is_login){
							var like='<a href="#" onclick="return false;" class="like_costume" data-costume-id='+value.costume_id+'><span '+is_like+'><i aria-hidden=true class="fa fa-thumbs-up"></i>'+value.like_count+'</span></a>';
							var fav='<a href="#" onclick="return false;" class="fav_costume" data-costume-id='+value.costume_id+'><span '+is_fav+'>'+icon+'</span></a>';
						}else{
							var like='<a data-toggle="modal" data-target="#login_popup"><span><i aria-hidden=true class="fa fa-thumbs-up"></i>'+value.like_count+'</span></a>';
							var fav='<a data-toggle="modal" data-target="#login_popup"><span '+is_fav+'>'+icon+'</span></a>';
						}
						if(value.quantity>=1){
							var stock='<p class="hover_crt add-cart" data-costume-id="'+value.costume_id+'"><i aria-hidden=true class="fa fa-shopping-cart"></i> Add to Cart</p>';
						}else{
							var stock='<p class="hover_crt"><i aria-hidden=true class="fa fa-shopping-cart"></i> Out of stock</p>';
						}
						if(value.name.length<=30){
							var cst_name=value.name;
							cst_len+=" sml_name";
						}else{
							var cst_name=value.name.substr(0,30)+"...";
						}

						res+='<div class="col-md-3 col-sm-4 col-xs-6"><div class=prod_box><div class=img_layer><a href="/product'+link+'"  style="background-image:url('+src+');background-repeat:no-repeat;">&nbsp;</a><div class=hover_box><p class=like_fav>'+like+' '+fav+' '+stock+'</div></div><div class="slider_cnt  '+cst_len+'"><span class="cc_brand">'+cc_cos+'</span><h4><a href="/product'+link+'"</a>'+cst_name+'</h4>'+price+'</div></div></div>';
				    });
					$(".pagination").show();
					$("#itemContainer").append(res);
					pagination();
				}else{
					var list=$('#itemContainer').html().length;
					$("ul.holder").remove();
					$('#counting').html('')
				    res='<div class="col-sm-12 col-md-6"><div class="caption">Sorry, we could not find any costumes</div></div>';
				    $("#itemContainer").html(res);
				 }
			},
		     complete: function(jqXHR, textStatus) {
		    	 $("#itemContainer").removeClass("search_icn_load");
		      },

		});
}
function now()
{
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();

  var output =	 d.getFullYear()+'-'+(month<10 ? '0' : '') + month +"-"+(day<10 ? '0' : '') + day;

  return output;
}
  function fileExists(url) {
	    if(url){
	        var req = new XMLHttpRequest();
	        req.open('GET', url, false);
	        req.send();
	        return req.status==200;
	    } else {
	        return false;
	    }
	}
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return (x1 + x2);
}

});
