var FormSamples = function () {


	return {
		//main function to initiate the module
		init: function () {

			// use select2 dropdown instead of chosen as select2 works fine with bootstrap on responsive layouts.
			$('.select2_category').select2({
				placeholder: "Select an option",
				allowClear: true
			});

			$('.select2_sample1').select2({
				placeholder: "Select a State",
				allowClear: true
			});

			$(".select2_sample2").select2({
				placeholder: "Type to select an option",
				allowClear: true,
				minimumInputLength: 1,
				query: function (query) {
					var data = {
						results: []
					}, i, j, s;
					for (i = 1; i < 5; i++) {
						s = "";
						for (j = 0; j < i; j++) {
							s = s + query.term;
						}
						data.results.push({
							id: query.term + i,
							text: s
						});
					}
					query.callback(data);
				}
			});

			$(".select2_sample3").select2({
				tags: ["red", "green", "blue", "yellow", "pink"]
			});

		}

	};
}();

var uploadFile = function(){

	$('.fileinput').on('change.bs.fileinput',function(){

	img_prev = $('.fileinput-preview img')

	div = $('.fileinput-preview')

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

}();