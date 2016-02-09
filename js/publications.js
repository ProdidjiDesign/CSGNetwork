function shortPub(){
	$('.text-pub').each(function(event){
		
			var max_length = 300;
			
			if($(this).html().length > max_length){ 
				
				var short_content 	= $(this).html().substr(0,max_length);
				var long_content	= $(this).html().substr(max_length);
				
				$(this).html(short_content+
							 '<a href="#" class="read_more"><br />...Lire la suite</a>'+
							 '<span class="more_text" style="display:none;">'+long_content+'</span>');
							 
				$(this).find('a.read_more').click(function(event){
	 
					event.preventDefault();
					$(this).hide();
					$(this).parents('.text-pub').find('.more_text').show();
			 
				});
				
			}
			
	});

	$('.mosaicflow').mosaicflow({
				    itemSelector: '.mosaicflow__item',
				    minItemWidth: $('.mosaicflow').width()/2
				});

	$('.item').each(function(){

		if($(this).find('.mosaicflow img').size()>0){
			$(this).find('.mosaicflow__item').fadeOut();
			$(this).append('<a href="#" class="display_more"><br />Afficher toutes les images...</a>');
		}

	});

	$('body').on('click','.display_more',function(event){
		event.preventDefault();
		$(this).parent().find('.mosaicflow__item').fadeIn();
		$(this).parent().append('<a href="#" class="display_min"></br>Masquer les images...</a>');
		$(this).remove();
	});

	$('body').on('click','.display_min',function(event){
		event.preventDefault();
		$(this).parent().find('.mosaicflow__item').fadeOut();
		$(this).parent().append('<a href="#" class="display_more"><br />Afficher toutes les images...</a>');
		$(this).remove();
	});
}

function loadPic(event,index,nbr,type) {

	if(nbr===8){
		if(!alert('Nous sommes désolés mais l\'upload de plus de 8 photos n\'est pas autorisé.\n Si vous voulez mettre un album en ligne et l\'envoyer à vos amis\n utilisez le transfert de fichiers.')){
			$('.wrapper').remove();
			return;
		}
	}
	if(nbr>8){
		return;
	}

	if (type === 'transfer')
		var src = URL.createObjectURL(event.originalEvent.dataTransfer.files[index]);
	else
		var src = URL.createObjectURL(event.target.files[index]);
	$('#img-preview').prepend('<div class="wrapper"><img style = "margin-bottom:10px;" src = "'+src+'" /><span class="delete"></span></div>');
	$('.box').fadeOut('slow');
	if(nbr>1)
		$('.wrapper').css('width','50%');
}

function isAdvancedUpload() {
  	var div = document.createElement('div');
  	return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
}

//	Not final function:
//  it have to display links live...

function detectLink(text){

	var words = text.split(" ");
	words.unshift("<p class = 'text-pub'>");
	words.push("</p>");
	var a = 0;
	var i = 0;
	var https = new Array();
	var found = false;
	var cutted_url = "";

	for (var a = 0; a < words.length; a++){
		if(words[a].indexOf('http') >= 0){
			https[i] = a;
			found = true;
			i++;
		}
	}

	if(found){

		for(var j=0;j<https.length;j++){

			var cutted_url = words[https[j]].split("/");

			$('#img-preview').prepend("<a class='embedly-card' href='"+words[https[j]]+"'>"+cutted_url[2]+"</a>");
			words.push("<a class='embedly-card' href='"+words[https[j]]+"'>"+cutted_url[2]+"</a>");
			words[https[j]] = "";
			
		}
		
	}
	return words.join(" ");

}

