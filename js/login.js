$(document).ready(function(){

	$("#register-btn").click(function(e){

		e.preventDefault();
		var form_values = {};
		var ok = true;

		$("#register-form .required").each(function(){

			if($.trim($(this).val()) == ""){

				$(this).css("border-color","red");
				$(this).addClass("shake");
				ok = false;

			}



			else{

				var name = $(this).attr('id');
				form_values[name] = $.trim($(this).val());
				$(this).css("border-color","#CCCCCC");
				$(this).removeClass("shake");

			}


		});
		if($("#pass1").val() != $("#pass2").val()){

			ok = false;
			$("#pass2").val('');
			$("#pass2").css("border-color","red");
			$("#pass2").addClass("shake");
			$("#pass2").attr("placeholder","Mots de passes différents");

		}

		if(ok){

			var year = $( "#year option:selected" ).text();
			var sex = $("input[name=sex]:checked", "#register-form").val();
			form_values["class-id"] = year+form_values["class-id"].toUpperCase();

			if(sex == "boy"){
				form_values["sex"] = 1;
			}
			else{
				form_values["sex"] = 0;
			}

			$(".home-form").css("display","none");
			$(".cssload-loader-inner").fadeIn("slow");

			$.ajax({

				type	:"POST",
				url		:"./AJAX/register.php",
				data	:form_values,
				dataType : "html",
				success: function(data){


					if($.trim(data) == "existing_user"){

						$(".home-form").fadeIn("slow");
						$(".cssload-loader-inner").css("display","none");
						$(".home-form .info-text").css('display','none');
						$(".home-form").append("<p class = 'info-text'>Vous êtes déjà enregistré, avez vous oublié votre <a href = ''>mot de passe</a> ?</p>");

					}
					else if($.trim(data) == "ok"){

						window.location.href = "./profile.php";

					}
					else{
						console.log(data);
					}

				},
				error: function(){
						$(".home-form").fadeIn("slow");
						$(".cssload-loader-inner").css("display","none");
						$(".home-form").append("<p class = 'info-text'>Une erreur s'est produite, veuillez réessayer.</p>");

				}

			});



		}


	});

	$("#login-btn").click(function(e){


	});
});
