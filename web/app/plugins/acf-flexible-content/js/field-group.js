acf_fc = {};

(function($){
	
	acf_fc = {
		
		$el : null,
		
		init : function(){
			
			// reference
			var _this = this;
			
			
			// vars
			this.$el = $('#acf_fields');
			
			
			// events
			this.$el.on('click', '.acf-fc-add', function( e ){
				
				e.preventDefault();
				
				_this.add( $(this).closest('.field_option') );
				
			});
			
			
			this.$el.on('click', '.acf-fc-duplicate', function( e ){
				
				e.preventDefault();
				
				_this.duplicate( $(this).closest('.field_option') );
				
			});
			
			
			this.$el.on('click', '.acf-fc-delete', function( e ){
				
				e.preventDefault();
				
				_this.remove( $(this).closest('.field_option') );
				
			});
			
			
			this.$el.on('change', '.acf-fc-meta-label input', function( e ){
					
				var $label = $(this);
				var $name = $(this).closest('.acf-fc-meta').find('.acf-fc-meta-name input');
				
				if( $name.val() == '' )
				{
					// thanks to https://gist.github.com/richardsweeney/5317392 for this code!
					var val = $label.val(),
						replace = {
							'ä': 'a',
							'æ': 'a',
							'å': 'a',
							'ö': 'o',
							'ø': 'o',
							'é': 'e',
							'ë': 'e',
							'ü': 'u',
							'ó': 'o',
							'ő': 'o',
							'ú': 'u',
							'é': 'e',
							'á': 'a',
							'ű': 'u',
							'í': 'i',
							' ' : '_',
							'\'' : ''
						};
					
					$.each( replace, function(k, v){
						var regex = new RegExp( k, 'g' );
						val = val.replace( regex, v );
					});
					
					
					val = val.toLowerCase();
					$name.val( val );
					$name.trigger('keyup');
				}
		
			});
			
			
			this.$el.on('mouseenter', '.acf-fc-reorder', function( e ){
				
				// vars
				var $table = $(this).closest('.acf_field_form_table');
				
				
				// only once
				if( $table.hasClass('sortable') )
				{
					return;
				}
				
				$table.addClass('sortable');
				
				
				// init sortable
				$table.children('tbody').sortable({
					items					: '.field_option_flexible_content',
					handle					: '.acf-fc-reorder',
					helper					: acf.helpers.sortable,
					forceHelperSize			: true,
					forcePlaceholderSize	: true,
					scroll					: true,
					start					: function (event, ui) {
						
		        		ui.placeholder.html('<td colspan="2"></td>');
		        		
		   			}
				});
				
			});
			
			
			this.$el.on('change', '.acf-fc-meta-display select', function( e ){
				
				// vars
				var $repeater = $(this).closest('.acf-fc-meta').siblings('.repeater');
				
				
				// Set class
				$repeater.removeClass('layout-row').removeClass('layout-table').addClass( 'layout-' + $(this).val() );
				
			});
			
		},
		
		
		add : function( $tr ){
			
			// vars
			var $new_tr = $tr.clone( false );
		
		
			// remove sub fields
			$new_tr.find('.field:not(.field_key-field_clone)').remove();
	
			
			// show add new message
			$new_tr.find('.no_fields_message').show();
			
			
			// reset layout meta values
			$new_tr.find('.acf-fc-meta input').val('');
			
			
			this.wipe_layout( $new_tr );
			
			
			// add new tr
			$tr.after( $new_tr );
			
			
			// display
			$new_tr.find('.acf-fc-meta select').val('row').trigger('change');
			
		},
		
		
		duplicate : function( $tr ){
			
			// save select values
			$tr.find('select').each(function(){
			
				$(this).attr( 'data-val', $(this).val() );
				
			});
			
			
			// vars
			var $new_tr = $tr.clone( false );
			
			
			this.wipe_layout( $new_tr );
			
			
			// update field names
			$new_tr.find('.field:not(.field_key-field_clone)').each(function(){
			
				$(this).update_names();
				
			});
			
			
			// add new tr
			$tr.after( $new_tr );
			
			
			// set select values
			$new_tr.find('select').each(function(){
			
				$(this).val( $(this).attr('data-val') ).trigger('change');
				
			});
			
			
			// focus on new label
			$new_tr.find('.acf-fc-meta-label input').focus();
			
		},
		
		
		remove : function( $tr ){
			
			if( $tr.siblings('.field_option_flexible_content[data-id]').length == 0 )
			{
				alert( acf.l10n.flexible_content_delete );
				return false;
			}
			
			
			// set layout
			$tr.css({
				height		: $tr.height(),
				width		: $tr.width(),
				position	: 'absolute'
			});
			
			
			// fade $tr
			$tr.animate({ opacity : 0 }, 250, function(){
				
				$(this).remove();
				
			});
			
			
			// create blank space
			$blank = $('<tr style="height:' + $tr.height() + 'px"><td colspan="2"></td></tr>');
			
			
			$tr.after( $blank );
			
			$blank.animate({ height : 0 }, 250, function(){
				
				$(this).remove();
				
			});
						
		},
		
		
		render : function( $el ){
			
			
			
		},
		
		
		wipe_layout : function( $el ){
			
			// vars
			var old_id = $el.attr('data-id'),
				new_id = acf.helpers.uniqid();
			
			
			// give field a new id
			$el.attr('data-id', new_id);
			
			
			// update attributes
			$el.find('[name]').each(function(){
			
				var name = $(this).attr('name').replace('[layouts][' + old_id + ']','[layouts][' + new_id + ']');
				
				$(this).attr('name', name);
				$(this).attr('id', name);
				
			});
						
		}
		
	};
	
	
	/*
	*  Document Ready
	*
	*  initialize
	*
	*  @type	event
	*  @date	15/10/12
	*  @since	1.1.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	$(document).on('ready', function(){
		
		acf_fc.init();
			
	});
	
	
	$(document).live('acf/field_form-open', function(e, field){
		
		$(field).find('.acf-fc-meta-display select').each(function(){
		
			$(this).trigger('change');
			
		});
		
	});
	

})(jQuery);
