<section class="container">

	<div class="d-flex flex-row-reverse">
		<div class="p-2">
			<p class="text-muted"><?php echo count($contacts) ?> contado(s) listado(s)</p>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-hover">
	  		<thead>
	    		<tr>
					<th scope="col">Nome</th>
					<th scope="col">Data de Nascimento</th>
					<th scope="col">Telefone</th>
					<th scope="col">Celular</th>
					<th scope="col">E-mail</th>
					<th scope="col">Opções</th>      
	    		</tr>
	  		</thead>
	  		<tbody>
			<?php foreach ($contacts as $contact): ?>
				<tr>
					<td><?php echo $contact->getName() ?></td>
					<td><?php echo $contact->getBirthFormated() ?></td>
					<td><?php echo $contact->getPhoneFormated() ?></td>
					<td><?php echo $contact->getCelFormated() ?></td>
					<td><?php echo $contact->getMail() ?></td>
					<td>
						<a href="?controller=Contact&action=view&id=<?php echo $contact->getId() ?>" title="Visualizar detalhes do contato <?php echo $contact->getName() ?>" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
						<a href="?controller=Contact&action=update&id=<?php echo $contact->getId() ?>" title="Atualizar informações do contato <?php echo $contact->getName() ?>" class="btn btn-secondary btn-sm" role="button" aria-pressed="true"><i class="fas fa-pencil-alt"></i></span></a>
						<button type="button" class="btn btn-outline-danger btn-sm" title="Remover o contato <?php echo $contact->getName() ?>" data-toggle="modal" data-target="#deleteModal" data-whatever="<?php echo $contact->getId() ?>"><i class="fas fa-trash"></i></button>
					</td>
				</tr>
				<?php endforeach; ?>
	  		</tbody>
		</table>
	</div>

	<div class="clearfix">
		<a href="?controller=Contact&action=create" title="Adicionar um contato" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fas fa-user-plus"> Adicionar</i></a>
	</div>
</section>