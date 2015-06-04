var ToursIndexTable = function () {

	var initToursIndexTable = function () {

		var table = $('#tours_table');

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
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": LocalVar.ajaxSource, //set in view
			"aaSorting": [[1,'asc']], //Ordenar por nombre
			"columnDefs": [
				{ "width": "36px", "targets": 0 } //First row at 36px
			],
			"aoColumns": [
				{mData:"Tour.color", bSortable: false},
				{mData:"Tour.name"},
				{mData:"Tour.price"},
				{mData:"Tour.quota"},
				{mData:"Tour.length"},
				{mData:"Tour.id", bSortable: false}
			],
			"fnCreatedRow": function(nRow, aData, iDataIndex){ //callback function after create a row for add action buttons en column 3
				htmlContent = '';
				htmlContent += '<button class="btn btn-sm red" onclick="confirmAlert(\''+LocalVar.tourDeleterUrl+"/"+aData.Tour.id+'\');" ><i class="fa fa-times"></i> '+LocalVar.tourDeleteText+'</button> ';
				htmlContent += '<a class="btn btn-sm blue" href="'+LocalVar.tourEditUrl+"/"+aData.Tour.id+'" ><i class="fa fa-pencil"></i> '+LocalVar.tourEditText+'</a> ';
				htmlContent += '<a class="btn btn-sm green" href="'+LocalVar.tourViewrUrl+"/"+aData.Tour.id+'" ><i class="fa fa-file"></i> '+LocalVar.tourViewText+'</a> ';
				//Set to column 6
				$('td:eq(5)', nRow).html(htmlContent);
				//Set to column 1
				$('td:eq(0)', nRow).html('<div style="width: 100%;height: 28px;background-color: '+aData.Tour.color+';"></div>');
			}
		});

		//Sort the table afer load [TODO do it after first load! it bring data twice]
		//table.fnSort([[2, 'des']]); //THe number is the column number to sort

		var tableWrapper = jQuery('#tours_table_old_wrapper');

		tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}

	return {

		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}

			initToursIndexTable();
		}

	};

}();