<?php
$label = "Adicionar";
$icon = "plus";

if ($action == "update") {
	$label = "Atualizar";
	$icon = "edit";
}
?>

<section class="container">

	<div class="justify-content-center">
		<h1><?php echo $label ?> um Contato</h1>
		<hr class="my-4">
	</div>

	<div class="row justify-content-center">
		<div class="col-6">
		<form action="?controller=Contact&action=<?php echo $action ?>" method="post" enctype="multipart/form-data">
			<?php if (isset($hiddenID)) { echo $hiddenID; } ?>
			<div class="form-row">
		    	<div class="col-md-2">
		    		<img class="img-fluid img-thumbnail" src="<?php echo isset($contact) ? $contact->getImgFormated() : 'public/img/contact/default.png' ?>" alt="Foto do Contato">
		    	</div>
			    <div class="form-group col-md-10">
					<div class="form-group">
		    			<label for="img">Selecione uma foto</label>
		    			<input type="file" class="form-control-file" name="img" id="img">
		    			<?php if (isset($notices['img'])) : ?>
				    		<small class="form-text text-danger">
		  						<?php echo $notices['img'] ?>
							</small>
			    		<?php endif;?>
					</div>
			    </div>
		  	</div>
			<div class="form-group">
		    	<label for="name">Nome</label>
		    	<input class="form-control" type="text" name="name" id="name" placeholder="Nome" maxlength="50" required="required"<?php echo isset($contact) ? " value = \"{$contact->getName()}\"" : '' ?> />
		    	<?php if (isset($notices['name'])) : ?>
		    		<small class="form-text text-danger">
  						<?php echo $notices['name'] ?>
					</small>
		    	<?php endif;?>		    	
		  	</div>
			<div class="form-row">
		    	<div class="form-group col-md-4">
					<label for="inputCPF">CPF</label>
		    		<input class="form-control" type="text" name="cpf" placeholder="CPF" maxlength="11" required="required"<?php echo isset($contact) ? " value = \"{$contact->getCpf()}\"" : '' ?> />
		    		<?php if (isset($notices['cpf'])) : ?>
			    		<small class="form-text text-danger">
	  						<?php echo $notices['cpf'] ?>
						</small>
		    		<?php endif;?>
		    	</div>
			    <div class="form-group col-md-8">
					<label for="inputMail">E-mail</label>
					<input class="form-control" type="email" name="mail" placeholder="E-mail" maxlength="255" required="required"<?php echo isset($contact) ? " value = \"{$contact->getMail()}\"" : '' ?> />
					<?php if (isset($notices['mail'])) : ?>
			    		<small class="form-text text-danger">
	  						<?php echo $notices['mail'] ?>
						</small>
		    		<?php endif;?>	
			    </div>
		  	</div>
		  	<div class="form-row">
		    	<div class="form-group col-md-4">
					<label for="inputPhone">Telefone</label>
					<input class="form-control" type="tel" name="phone" placeholder="Telefone" maxlength="10" required="required"<?php echo isset($contact) ? " value = \"{$contact->getPhone()}\"" : '' ?> />
					<?php if (isset($notices['phone'])) : ?>
			    		<small class="form-text text-danger">
	  						<?php echo $notices['phone'] ?>
						</small>
		    		<?php endif;?>	
		    	</div>
			    <div class="form-group col-md-4">
					<label for="inputCel">Celular</label>
					<input class="form-control" type="tel" name="cel" placeholder="Celular" maxlength="11" required="required"<?php echo isset($contact) ? " value = \"{$contact->getCel()}\"" : '' ?> />
					<?php if (isset($notices['cel'])) : ?>
			    		<small class="form-text text-danger">
	  						<?php echo $notices['cel'] ?>
						</small>
		    		<?php endif;?>	
			    </div>
		  	</div>

		  	<div class="form-row align-items-center">
			  	<div class="form-group col-md-4">
			    	<label for="inputBirth">Data de Nascimento</label>
					<input class="form-control" type="date" name="birth" placeholder="Data de Nascimento"<?php echo isset($contact) ? " value = \"{$contact->getBirth()}\"" : '' ?> />
					<?php if (isset($notices['birth'])) : ?>
			    		<small class="notice form-text text-danger">
	  						<?php echo $notices['birth'] ?>
						</small>
		    		<?php endif;?>	
				</div>
				<div class="form-group col-md-4 text-center">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="highlight" id="highlight"<?php echo isset($contact) && $contact->getHighlight() ? " checked" : '' ?> />
						<label class="form-check-label" for="highlight">
							Destaque
						</label>
					</div>
				</div>
				<div class="form-group col-md-4 text-right align-self-end">
					<button type="submit" name="save" class="btn btn-success"><i class="fas fa-<?php echo $icon ?>"></i> <?php echo $label ?></button>
				</div>
		  	</div>
		</form>
		</div>
	</div>
</section>