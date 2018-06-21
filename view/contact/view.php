<section class="container">

	<div class="row justify-content-center">
	    <div class="col-sm-3">
			<img class="rounded img-fluid" src="<?php echo $contact->getImgFormated() ?>" alt="Foto do Contato"/>
		</div>
		<div class="col-sm-9">
			<div class="card box-shadow">
				<div class="card-header">
					<div class="d-flex justify-content-between">
						<div>
							<h1>
								<?php if ($contact->getHighlight()) : ?>
									<small><i class="fas fa-star"></i></small>
								<?php endif; ?>
								#<?php echo $contact->getId() ?> - <?php echo $contact->getName() ?>								
							</h1>
						</div>
						<div>
							<a href="?controller=Contact&action=update&id=<?php echo $contact->getId() ?>" title="Atualizar informações do contato " class="btn btn-secondary" role="button" aria-pressed="true"><i class="fas fa-pencil-alt"></i> Atualizar</span></a>
							<button type="button" class="btn btn-outline-danger" title="Remover o contato <?php echo $contact->getName() ?>" data-toggle="modal" data-target="#deleteModal" data-whatever="<?php echo $contact->getId() ?>"><i class="fas fa-trash"></i> Deletar</button>
						</div>
					</div>					
				</div>
				<div class="card-body">
					<dl>
						<dt>CPF</dt>
						<dd><?php echo $contact->getCpfFormated() ?></dd>
						<dt>Data de Aniversário</dt>
						<dd><?php echo $contact->getBirthFormated() ?></dd>
						<dt>Telefone</dt>
						<dd><?php echo $contact->getPhoneFormated() ?></dd>
						<dt>Celular</dt>
						<dd><?php echo $contact->getCelFormated() ?></dd>
						<dt>E-mail</dt>
						<dd><?php echo $contact->getMail() ?></dd>					
					</dl>			
				</div>				
			</div>
		</div>
	</div>
</section>