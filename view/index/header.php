<!DOCTYPE html>
<html lang="pt">
<head>

	<meta charset="UTF-8">
  	<meta name="description" content="Agenda de contatos BeforeForget. Registre seus as informações de seus contatos antes que esqueça">
  	<meta name="keywords" content="BeforeForget, Lista, Agenda, Contatos, Organizar">
  	<meta name="author" content="Marcelo HP">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Before Forget - Antes que Esqueça!</title>

	<base href="<?php echo BASE_URL ?>">

	<link rel="shortcut icon" type="image/png" href="public/img/favicon.png"/>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="public/css/fontawesome-all.min.css"/>
  <link rel="stylesheet" type="text/css" href="public/css/style.css"/>

</head>
<body>
<header class="box-shadow">
	<nav class="navbar navbar-expand-md navbar-dark bg-green">
    <div class="d-flex justify-content-between container">
      <div>
        <a class="navbar-brand" href="#"><i class="fas fa-address-book"></i> Before Forget</a>        
      </div>
      <div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
              <a class="nav-link" href="#" title="Página com resumo dos contatos">Principal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?controller=Contact&action=list" title="Listar Contatos">Contatos</a>
            </li>
        </ul>
      </div>
      </div>
    </div>
  </nav>
</header>

<section class="subheader box-shadow">
<div class="container">
<div class="row justify-content-center">
  <div class="col-7">
    <form action="?controller=Contact&action=search" method="post">
      <div class="input-group">
          <input type="text" class="form-control" placeholder="ex. José, 408121 ou jose@mail.com" aria-label="Pesquisar um Contato" aria-describedby="basic-addon2" name="search">
        <div class="input-group-append">
          <button type="submit" title="Pesquisar um contato" class="btn btn-info"><i class="fas fa-search"></i></button>
          <a href="?controller=Contact&action=create" title="Adicionar um contato" class="btn btn-secondary" role="button" aria-pressed="true"><i class="fas fa-user-plus"> Adicionar</i></a>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</section>

<div class="container">
  <?php foreach ($successes as $success) : ?>

  <div class="alert alert-success" role="alert">
    <?php echo $success ?>
  </div>

  <?php endforeach; ?>

  <?php foreach ($warnings as $warning) : ?>

  <div class="alert alert-danger" role="alert">
    <?php echo $warning ?>
  </div>

  <?php endforeach; ?>
</div>
