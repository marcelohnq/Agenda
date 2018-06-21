<footer>
	<div class="container text-right text-muted">
		&copy; Copyright <?php echo date('Y') ?> <i>Marcelo HP</i>
	</div>
</footer>

<!-- Modal -->
<div class="modal fade" id="deleteModal" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <h4 class="modal-title text-danger">Deletar Contato</h4>
	      <button type="button" class="close" data-dismiss="modal">&times;</button>	    
	    </div>
	    <div class="modal-body">
	     	<p class="text-danger">Verifique se você quer realmente deletar o contato</p>

	     	<form action="?controller=Contact&action=delete" method="post" id="deleteForm">
	     		<input type="text" name="id" hidden/>
	     	</form>

	    </div>
	    <div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
			<button type="submit" form="deleteForm" name="save" value="Delete" class="btn btn-outline-danger">Deletar</button>
	    </div>
	  </div>
	  
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="public/js/script.js"></script>

</body>
</html>