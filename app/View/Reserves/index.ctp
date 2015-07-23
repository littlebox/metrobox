<?php
	//debug($toursData);die();
	$countryList = array(
		'AF' => 'Afghanistan',
		'AL' => 'Albania',
		'DZ' => 'Algeria',
		'AS' => 'American Samoa',
		'AD' => 'Andorra',
		'AO' => 'Angola',
		'AI' => 'Anguilla',
		'AR' => 'Argentina',
		'AM' => 'Armenia',
		'AW' => 'Aruba',
		'AU' => 'Australia',
		'AT' => 'Austria',
		'AZ' => 'Azerbaijan',
		'BS' => 'Bahamas',
		'BH' => 'Bahrain',
		'BD' => 'Bangladesh',
		'BB' => 'Barbados',
		'BY' => 'Belarus',
		'BE' => 'Belgium',
		'BZ' => 'Belize',
		'BJ' => 'Benin',
		'BM' => 'Bermuda',
		'BT' => 'Bhutan',
		'BO' => 'Bolivia',
		'BA' => 'Bosnia and Herzegowina',
		'BW' => 'Botswana',
		'BV' => 'Bouvet Island',
		'BR' => 'Brazil',
		'IO' => 'British Indian Ocean Territory',
		'BN' => 'Brunei Darussalam',
		'BG' => 'Bulgaria',
		'BF' => 'Burkina Faso',
		'BI' => 'Burundi',
		'KH' => 'Cambodia',
		'CM' => 'Cameroon',
		'CA' => 'Canada',
		'CV' => 'Cape Verde',
		'KY' => 'Cayman Islands',
		'CF' => 'Central African Republic',
		'TD' => 'Chad',
		'CL' => 'Chile',
		'CN' => 'China',
		'CX' => 'Christmas Island',
		'CC' => 'Cocos (Keeling) Islands',
		'CO' => 'Colombia',
		'KM' => 'Comoros',
		'CG' => 'Congo',
		'CD' => 'Congo, the Democratic Republic of the',
		'CK' => 'Cook Islands',
		'CR' => 'Costa Rica',
		'CI' => 'Cote d\'Ivoire',
		'HR' => 'Croatia (Hrvatska)',
		'CU' => 'Cuba',
		'CY' => 'Cyprus',
		'CZ' => 'Czech Republic',
		'DK' => 'Denmark',
		'DJ' => 'Djibouti',
		'DM' => 'Dominica',
		'DO' => 'Dominican Republic',
		'EC' => 'Ecuador',
		'EG' => 'Egypt',
		'SV' => 'El Salvador',
		'GQ' => 'Equatorial Guinea',
		'ER' => 'Eritrea',
		'EE' => 'Estonia',
		'ET' => 'Ethiopia',
		'FK' => 'Falkland Islands (Malvinas)',
		'FO' => 'Faroe Islands',
		'FJ' => 'Fiji',
		'FI' => 'Finland',
		'FR' => 'France',
		'GF' => 'French Guiana',
		'PF' => 'French Polynesia',
		'TF' => 'French Southern Territories',
		'GA' => 'Gabon',
		'GM' => 'Gambia',
		'GE' => 'Georgia',
		'DE' => 'Germany',
		'GH' => 'Ghana',
		'GI' => 'Gibraltar',
		'GR' => 'Greece',
		'GL' => 'Greenland',
		'GD' => 'Grenada',
		'GP' => 'Guadeloupe',
		'GU' => 'Guam',
		'GT' => 'Guatemala',
		'GN' => 'Guinea',
		'GW' => 'Guinea-Bissau',
		'GY' => 'Guyana',
		'HT' => 'Haiti',
		'HM' => 'Heard and Mc Donald Islands',
		'VA' => 'Holy See (Vatican City State)',
		'HN' => 'Honduras',
		'HK' => 'Hong Kong',
		'HU' => 'Hungary',
		'IS' => 'Iceland',
		'IN' => 'India',
		'ID' => 'Indonesia',
		'IR' => 'Iran (Islamic Republic of)',
		'IQ' => 'Iraq',
		'IE' => 'Ireland',
		'IL' => 'Israel',
		'IT' => 'Italy',
		'JM' => 'Jamaica',
		'JP' => 'Japan',
		'JO' => 'Jordan',
		'KZ' => 'Kazakhstan',
		'KE' => 'Kenya',
		'KI' => 'Kiribati',
		'KP' => 'Korea, Democratic People\'s Republic of',
		'KR' => 'Korea, Republic of',
		'KW' => 'Kuwait',
		'KG' => 'Kyrgyzstan',
		'LA' => 'Lao People\'s Democratic Republic',
		'LV' => 'Latvia',
		'LB' => 'Lebanon',
		'LS' => 'Lesotho',
		'LR' => 'Liberia',
		'LY' => 'Libyan Arab Jamahiriya',
		'LI' => 'Liechtenstein',
		'LT' => 'Lithuania',
		'LU' => 'Luxembourg',
		'MO' => 'Macau',
		'MK' => 'Macedonia, The Former Yugoslav Republic of',
		'MG' => 'Madagascar',
		'MW' => 'Malawi',
		'MY' => 'Malaysia',
		'MV' => 'Maldives',
		'ML' => 'Mali',
		'MT' => 'Malta',
		'MH' => 'Marshall Islands',
		'MQ' => 'Martinique',
		'MR' => 'Mauritania',
		'MU' => 'Mauritius',
		'YT' => 'Mayotte',
		'MX' => 'Mexico',
		'FM' => 'Micronesia, Federated States of',
		'MD' => 'Moldova, Republic of',
		'MC' => 'Monaco',
		'MN' => 'Mongolia',
		'MS' => 'Montserrat',
		'MA' => 'Morocco',
		'MZ' => 'Mozambique',
		'MM' => 'Myanmar',
		'NA' => 'Namibia',
		'NR' => 'Nauru',
		'NP' => 'Nepal',
		'NL' => 'Netherlands',
		'AN' => 'Netherlands Antilles',
		'NC' => 'New Caledonia',
		'NZ' => 'New Zealand',
		'NI' => 'Nicaragua',
		'NE' => 'Niger',
		'NG' => 'Nigeria',
		'NU' => 'Niue',
		'NF' => 'Norfolk Island',
		'MP' => 'Northern Mariana Islands',
		'NO' => 'Norway',
		'OM' => 'Oman',
		'PK' => 'Pakistan',
		'PW' => 'Palau',
		'PA' => 'Panama',
		'PG' => 'Papua New Guinea',
		'PY' => 'Paraguay',
		'PE' => 'Peru',
		'PH' => 'Philippines',
		'PN' => 'Pitcairn',
		'PL' => 'Poland',
		'PT' => 'Portugal',
		'PR' => 'Puerto Rico',
		'QA' => 'Qatar',
		'RE' => 'Reunion',
		'RO' => 'Romania',
		'RU' => 'Russian Federation',
		'RW' => 'Rwanda',
		'KN' => 'Saint Kitts and Nevis',
		'LC' => 'Saint LUCIA',
		'VC' => 'Saint Vincent and the Grenadines',
		'WS' => 'Samoa',
		'SM' => 'San Marino',
		'ST' => 'Sao Tome and Principe',
		'SA' => 'Saudi Arabia',
		'SN' => 'Senegal',
		'SC' => 'Seychelles',
		'SL' => 'Sierra Leone',
		'SG' => 'Singapore',
		'SK' => 'Slovakia (Slovak Republic)',
		'SI' => 'Slovenia',
		'SB' => 'Solomon Islands',
		'SO' => 'Somalia',
		'ZA' => 'South Africa',
		'GS' => 'South Georgia and the South Sandwich Islands',
		'ES' => 'Spain',
		'LK' => 'Sri Lanka',
		'SH' => 'St. Helena',
		'PM' => 'St. Pierre and Miquelon',
		'SD' => 'Sudan',
		'SR' => 'Suriname',
		'SJ' => 'Svalbard and Jan Mayen Islands',
		'SZ' => 'Swaziland',
		'SE' => 'Sweden',
		'CH' => 'Switzerland',
		'SY' => 'Syrian Arab Republic',
		'TW' => 'Taiwan, Province of China',
		'TJ' => 'Tajikistan',
		'TZ' => 'Tanzania, United Republic of',
		'TH' => 'Thailand',
		'TG' => 'Togo',
		'TK' => 'Tokelau',
		'TO' => 'Tonga',
		'TT' => 'Trinidad and Tobago',
		'TN' => 'Tunisia',
		'TR' => 'Turkey',
		'TM' => 'Turkmenistan',
		'TC' => 'Turks and Caicos Islands',
		'TV' => 'Tuvalu',
		'UG' => 'Uganda',
		'UA' => 'Ukraine',
		'AE' => 'United Arab Emirates',
		'GB' => 'United Kingdom',
		'US' => 'United States',
		'UM' => 'United States Minor Outlying Islands',
		'UY' => 'Uruguay',
		'UZ' => 'Uzbekistan',
		'VU' => 'Vanuatu',
		'VE' => 'Venezuela',
		'VN' => 'Viet Nam',
		'VG' => 'Virgin Islands (British)',
		'VI' => 'Virgin Islands (U.S.)',
		'WF' => 'Wallis and Futuna Islands',
		'EH' => 'Western Sahara',
		'YE' => 'Yemen',
		'ZM' => 'Zambia',
		'ZW' => 'Zimbabwe'
	)
