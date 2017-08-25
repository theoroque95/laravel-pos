<script>

// TODO: pulse clock
// setInterval(function() {
// 	$("h4#datetime").text("{!! \Carbon\Carbon::now()->toDayDateTimeString(); !!}");
// }, 1000);

$('#data-table').DataTable({
  'paging'      : true,
  'lengthChange': false,
  'searching'   : false,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : false
})

//Date picker
$('#datepicker').datepicker({
  autoclose: true
})

$("button[data-target='#modal-delete']").on('click', function() {
	$('input#modal-id').val($(this).data('id'));
	$('input#modal-form').val($(this).data('form'));
});

$("button[data-target='#modal-replenish']").on('click', function() {
	$('input#modal-id').val($(this).data('id'));
	$('span#modal-acronym').text($(this).data('acronym'));
});

function deleteItem() {
	var id = $('#modal-id').val();
	var form = $('#modal-form').val();

	$("form#modal-delete").submit();
}

function formatDate(dateArg) {
	var date = new Date(dateArg);
	var day = ('0' + date.getDate()).slice(-2);
    var month = ('0' + (date.getMonth() + 1)).slice(-2);
    var year = date.getFullYear();

    return month + '/' + day + '/' + year;
}

function parseToPeso(number) {
	return parseFloat(Math.round(number * 100) / 100).toFixed(2);
}

</script>