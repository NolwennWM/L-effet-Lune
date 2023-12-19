jQuery( function($){
	// on upload button click
	const preview = $(".slider-preview");
	const input = $(".slider_img");
	$( 'body' ).on( 'click', '.slider-upload', function( event ){
		event.preventDefault(); // prevent default link click and page refresh
		
		const imageId = input.val().split(",");
		
		const customUploader = wp.media({
			title: 'Selectionnés les images', // modal window title
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				type : 'image'
			},
			button: {
				text: 'Utiliser ces images' // button label text
			},
			multiple: true
		}).on( 'select', function() 
		{
			preview.text("");
			input.val("");
			customUploader.state().get( 'selection' ).forEach(element => {
				element = element.toJSON();
				$("<img>").attr({
					src: element.url,
					alt: element.title
				}).appendTo(preview);
				input.val((i, val)=>val + (val?",":"")+ element.id);// Populate the hidden field with image ID
			});
			$(".slider-remove").show();
		})
		
		// already selected images
		customUploader.on( 'open', function() {

			if( !imageId.length )return;
			imageId.forEach(id=>{
				const selection = customUploader.state().get( 'selection' )
				attachment = wp.media.attachment( id );
				attachment.fetch();
				selection.add( attachment ? [attachment] : [] );
			});
				
			
		})

		customUploader.open()
	
	});
	// on remove button click
	$( 'body' ).on( 'click', '.slider-remove', function( event ){
		event.preventDefault();
		const del = $(this);
		input.val(''); // emptying the hidden field
		preview.text("");
		del.hide(); // replace the image with text
	});
});