?>

<!-- CALENDAR PORTLET-->
<div class="portlet box purple-plum calendar">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-book"></i><?= __('Reserves') ?>
		</div>
	</div>
	<div class="portlet-body">
		<div class="row">
			<!-- CALENDAR -->
			<div class="col-md-9 col-md-push-3 col-sm-12">
				<div id="calendar" class="has-toolbar">
				</div>
			</div>
			<!-- END CALENDAR -->

			<!-- NEW RESERVE FORM -->
			<div class="col-md-3 col-md-pull-9 col-sm-12">
				<h3 class="form-section" style="margin-top:3px;"><?= __('New Reserve') ?></h3>
				<div id="external-events">
					<?php echo $this->Form->create('Reserve', array(
						'enctype' => 'multipart/form-data',
						'action' => 'add',
						'inputDefaults' => array(
							'format' => array('before','label','between','input','after','error'),
							'autocomplete' => 'off',
							'div' => array(
								'class' => 'form-group',
							),
							'label' => array(
								'class' => 'control-label'
							),
							'class' => 'form-control',
							'error' => array('attributes' => array(
								'class' => 'help-block',
								'wrap' => 'span',
								))
						),
						'class' => 'inline-form',
						'id' => 'reserve-add-form',
					)); ?>
						<?php
							echo $this->Form->input('tour_id', array('id' => 'tour-selector', 'empty' => __('Select a tour...')));
							echo $this->Form->input('language_id', array('id' => 'language-selector', 'empty' => __('Select a tour first')));
							echo $this->Form->input('date', array('id' => 'date-selector', 'type' => 'text', 'class' => 'date-picker form-control', 'placeholder' => '--/--/----', 'between' => '<div class="input-icon right"><i id="date-selector-spinner" class="fa fa-cog fa-spin" style="display:none;transform-origin: 8px 6px;"></i>', 'after' => '</div>'));
							echo $this->Form->input('time', array('id' => 'time-selector', 'type' => 'select', 'placeholder' => '--:--', 'empty' => __('Select a tour first')));
							echo $this->Form->input('Client.email', array('id' => 'client-email', 'between' => '<div class="input-icon right"><i id="client-email-spinner" class="fa fa-cog fa-spin" style="display:none;transform-origin: 8px 6px;"></i>', 'after' => '</div>'));
							echo $this->Form->input('Client.full_name', array('id' => 'client-full-name'));
							echo $this->Form->input('Client.birth_date', array('type' => 'text', 'id' => 'client-birth-date', 'class' => 'birth-date-picker form-control', 'placeholder' => '--/--/----'));
							echo $this->Form->input('number_of_adults');
							echo $this->Form->input('number_of_minors', array('value' => 0));
							echo $this->Form->input('Client.country',array('type' => 'select', 'id' => 'client-country', 'options' => $countryList, 'empty' => ''));
							echo $this->Form->input('Client.phone', array('id' => 'client-phone'));
							echo $this->Form->input('note');
						?>
						<?= $this->Form->button($this->Html->tag('span', __('Add'), array('class' => 'ladda-label')), array('id' => 'reserve-add-submit-button', 'class' => 'btn default ladda-button', 'data-style' => 'zoom-out'));?>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
			<!-- END NEW RESERVE FORM -->
		</div>
	</div>
