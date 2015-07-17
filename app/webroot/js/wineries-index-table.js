var WineriesIndexTable = function () {

	var initWineriesIndexTable = function () {

		var table = $('#wineries_table');

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
			"aaSorting": [[4,'desc']], //Ordr by created date
			"aoColumns": [
				{mData:"Winery.name"},
				{mData:"Winery.priority"},
				{mData:"Winery.visible"},
				{mData:"Winery.reserve_count"},
				{mData:"Winery.created"},
				{mData:"Winery.id", bSortable: false}
			],
			"fnCreatedRow": function(nRow, aData, iDataIndex){ //callback function after create a row for add action buttons en column 3
				//Is Visible
				htmlVisible = aData.Winery.visible ? '<i class="fa fa-check font-green"></i>' : '<i class="fa fa-times font-red"></i>'
				$('td:eq(2)', nRow).html(htmlVisible);

				//Buttons
				htmlContent = '';
				htmlContent += '<button class="btn btn-sm red" onclick="confirmAlert(\''+LocalVar.wineryDeleterUrl+"/"+aData.Winery.id+'\');" ><i class="fa fa-times"></i> '+LocalVar.wineryDeleteText+'</button> ';
				htmlContent += '<a class="btn btn-sm blue" href="'+LocalVar.wineryEditUrl+"/"+aData.Winery.id+'" ><i class="fa fa-pencil"></i> '+LocalVar.wineryEditText+'</a> ';
				//htmlContent += '<a class="btn btn-sm green" href="'+LocalVar.wineryViewrUrl+"/"+aData.Winery.id+'" ><i class="fa fa-file"></i> '+LocalVar.wineryViewText+'</a> ';
				$('td:eq(5)', nRow).html(htmlContent);


			}
		});

		var tableWrapper = jQuery('#wineries_table_old_wrapper');

		tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}

	return {

		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}

			initWineriesIndexTable();
		}

	};

}();