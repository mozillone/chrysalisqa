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
		max: 10000,
		values: [ 0, 10000],
		slide: function( event, ui ) {
			$( "#amount2" ).val( +ui.values[ 0 ] + "-" +ui.values[ 1 ] );
			$(".price_min").html('$'+ui.values[ 0 ]);$(".price_max").html('$'+ui.values[ 1 ]);
		},
		change: function(event, ui) {
			var search=$('#search_list').serializeArray();
			searching(search);
		}
	});
    

var search=$('#search_list').serializeArray();
//searching(search);
$(document).on('click','.gender > li',function(){
	$('.gender li').removeClass('active');
	$(this).addClass('active');
	var gender=$(this).attr('data-gender');
	$('input[name="search[gender]"]').val(gender);
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

	$('input[name="search[sizes]"]').val(sizes);
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
});

$(document).on("click",".pagination li a",function(e)
{ 
       e.preventDefault();
     var anchor = $(this).attr('href');
     var queryString = anchor.split('?', 2)[1] || '';
     var id =  queryString.split('=',2)[1];
     $("#page").val(id);
     searching(search);
});

$(document).on("change",".per_page",function(e)
{ 
     e.preventDefault();
     var id = $(this).val();
     $("#perpage").val(id);
     searching(search);
});

function searching(search){
	var filter=$('#search_list').serializeArray();
	var res="";
	var cat_id=$('input[name="cat_id"]').val();
	var parent_cat_name=$('input[name="parent_cat_name"]').val();
	var sub_cat_name=$('input[name="sub_cat_name"]').val();
	var is_login=$('input[name="is_login"]').val();
	$("#itemContainer").html("");
	$("#itemContainer").addClass("search_icn_load");
	var search=$('#search_list').serializeArray();
	if(search!=null){
		filter=search;
	}else{
		//filter="";
	}
	  var url = $("#search_list").attr('action');
	  
		$.ajax({
			type: 'POST',
			url: url,
			data: filter,
			success: function(response){
				console.log(response);
			    $("#search-container").html(response);
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
