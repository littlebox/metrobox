var TableManaged = function () {

	var initUsersTable = function () {

		var table = $('#users_table');

		// begin first table
		table.dataTable({
			"pagingType": "bootstrap_full_number",
			"language": {
				"paginate": {
					"previous":"Prev",
					"next": "Next",
					"last": "Last",
					"first": "First"
				}
			},
			"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "/metrobox/users/index.json",
				"aoColumns": [
					{mData:"User.full_name"},
					{mData:"User.email"},
					{mData:"User.created"}
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

			initUsersTable();
		}

	};

}();