$(function() {

	function googleMapList(locations,listinginfo,start_page,offset_page)
	{
		var map;
	    var bounds = new google.maps.LatLngBounds();
	    var mapOptions = {
			//center:new google.maps.LatLng(40.7127837,-74.0059413),
	        //zoom:5,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		// Display a map on the page
	    map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
	    map.setTilt(45);
	    var gmarkers = [];
		var gicons = [];
		gicons["yelow"] = "/assets/img/marker_yellow.png";




	    if(locations==0)
		{
			var markers = [
			['London Eye, London', 51.503454,-0.119562]];
		}
		else
		{
	        var markers = locations;
	   }
		var listinginfodata=[];
		for( j = 0; j < listinginfo.length; j++ )
		{
			var listing='<div class="info_content">'+listinginfo[j][0]+'<h4>'+listinginfo[j][1]+'</h4>'+'<p>'+listinginfo[j][2]+'</p><p class="mp-prc"><span>From</span> $250.00 <span>/hr</span></p></div><div class="sp-triangle"></div>'
			listinginfodata.push(listing);
		}

		if(listinginfo==0)
		{
			var listing='No listings found';

			listinginfodata.push(listing);
		}
		var infoWindowContent = listinginfodata;


	    // Display multiple markers on a map
	    var infoWindow = new google.maps.InfoWindow(), marker, i;

	    // Loop through our array of markers & place each one on the map

		for( i = start_page; i < offset_page; i++ ) {

	  //  for( i = 0; i < markers.length; i++ ) {
			if(markers[i]!=undefined){
				var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

				bounds.extend(position);
		        if(locations==0){position='';}
		        marker = new google.maps.Marker({
		        	id:position,
		            position: position,
		            map: map,
		            title: markers[i][0],
		           // animation: google.maps.Animation.DROP,
		     	});
			    google.maps.event.addListener(marker, 'click', (function(marker, i) {
		        	return function() {
						infoWindow.setContent(infoWindowContent[i]);
		                infoWindow.open(map, marker);
					}
				})(marker, i));

		        // Automatically center the map fitting all markers on the screen
		   }
		    gmarkers.push(marker);
		}
		console.log(gmarkers);
$(document).on('mouseover',".list",function(){
	 var curent_pos=$(this).index();
	 var page=$('.jp-current').html();
	 if(page>1){page=page-1;}
	 if(curent_pos>3){

	 	var index=curent_pos-(page*4);
	 }else{
	 	var index=curent_pos;
	 }

	 gmarkers[index].setIcon(gicons["yelow"]);
});
$(document).on('mouseout',".list",function(){
	 var curent_pos=$(this).index();
	 var page=$('.jp-current').html();
	 if(page>1){page=page-1;}
	  if(curent_pos>3){
	 	var index=curent_pos-(page*4);
	 }else{
	 	var index=curent_pos;
	 }
	 gmarkers[index].setIcon(gicons["red"]);
});

	    map.setCenter(bounds.getCenter());
	    map.fitBounds(bounds);


	}
function getfaultMap(){
	 var myCenter = new google.maps.LatLng(0,0);
     var mapCanvas = document.getElementById("googleMap");
     var mapOptions = {center: myCenter};
     var map = new google.maps.Map(mapCanvas, mapOptions);
     var marker = new google.maps.Marker({position:myCenter});
     google.maps.event.addListener(marker);
}
function pagination(mapsearch,listinginfo)
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
        callback    : function( pages,items ){
        		var start_page=items.range.start;
        		var offset_page=items.range.end;
        		if(start_page!=1){
        			google.maps.event.addDomListener(window, 'change', googleMapList(mapsearch,listinginfo,start_page-1,offset_page));
        		}
        	$("#counting").html(items.range.start + " - " + items.range.end + " of " + items.count +" results ");
        }
    });

}
var search=$('#search_list').serializeArray();
searching(search);
$(document).on('change','.search',function(){
	var search=$('#search_list').serializeArray();
	//$("input[name='search[sort_by]'] option:first").attr('selected','selected');
	searching(search);
})
$(document).on('keypress','.keywords',function(e){
	 if (e.keyCode == 13) {
		 var search=$('#search_list').serializeArray();
		 searching(search);
	 }
})
$(document).on('click','.amenties',function(e){
	 var search=$('#search_list').serializeArray();
	 searching(search);
})
$(document).on('click','.styles',function(e){
	 var search=$('#search_list').serializeArray();
	 searching(search);
})
function searching(search=null){
	var filter=$( this).serializeArray();
	var resonse="";
	var locations=[];
	var listingdata = [];
	$("#itemContainer").html("");
	$("#itemContainer").addClass("search_icn_load");
	if(search!=null){
		filter=search;
	}else{
		filter="";
	}
		$.ajax({
			type: 'POST',
			url: '/searching',
			data: filter,
			success: function(response){
				if(response.data.listings.length!=0){
				　$.each(response.data.listings,function(index, value) {
					var img_slider="";
					if(value.filename!=null){
						var images=value.filename.split("&&&");
						var count="1";
						img_slider+='<div id="myCarousel'+value.rs_id+'" class="carousel slide" data-interval="false"><div class="carousel-inner">';
						if(images.length>1){
								$.each(images,function(i,v){
									if(count==1){
										var is_active="active";
									}
									else{
										var is_active="";
									}
									img_slider+='<div class="item '+is_active+'"><div class="fill" style="background-image:url(/uploads/listing_images/Banners/'+v+')"></div></div>';
									count++;
								});
							img_slider+='</div><div class="pull-center"><a class="carousel-control left" href="#myCarousel'+value.rs_id+'" data-slide="prev">‹</a><a class="carousel-control right" href="#myCarousel'+value.rs_id+'" data-slide="next">›</a></div></div>';
							var src=img_slider;
						}else{
							 var src='<img class="img-responsive" src="/uploads/listing_images/Banners/'+images+'"/>';
						}
					}else{
						 var src='<img class="img-responsive" src="/uploads/listing_images/default.png"/>';
					}

					if(value.rent_price_type=="1"){
						var price="<p class='price_neg'>Negotiable</p>"
					}else{
						if(value.rental_dur_type=="d"){var dur="day";}else{var dur="hour";}
						var price='<p>from <span> $'+value.rent_from+'</span>/ '+dur+'</p>';
					}

					if(value.listing_type=="entire"){
						var list_data='<span>Entire</span> '+value.available_space+' sq ft';
					}
					if(value.listing_type=="event"){
						var list_data='<span>Event</span> '+value.available_space+' sq ft';
					}
					if(value.listing_type=="popup"){
						var list_data='<span>Pop Up</span> '+value.available_space+' sq ft';
					}
					 if(value.rete_val){var avg_rate=value.rete_val;}else{var avg_rate=0;}
					 
                    resonse+='<div class="col-md-6 col-sm-6 col-xs-12 list" id="img_'+value.rs_id+'"><input type="hidden" value="'+value.lat+'" class="lat"/><input type="hidden" value="'+value.lng+'" class="lng"/> <div class="space-total-box"><div class="search-bx"><a href='+value.rs_id+'><a href="/list/'+value.rs_id+'">'+src+'</a></a></div><div class="space-content-box"><h4><a href="/list/'+value.rs_id+'">'+value.name+'</a></h4><p>'+value.state_name+', '+value.state_abbr+'</p><p class="titles">'+list_data+'</p><div class="row price-box"><div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><div class="rating_info" attr-user-id="'+value.rs_id+'" attr-rate="'+avg_rate+'"><div class="rateing_list'+value.rs_id+'"></div></div></div><div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">'+price+'</div></div></div></div></div>';
                    var locationData=[];
                	var states=value.city+','+value.state_name	;
                 	locationData.push(states);
                 	locationData.push(value.lat);
                 	locationData.push(value.lng);
					locations.push(locationData);
	             	var listing = [];
                 	if(value.filename!=null){
                 		var src='/uploads/listing_images/searching/'+value.filename+'';

                 	}else{
                 		var src='/uploads/listing_images/default.png';
                 	}
                	listing.push('<a href="/list/'+value.rs_id+'"><img class="img-responsive" data-src="holder.js/100%x200" alt="100%x200" src="'+src+'" data-holder-rendered="true" width="200px" height="300px"/></a>');
    				listing.push(value.name);
					listing.push(value.city);
					listingdata.push(listing);
				});
				$(".pagination").show();
				$("#itemContainer").append(resonse);
				var mapsearch=locations;
				var listinginfo=listingdata;
				var start_page=$('input[name="start_page"]').val();
				var offset_page=$('input[name="offset_page"]').val();
				pagination(mapsearch,listinginfo);
				google.maps.event.addDomListener(window, 'change', googleMapList(mapsearch,listinginfo,start_page,offset_page));
			}else{
				var list=$('#itemContainer').html().length;
				$("ul.holder").empty();
				$('#counting').html('')
                resonse='<div class="col-sm-12 col-md-6"><div class="caption">Sorry, we could not find any spaces Try expanding your criteria</div></div>';
                $("#itemContainer").html(resonse);
                getfaultMap();


			}
			
			$('.rating_info').each(function(){
	var attr_id=$(this).attr("attr-user-id");
	var rate_val=$(this).attr("attr-rate");
	if(attr_id){
	     $(".rateing_list"+attr_id).rateYo({
	        rating: rate_val,
	        starWidth: "14px",
	        readOnly: true,
	        numStars: 5,
	        halfStar: true
	    });
	}

}); 

			},
		     complete: function(jqXHR, textStatus) {
		    	 $("#itemContainer").removeClass("search_icn_load");
		      },

		});
}

$(document).on('click','ul.holder > a',function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});

$('[data-toggle="tooltip"]').tooltip();

});

$('#myCarousel').carousel({
 interval: 3000,
 cycle: true
});
