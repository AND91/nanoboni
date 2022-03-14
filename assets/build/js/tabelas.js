$(document).ready(function () {

	function tabela(idTabela) {
		$(idTabela).DataTable({
			// "scrollX": true,
			"language": {
				"lengthMenu": "Mostrar MENU registros",
				"zeroRecords": "Nenhum registro encontrado",
				"info": "Página PAGE de PAGES",
				"infoEmpty": "Nenhum registro encontrado",
				"infoFiltered": "(Filtrado de MAX registros no total)",
				"sSearch": "Buscar: INPUT",
				"paginate": {
					"previous": "Anterior",
					"next": "Próximo",
					"first": "Primeira página",
					"last": "Última página"
        }
			}
		});
	}
	tabela('#tabelaUm');
	tabela('#tabelaDois');
	tabela('#tabelaTres');
	tabela('#tabelaQuatro');
  
  function tabelaComModal(idTabela,idModal) {
		$(idTabela).DataTable({
			"scrollX": true,
			"language": {
				"lengthMenu": "Mostrar MENU registros",
				"zeroRecords": "Nenhum registro encontrado",
				"info": "Página PAGE de PAGES",
				"infoEmpty": "Nenhum registro encontrado",
				"infoFiltered": "(Filtrado de MAX registros no total)",
				"sSearch": "Buscar: INPUT",
				"paginate": {
					"previous": "Anterior",
					"next": "Próximo",
					"first": "Primeira página",
					"last": "Última página"
				}
			},
			dropdownParent: $("#lista_clientes")
		});
	}
});