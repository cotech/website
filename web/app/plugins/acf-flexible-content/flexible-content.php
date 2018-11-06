<?php

class acf_field_flexible_content extends acf_field
{

	var $settings;
	
	
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'flexible_content';
		$this->label = __("Flexible Content",'acf');
		$this->category = __("Layout",'acf');
		$this->defaults = array(
			'layouts'		=>	array(),
			'min'			=>	'',
			'max'			=>	'',
			'button_label'	=>	__("Add Row",'acf'),
		);
		$this->l10n = array(
			'layout' 		=> __("layout", 'acf'),
			'layouts'		=> __("layouts", 'acf'),
			'remove'		=> __("remove {layout}?", 'acf'),
			'min'			=> __("This field requires at least {min} {identifier}",'acf'),
			'max'			=> __("This field has a limit of {max} {identifier}",'acf'),
			'min_layout'	=> __("This field requires at least {min} {label} {identifier}",'acf'),
			'max_layout'	=> __("Maximum {label} limit reached ({max} {identifier})",'acf'),
			'available'		=> __("{available} {label} {identifier} available (max {max})",'acf'),
			'required'		=> __("{required} {label} {identifier} required (min {min})",'acf'),
		);		
		
		// do not delete!
    	parent::__construct();
    	

    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.1.1'
		);
		
	}
    
    
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add css + javascript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{
		// register acf scripts
		wp_register_script( 'acf-input-flexible-content', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version']);
		wp_register_style( 'acf-input-flexible-content', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version'] ); 
		
		
		// scripts
		wp_enqueue_script(array(
			'acf-input-flexible-content',	
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-flexible-content',	
		));
		
	}
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add css + javascript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{
		wp_register_script( 'acf-field-group-flexible-content', $this->settings['dir'] . 'js/field-group.js', array('acf-field-group'), $this->settings['version']);
		wp_register_style( 'acf-field-group-flexible-content', $this->settings['dir'] . 'css/field-group.css', array('acf-field-group'), $this->settings['version'] ); 
		
		// scripts
		wp_enqueue_script(array(
			'acf-field-group-flexible-content',	
		));
		
		// styles
		wp_enqueue_style(array(
			'acf-field-group-flexible-content',	
		));
	}
	
	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add css and javascript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head()
	{
		?>
		<script type="text/javascript">
			acf.l10n.flexible_content_delete = "<?php _e('Flexible Content requires at least 1 layout','acf'); ?>";
		</script>
		<?php
	}
	
	
	/*
	*  load_field()
	*
	*  This filter is appied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/
	
	function load_field( $field )
	{
		// apply_load field to all sub fields
		if( isset($field['layouts']) && is_array($field['layouts']) )
		{
			foreach( $field['layouts'] as $k => $layout )
			{
				if( isset($layout['sub_fields']) && is_array($layout['sub_fields']) )
				{
					foreach( $layout['sub_fields'] as $i => $sub_field )
					{
						// apply filters
						$sub_field = apply_filters('acf/load_field_defaults', $sub_field);
						
						
						// apply filters
						foreach( array('type', 'name', 'key') as $key )
						{
							// run filters
							$sub_field = apply_filters('acf/load_field/' . $key . '=' . $sub_field[ $key ], $sub_field); // new filter
						}


						// update sub field
						$field['layouts'][ $k ]['sub_fields'][ $i ] = $sub_field;
						
					}
					// foreach( $layout['sub_fields'] as $i => $sub_field )
				}
				// if( isset($layout['sub_fields']) && is_array($layout['sub_fields']) )
			}
			// foreach( $field['layouts'] as $k => $layout )
		}
		// if( isset($field['layouts']) && is_array($field['layouts']) )
		
		return $field;
		
	}
	
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function create_field( $field )
	{
		include( $this->settings['path'] . 'views/field.php' );
	}
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function create_options( $field )
	{
		include( $this->settings['path'] . 'views/options.php' );
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is appied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the $post_id of which the value will be saved
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field )
	{
		// vars
		$sub_fields = array();
		
		foreach( $field['layouts'] as $layout )
		{
			foreach( $layout['sub_fields'] as $sub_field )
			{
				$sub_fields[ $sub_field['key'] ] = $sub_field;
			}
		}

		$total = array();
		
		if( $value )
		{
			// remove dummy field
			unset( $value['acfcloneindex'] );
			
			$i = -1;
			
			// loop through rows
			foreach($value as $row)
			{	
				$i++;
				
				
				// increase total
				$total[] = $row['acf_fc_layout'];
				unset( $row['acf_fc_layout'] );
				
				
				// loop through sub fields
				foreach($row as $field_key => $v)
				{
					$sub_field = $sub_fields[ $field_key ];

					// update full name
					$sub_field['name'] = $field['name'] . '_' . $i . '_' . $sub_field['name'];
					
					// save sub field value
					do_action('acf/update_value', $v, $post_id, $sub_field );
				}
			}
		}
		
		
		/*
		*  Remove Old Data
		*
		*  @credit: http://support.advancedcustomfields.com/discussion/1994/deleting-single-repeater-fields-does-not-remove-entry-from-database
		*/
		
		$old_total = apply_filters('acf/load_value', 0, $post_id, $field);
		$old_total = count( $old_total );
		$new_total = count( $total );

		if( $old_total > $new_total )
		{
			foreach( $sub_fields as $sub_field )
			{
				for ( $j = $new_total; $j < $old_total; $j++ )
				{ 
					do_action('acf/delete_value', $post_id, $field['name'] . '_' . $j . '_' . $sub_field['name'] );
				}
			}
		}
		
		
		// update $value and return to allow for the normal save function to run
		$value = $total;
		
		return $value;
	}
	
	
	/*
	*  update_field()
	*
	*  This filter is appied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field, $post_id )
	{
		// format sub_fields
		if( $field['layouts'] )
		{
			$layouts = array();
			
			// loop through and save fields
			foreach($field['layouts'] as $layout_key => $layout)
			{				
			
				if( $layout['sub_fields'] )
				{
					// remove dummy field
					unset( $layout['sub_fields']['field_clone'] );
				
				
					// loop through and save fields
					$i = -1;
					$sub_fields = array();
					
					
					foreach( $layout['sub_fields'] as $key => $f )
					{
						$i++;
				
				
						// order + key
						$f['order_no'] = $i;
						$f['key'] = $key;
						
						
						// save
						$f = apply_filters('acf/update_field/type=' . $f['type'], $f, $post_id ); // new filter
						
						
						$sub_fields[] = $f;
						
					}
					
					
					// update sub fields
					$layout['sub_fields'] = $sub_fields;
					
				}
				
				$layouts[] = $layout;
				
			}
			
			// clean array keys
			$field['layouts'] = $layouts;
			
		}
		

		// return updated repeater field
		return $field;
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value( $value, $post_id, $field )
	{
		$layouts = array();
		foreach( $field['layouts'] as $l )
		{
			$layouts[ $l['name'] ] = $l;
		}
		

		// vars
		$values = false;
		$layout_order = false;


		if( is_array($value) && !empty($value) )
		{
			$i = -1;
			$values = array();
			
			
			// loop through rows
			foreach( $value as $layout )
			{
				$i++;
				$values[ $i ] = array();
				$values[ $i ]['acf_fc_layout'] = $layout;
				
				
				// check if layout still exists
				if( isset($layouts[ $layout ]) )
				{
					// loop through sub fields
					if( is_array($layouts[ $layout ]['sub_fields']) ){ foreach( $layouts[ $layout ]['sub_fields'] as $sub_field ){

						// update full name
						$key = $sub_field['key'];
						$sub_field['name'] = $field['name'] . '_' . $i . '_' . $sub_field['name'];
						
						$v = apply_filters('acf/load_value', false, $post_id, $sub_field);
						$v = apply_filters('acf/format_value', $v, $post_id, $sub_field);
						
						$values[ $i ][ $key ] = $v;

					}}
				}
			}
		}
		
		
		return $values;
	}
	
	
	/*
	*  format_value_for_api()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value_for_api( $value, $post_id, $field )
	{
		$layouts = array();
		foreach( $field['layouts'] as $l )
		{
			$layouts[ $l['name'] ] = $l;
		}
		

		// vars
		$values = false;
		$layout_order = false;


		if( is_array($value) && !empty($value) )
		{
			$i = -1;
			$values = array();
			
			
			// loop through rows
			foreach( $value as $layout )
			{
				$i++;
				$values[ $i ] = array();
				$values[ $i ]['acf_fc_layout'] = $layout;
				
				
				// check if layout still exists
				if( isset($layouts[ $layout ]) )
				{
					// loop through sub fields
					if( is_array($layouts[ $layout ]['sub_fields']) ){ foreach( $layouts[ $layout ]['sub_fields'] as $sub_field ){

						// update full name
						$key = $sub_field['name'];
						$sub_field['name'] = $field['name'] . '_' . $i . '_' . $sub_field['name'];
						
						$v = apply_filters('acf/load_value', false, $post_id, $sub_field);
						$v = apply_filters('acf/format_value_for_api', $v, $post_id, $sub_field);
						
						$values[ $i ][ $key ] = $v;

					}}
				}
			}
		}
		
		
		return $values;
		
	}
	
}

new acf_field_flexible_content();



/*
*  acf_get_valid_flexible_content_layout
*
*  This function will fill in the missing keys to create a valid layout
*
*  @type	function
*  @date	3/10/13
*  @since	1.1.0
*
*  @param	$layout (array)
*  @return	$layout (array)
*/

function acf_get_valid_flexible_content_layout( $layout = array() )
{
	$defaults = array(
		'name'			=> '',
		'label'			=> '',
		'display'		=> 'row',
		'sub_fields'	=> array(),
		'min'			=> '',
		'max'			=> '',
	);
	
	$layout =  wp_parse_args( $layout, $defaults );
	
	
	// return
	return $layout;
}

?>
