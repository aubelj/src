
<?php include("includes/header.php"); ?>

<?php include("includes/menu.php"); ?>

	<div class="l-container">
<!-- login-form -->	

<!-- strat-login-form -->	
<div class="login-form">
<!-- start-form -->
	<form class="contact_form" action="#" method="post" name="contact_form">
		<h1>Connectez-vous</h1>
	    <ul>
	        <li>
	            <input type="email" class="textbox1" name="email" placeholder="Votre adresse mail" required />
	            <span class="form_hint">Entrez un email valide</span>
	             <p><img src="images/contact.png" alt=""></p>
	        </li>
	        <li>
	            <input type="password" name="website" class="textbox2" placeholder="password">
	            <p><img src="images/lock.png" alt=""></p>
	        </li>
         </ul>
       	 	<input type="submit" name="Sign In" value="Sign In"/>
			<div class="clear"></div>	
			<label class="checkbox"><input type="checkbox" name="checkbox" checked><i></i>Se souvenir de moi</label>
		<div class="forgot">
			<a href="#">Mot de passe oublié ?</a>
		</div>	
		<div class="clear"></div>	
	</form>
<!-- end-form -->
<!-- start-account -->
<div class="account">
	<h2><a href="#">Pas encore de compte?<br> Inscrivez vous!</a></h2>
    <div class="span"><a href="#"><img src="images/facebook.png" alt=""/><i>Connection via  Facebook</i><div class="clear"></div></a></div>	
    <div class="span1"><a href="#"><img src="images/twitter.png" alt=""/><i>Connection via  Twitter</i><div class="clear"></div></a></div>
    <div class="span2"><a href="#"><img src="images/gplus.png" alt=""/><i>Connection via Google+</i><div class="clear"></div></a></div>
</div>	
<!-- end-account -->
<div class="clear"></div>	

<!-- end-login-form -->

	
</div>

</div>

<?php include("includes/footer.php"); ?>
