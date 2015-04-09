var EstateAdd = {

	imagesDropzone: function (){

		var dropzone = new Dropzone('#imagesDropzone', {
			// previewTemplate: document.querySelector('#preview-template').innerHTML,
			url: estateAddImageUrl,
			dictDefaultMessage: 'Arrastra o clickea para subir fotos<span class="dz-note">(Podés subir hasta 20 fotos. Las fotos se cortarán al tamaño predefinido.)</span>',
			parallelUploads: 2,
			thumbnailHeight: 120,
			thumbnailWidth: 120,
			maxFilesize: 3,
			filesizeBase: 1000,
			// thumbnail: function(file, dataUrl) {
			// 	if (file.previewElement) {
			// 		file.previewElement.classList.remove("dz-file-preview");
			// 		var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
			// 		for (var i = 0; i < images.length; i++) {
			// 			var thumbnailElement = images[i];
			// 			thumbnailElement.alt = file.name;
			// 			thumbnailElement.src = dataUrl;
			// 		}
			// 		setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
			// 	}
			// }
		})

	},

	init: function (){
		EstateAdd.imagesDropzone();
	}

}
