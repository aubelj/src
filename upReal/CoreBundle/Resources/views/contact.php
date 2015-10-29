{% extends "URCoreBundle::mainLayout.html.twig" %}

{% block currentPage %}

<div class="l-container">
	
	<div class="">
		<h1>Contactez nous</h1>

		<form class="form-horizontal submit-form login-form" action="#" method="post" id="contact_form">
		    <ul>
				<div class="form-group"><p>N'hésitez pas ou nous faire des remarques. upReal est en constante évolution et s'efforce de répondre au mieux au commentaire de ses utilisateurs. Notre équipe vous fournira une réponse très rapidement.</p><br/></div>
		        <div class="form-group">
		        	<label for="email" class="col-sm-2">E-mail *</label>
					<div class="col-sm-9"><input requiered type="email" class="form-control" id="email" placeholder="Votre e-mail" required/></div>
				</div>
		      	<div class="form-group">
		        	<label for="subject" class="col-sm-2">Sujet *</label>
					<div class="col-sm-9">
						<select id="subject" class="form-control" requiered>
							<option value="cat1">Reporter un bug</option>
							<option value="cat2">Intégrer l'équipe</option>
							<option value="cat3">Question</option>
							<option value="cat4">Réclamation</option>
							<option value="cat5">Problème technique</option>
							<option value="cat6">Autre</option>
						</select>
					</div>
				</div>
		
		        <div class="form-group">
		        	<label for="message" class="col-sm-2">Votre message</label>
					<div class="col-sm-9">
						<textarea class="form-control" rows="6" id="message" placeholder="Message" requiered></textarea>
					</div>
				</div>
		       </ul>
	       	 	<input disabled type="submit" id="Validate" value="Valider"/>
		</form>

	</div>

</div>
{% endblock %}
