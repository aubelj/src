{% extends "URCoreBundle::mainLayout.html.twig" %}

{% block currentPage %}

<div class="l-container">
	<h1>Mes listes</h1>
	<div class="">
		<button id='addListButton'>Ajouter</button>
	   	<div id='addListModal'></div>
		<table class="table">
	      <caption>Ci-dessous, l'intégralité de vos listes depuis votre arrivée chez nous</caption>
	      <thead>
	        <tr data-href="#">
	          <th>Nom</th>
		   	  <th>Nb éléments</th>
	          <th>Visibilité</th>
	          <th></th>
	        </tr>
	      </thead>
	      <tbody>
		    {% for list in lists %}
		        <tr data-href="./listDisplay.php" class="clickable">
		          <td>{{ list.name }}</td>
  				  <td>{{ list.nbItems }}</td>
				  <td>{{ list.public }}</td>
				  <td>
					<a href="{{ path('ur_user_list_delete', {'id': list.id}) }}" onclick="return confirm('Cette liste va être supprimée. Continuer ?')">
						<button>Delete</button>
					</a>
			 	  </td>
		        </tr>
		       {% endfor %}

	      </tbody>
	    </table>

	</div>

</div>
{% endblock %}

{% block scriptSection %}
	<script>
		$(document).ready(function() {
		    $('#addListButton').click(function(event) {
		        event.preventDefault();
		        // appel Ajax
				$.ajax({
				    type: "POST",
				    dataType: 'html',
				    url: '{{ path('ur_user_list_create_form') }}',
				    async: false //you won't need that if nothing in your following code is dependend of the result
				})
				.done(function(response){
				    $('#addListModal').html(response); //Change the html of the div with the id = "your_div"                        
				})
				.fail(function(jqXHR, textStatus, errorThrown){
				    alert('Error : ' + errorThrown);
				})
		    });
		});
	</script>
{% endblock %}
