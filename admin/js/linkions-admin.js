(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 jQuery(document).ready(function($){
		
		$('body').on( 'click', '.linkion-profile-upload', function(e){			
			e.preventDefault();

			var button = $(this),
			custom_uploader = wp.media({
				title: 'Insert image',
				library : {					
					type : 'image'
				},
				button: {
					text: 'Use this image' 
				},
				multiple: false
			}).on('select', function() { 
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				button.html('<img style="max-width:100%" src="' + attachment.url + '">').next().show().next().val(attachment.id);
			}).open();
		
		});

		// on remove button click
		$('body').on('click', '.linkion-profile-remove', function(e){
			e.preventDefault();
			var button = $(this);
			button.next().val(''); 
			button.hide().prev().html('Upload image');
		});
 	});

	

})( jQuery );
