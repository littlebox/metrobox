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
		})

	},


	init: function (){
		EstateAdd.imagesDropzone();
	}

}
