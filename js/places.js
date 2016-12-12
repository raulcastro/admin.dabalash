$(function(){
	
	if ( $('#addPlace').length ) { 
		$('#addPlace').click(function(){
			addPlace();
			return false;
		});
	}
	
	if ( $('.delete-place').length ) { 
		$('.delete-place').click(function(){
			deletePlace(this);
			return false;
		});
	}
	
	if ( $('.add-sub').length ) { 
		$('.add-sub').click(function(){
			addSub(this);
			return false;
		});
	}
	
});

function addPlace()
{
	var placeName = $('#placeName').val();
	
	if (placeName)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/places.php",
	    data: {
	    	placeName: 	placeName,
	    	opt:			'1'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		$('#placeName').val('');
	        	}
	        	else
				{
				}
	        }
	    });
	}
}


function deletePlace(node)
{
	var placeId = $(node).attr('place-id');
	
	if (placeId)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/places.php",
	    data: {
	    	placeId: 	placeId,
	    	opt:			'2'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
//	        		$('#placeName').val('');
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function addSub(node)
{
	var placeId = $(node).attr('place-id');
	var subTitle = $('#subTitle-'+placeId).val();
	var subContent = $('#subContent-'+placeId).val();
	
	if (placeId)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/places.php",
	    data: {
	    	placeId: 	placeId,
	    	subTitle: 	subTitle,
	    	subContent: subContent,
	    	opt:		'3'
	    },
	    success:
	        function(info)
	        {
	        	if (info != '0')
	        	{
	        		$('#subTitle-'+placeId).val('');
	        		$('#subContent-'+placeId).val('');
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function updateBook()
{
	var storeName 	= $('#bookTitle').val(); 
	var storeUrl	= $('#bookAuthor').val();
	var storeId 	= $('#storeId').val();
	
	if (storeId)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/stores.php",
	    data: {
	    	storeId:	storeId,
	    	storeName: 	storeName,
	    	storeUrl: 	storeUrl,
	    	opt:		'2'
	    },
	    success:
	        function(info)
	        {
		    	if (info != '0')
	        	{
	        		pathArray 		= $(location).attr('href').split( '/' );
	            	newURL 			= pathArray[0]+'//'+pathArray[2]+'/'+pathArray[3]+'/'+pathArray[4]+'/'+pathArray[5]+'-'+Math.floor((Math.random() * 100) + 1)+'/#';
	            	window.location = newURL;
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function deleteBook()
{
	var storeId = $('#storeId').val();
	
	if (storeId)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/stores.php",
	    data: {
	    	storeId:	storeId,
	    	opt:		'3'
	    },
	    success:
	        function(info)
	        {
		    	if (info != '0')
	        	{
		    		pathArray 		= $(location).attr('href').split( '/' );
	        		newURL 			= pathArray[0]+'//'+pathArray[2]+'/dashboard/';
	            	window.location = newURL;
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function getSliders()
{
	var storeId = $('#storeId').val();
	
	if (storeId)
	{
		$.ajax({
	    type: "POST",
	    url: "/ajax/stores.php",
	    data: {
	    	storeId:	storeId,
	    	opt:		'4'
	    },
	    success:
	        function(info)
	        {
		    	if (info != '0')
	        	{
		    		$('#sliderBox').html(info);
		    		
		    		if ( $('.delete-slider').length ) { 
		    			$('.delete-slider').click(function(){
		    				deleteSlider(this);
		    				return false;
		    			});
		    		}
		    		
		    		if ( $('.update-slider').length ) { 
		    			$('.update-slider').click(function(){
		    				updateSlider(this);
		    				return false;
		    			});
		    		}
	        	}
	        	else
				{
				}
	        }
	    });
	}
}

function deleteSlider(node)
{
	var sliderId = $(node).attr('slider-id');
	
	$.ajax({
	    type: "POST",
	    url: "/ajax/stores.php",
	    data: {
	    	sliderId:	sliderId,
	    	opt:		'5'
	    },
	    success:
	        function(info)
	        {
		    	if (info != '0')
	        	{
		    		getSliders();
	        	}
	        	else
				{
				}
	        }
	    });
}

function updateSlider(node)
{
	var sliderId 		= $(node).attr('slider-id');
	var sliderTitle 	= $('#title-'+sliderId).val();
	var sliderContent	= $('#content-'+sliderId).val();
	var sliderUrl 		= $('#url-'+sliderId).val();
	
	$.ajax({
	    type: "POST",
	    url: "/ajax/stores.php",
	    data: {
	    	sliderId:		sliderId,
	    	sliderTitle: 	sliderTitle,
	    	sliderContent:	sliderContent,
	    	sliderUrl: 		sliderUrl,
	    	opt:			'6'
	    },
	    success:
	        function(info)
	        {
		    	if (info != '0')
	        	{
		    		alert("Updated!");
	        	}
	        	else
				{
				}
	        }
	    });
}














