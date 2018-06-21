<main class="container">

	<div class="row">
	    <section class="col-9">
			<h1>Destaques</h1>
			<hr class="my-4">

			<div class="card-columns">
			<?php foreach ($highlights as $highlight): ?>
				<div class="card box-shadow">
					<img class="card-img-top img-fluid" src="<?php echo $highlight->getImgFormated() ?>" alt="Foto do Contato">
					<div class="card-body">
						<h5 class="card-title"><small class="text-muted">Nome</small> <?php echo $highlight->getName() ?></h5>
						<p class="card-text"><small class="text-muted">E-mail</small> <?php echo $highlight->getMail() ?></p>
						<p class="card-text"><small class="text-muted">Celular</small> <?php echo $highlight->getCelFormated() ?></p>
						<p class="card-text"><small class="text-muted">Aniversário</small> <?php echo $highlight->getBirthFormated() ?></p>				
					</div>
					<div class="card-footer text-muted">
						<div class="text-center">
							<a href="?controller=Contact&action=view&id=<?php echo $highlight->getId() ?>" title="Visualizar detalhes do contato <?php echo $highlight->getName() ?>" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fas fa-eye"></i></a>
							<a href="?controller=Contact&action=update&id=<?php echo $highlight->getId() ?>" title="Atualizar informações do contato <?php echo $highlight->getName() ?>" class="btn btn-secondary btn-sm" role="button" aria-pressed="true"><i class="fas fa-pencil-alt"></i></span></a>
							<button type="button" class="btn btn-outline-danger btn-sm" title="Remover o contato <?php echo $highlight->getName() ?>" data-toggle="modal" data-target="#deleteModal" data-whatever="<?php echo $highlight->getId() ?>"><i class="fas fa-trash"></i></button>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
	    </section>
	    <aside class="col-3">
	    	<div class="box-shadow">
				<h3 class="d-flex justify-content-between align-items-center">
	            	<span class="text-muted">E-mail <small>Recentes</small></span>
	            	<span class="badge badge-secondary badge-pill"><?php echo count($lasts) ?></span>
	          	</h3>
	          	<ul class="list-group">			
				<?php foreach ($lasts as $last): ?>
		            <li class="list-group-item d-flex justify-content-between">
	                	<div>
		            		<a href="?controller=Contact&action=view&id=<?php echo $last->getId() ?>" title="Visualizar detalhes do contato <?php echo $last->getName() ?>" class=""><h6 class="my-0"><?php echo $last->getName() ?></h6></a>
	            			<small class="text-muted"><?php echo $last->getMail() ?></small>		            		
	              		</div>
		            </li>         
				<?php endforeach; ?>
				</ul>
			</div>
	    </aside>
  	</div>
</main>