var UsersIndexTable = function () {

	var initUsersIndexTable = function () {

		var table = $('#users_table');

		// begin first table
		table.dataTable({
			"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
			"pagingType": "bootstrap_full_number",
			"language": {
				"paginate": {
					"previous":"Prev",
					"next": "Next",
					"last": "Last",
					"first": "First"
				}
			},
			"lengthMenu": [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"] // change per page values here
			],
			"pageLength": 50, // set the initial value
			"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "/metrobox/users/index.json", //CAMBIAR POR RUTA CON HTML LINK HELPER
				"aoColumns": [
					{mData:"User.full_name"},
					{mData:"User.email"},
					{mData:"User.created"},
					{mData:"User.id",
					mRender: function ( data, type, full ) {
						return '<a class="delete" href="/metrobox/users/edit/'+data+'" >Edit</a> | <a class="delete" href="/metrobox/users/delete/'+data+'" >Delete</a>';
					}}
				],
		});

		var tableWrapper = jQuery('#users_table_old_wrapper');

		tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}

	var initUsersTableOld = function () {

		var table = $('#users_table_old');

		// begin first table
		table.dataTable({

			"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

			"columns": [{
				"orderable": false
			}, {
				"orderable": true
			}, {
				"orderable": false
			}, {
				"orderable": false
			}, {
				"orderable": true
			}, {
				"orderable": false
			}],
			"lengthMenu": [
				[10, 20, 50, 100, -1],
				[10, 20, 50, 100, "All"] // change per page values here
			],
			// set the initial value
			"pageLength": 50,
			"pagingType": "bootstrap_full_number",
			"columnDefs": [{ // set default column settings
				'orderable': false,
				'targets': [0]
			}, {
				"searchable": false,
				"targets": [0]
			}],
			"order": [
				[1, "asc"]
			] // set first column as a default sort by asc
		});

		var tableWrapper = jQuery('#users_table_old_wrapper');

		table.find('.group-checkable').change(function () {
			var set = jQuery(this).attr("data-set");
			var checked = jQuery(this).is(":checked");
			jQuery(set).each(function () {
				if (checked) {
					$(this).attr("checked", true);
					$(this).parents('tr').addClass("active");
				} else {
					$(this).attr("checked", false);
					$(this).parents('tr').removeClass("active");
				}
			});
			jQuery.uniform.update(set);
		});

		table.on('change', 'tbody tr .checkboxes', function () {
			$(this).parents('tr').toggleClass("active");
		});

		tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
	}




	return {

		//main function to initiate the module
		init: function () {
			if (!jQuery().dataTable) {
				return;
			}

			initUsersIndexTable();
		}

	};

}();