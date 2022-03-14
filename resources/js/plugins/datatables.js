export default function generateTable(idTabela, idModal) {
	if (arguments.length == 2) {
		$(`#${idTabela}`).DataTable({
			"scrollX": true,
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros",
				"zeroRecords": "Nenhum registro encontrado",
				"info": "Página _PAGE_ de _PAGES_",
				"infoEmpty": "Nenhum registro encontrado",
				"infoFiltered": "(Filtrado de _MAX_ registros no total)",
				"sSearch": "Buscar: _INPUT_",
				"paginate": {
					"previous": "Anterior",
					"next": "Próximo",
					"first": "Primeira página",
					"last": "Última página"
				}
			},
			dropdownParent: $(`#${idModal}`)
		});
	} else if (arguments.length == 1) {
		$(`#${idTabela}`).DataTable({
			"scrollX": true,
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros",
				"zeroRecords": "Nenhum registro encontrado",
				"info": "Página _PAGE_ de _PAGES_",
				"infoEmpty": "Nenhum registro encontrado",
				"infoFiltered": "(Filtrado de _MAX_ registros no total)",
				"sSearch": "Buscar: _INPUT_",
				"paginate": {
					"previous": "Anterior",
					"next": "Próximo",
					"first": "Primeira página",
					"last": "Última página"
				}
			},
		});
	} else {
		return false;
	}
}