</div>
<!-- END CALENDAR PORTLET-->

<!-- RESERVE DETAILS MODAL -->
<div id="reserve-details" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title"><?= __('Reserve Details') ?></h4>
			</div>
			<div class="modal-body form">
				<div class="scroller" style="height:500px" data-always-visible="1" data-rail-visible1="1">
					<?php echo $this->Form->create('Reserve', array(
						'enctype' => 'multipart/form-data',
						'action' => 'edit',
						'inputDefaults' => array(
							'format' => array('before','label','between','input','error','after'),
							'autocomplete' => 'off',
							'div' => array(
								'class' => 'form-group',
							),
							'label' => array(
								'class' => 'control-label col-md-3'
							),
							'class' => 'form-control',
							'between' => '<div class="col-md-9">',
							'after' => '</div>',
							'error' => array('attributes' => array(
								'class' => 'help-block',
								'wrap' => 'span',
							))
						),
						'class' => 'form-horizontal form-bordered form-row-stripped',
						'id' => 'reserve-edit-form',
					)); ?>
						<?php
							echo $this->Form->input('Client.full_name', array('id' => 'client-full-name-modal', 'disabled' => 'disabled'));
							echo $this->Form->input('Client.country',array('id' => 'client-country-modal', 'type' => 'select', 'options' => $countryList, 'empty' => '', 'disabled' => 'disabled'));
							echo $this->Form->input('number_of_adults', array('id' => 'number-of-adults-modal', 'disabled' => 'disabled'));
							echo $this->Form->input('number_of_minors', array('id' => 'number-of-minors-modal', 'disabled' => 'disabled'));
							echo $this->Form->input('Client.email', array('id' => 'client-email-modal', 'disabled' => 'disabled'));
							echo $this->Form->input('Client.phone', array('id' => 'client-phone-modal', 'disabled' => 'disabled'));
							echo $this->Form->input('Client.birth_date', array('id' => 'client-birth-date-modal','type' => 'text', 'class' => 'birth-date-picker form-control', 'placeholder' => '--/--/----', 'disabled' => 'disabled'));
							echo $this->Form->input('tour_id', array('id' => 'tour-selector-modal', 'empty' => __('Select a tour...'), 'disabled' => 'disabled'));
							echo $this->Form->input('language_id', array('id' => 'language-selector-modal', 'empty' => __('Select a tour first'), 'disabled' => 'disabled'));
							echo $this->Form->input('date', array('id' => 'date-modal', 'type' => 'text', 'class' => 'date-picker form-control', 'placeholder' => '--/--/----', 'disabled' => 'disabled'));
							echo $this->Form->input('time', array('id' => 'time-selector-modal', 'type' => 'select', 'placeholder' => '--:--', 'empty' => __('Select a tour first'), 'disabled' => 'disabled'));
							echo $this->Form->input('note', array('id' => 'note-modal', 'disabled' => 'disabled'));
							echo $this->Form->hidden('id', array('id' => 'id-modal'));
						?>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
			<div class="modal-footer">
				<div id="attended-modal-div" class="ac-custom ac-checkbox ac-checkmark" style="float: left;">
					<input type="hidden" name="data[Reserve][attended]" id="ReserveAttended_" value="0">
					<input id="attended-modal" name="data[Reserve][attended]" type="checkbox" value="1"><label><?= __('Attended') ?></label>
				</div>
				<button type="button" class="btn red" id="reserve-delete-modal-btn" onclick="confirmAlert();"><?= __('Delete') ?></button>
				<button type="button" class="btn blue" id="edit-modal-btn"><?= __('Edit') ?></button>
				<button type="button" class="btn default" id="cancel-edit-modal-btn" style="display: none;"><?= __('Cancel') ?></button>
				<?= $this->Form->button($this->Html->tag('span', __('Save Changes'), array('class' => 'ladda-label')), array('id' => 'reserve-edit-submit-button', 'class' => 'btn green ladda-button', 'data-style' => 'zoom-out', 'form' => 'reserve-edit-form', 'style' => 'display: none;'));?>
			</div>
		</div>
	</div>
