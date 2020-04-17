<h1>Contactez-moi</h1>

<hr>

<div class="comment-form">
	<form id="contact-form" action="/contact" method="POST">
    <fieldset>
    	<legend>Merci de me laisser votre message</legend>
    
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="firstname">Nom</label>
				<input type="text" class="form-control" id="firstname" placeholder="Nom">
			</div>
			<div class="form-group col-md-6">
				<label for="lastname">Prénom</label>
				<input type="text" class="form-control" id="lastname" placeholder="Prénom">
			</div>
			<div class="form-group col-md-12">
				<label for="email">Email</label><br />
				<input type="text"  class="form-control" id="email" name="email" />
			</div>
			<div class="form-group col-md-12">
				<label for="message">Message</label><br />
				<textarea id="message" class="form-control" name="message"></textarea>
			</div>
			<button type="submit" class="btn">Envoyer</button>
		</div>
		</fieldset>
	</form>
</div>



