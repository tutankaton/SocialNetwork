// Jquery with no conflict
jQuery(document).ready(function($) {

	//info de amigo
	$('.minifotoindex').hover(function(eventObject){
		$('#blobmovie').attr('style', 'top:0px; left:0px;display:none;');
		var friend = this.id;
	    $.ajax({
                     type: "post",
                     url: "/socialNetwork/index.php/user/get_info_friend_to_tooltip",
                     dataType: "json",
                     data: { id_friend: friend} ,

              success: function(data) {
                   $('#blob .name').html(data.name_friend);
                   if(data.cant_amigos_en_comun == 0)
                   		$('#blob .friends').html("No friends in common");
                   else
                   		$('#blob .friends').html(data.cant_amigos_en_comun+" friends in common");
                   $('#blob .saw').html('');
                   for (var i=0; i < data.vistas.length; i++) {
                   		$('#blob .saw').append('<img class="microfotomovie" src="'+data.vistas[i].thumbnail+'" title="'+data.vistas[i].title+'"></img>');
                   };
                   if(data.por_ver.length==0)
                   	$('#blob .to_view').html('No movies enqueue');
                   else
                   	$('#blob .to_view').html('');
                   for (var i=0; i < data.por_ver.length; i++) {
                   		$('#blob .to_view').append('<img class="microfotomovie" src="'+data.por_ver[i].thumbnail+'" title="'+data.por_ver[i].title+'"></img>');
                   };                   
                   $('#blob').attr('style', 'top:'+(eventObject.fromElement.offsetParent.offsetTop+4)+'px; left:'+(eventObject.fromElement.offsetParent.offsetLeft+40)+'px;display:block;');
               }
        });

               //eventObject.fromElement.offsetParent.offsetLeft
    },function(eventObject){
        $('#blob').attr('style', 'top:0px; left:0px;display:none;');
    });
   
    //info de movie
	$('.minifotomovie').hover(function(eventObject){
		$('#blob').attr('style', 'top:0px; left:0px;display:none;');
		var movie = this.id;
		$.ajax({
	                 type: "post",
	                 url: "/socialNetwork/index.php/user/get_info_movie_to_tooltip",
	                 dataType: "json",
	                 data: { id_movie: movie} ,
	
	          success: function(data) {
	          		$('#blobmovie .tit').html(data.title);
	          		$('#blobmovie .ano').html(data.year);
	          		$('#blobmovie .txt').html(data.sinopsis);
	          		$('#blobmovie .genero').html(data.genre);
	          		$('#blobmovie .calification').html(data.calification);
	          		$('#blobmovie .cantidad').html(data.cant_amigos_vieron+' friends have seen it');
	          		
	          		if(data.actores.length==0)
                   		$('#blobmovie .reparto').html('No data');
                    else
                    	$('#blobmovie .reparto').html('');
                    for (var i=0; i < data.actores.length; i++) {
                    		$('#blobmovie .reparto').append('<span>'+data.actores[i].name+', </span>');
                    };    
                    if(data.directores.length==0)
                   		$('#blobmovie .director').html('No data');
                    else
                    	$('#blobmovie .director').html('');
                    for (var i=0; i < data.directores.length; i++) {
                    		$('#blobmovie .director').append('<span>'+data.directores[i].name+' </span>');
                    };                
					$('#blobmovie').attr('style', 'top:'+(eventObject.fromElement.offsetParent.offsetTop+4)+'px; left:'+(eventObject.fromElement.offsetParent.offsetLeft-5)+'px;display:block;width:290px;');
	           }
	    });		
               //eventObject.fromElement.offsetParent.offsetLeft
    },function(eventObject){
        $('#blobmovie').attr('style', 'top:0px; left:0px;display:none;');
    });



	$('.auto-submit-star').rating({
               required: true,
               callback: function(value, link) {

                $.ajax({
                         type: "post",
                         url: "/socialNetwork/index.php/user/rating",
                         dataType: "json",
                         data: { id: $("#hidden_design_id").val(), rate_val: value } ,

                  success: function(e) {
                       //$.jGrowl(e.code + "" + e.msg);
                        	 //alert(e.code + "" + e.msg);
                        	 $('#msg_rate').html(e.msg);
                        	 $('#msg_rate').fadeIn();
                        	 $('#msg_rate').fadeOut(5000);
                        	 window.location.reload();
                   }
             });
         }
    });
	// nivo slider ------------------------------------------------------ //
	
	$('#slider').nivoSlider({
		effect:'random', //Specify sets like: 'fold,fade,sliceDown'
        slices:5,
        animSpeed:500, //Slide transition speed
        pauseTime:3000,
        startSlide:0, //Set starting Slide (0 index)
        directionNav:true, //Next & Prev
        directionNavHide:true, //Only show on hover
        controlNav:true, //1,2,3...
        controlNavThumbs:false, //Use thumbnails for Control Nav
        controlNavThumbsFromRel:false, //Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', //Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
        keyboardNav:true, //Use left & right arrows
        pauseOnHover:true, //Stop animation while hovering
        manualAdvance: false, //Force manual transitions
        captionOpacity:0.7 //Universal caption opacity
	});
	

	// Poshytips ------------------------------------------------------ //
	
    $('.poshytip').poshytip({
    	className: 'tip-twitter',
		showTimeout: 1,
		alignTo: 'target',
		alignX: 'center',
		offsetY: 5,
		allowTipHover: false
    });
    
    
    // Poshytips Forms ------------------------------------------------------ //
    
    $('.form-poshytip').poshytip({
		className: 'tip-yellowsimple',
		showOn: 'focus',
		alignTo: 'target',
		alignX: 'right',
		alignY: 'center',
		offsetX: 5
	});
	 
	// Superfish menu ------------------------------------------------------ //
	
	$("ul.sf-menu").superfish({ 
        animation: {height:'show'},   // slide-down effect without fade-in 
        delay:     800               // 1.2 second delay on mouseout 
    });
    
    // Scroll to top ------------------------------------------------------ //
    
	$('#to-top').click(function(){
		$.scrollTo( {top:'0px', left:'0px'}, 300 );
	});
		
	// Submenu rollover --------------------------------------------- //
	
	$("ul.sf-menu>li>ul li").hover(function() { 
		// on rollover	
		$(this).children('a').children('span').stop().animate({ 
			marginLeft: "3" 
		}, "fast");
	} , function() { 
		// on out
		$(this).children('a').children('span').stop().animate({
			marginLeft: "0" 
		}, "fast");
	});
	
	
	// Tweet Feed ------------------------------------------------------ //
	
    $("#tweets").tweet({
        count: 3,
        username: "ansimuz",
        callback: tweet_cycle
    });
	
	// Tweet arrows rollover --------------------------------------------- //
	
	$("#twitter #prev-tweet").hover(function() { 
		// on rollover	
		$(this).stop().animate({ 
			left: "27" 
		}, "fast");
	} , function() { 
		// on out
		$(this).stop().animate({
			left: "30" 
		}, "fast");
	});
	
	$("#twitter #next-tweet").hover(function() { 
		// on rollover	
		$(this).stop().animate({ 
			right: "27" 
		}, "fast");
	} , function() { 
		// on out
		$(this).stop().animate({
			right: "30" 
		}, "fast");
	});
	
	// Tweet cycle --------------------------------------------- //
	
	function tweet_cycle(){
    	$('#tweets .tweet_list').cycle({ 
			fx:     'scrollHorz', 
			speed:  500, 
			timeout: 0, 
			pause: 1,
			next:   '#twitter #next-tweet', 
			prev:   '#twitter #prev-tweet' 
		});
	}
	
	// tabs ------------------------------------------------------ //
	
	$("ul.tabs").tabs("div.panes > div", {effect: 'fade'});
	
	// Thumbs rollover --------------------------------------------- //
	
	$('.thumbs-rollover li a img').hover(function(){
		// on rollover
		$(this).stop().animate({ 
			opacity: "0.5" 
		}, "fast");
	} , function() { 
		// on out
		$(this).stop().animate({
			opacity: "1" 
		}, "fast");
	});
	
	// Resize home top-padding ------------------------------------------------------ //
	
	//$('#headline-gap').height($('#headline').height());
	$('.home #header').height($('#headline').height() + 430);
	
	
	// Blog posts rollover --------------------------------------------- //
	
	$('#posts .post').hover(function(){
		// on rollover
		$(this).children('.thumb-shadow').children('.post-thumbnail').children(".cover").stop().animate({ 
			left: "312"
		}, "fast");
	} , function() { 
		// on out
		$(this).children('.thumb-shadow').children('.post-thumbnail').children(".cover").stop().animate({
			left: "0" 
		}, "fast");
	});
	
	// Portfolio projects rollover --------------------------------------------- //
	
	$('#projects-list .project').hover(function(){
		// on rollover
		$(this).children('.project-shadow').children('.project-thumbnail').children(".cover").stop().animate({ 
			top: "90"
		}, "fast");
	} , function() { 
		// on out
		$(this).children('.project-shadow').children('.project-thumbnail').children(".cover").stop().animate({
			top: "0" 
		}, "fast");
	});
	
	// Sidebar rollover --------------------------------------------------- //

	$('#sidebar>li>ul>li').hover(function(){
		// over
		$(this).children('a').stop().animate({ marginLeft: "5"	}, "fast");
	} , function(){
		// out
		$(this).children('a').stop().animate({marginLeft: "0"}, "fast");
	});
	
	// Fancybox --------------------------------------------------- //
	
	$("a.fancybox").fancybox({ 
		'overlayColor':	'#000'
	});
	
	// pretty photo  ------------------------------------------------------ //
	
	$("a[rel^='prettyPhoto']").prettyPhoto();


	// Project gallery over --------------------------------------------- //
	
	$('.project-gallery li a img').hover(function(){
		// on rollover
		$(this).stop().animate({ 
			opacity: "0.5" 
		}, "fast");
	} , function() { 
		// on out
		$(this).stop().animate({
			opacity: "1" 
		}, "fast");
	});
	
	
	// Thumbs functions ------------------------------------------------------ //
	
	function thumbsFunctions(){
	
		// prettyphoto
		
		$("a[rel^='prettyPhoto']").prettyPhoto();
						
		// Fancy box
		$("a.fancybox").fancybox({ 
			'overlayColor'		:	'#000'
		});
		
		// Gallery over 
	
		$('.gallery li a img').hover(function(){
			// on rollover
			$(this).stop().animate({ 
				opacity: "0.5" 
			}, "fast");
		} , function() { 
			// on out
			$(this).stop().animate({
				opacity: "1" 
			}, "fast");
		});
		
		// tips
		
		$('.gallery a').poshytip({
	    	className: 'tip-twitter',
			showTimeout: 1,
			alignTo: 'target',
			alignX: 'center',
			offsetY: -15,
			allowTipHover: false
	    });
		
	}
	// init
	thumbsFunctions();
	
	// Quicksand -----------------------------------------------------------//
	
	// get the initial (full) list
	var $filterList = $('ul#portfolio-list');
		
	// Unique id 
	for(var i=0; i<$('ul#portfolio-list li').length; i++){
		$('ul#portfolio-list li:eq(' + i + ')').attr('id','unique_item' + i);
	}
	
	// clone list
	var $data = $filterList.clone();
	
	// Click 
	$('#portfolio-filter a').click(function(e) {
		if($(this).attr('rel') == 'all') {
			// get a group of all items
			var $filteredData = $data.find('li');
		} else {
			// get a group of items of a particular class
			var $filteredData = $data.find('li.' + $(this).attr('rel'));
		}
		
		// call Quicksand
		$('ul#portfolio-list').quicksand($filteredData, {
			duration: 500,
			attribute: function(v) {
				// this is the unique id attribute we created above
				return $(v).attr('id');
			}
		}, function() {
	        // restart thumbs functions
	        thumbsFunctions();
		});
		// remove # link
		e.preventDefault();
	});

		
	// UI Accordion ------------------------------------------------------ //
	
	$( ".accordion" ).accordion();
	
	// Toggle box ------------------------------------------------------ //
	
	$(".toggle-container").hide(); 
	$(".toggle-trigger").click(function(){
		$(this).toggleClass("active").next().slideToggle("slow");
		return false;
	});
		
//close			
});
	
// search clearance	
function defaultInput(target){
	if((target).value == 'Search friends...'){(target).value=''}
}

function clearInput(target){
	if((target).value == ''){(target).value='Search friends...'}
}

// search clearance	
function defaultInputm(target){
	if((target).value == 'Search movies...'){(target).value=''}
}

function clearInputm(target){
	if((target).value == ''){(target).value='Search movies...'}
}