</div>
<!-- RESERVE DETAILS MODAL -->

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/select2/select2');?>
	<?= $this->Html->css('/plugins/fullcalendar/fullcalendar.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min');?>
	<?= $this->Html->css('/plugins/bootstrap-datepicker/css/datepicker3');?>
	<?= $this->Html->css('/plugins/animated-checkboxes/css/component');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');?>
	<?php
		//Translate Validations if Language is Spanish
		if(strtolower(substr(Configure::read('Config.language'), 0, 2)) == 'es'){
			echo $this->Html->script('/plugins/jquery-validation/js/localization/messages_es.js');
		}
	?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/moment.min');?>
	<?= $this->Html->script('/plugins/fullcalendar/fullcalendar.min');?>
	<?php
		//Translate Calendar if Language is Spanish
		if(strtolower(substr(Configure::read('Config.language'), 0, 2)) == 'es'){
			echo $this->Html->script('/plugins/fullcalendar/lang/es');
		}
	?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/bootstrap-datepicker');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es');?>
	<?= $this->Html->script('/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min');?>
	<?= $this->Html->script('/plugins/animated-checkboxes/js/svgcheckbx');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('reserves');?>
	<script>
		var toursData = <?= json_encode($toursData) ?>;
		var getReservesUrl = "<?= $this->Html->Url(array('controller' => 'reserves', 'action' => 'get')); ?>";
		var placeHolderCountrySelect = '<?= __("Select a country...");?>';
		var selecTourFirstText = '<?= __("Select a tour first");?>';

		<?php
			//Prepare select element for tour filter
			// $tours[-1] = __('All Tours'); //Add show all tours option
			// ksort($tours);// Sort array by key (to show "All Tours" first)
			$filterByTourSelect = $this->Form->input('tour_id', array(
				'id' => 'tour-filter',
				'empty' => __('All Tours'),
				'style' => 'position: absolute; right: 15px; top: -4px; width: auto;',
				'div' => false,
				'label' => false,
				'class' => 'form-control tour-filter',
				'between' => '',
				'after' => '',
				'error' => false,
				'name' => 'tour-filter',
				'options' => $tours
			));

			$filterByTourSelect = eregi_replace("[\n|\r|\n\r]", " ", $filterByTourSelect);
		?>

		var filterByTourSelect = '<?= $filterByTourSelect ?>';

		function sendReserveAddForm() {
			var button = $('#reserve-add-submit-button').ladda();
			button.ladda( 'start' ); //Show loader in button

			var targeturl = $('#reserve-add-form').attr('action');
			var formData = $('#reserve-add-form').serializeArray();



			$.ajax({
				type: 'put',
				cache: false,
				url: targeturl,
				data: formData,
				dataType: 'json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				},
				success: function(response) {
					if (response.content) {
						//Prepare an add new reserve to calendar
						var newReserve = {
							id: response.reserve.id,
							title: response.reserve.title,
							start: response.reserve.start,
							tour: response.reserve.tour,
							language: response.reserve.language,
							date: response.reserve.date,
							time: response.reserve.time,
							clientEmail: response.reserve.clientEmail,
							clientName: response.reserve.clientName,
							clientBirthDate: response.reserve.clientBirthDate,
							clientCountry: response.reserve.clientCountry,
							clientPhone: response.reserve.clientPhone,
							numberOfAdults: response.reserve.numberOfAdults,
							numberOfMinors: response.reserve.numberOfMinors,
							note: response.reserve.note,
							backgroundColor: response.reserve.backgroundColor,

						};
						$('#calendar').fullCalendar('renderEvent', newReserve);
						//Show sweetalert
						swal({
							title: response.content.title,
							text: response.content.text,
							type: "success",
							confirmButtonText: "<?= __('Ok') ?>"
						});
						//Reset form
						$('#reserve-add-form')[0].reset();
						$('#tour-selector').trigger('change');

					}
					if (response.error) {
						swal({
							title: 'Error',
							text: response.error,
							type: "error",
							confirmButtonText: "<?= __('Ok') ?>"
						});
					}
				},
				error: function(e) {
					swal({
						title: 'Error',
						text: 'Ajax Error',
						type: "error",
						confirmButtonText: "<?= __('Ok') ?>"
					});
					console.log(e.responseText.message);
				},
				complete: function(){
					button.ladda( 'stop' ); //Hide loader in button
				}
			});
		};

		function sendReserveEditForm() {
			var button = $('#reserve-edit-submit-button').ladda();
			button.ladda( 'start' ); //Show loader in button

			var targeturl = $('#reserve-edit-form').attr('action');
			var formData = $('#reserve-edit-form').serializeArray();

			$.ajax({
				type: 'put',
				cache: false,
				url: targeturl,
				data: formData,
				dataType: 'json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				},
				success: function(response) {
					//Hide modal to view swal
					$('#reserve-details').modal('hide');
					if (response.content) {
						//Bring the modified reserve
						modReserve = $('#calendar').fullCalendar('clientEvents', response.reserve.id)[0];
						//Update the content
						modReserve.title = response.reserve.title;
						modReserve.start = response.reserve.start;
						modReserve.tour = response.reserve.tour;
						modReserve.language = response.reserve.language;
						modReserve.date = response.reserve.date;
						modReserve.time = response.reserve.time;
						modReserve.clientEmail = response.reserve.clientEmail;
						modReserve.clientName = response.reserve.clientName;
						modReserve.clientBirthDate = response.reserve.clientBirthDate;
						modReserve.clientCountry = response.reserve.clientCountry;
						modReserve.clientPhone = response.reserve.clientPhone;
						modReserve.numberOfAdults = response.reserve.numberOfAdults;
						modReserve.numberOfMinors = response.reserve.numberOfMinors;
						modReserve.note = response.reserve.note;
						modReserve.backgroundColor = response.reserve.backgroundColor;
						//Aply the changes on calendar
						$('#calendar').fullCalendar('updateEvent', modReserve);
						//Show sweetalert
						swal({
							title: response.content.title,
							text: response.content.text,
							type: "success",
							confirmButtonText: "<?= __('Ok') ?>"
						});

					}
					if (response.error) {
						swal({
							title: 'Error',
							text: response.error,
							type: "error",
							confirmButtonText: "<?= __('Ok') ?>"
						});
					}
				},
				error: function(e) {
					//Hide modal to view swal
					$('#reserve-details').modal('hide');
					swal({
						title: 'Error',
						text: 'Ajax Error',
						type: "error",
						confirmButtonText: "<?= __('Ok') ?>"
					});
					console.log(e.responseText.message);
				},
				complete: function(){
					button.ladda( 'stop' ); //Hide loader in button
				}
			});
		};

		//For setQuotaAvailable function in reserves.js
		var getQuotaAvailable = "<?= $this->Html->Url(array('controller' => 'reserves', 'action' => 'getQuotaAvailable')); ?>/";

		function findClient() {
			var targeturl = "<?= $this->Html->Url(array('controller' => 'clients', 'action' => 'find')); ?>/"+$('#client-email').val();
			//var formData = $('#client-email').serializeArray();

			$('#client-email-spinner').show();

			$.ajax({
				type: 'get',
				cache: false,
				url: targeturl,
				//data: formData,
				dataType: 'json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				},
				success: function(response) {
					if (response.content) {
						$('#client-full-name').val(response.content.Client.full_name);
						if (response.content.Client.birth_date != null) $('#client-birth-date').val(response.content.Client.birth_date.split('-').reverse().join('/'));
						$('#client-birth-date').datepicker('update');
						$('#client-country').select2('val', response.content.Client.country);
						$('#client-phone').val(response.content.Client.phone);
					}
					if (response.error) {
						$('#client-full-name').val('');
						$('#client-birth-date').val('');
						$('#client-country').select2('val', '');
						$('#client-phone').val('');
					}
				},
				error: function(e) {
					console.log('Ajax error: '+e.responseText.message);
				},
				complete: function(){
					$('#client-email-spinner').hide();
				}
			});
		};

		function changeReserveDate(reserve, revertFunc) {

			var targeturl = "<?= $this->Html->Url(array('controller' => 'reserves', 'action' => 'edit')); ?>";
			var formData = [
				{
					"name": "data[Reserve][id]",
					"value": reserve.id
				},
				{
					"name": "data[Reserve][date]",
					"value": reserve.start.format('DD/MM/YYYY')
				}
			];

			oiginalDate = reserve.date;
			reserve.date = reserve.start.format('YYYY-MM-DD');

			$.ajax({
				type: 'put',
				cache: false,
				url: targeturl,
				data: formData,
				dataType: 'json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				},
				success: function(response) {
					if (response.content) {
						//console.log(response.content);
					}
					if (response.error) {
						revertFunc();
						reserve.date = oiginalDate;
						swal({
							title: 'Error',
							text: response.error,
							type: "error",
							confirmButtonText: "<?= __('Ok') ?>"
						});
					}
				},
				error: function(e) {
					revertFunc();
					reserve.date = oiginalDate;
					swal({
						title: 'Error',
						text: 'Ajax Problem',
						type: "error",
						confirmButtonText: "<?= __('Ok') ?>"
					});
					console.log('Ajax Error: '+e.responseText.message);
				}
			});
		};

		isDeleting = false;
		reserveDeleterUrl = ('<?= $this->Html->url(array('controller'=>'reserves', 'action' => 'delete')) ?>');
		function confirmAlert(){
			//Hide modal to show swal
			$('#reserve-details').modal('hide');

			swal(
				{
					title: "<?= __('Are you sure?') ?>",
					text: "<?= __('You will not be able to recover this!') ?>",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "<?= __('Yes, delete it!') ?>",
					cancelButtonText: "<?= __('Cancel') ?>",
					closeOnConfirm: false
				},
				function(isConfirm){
					if(isConfirm){
						if(!isDeleting){
							reserveId = $('#id-modal').val();
							isDeleting = true;
							$.ajax({
								type: 'post',
								cache: false,
								url: reserveDeleterUrl+'/'+reserveId+'.json',
								beforeSend: function(xhr) {
									xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
									xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
								},
								success: function(response) {

									if (response.content) {
										swal({
											title: "<?= __('Deleted!') ?>",
											text: response.content,
											type: "success",
										},
										function(){
											//Remove reserve from calendar
											$('#calendar').fullCalendar('removeEvents', reserveId);
										})
									}
									if (response.error) {
										swal("<?= __('Error') ?>", response.error, "error");
									}
								},
								error: function(e) {
									swal("<?= __('Error') ?>", "<?= __('Reserve hasn\'t been deleted.') ?>", "error");
								},
								complete: function() {
									isDeleting = false;
								}
							});
						}
					}else{
						//Show modal again
						$('#reserve-details').modal('show');
					}
				}
			);
		};

		reserveCheckAttendUrl = ('<?= $this->Html->url(array('controller'=>'reserves', 'action' => 'checkAttend')) ?>');
		function checkAttend(){
			reserveId = $('#id-modal').val();
			//Bring the modified reserve
			modReserve = $('#calendar').fullCalendar('clientEvents', reserveId)[0];
			//Save previous value
			prevVal = modReserve.attended;
			//Update the content
			modReserve.attended = $('#attended-modal')[0].checked;
			//Rerender event
			$('#calendar').fullCalendar('renderEvent', modReserve);

			var formData = $('#attended-modal-div input').serializeArray();
			$.ajax({
				type: 'post',
				cache: false,
				data: formData,
				url: reserveCheckAttendUrl+'/'+reserveId+'.json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				},
				success: function(response) {

					if (response.content) {
						//All ok, nothing to do
					}
					if (response.error) {
						//Load previous value
						modReserve.attended = prevVal;
						//Rerender event
						$('#calendar').fullCalendar('renderEvent', modReserve);
						//Hide modal to view swal
						$('#reserve-details').modal('hide');
						swal("<?= __('Error') ?>", "<?= __('Hasn\'t been change attended state: ') ?>"+response.error, "error");
					}
				},
				error: function(e) {
					//Load previous value
					modReserve.attended = prevVal;
					//Rerender event
					$('#calendar').fullCalendar('renderEvent', modReserve);
					//Hide modal to view swal
					$('#reserve-details').modal('hide');
					swal("<?= __('Error') ?>", "<?= __('Hasn\'t been change attended state.') ?>", "error");

				},
				complete: function() {
					//Rerender event
					$('#calendar').fullCalendar('renderEvent', modReserve);
				}
			});
		}

		jQuery(document).ready(function() {
			$.uniform.restore($("input[name='data[Reserve][attended]']")); //Brings back checkbox to normality
			reserves.init();
		});

	</script>
<?php $this->end(); ?>