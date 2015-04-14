var FormWizard = function () {


	return {
		//main function to initiate the module
		init: function () {
			if (!jQuery().bootstrapWizard) {
				return;
			}

			function format(state) {
				if (!state.id) return state.text; // optgroup
				return "<img class='flag' src='/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
			}

			$("#country_list").select2({
				placeholder: "Select",
				allowClear: true,
				formatResult: format,
				formatSelection: format,
				escapeMarkup: function (m) {
					return m;
				}
			});

			var form = $('#estate-add-form');
			var error = $('.alert-danger', form);
			var success = $('.alert-success', form);

			form.validate({
				doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
				errorElement: 'span', //default input error message container
				errorClass: 'help-block help-block-error', // default input error message class
				focusInvalid: false, // do not focus the last invalid input
				rules: {
					//tab1
					'data[Estate][operation_id]': {
						required: true
					},
					'data[Estate][type_id]': {
						required: true
					},
					'data[Estate][city]': {
						required: true,
					},
					'data[Estate][street_name]': {
						required: true,
					},
					'data[Estate][street_number]': {
						required: true,
					},
					//tab2
					'data[Estate][price]': {
						required: true
					},
					'data[Estate][currency_id]': {
						required: true
					},
					// 'data[Estate][show_price]': {
					// 	required: true
					// },
					// 'data[Estate][offers_funding]': {
					// 	required: true
					// },
					'data[Estate][total_surface]': {
						required: true
					},
					'data[Estate][covered_surface]': {
						required: true
					},
					// 'data[Estate][is_new]': {
					// 	required: true
					// },
					'data[Estate][rooms_number]': {
						required: true
					},
					'data[Estate][bedrooms]': {
						required: true
					},
					'data[Estate][bathrooms]': {
						required: true
					},
					'data[Estate][garages]': {
						required: true
					},
					'data[Estate][orientation]': {
						required: true
					},
					'data[Estate][disposition_id]': {
						required: true
					},
					'data[Estate][building_type_id]': {
						required: true
					},
					'data[Estate][building_condition_id]': {
						required: true
					},
					'data[Estate][building_category_id]': {
						required: true
					},
					'data[Estate][condition_id]': {
						required: true
					},
					'data[Estate][floors]': {
						required: true
					},
					'data[Estate][apartments_per_floor]': {
						required: true
					},
					'data[Estate][number_of_elevators]': {
						required: true
					},
					'data[Estate][expenses]': {
						required: true
					},
					// 'data[Estate][commercial_use]': {
					// 	required: true
					// },
					'data[Estate][brightness]': {
						required: true
					},

				},

				messages: { // custom messages for radio buttons and checkboxes
					'payment[]': {
						required: "Please select at least one option",
						minlength: jQuery.validator.format("Please select at least one option")
					}
				},

				errorPlacement: function (error, element) { // render error placement for each input type
					if (element.attr("name") == "data[Estate][operation_id]") { // for uniform radio buttons, insert the after the given container
						error.insertAfter("#form_operation_id_error");
					} else if (element.attr("name") == "data[Estate][type_id]") { // for uniform radio buttons, insert the after the given container
						error.insertAfter("#form_type_id_error");
					} else {
						error.insertAfter(element); // for other inputs, just perform default behavior
					}
				},

				invalidHandler: function (event, validator) { //display error alert on form submit
					success.hide();
					error.show();
					Metrobox.scrollTo(error, -200);
				},

				highlight: function (element) { // hightlight error inputs
					$(element)
						.closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
				},

				unhighlight: function (element) { // revert the change done by hightlight
					$(element)
						.closest('.form-group').removeClass('has-error'); // set error class to the control group
				},

				success: function (label) {
					if (label.attr("for") == "data[Estate][operation_id]" || label.attr("for") == "data[Estate][type_id]") { // for checkboxes and radio buttons, no need to show OK icon
						label
							.closest('.form-group').removeClass('has-error').addClass('has-success');
						label.remove(); // remove error label here
					} else { // display success icon for other inputs
						label
							.addClass('valid') // mark the current input as valid and display OK icon
						.closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
					}
				},

				submitHandler: function (form) {
					// success.show();
					error.hide();
					form.submit();
					//add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
				}

			});

			var displayConfirm = function() {
				$('#tab4 .form-control-static', form).each(function(){
					var input = $('[name="'+$(this).attr("data-display")+'"]', form);
					if (input.is(":radio")) {
						input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
					}
					if (input.is(":text") || input.is("textarea")) {
						$(this).html(input.val());
					} else if (input.is("select")) {
						$(this).html(input.find('option:selected').text());
					} else if (input.is(":radio") && input.is(":checked")) {
						$(this).html(input.attr("data-title"));
					} else if ($(this).attr("data-display") == 'payment[]') {
						var payment = [];
						$('[name="payment[]"]:checked', form).each(function(){
							payment.push($(this).attr('data-title'));
						});
						$(this).html(payment.join("<br>"));
					}
				});
			}

			var handleTitle = function(tab, navigation, index) {
				var total = navigation.find('li').length;
				var current = index + 1;
				// set wizard title
				$('.step-title', $('#estate_add_form_wizard')).text('Step ' + (index + 1) + ' of ' + total);
				// set done steps
				jQuery('li', $('#estate_add_form_wizard')).removeClass("done");
				var li_list = navigation.find('li');
				for (var i = 0; i < index; i++) {
					jQuery(li_list[i]).addClass("done");
				}

				if (current == 1) {
					$('#estate_add_form_wizard').find('.button-previous').hide();
				} else {
					$('#estate_add_form_wizard').find('.button-previous').show();
				}

				if (current >= total) {
					$('#estate_add_form_wizard').find('.button-next').hide();
					$('#estate_add_form_wizard').find('.button-submit').show();
					displayConfirm();
				} else {
					$('#estate_add_form_wizard').find('.button-next').show();
					$('#estate_add_form_wizard').find('.button-submit').hide();
				}
				Metrobox.scrollTo($('.page-title'));
			}

			// default form wizard
			$('#estate_add_form_wizard').bootstrapWizard({
				'nextSelector': '.button-next',
				'previousSelector': '.button-previous',
				onTabClick: function (tab, navigation, index, clickedIndex) {
					success.hide();
					error.hide();
					if (form.valid() == false) {
						return false;
					}
					handleTitle(tab, navigation, clickedIndex);

				},
				onNext: function (tab, navigation, index) {
					success.hide();
					error.hide();

					if (form.valid() == false) {
						return false;
					}

					handleTitle(tab, navigation, index);
				},
				onPrevious: function (tab, navigation, index) {
					success.hide();
					error.hide();

					handleTitle(tab, navigation, index);
				},
				onTabShow: function (tab, navigation, index) {
					var total = navigation.find('li').length;
					var current = index + 1;
					var $percent = (current / total) * 100;
					$('#estate_add_form_wizard').find('.progress-bar').css({
						width: $percent + '%'
					});
				}
			});

			$('#estate_add_form_wizard').find('.button-previous').hide();
			$('#estate_add_form_wizard .button-submit').click(function () {
				// alert('Finished! Hope you like it :)');
				if (form.valid() == false) {
					return false;
				}else{
					form.submit();
				}
			}).hide();
		}

	};

}();