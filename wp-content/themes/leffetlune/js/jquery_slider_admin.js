jQuery( function($){
	// on upload button click
	$( 'body' ).on( 'click', '.slider-upload', function( event ){
		event.preventDefault(); // prevent default link click and page refresh
		
		const input = $(".slider_img");
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
			const preview = $(".slider-preview");
			preview.text("");
			input.val("");
			customUploader.state().get( 'selection' ).forEach(element => {
				element = element.toJSON();
				$("<img>").attr({
					src: element.url,
					alt: element.title
				}).appendTo(preview);
				input.val((i, val)=>val + (val?",":"")+ element.id)
			});
			//button.removeClass( 'button' ).html( '<img src="' + attachment.url + '">'); // add image instead of "Upload Image"
			//button.next().show(); // show "Remove image" link
			//button.next().next().val( attachment.id ); // Populate the hidden field with image ID
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
	// $( 'body' ).on( 'click', '.rudr-remove', function( event ){
	// 	event.preventDefault();
	// 	const button = $(this);
	// 	button.next().val( '' ); // emptying the hidden field
	// 	button.hide().prev().addClass( 'button' ).html( 'Upload image' ); // replace the image with text
	// });
});