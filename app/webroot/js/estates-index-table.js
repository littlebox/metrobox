var EstatesIndexTable = function () {

	var initEstatesIndexTable = function () {

		var table = $('#estates_table');

		// begin first table
		LocalVar.dataTable = table.dataTable({
			"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
			"pagingType": "bootstrap_full_number",
			"language": {
				"url": '../plugins/datatables/i18n/'+LocalVar.langFile+'.json'
			},
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"] // change per page values here
			],
			"pageLength": 50, // set the initial value
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": LocalVar.ajaxSource, //set in view
			"aoColumns": [
				{mData:"Estate.city"},
				{mData:"Type.name"},
				{mData:"Subtype.name"},
				{mData:"Estate.street_name"},
				{mData:"Estate.street_number"},
				{mData:"Estate.id"},
			],
			"fnCreatedRow": function(nRow, aData, iDataIndex){ //callback function after create a row for add action buttons en column 3
				$('td:eq(5)', nRow).html('<button class="btn btn-sm red" onclick="confirmAlert(\''+LocalVar.estateDeleterUrl+"/"+aData.Estate.id+'\');" ><i class="fa fa-times"></i> '+LocalVar.estateDeleteText+'</button> <a class="btn btn-sm blue" href="'+LocalVar.estateEditUrl+"/"+aData.Estate.id+'" ><i class="fa fa-pencil"></i> '+LocalVar.estateEditText+'</a> <a class="btn btn-sm green" href="'+LocalVar.estateViewrUrl+"/"+aData.Estate.id+'" ><i class="fa fa-file"></i> '+LocalVar.estateViewText+'</a>');
			}
		});

		//Sort the table afer load [TODO do it after first load! it bring data twice]
		// table.fnSort([[2, 'des']]);

		var tableWrapper = jQuery('#estates_table_old_wrapper');

		tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}

	return {

		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}

			initEstatesIndexTable();
		}

	};

}();