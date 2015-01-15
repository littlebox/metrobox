var UsersView = {

	init: function(){

		//Profile picture cropping function
		$('.fileinput').on('change.bs.fileinput',function(){
			$('#user-profile-picture-edit-btn-save').show();
			img_prev = $('.fileinput-preview img');
			div = $('.fileinput-preview');
			img_prev.css('min-width','100px');
			img_prev.css('min-height','100px');
			img_prev.Jcrop({
				bgFade:true,
				bgOpacity: 0.5,
				bgColor: 'black',
				addClass: 'jcrop-light',
				setSelect: [ 0, 0, 200, 200 ],
				aspectRatio: 1,
				minSize: [20,20],
				onSelect: function(c){
					document.getElementById('profile_picture_x').value = c.x;
					document.getElementById('profile_picture_y').value = c.y;
					document.getElementById('profile_picture_w').value = c.w;
					document.getElementById('profile_picture_h').value = c.h;
					document.getElementById('profile_picture_ow').value = div.width();
					document.getElementById('profile_picture_oh').value = div.height();
				}
			});
		})

	},

	sendProfilePictureForm: function (){

		var button = $( '#user-profile-picture-edit-btn-save' ).ladda();
		button.ladda( 'start' ); //Show loader in button
		button.ladda( 'setProgress', 0.5 );

		var targeturl = $('#user-profile-picture-edit').attr('action');
		var formData = new FormData(document.getElementById('user-profile-picture-edit'));

		pic = document.getElementById('profile_picture').files[0]

		xhr = new XMLHttpRequest();

		xhr.addEventListener("progress", updateProgress, false);
		xhr.addEventListener("load", transferComplete, false);
		xhr.addEventListener("error", transferFailed, false);
		xhr.addEventListener("abort", transferCanceled, false);

		xhr.open('POST', targeturl, true);
		
		xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax

		function updateProgress(ev){

			p = (ev.loaded / ev.total);
			button.ladda( 'setProgress', p );


		}

		function transferComplete(ev){

			p = (ev.loaded / ev.total);
			button.ladda( 'setProgress', p );

		}

		function transferFailed(ev){

			console.log(ev);

		}

		function transferCanceled(ev){

			console.log(ev);

		}

		xhr.send(formData);

		

		/*$.ajax({
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
					$('#page-alert-success').find('span').text(response.content);
					$('#page-alert-success').show();
					//Save new insputs values on an object LocalVar
					$("form#user-profile-info-edit input[type!='hidden']").each(function(){
						var input = $(this); // This is the jquery object of the input, do what you will
						LocalVar[input.attr('name')]=input.val();
					});
					unmakeEditable();
					$('#profile-usertitle-name').text(LocalVar['data[User][full_name]']);
				}
				if (response.error) {
					$('#page-alert-danger').find('span').text(response.error);
					$('#page-alert-danger').show();
				}
			},
			error: function(e) {
				$('#page-alert-danger').find('span').text("<?= __('An error ocurred, please try later.') ?>");
				$('#page-alert-danger').show();
			},
			complete: function(){
				button.ladda( 'stop' ); //Hide loader in button
			}*/

		}

};