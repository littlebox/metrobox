var WineriesStatistics = function () {

	var initPickers = function () {
		//init date pickers
		$('.date-picker').datepicker({
			autoclose: true,
			orientation: "auto right",
		});
	}

	var initTable = function () {
		var table = $('#wineries_statistics_datatable');

		// begin first table
		LocalVar.dataTable = table.dataTable({
			"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
			"pagingType": "bootstrap_full_number",
			"language": {
				"url": '/plugins/datatables/i18n/'+LocalVar.langFile+'.json'
			},
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"] // change per page values here
			],
			"pageLength": 50, // set the initial value
			"aaSorting": [[0,'asc']], //Ordenar por nombre
		});
	}

	return {

		//main function to initiate the module
		init: function () {

			if (!jQuery().dataTable) {
				return;
			}

			initTable();
			initPickers();
		}

	};

}();