(function($){
	
	/*
	*  Flexible Content
	*
	*  static model for this field
	*
	*  @type	event
	*  @date	18/08/13
	*
	*/
	
	acf.fields.flexible_content = {
		
		$el : null,
		$values : null,
				
		o : {},
		
		set : function( o ){
			
			// merge in new option
			$.extend( this, o );
			
			
			// find elements
			this.$values = this.$el.children('.values');
			
			
			// get options
			this.o = acf.helpers.get_atts( this.$el );
			
			
			// add layout_count
			this.o.layout_count = this.$values.children('.layout').length;	
			
			
			// return this for chaining
			return this;
			
		},
		init : function(){
			
			// reference
			var _this = this,
				$el = this.$el;
			
			
			// sortable
			if( this.o.max != 1 )
			{
				this.$values.unbind('sortable').sortable({
					items					: '> .layout',
					handle					: '> .acf-fc-layout-handle',
					forceHelperSize			: true,
					forcePlaceholderSize	: true,
					scroll					: true,
					
					start : function (event, ui) {
					
						$(document).trigger('acf/sortable_start', ui.item);
						$(document).trigger('acf/sortable_start_flex', ui.item);
		        		
		   			},
		   			stop : function (event, ui) {
					
						$(document).trigger('acf/sortable_stop', ui.item);
						$(document).trigger('acf/sortable_stop_flex', ui.item);
						
						// render
						_this.set({ $el : $el }).render();
		   			}
				});
			}
						
			
			// render
			this.render();
			
			
			// make field required if has min
			var add_required = false;
			
			if( this.o.min > 0 )
			{
				add_required = true;
			}
			else
			{
				// vars
				var $popup = $( this.$el.children('.tmpl-popup').html() );
				
				
				$popup.find('a').each(function(){
					
					// vars
					var min = parseInt( $(this).attr('data-min') );
					
					
					if( min > 0 )
					{
						add_required = true;
						
						// end loop
						return false;	
					}
					
				});

				
			}
			
			
			if( add_required )
			{
				this.$el.closest('.field').addClass('required');
			}		
			
		},
		render : function(){
			
			// update order numbers
			this.$values.children('.layout').each(function( i ){
			
				$(this).find('> .acf-fc-layout-handle .fc-layout-order').html( i+1 );
				
			});
			
			
			// empty?
			if( this.o.layout_count == 0 )
			{
				this.$el.addClass('empty');
			}
			else
			{
				this.$el.removeClass('empty');
			}
			
			
			// row limit reached
			if( this.o.layout_count >= this.o.max )
			{
				this.$el.addClass('disabled');
				this.$el.find('> .acf-flexible-content-footer .acf-button').addClass('disabled');
			}
			else
			{
				this.$el.removeClass('disabled');
				this.$el.find('> .flexible-footer .acf-button').removeClass('disabled');
			}
			
		},
		
		validate_add : function( layout ){
			
			var r = true;
			
			// vadiate max
			this.o.max = parseInt(this.o.max);
			if( this.o.max > 0 && this.o.layout_count >= this.o.max )
			{
				var identifier	= ( this.o.max == 1 ) ? 'layout' : 'layouts',
					s 			= acf.l10n.flexible_content.max;
				
				// translate
				s = s.replace('{max}', this.o.max);
				s = s.replace('{identifier}', acf.l10n.flexible_content[ identifier ]);
				
				r = false;
				
				alert( s );
			}
			
			
			// vadiate max layout
			var $popup			= $( this.$el.children('.tmpl-popup').html() ),
				$a				= $popup.find('[data-layout="' + layout + '"]'),
				layout_max		= $a.attr('data-max'),
				layout_count	= this.$values.children('.layout[data-layout="' + layout + '"]').length;
			
			
			layout_max = parseInt(layout_max);
			if( layout_max > 0 && layout_count >= layout_max )
			{
				var identifier	= ( layout_max == 1 ) ? 'layout' : 'layouts',
					s 			= acf.l10n.flexible_content.max_layout;
				
				// translate
				s = s.replace('{max}', layout_count);
				s = s.replace('{label}', '"' + $a.text() + '"');
				s = s.replace('{identifier}', acf.l10n.flexible_content[ identifier ]);
				
				r = false;
				
				alert( s );
			}
			
			
			// return
			return r;
			
		},
		
		validate_remove : function( layout ){
			
			// vadiate min
			this.o.min = parseInt(this.o.min);
			if( this.o.min > 0 && this.o.layout_count <= this.o.min )
			{
				var identifier	= ( this.o.min == 1 ) ? 'layout' : 'layouts',
					s 			= acf.l10n.flexible_content.min + ', ' + acf.l10n.flexible_content.remove;
				
				// translate
				s = s.replace('{min}', this.o.min);
				s = s.replace('{identifier}', acf.l10n.flexible_content[ identifier ]);
				s = s.replace('{layout}', acf.l10n.flexible_content.layout);
				
				return confirm( s );

			}
			
			
			// vadiate max layout
			
			var $popup			= $( this.$el.children('.tmpl-popup').html() ),
				$a				= $popup.find('[data-layout="' + layout + '"]'),
				layout_min		= $a.attr('data-min'),
				layout_count	= this.$values.children('.layout[data-layout="' + layout + '"]').length;
			
			
			layout_min = parseInt(layout_min);
			if( layout_min > 0 && layout_count <= layout_min )
			{
				var identifier	= ( layout_min == 1 ) ? 'layout' : 'layouts',
					s 			= acf.l10n.flexible_content.min_layout + ', ' + acf.l10n.flexible_content.remove;
				
				// translate
				s = s.replace('{min}', layout_count);
				s = s.replace('{label}', '"' + $a.text() + '"');
				s = s.replace('{identifier}', acf.l10n.flexible_content[ identifier ]);
				s = s.replace('{layout}', acf.l10n.flexible_content.layout);
				
				return confirm( s );
			}
			
			
			// return
			return true;
			
		},
		
		
		add : function( layout, $before ){
			
			// bail early if validation fails
			if( !this.validate_add( layout ) )
			{
				return;
			}
			
			
			// vars
			var new_id = acf.helpers.uniqid(),
				new_field_html = this.$el.find('> .clones > .layout[data-layout="' + layout + '"]').html().replace(/(=["]*[\w-\[\]]*?)(acfcloneindex)/g, '$1' + new_id),
				new_field = $('<div class="layout" data-layout="' + layout + '"></div>').append( new_field_html );
				
				
			// hide no values message
			this.$el.children('.no_value_message').hide();
			
			
			// add row
			if( $before )
			{
				$before.before( new_field );
			}
			else
			{
				this.$values.append( new_field ); 
			}
			
			
			// acf/setup_fields
			$(document).trigger('acf/setup_fields', [ new_field ] );
			
			
			// update order
			this.render();
			
			
			// validation
			this.$el.closest('.field').removeClass('error');
			
		},
		remove : function( $el ){
			
			// bail early if validation fails
			if( !this.validate_remove( $el.attr('data-layout') ) )
			{
				return;
			}
			
			
			// refernce
			var _this = this;
			
			
			// set layout
			$el.css({
				height		: $el.height(),
				width		: $el.width(),
				position	: 'absolute'
			});
			
			
			// fade $tr
			$el.animate({ opacity : 0 }, 250, function(){
				
				$(this).remove();
				
			});
			
			
			// create blank space
			$blank = $('<div style="height:' + $el.height() + 'px"></div>');
			
			
			$el.after( $blank );
			
			
			// close field
			var end_height = 0;
			
			if( $el.siblings('.layout').length == 0 )
			{
				end_height = this.$el.children('.no_value_message').outerHeight();
			}
			
			$blank.animate({ height : end_height }, 250, function(){
				
				$(this).remove();
				
				
				if( end_height > 0 )
				{
					_this.$el.children('.no_value_message').show();
				}
				
			});
			
			
		},
		
		toggle : function( $layout ){
			
			if( $layout.attr('data-toggle') == 'closed' )
			{
				$layout.attr('data-toggle', 'open');
				$layout.children('.acf-input-table').show();
			}
			else
			{
				$layout.attr('data-toggle', 'closed');
				$layout.children('.acf-input-table').hide();
			}	
			
		},
		
		open_popup : function( $a, in_layout ){
			
			// reference
			var _this = this;
			
			
			// defaults
			in_layout = in_layout || false;
			
			
			// vars
			$popup = $( this.$el.children('.tmpl-popup').html() );
			
			
			$popup.find('a').each(function(){
				
				// vars
				var min		= parseInt( $(this).attr('data-min') ),
					max		= parseInt( $(this).attr('data-max') ),
					name	= $(this).attr('data-layout'),
					label	= $(this).text(),
					count	= _this.$values.children('.layout[data-layout="' + name + '"]').length,
					$status = $(this).children('.status');
				
				
				if( max > 0 )
				{
					// find diff
					var available	= max - count,
						s			= acf.l10n.flexible_content.available,
						identifier	= ( available == 1 ) ? 'layout' : 'layouts',
				
					// translate
					s = s.replace('{available}', available);
					s = s.replace('{max}', max);
					s = s.replace('{label}', '"' + label + '"');
					s = s.replace('{identifier}', acf.l10n.flexible_content[ identifier ]);
					
					
					$status.show().text( available ).attr('title', s);
					
					// limit reached?
					if( available == 0 )
					{
						$status.addClass('warning');
					}
				}
				
				
				if( min > 0 )
				{
					// find diff
					var required	= min - count,
						s			= acf.l10n.flexible_content.required,
						identifier	= ( required == 1 ) ? 'layout' : 'layouts',
				
					// translate
					s = s.replace('{required}', required);
					s = s.replace('{min}', min);
					s = s.replace('{label}', '"' + label + '"');
					s = s.replace('{identifier}', acf.l10n.flexible_content[ identifier ]);
					
					
					if( required > 0 )
					{
						$status.addClass('warning').show().text( required ).attr('title', s);
					}
					
					
				}
				
			});
			
			
			// add popup
			$a.after( $popup );
			
			
			// within layout?
			if( in_layout )
			{
				$popup.addClass('within-layout');
				$popup.closest('.layout').addClass('popup-open');
			}
			
			
			// vars
			$popup.css({
				'margin-top' : 0 - $popup.height() - $a.outerHeight() - 14,
				'margin-left' : ( $a.outerWidth() - $popup.width() ) / 2,
			});
			
			
			// check distance to top
			var offset = $popup.offset().top;
			
			if( offset < 30 )
			{
				$popup.css({
					'margin-top' : 15
				});
				
				$popup.find('.bit').addClass('top');
			}
			
			
			$popup.children('.focus').trigger('focus');
			
		}
		
	};
	
	
	/*
	*  acf/setup_fields
	*
	*  run init function on all elements for this field
	*
	*  @type	event
	*  @date	20/07/13
	*
	*  @param	{object}	e		event object
	*  @param	{object}	el		DOM object which may contain new ACF elements
	*  @return	N/A
	*/
	
	$(document).on('acf/setup_fields', function(e, el){
		
		$(el).find('.acf-flexible-content').each(function(){
			
			acf.fields.flexible_content.set({ $el : $(this) }).init();
						
		});
		
	});
	
	
	/*
	*  Events
	*
	*  jQuery events for this field
	*
	*  @type	function
	*  @date	1/03/2011
	*
	*  @param	N/A
	*  @return	N/A
	*/
	
	$(document).on('click', '.acf-flexible-content .flexible-footer .acf-fc-add', function( e ){
		
		e.preventDefault();
		
		acf.fields.flexible_content.set({ $el : $(this).closest('.acf-flexible-content') }).open_popup( $(this) );
		
		$(this).blur();
		
	});
	
	$(document).on('click', '.acf-flexible-content .acf-fc-layout-controlls .acf-fc-add', function( e ){
		
		e.preventDefault();
		
		acf.fields.flexible_content.set({ $el : $(this).closest('.acf-flexible-content') }).open_popup( $(this), true );
		
		$(this).blur();
		
	});
	
	$(document).on('click', '.acf-flexible-content .acf-fc-layout-controlls .acf-fc-remove', function( e ){
		
		e.preventDefault();
		
		acf.fields.flexible_content.set({ $el : $(this).closest('.acf-flexible-content') }).remove( $(this).closest('.layout') );
		
		$(this).blur();
		
	});
	
	$(document).on('click', '.acf-flexible-content .acf-fc-layout-handle', function( e ){
	
		e.preventDefault();
		
		acf.fields.flexible_content.toggle( $(this).closest('.layout') );
		
		$(this).blur();
			
	});
	
	
	/* popup */
	
	$(document).on('click', '.acf-flexible-content .acf-fc-popup li a', function( e ){
		
		e.preventDefault();
		
		var $popup = $(this).closest('.acf-fc-popup'),
			$layout = null;
		
		if( $popup.hasClass('within-layout') )
		{
			$layout = $popup.closest('.layout');
		}
		
		
		acf.fields.flexible_content.set({ $el : $(this).closest('.acf-flexible-content') }).add( $(this).attr('data-layout'), $layout );
		
		$(this).blur();
		
	});
	
	$(document).on('blur', '.acf-flexible-content .acf-fc-popup .focus', function( e ){
		
		var $popup = $(this).parent();
		
		
		// hide controlls?
		if( $popup.closest('.layout').exists() )
		{
			$popup.closest('.layout').removeClass('popup-open');
		}
		
		
		setTimeout(function(){
			
			$popup.remove();
			
		}, 200);

		
	});
	
	
	/*
	*  Validate
	*
	*  jQuery events for this field
	*
	*  @type	function
	*  @date	1/03/2011
	*
	*  @param	N/A
	*  @return	N/A
	*/
	
	$(document).on('acf/validate_field', function( e, field ){
		
		// vars
		var $field = $( field );
		
		
		// validate
		if( ! $field.hasClass('field_type-flexible_content') )
		{
			return;
		}
		
		var $el = $field.find('.acf-flexible-content:first');
		
		
		// required
		$field.data('validation', false);
		$field.data('validation_message', false);
		
		
		if( $el.children('.values').children('.layout').exists() )
		{
			$field.data('validation', true);
		}
		
		
		// min total
		var min = parseInt( $el.attr('data-min') );
		
		if( min > 0 )
		{
			if( $el.children('.values').children('.layout').length < min )
			{
				var identifier	= ( min == 1 ) ? 'layout' : 'layouts',
					s 			= acf.l10n.flexible_content.min;
				
				// translate
				s = s.replace('{min}', min);
				s = s.replace('{identifier}', acf.l10n.flexible_content[ identifier ]);
				
				
				$field.data('validation', false);
				$field.data('validation_message', s);
			}
		}
		
		
		// min layout
		var $popup = $( $el.children('.tmpl-popup').html() );
		
		$popup.find('a').each(function(){
			
			// vars
			var min		= parseInt( $(this).attr('data-min') ),
				max		= parseInt( $(this).attr('data-max') ),
				name	= $(this).attr('data-layout'),
				label	= $(this).text(),
				count	= $el.children('.values').children('.layout[data-layout="' + name + '"]').length;
			
			
			if( count < min )
			{
				var identifier	= ( min == 1 ) ? 'layout' : 'layouts',
					s 			= acf.l10n.flexible_content.min_layout;
				
				// translate
				s = s.replace('{min}', min);
				s = s.replace('{label}', '"' + label + '"');
				s = s.replace('{identifier}', acf.l10n.flexible_content[ identifier ]);
				
				$field.data('validation', false);
				$field.data('validation_message', s);
			}
			
		});
		
		
		
		
	});
	

})(jQuery);
