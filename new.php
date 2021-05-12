<html>
<script type="text/javascript" src="/bitrix/js/main/jquery/jquery-1.8.3.min.js?156943410993637"></script>
<script>
	jQuery(document).ready(function(){
	  jQuery("#post_to_url").click(function(){ 
		var response1js = '50bb6d87-7128-bb65-3beb-9d20bc6f1c4e';
	    $.ajax({
	      url: "https://service.gotdoc.ru/api/?class=Market&action=getDocsList",
		data: { 
			//"ext_url": "https://service.gotdoc.ru/api/?class=Market&action=getDocsList,
	        "privateUUID": response1js,
	      },		 
		  
		  method: "POST", 
		//  dataType: 'jsonp',
		//	jsonp: 'mycallbackfunction',
		//	crossDomain: true,	
		  dataType: "json" ,
		  success: function(data){   
				console.log(data); 
				var obj = JSON.stringify(data);
				jQuery('#current').html(obj);
			},
	    })
	  });
	});
	
</script>

<a id="post_to_url">Список документов</a>
<div id="current"></div>
</html>