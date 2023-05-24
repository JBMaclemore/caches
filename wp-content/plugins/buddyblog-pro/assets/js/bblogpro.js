(function( $){
	var doingDraftRequest = false, doingSubmission = false, currentMediaFieldID;
	var termsTemplate = {
			checkbox: _.template('<li id="category-<%= id %>"><label><input value="<%= id %>" type="checkbox" name="tax_input[<%= taxonomy %>][]" id="in-category-<%= id %>"><%= label %></label></li>'),
			selectbox : _.template("<option class='level-0' value='<%= id %>'><%= label %></option>")
	};

	$(document).ready(function ($) {
		// confirm action

		$(document).on('click', '.bbl-confirm-action', function( evt) {
			evt.stopPropagation();
            var confirmationMessage = $(this).data('bbl-confirm');
            if( !  confirmationMessage ) {
                confirmationMessage = typeof BuddyBlog_Pro !== "undefined" ? BuddyBlog_Pro.confirm_message : 'Are you sure about it?';
            }

			// stop action if not confirmed.
			if( ! confirm( confirmationMessage )) {
				return false;
			}
		});


		var postType = typeof BuddyBlog_Pro !== "undefined" ? BuddyBlog_Pro.post_type : '';

        if ( ! postType ) {
            postType = $( '.bblpro-post-form input[name="bbl_post_type"]' ).val();
        }

		var post_id = $( '#bbl_post_id' ).val();
		var nonce = $( "#_bbl_update_post_nonce" ).val();
		if ( ! nonce ) {
			nonce = $( "#_bbl_form_nonce" ).val();
		}
		// update media modal setting with post id.
		if ( post_id && parseInt( post_id, 10 ) && isWPMediaJSLoaded() ) {
			wp.media.model.settings.post.id = wp.media.view.settings.post.id = post_id;
			wp.media.model.settings.post.nonce = wp.media.view.settings.post.nonce = nonce;
		}
		//= wp.media.view.settings.post;

		// add our context.
		$.ajaxPrefilter(function (options, originalOptions, jqXHR) {
			var action = get_query_var('action', options.data);

			if ('get-post-thumbnail-html' === action) {
				options.data = options.data + '&bbl_thumbnail_context=1&bbl_context_type=' + postType;
			} else if ('query-attachments' === action) {
				options.data = options.data + '&bbl_context_type=' + postType;
				if (typeof BuddyBlog_Pro.currentMediaFieldID !== "undefined" && BuddyBlog_Pro.currentMediaFieldID) {
					options.data = options.data + '&bbl_field_id='+BuddyBlog_Pro.currentMediaFieldID;
				}
			}
		});

		// form submission handling for posting/editing.
		$( document ).on('click', '#bbl-submit-button, #bbl-edit-submit-button', function () {
			if ( doingSubmission ) {
				return false;
			}

			doingSubmission = true;

			// if for some reason there was an error thrown by reponse js, still set the button anctive.
			setTimeout(function() {
				doingSubmission = false;
			}, 5000 );

			// enable loader..
			var $this = $( this ),
				$form = $( this ).parents( '.bblpro-post-form' );

			if ( ! $form.length ) {
				return;
			}

			// remove any old error.
			$form.find( '.bbl-form-field-error, .bbl-form-field-success' ).remove();
			$form.find( '.bblpro-ajax-loader' ).removeClass( 'bblpro-ajax-loader-hidden' );

			var query = $form.serialize() + '&action=bblpro_submit_post';

			if ( typeof tinyMCE !== "undefined" && tinymce.get( "bbl_post_content" )) {
				query = query + '&bbl_post_content=' + encodeURIComponent( tinymce.get( "bbl_post_content" ).getContent() );
			}

            if ( typeof tinyMCE !== "undefined" && tinymce.get( "bbl_post_excerpt" )) {
				query = query + '&bbl_post_excerpt=' + encodeURIComponent( tinymce.get( "bbl_post_excerpt" ).getContent() );
			}

			// custom fields.
            query = prepareQueryForEditorFields( query );

			$.post( ajaxurl, query, function ( response ) {
				$form.find( '.bbl-form-field-error, .bbl-form-field-success' ).remove();
				if ( response.success ) {

					var data = response.data;
					for ( var key in data ) {

						if ( ! data.hasOwnProperty( key ) ) {
							continue;
						}

						if ( 'global' === key ) {
							// show the status update.
							$( '.bbl-submit-form-panel' ).before( successMessageMarkup( key, Array.isArray( data[key] ) ? data[key][0] : data[key] ) );
						}
					}
					// redirect.
					if (data.url) {
						window.location.href = data.url;
					}
				} else {
					var errors = response.data;
					var selector;
					for ( var key in errors ) {

						if ( ! errors.hasOwnProperty( key ) ) {
							continue;
						}

						// if for custom fields.
						if ( 'global' === key ) {
							// show the status update.
							selector = '';
							$( '.bbl-submit-form-panel' ).before( errorMessageMarkup( key, Array.isArray( errors[key] ) ? errors[key][0] : errors[key] ) );
						} else if ( startsWith( "bbl_cf_", key ) ) {
							selector = '.bbl-form-field-bbl_custom_field' + key.substring( 'bbl_cf_'.length ) + '-container';
						} else if ( startsWith( "bbl_tax_", key ) ) {
							selector = '.bbl-form-field-taxonomy-' + key.substring( 'bbl_tax_'.length ) + '-terms-container';
						} else {
							selector = '.bbl-form-field-' + key + '-container';
						}

						if ( selector ) {
							$( selector ).prepend( errorMessageMarkup( key, Array.isArray( errors[key] ) ? errors[key][0] : errors[key] ) );
						}
					}
				}
				// show notice.
				// disable loader.
				$form.find( '.bblpro-ajax-loader' ).addClass( 'bblpro-ajax-loader-hidden' );
				doingSubmission = false;
			}, 'json' );
			return false;
		} );

		$( document ).on( 'click', '#bbl-draft-button', function () {
			if ( doingDraftRequest ) {
				return false;
			}

			doingDraftRequest = true;

			// if for some reason there was an error thrown by reponse js, still set the button anctive.
			setTimeout(function() {
				doingDraftRequest = false;
			}, 5000 );

			// enable loader..
			var $this = $( this ),
				$form = $( this ).parents( '.bblpro-post-form' );

			if ( ! $form.length ) {
				return;
			}
			// remove any old error.
			$form.find( '.bbl-form-field-error, .bbl-form-field-success' ).remove();
			$form.find( '.bblpro-ajax-loader' ).removeClass( 'bblpro-ajax-loader-hidden' );

			var query = $form.serialize() + '&action=bblpro_save_draft';

			if ( typeof tinyMCE !== "undefined" && tinymce.get( "bbl_post_content" )) {
				query = query + '&bbl_post_content=' + encodeURIComponent( tinymce.get( "bbl_post_content" ).getContent() );
			}

            if ( typeof tinyMCE !== "undefined" && tinymce.get( "bbl_post_excerpt" )) {
				query = query + '&bbl_post_excerpt=' + encodeURIComponent( tinymce.get( "bbl_post_excerpt" ).getContent() );
			}

			// custom fields.
            query = prepareQueryForEditorFields( query );

			$.post( ajaxurl,query, function ( response ) {
				$form.find( '.bbl-form-field-error, .bbl-form-field-success' ).remove();
				if ( response.success ) {

					var data = response.data;
					for ( var key in data ) {

						if ( ! data.hasOwnProperty( key ) ) {
							continue;
						}

						if ( 'global' === key ) {
							// show the status update.
							$( '.bbl-submit-form-panel' ).before( successMessageMarkup( key, Array.isArray( data[key] ) ? data[key][0] : data[key] ) );
						}
					}

					// notify that draft was saved.
				} else {
					var errors = response.data;
					var selector;
					for ( var key in errors ) {

						if ( ! errors.hasOwnProperty( key ) ) {
							continue;
						}

						// if for custom fields.
						if ('global' === key) {
							// show the status update.
							selector = '';
							$( '.bbl-submit-form-panel' ).before( errorMessageMarkup( key, Array.isArray( errors[key] ) ? errors[key][0] : errors[key] ) );
						} else if ( startsWith( "bbl_cf_", key ) ) {
							selector = '.bbl-form-field-bbl_custom_field' + key.substring( 'bbl_cf_'.length ) + '-container'
						} else if ( startsWith( "bbl_tax_", key ) ) {
							selector = '.bbl-form-field-taxonomy-' + key.substring( 'bbl_tax_'.length ) + '-terms-container';
						} else {
							selector = '.bbl-form-field-' + key + '-container';
						}

						if ( selector ) {
							$( selector ).prepend( errorMessageMarkup( key, Array.isArray( errors[key] ) ? errors[key][0] : errors[key] ) );
						}
					}
				}
				// show notice.
				// disable loader.
				$form.find( '.bblpro-ajax-loader' ).addClass( 'bblpro-ajax-loader-hidden' );
				doingDraftRequest = false;
			}, 'json' );
			return false;
		} );

		$( document ).on( 'click', '#bbl-revert-draft-button', function () {
			if ( doingDraftRequest ) {
				return false;
			}

			doingDraftRequest = true;

			// if for some reason there was an error thrown by reponse js, still set the button anctive.
			setTimeout( function () {
				doingDraftRequest = false;
			}, 5000 );

			// enable loader..
			var $this = $( this ),
				$form = $( this ).parents( '.bblpro-post-form' );

			if ( ! $form.length ) {
				return;
			}
			// remove any old error.
			$form.find( '.bbl-form-field-error, .bbl-form-field-success' ).remove();
			$form.find( '.bblpro-ajax-loader' ).removeClass( 'bblpro-ajax-loader-hidden' );

			var query = $form.serialize() + '&action=bblpro_revert_to_draft';

			$.post( ajaxurl, query, function ( response ) {
				$form.find( '.bbl-form-field-error, .bbl-form-field-success' ).remove();
				if ( response.success ) {

					var data = response.data;
					if ( data.global ) {
						$( '.bbl-submit-form-panel' ).before( successMessageMarkup( key, data.global ) );
					}

					// redirect.
					if ( data.url ) {
						window.location.href = data.url;
					}
				} else {
					var errors = response.data;
					var selector;
					for ( var key in errors) {

						if ( ! errors.hasOwnProperty( key ) ) {
							continue;
						}

						// if for custom fields.
						if ( 'global' === key ) {
							// show the status update.
							selector = '';
							$( '.bbl-submit-form-panel' ).before( errorMessageMarkup( key, Array.isArray( errors[key] ) ? errors[key][0] : errors[key] ) );
						}
					}
				}
				// show notice.
				// disable loader.
				$form.find( '.bblpro-ajax-loader' ).addClass( 'bblpro-ajax-loader-hidden' );
				doingDraftRequest = false;
			}, 'json' );
			return false;
		} );

		$(document).on('click', '.bbl-input-term-new-button', function () {
			var $button = $(this),
				$container = $button.closest('.bbl-create-taxonomy-term-container'),
				$input = $container.find('.bbl-input-term-new'),
				view = $button.data('view'),
				form_id = $button.data('form-id'),
				taxonomy = $button.data('taxonomy'),
				nonce = $button.data('nonce'),
				term = $input.val();

			$container.find('.bbl-form-field-error, .bbl-form-field-success').remove();

			if ('' === term || !term.trim().length) {
				$container.prepend(errorMessageMarkup('term-' + taxonomy, 'Empty terms are not allowed.'));
				return false;
			}
			// disable button click.
			$button.prop('disabled', true );
			term = term.trim();// stip spaces.

			$.post(ajaxurl, {
				action: 'bblpro_create_term',
				_wpnonce: nonce,
				form_id: form_id,
				taxonomy: taxonomy,
				term: term
			}, function (response) {
				$button.prop('disabled', false);
				$input.val('');
				if (!response.success) {
					$container.prepend(errorMessageMarkup('term-' + taxonomy, response.data ? response.data.message : 'There was a problem, Please try again later.'));

					return false;
				}

				var data = response.data;

				var entry = {id: data.id, label: term, taxonomy: taxonomy}
				view = 'select' === view ? 'selectbox' : view;
				var template = termsTemplate[view];

				if (!template) {
					return false;
				}

				$('#bblpro-tax-' + view + '-' + taxonomy).append(template(entry));
				$container.prepend(successMessageMarkup('term-' + taxonomy, response.data ? response.data.message : 'Created successfully!.'));
				//$('#bblpro-tax-selectbox-'+taxonomy).append(termsTemplate.selectbox({id: 32, label: 'hello world'}));
				//$('#bblpro-tax-checkbox-'+taxonomy).append(termsTemplate.selectbox({id: 32, label: 'hello world', taxonomy: taxonomy}));
				//if we are here, the term creation succeeded
				// append to the list.
			}, 'json');

			return false;
		});

		// adds error message for the given field.
		function errorMessageMarkup( field, err ) {
		   return '<div class="bbl-form-field-error bbl-form-field-'+field +'-error">'+err +'</div>';
		}        // adds error message for the given field.

		function successMessageMarkup( field, err ) {
		   return '<div class="bbl-form-field-success bbl-form-field-'+field +'-sucess">'+err +'</div>';
		}

		/**
		 * Prepares query with editor field types.
		 *
		 * @param query
		 * @returns {*}
		 */
	   function prepareQueryForEditorFields( query ) {
			var key, name, val, values, editor;

			if (typeof MediumEditor !== "undefined") {
				$('.bbl-field-type-medium_editor').each(function (index, element) {
					editor = MediumEditor.getEditorFromElement($(this).get(0));
					if (!editor) {

						return;
					}

					name = $(this).attr('name');

					values = Object.values(editor.serialize());

					if (values.length) {
						val = values[0]['value'];
					} else {
						val = '';
					}

					query = query + '&' + name + '=' + encodeURIComponent(val);
				});
			}

            if ( typeof tinyMCE === "undefined" ) {
                return query;
            }

            var editorFields = $( '#bbl-custom-field-type-editor-ids' ).val();
            if ( ! editorFields || ! editorFields.length ) {
                return query;
            }

            var fields = editorFields.split( ',' );
            for ( var i =0; i< fields.length; i++ ) {
                key = 'bbl_custom_field' + fields[i];
                 name = 'bbl_custom_field[' + fields[i] + ']';

				if (tinymce.get(key)) {
					query = query + '&' + name + '=' + encodeURIComponent(tinymce.get(key).getContent());
				} else if ($('#' + key).length) {
					query = query + '&' + name + '=' + encodeURIComponent($('#' + key).val());
				}
			}
            return query;
        }
	} );


	/**
	 * Based on bp_get_query_var.
	 *
	 * Get a querystring parameter from a URL.
	 */
	function get_query_var(param, url) {

		if (!url || typeof url !== 'string') {
			return '';
		}

		var qs = {};

		url = url.split('&');

		// Parse querystring into object props.
		// http://stackoverflow.com/a/21152762 .
		url.forEach(function (item) {
			qs[item.split('=')[0]] = item.split('=')[1] && decodeURIComponent(item.split('=')[1]);
		});

		if (qs.hasOwnProperty(param) && qs[param] != null) {
			return qs[param];
		} else {
			return false;
		}
	}

	// check if string starts with prefix.
	function startsWith( prefix, heystack ) {

		if ( String.prototype.startsWith ) {
			return heystack.startsWith( prefix )
		}

		return heystack.substring( 0, prefix.length ) === prefix;
	}

	// checks if WordPress Media Uploader Js is loaded.
	function isWPMediaJSLoaded() {
		// for loading media related to the post.
		if ( typeof wp == 'undefined' || typeof wp.media == 'undefined' || typeof wp.media.model == 'undefined' || typeof wp.media.view == 'undefined' || wp.media.view.settings == undefined ) {
			return false;
		}
		return true;
	}
})(jQuery);

