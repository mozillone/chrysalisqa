  
  $(document).ready(function(){
      $(".tumblr_btn").click(function(){
        var url = $(this).find(".tumblr_url").val();
        var tumb_url = "https://www.tumblr.com/widgets/share/tool?content="+encodeURIComponent(url)+"&canonicalUrl="+encodeURIComponent(url)+"&shareSource=tumblr_share_button";
          window.open(tumb_url, 'Post to Tumblr', 'window settings');
      });
  });
  
  function statusChangeCallback(response) {
    //console.log('statusChangeCallback');
    //console.log(response);
    if (response.status === 'connected') {
      testAPI();

    } else if (response.status === 'not_authorized') {
      FB.login(function(response) {
        statusChangeCallback2(response);
      }, {scope: 'public_profile,email'});

    } else {
      //alert("not connected, not logged into facebook, we don't know");
    }
  }

  function statusChangeCallback2(response) {
    //console.log('statusChangeCallback2');
    //console.log(response);
    if (response.status === 'connected') {
      testAPI();

    } else if (response.status === 'not_authorized') {
      //console.log('still not authorized!');

    } else {
      //alert("not connected, not logged into facebook, we don't know");
    }
  }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  function testAPI() {
    //console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      //console.log('Successful login for: ' + response.name);
    });
  }

	
  $(document).on('click','.facebook', function(){

    var url = $(this).find('.url_fb').val();
    
  	FB.api('https://graph.facebook.com/','post',  {
          id: url,
          scrape: true,
          access_token:'EAAcMdgezwNYBAB96ZBPVzNfQGk5lSlV9mVzIQ0COFpNWcSZC1QqxUsM6Jm5hKXfBRwMJ3dy9xkos9AJlBlLHyCetnX7fZAJvyVEdian6K6TmmyWBzqwHvGe5ItK9nrNuJPWjMFUH7zVZBNUI6h9btuWVUJYJ1zMZD'
    }, function(response) {
          console.log('rescrape!',response);

    });

  	FB.init({
        	appId      : '1984025911869654',
          status     : true,
        	scrape     : true,
        	version    : 'v2.10',
          xfbml      : true
    });
  	
    checkLoginState();
  	
    FB.ui({
      method: 'share',
      display: 'popup',
      title: 'Spider man costume - Chrysalis',
      href: url
  	}, function(response){});		  
    
	});