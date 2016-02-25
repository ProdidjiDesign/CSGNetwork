$( document ).ready(function($) {
	notifId = 0;
    notifVisible = 0;
});
//tu appel la fonction ( ajax ) notification.newNotif();toutes les x seconde et tu met comme pararmetre
//notification.newNotif(Le type de notif (commentaire, like, identification), Le nom de la personne qui a "crer la notif");
notification = {
	newNotif: function(notifType, notifName, notifLink){
        notifVisible++;
		if(notifType == "commentary"){
			notification.notifAfficher(notifName, notifName + " a commentez votre publication", notifLink);
		}else if(notifType == "identification"){
			notification.notifAfficher(notifName, notifName + " vous a identifier dans une publication", notifLink);
		}else if(notifType == "like"){
			notification.notifAfficher(notifName, notifName + " a aimee votre publication", notifLink);
		}
	},
	notifAfficher: function(notifName ,NotificationText, notifLink){
		
		$("body").append('<div class="notif animNot" id="notif-'+notifId+'"><img src="pictures/cross.png" id="'+notifId+'" class="cross animnot"><p class="name">'+notifName+'</p><p class="evenement">'+NotificationText+'</p><p class="linker"><a href="'+notifLink+'">Voire la publication</a></p></div>');
		$(".animNot").animate({"opacity": 1}, 250);
		$(".animator").animate({"opacity": 1}, 750);
		$(".animNot").css({"bottom":35 +25 * notifVisible});
		$(".animator").css({"bottom":35 +25 * notifVisible});
		$(".animator").removeClass("animator");
		$(".animNot").removeClass("animNot");
		notifId++;
	}, 
	notifRemover: function(notifId){
        notifVisible--;
		$("#notif-"+notifId).animate({"bottom": -210, "opacity": -0}, 750);
		setTimeout(function() {
			$("#"+notifId).remove();
		}, 800);
	},
}