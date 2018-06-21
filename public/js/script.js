$( document ).ready(function() {
	$('#deleteModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var id = button.data('whatever');
		var modal = $(this);
		modal.find('input').attr("value", id);
	})

	$('#myModalSave').click(function() {
  		$('#deleteModal').modal('hide');
  		location.reload();
	});
});