$(document).ready(function() {


	var droppedFiles = Array();
	var nbr = 0;
	var inputs = document.querySelectorAll( '.box-input' );
	var letters = 0;
	var boxIsDisplayed = false;

	$.ajax({
		method	: "POST",
		url		: "./AJAX/thread.php",
		dataType: "html",
		data 	: {"place":"profile","last":"10"},
		success: function(data){

				$('#thread').prepend(data);
				shortPub();

		},
		error: function(){

				location.reload(true);

		}
	});

	$("body").on('click','.delete',function(){
		var index = $(this).parent().index();
		$(this).parent().hide();
		droppedFiles[droppedFiles.length-index-1] = "";
		nbr--;
	});

	$(".complement").click(function(){
		if(boxIsDisplayed){
			$(".box").fadeOut('slow');
			boxIsDisplayed = false;
		}
		else{
			$(".box").fadeIn('slow');
			boxIsDisplayed = true;
		}
	});

	$(".place-t-post").click(function(){

		$(".post-form").children().eq(0).children().each(function(){
			$(this).removeClass("active-item");
		});
		$(this).addClass("active-item");
		$("#write-space").attr("placeholder", $(this).attr("title"));

	});

	$("#pub-send").click(function(e){
		var content = detectLink($("#write-space").val());

		var place = $(".active-item").attr('id');

		var formData = new FormData();

		formData.append('content',content);
		formData.append('dest',place);

		for (var i = 0; i < droppedFiles.length; i++) {
		  var file = droppedFiles[i];
		  if (file != ""){
		  	if (!file.type.match('image.*')) {
		    	continue;
		  	}
		  	formData.append('photos[]', file, file.name);
		  }
		}
		var xhr = new XMLHttpRequest();
		xhr.open('POST', './AJAX/post_pub.php', true);
		xhr.timeout = 10000;

		xhr.onreadystatechange = function() {
		    if (xhr.readyState == XMLHttpRequest.DONE) {
		        if(xhr.responseText === "Are u lost ?"){
		        	window.location.reload();
		        }
		    }
		}

		xhr.onload = function () {
		  if (xhr.status === 200) {
		    alert('Upload');
		  } else {
		    alert('Une erreur s\'est produite!');
		  }
		};

		xhr.send(formData);

	});

	$("body").on('click','.glyphicon-heart',function(){

		var pid = $(this).parent().attr('id');

		$.ajax({
			method	: "POST",
			url		: "./AJAX/love.php",
			dataType: "html",
			data 	: {"pid":pid,"todo":"more"},
			success: function(data){

				if(data === "Are u lost ?"){
					window.location.reload(true);
				}
				else{
					var value = parseInt($("#"+pid).children().eq(1).text());
					value++;
					$("#"+pid).children().eq(1).text(value);
					$("#"+pid).children().eq(0).removeClass("glyphicon-heart");
					$("#"+pid).children().eq(0).addClass("icon-heart-broken under-pub-active");
				}

			},
			error: function(){

					location.reload(true);

			}
		});

	});

	$("body").on('click','.icon-heart-broken',function(){

		var pid = $(this).parent().attr('id');

		$.ajax({
			method	: "POST",
			url		: "./AJAX/love.php",
			dataType: "html",
			data 	: {"pid":pid,"todo":"min"},
			success: function(data){

				if(data === "Are u lost ?"){
					window.location.reload(true);
				}
				else{
					var value = parseInt($("#"+pid).children().eq(1).text());
					value--;
					$("#"+pid).children().eq(1).text(value);
					$("#"+pid).children().eq(0).removeClass("icon-heart-broken under-pub-active");
					$("#"+pid).children().eq(0).addClass("glyphicon-heart");
				}

			},
			error: function(){

					location.reload(true);

			}
		});

	});



	Array.prototype.forEach.call( inputs, function( input )
	{

		input.addEventListener( 'change', function( e )
		{

			var preview=true;

			var fileName = '', i=0;
			do{
				fileName = e.target.files[i].name;
				if( fileName ){
					var cutName = fileName.split('.');
					var ext = cutName[cutName.length-1];
					switch(ext){
						case 'jpg':
							//$('#drag-drop-label').append('<br />'+fileName);
							droppedFiles.push(e.target.files[i]);
							break;
						case 'jpeg':
							//$('#drag-drop-label').append('<br />'+fileName);
							droppedFiles.push(e.target.files[i]);
							break;
						case 'png':
							//$('#drag-drop-label').append('<br />'+fileName);
							droppedFiles.push(e.target.files[i]);
							break;
						case 'gif':
							//$('#drag-drop-label').append('<br />'+fileName);
							droppedFiles.push(e.target.files[i]);
							break;
						default:
							$('#drag-drop-label').append('<br />Oups, ce fichier ne semble pas être une image.');
							preview = false;
							break;	
					}
				}
				else{
					$('#drag-drop-label').append(labelVal);
				}
				nbr++;
				if(preview){
					loadPic(e,i,nbr,"target");
				}
				i++;
			}while(i<e.target.files.length)

		});
	});

	if (isAdvancedUpload()) {
					var input = document.getElementById('file');

					$('.box').addClass('has-advanced-upload');

		  			$('.box').on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
		    			e.preventDefault();
		    			e.stopPropagation();
		  			})
		  			.on('dragover dragenter', function() {
		  			  	$('.box').addClass('is-dragover');
		  			})
		  			.on('dragleave dragend drop', function() {
		   			  	$('.box').removeClass('is-dragover');
		  			})
		  			.on('drop', function(e) {
		  				var preview=true;
		  				var fileName = '', i=0;
		  				do{
		  					fileName = e.originalEvent.dataTransfer.files[i].name;
		  					if( fileName ){
		  						var cutName = fileName.split('.');
		  						var ext = cutName[cutName.length-1];
		  						switch(ext){
		  							case 'jpg':
		  								$('#drag-drop-label').append('<br />'+fileName);
		  								droppedFiles.push(e.originalEvent.dataTransfer.files[i]);
		  								break;
		  							case 'jpeg':
		  								$('#drag-drop-label').append('<br />'+fileName);
		  								droppedFiles.push(e.originalEvent.dataTransfer.files[i]);
		  								break;
		  							case 'png':
		  								$('#drag-drop-label').append('<br />'+fileName);
		  								droppedFiles.push(e.originalEvent.dataTransfer.files[i]);
		  								break;
		  							case 'gif':
		  								$('#drag-drop-label').append('<br />'+fileName);
		  								droppedFiles.push(e.originalEvent.dataTransfer.files[i]);
		  								break;
		  							default:
		  								$('#drag-drop-label').append('<br />Oups, ce fichier ne semble pas être une image.');
		  								preview = false;
		  								break;	
		  						}
		  					}
		  					else{
		  						$('#drag-drop-label').append(labelVal);
		  					}
		  					nbr++;
		  					if(preview){
		  						loadPic(e,i,nbr,"transfer");
		  					}
		  					i++;
		  				}while(i<e.originalEvent.dataTransfer.files.length)
		  			});
	}

});