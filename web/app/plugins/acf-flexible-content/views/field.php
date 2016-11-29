<?php 

// defaults
if( empty($field['button_label']) )
{
	$field['button_label'] = $this->defaults['button_label'];
}


// sort layouts into names
$layouts = array();
foreach( $field['layouts'] as $l )
{
	$layouts[ $l['name'] ] = acf_get_valid_flexible_content_layout( $l );
}

// clean up memory
unset( $field['layouts'] );


// vars
$i = 'acfcloneindex';
$value = array();


// helper function which does not exist yet in acf
if( !function_exists('acf_get_join_attr') ):

function acf_get_join_attr( $attributes = false )
{
	// validate
	if( empty($attributes) )
	{
		return '';
	}
	
	
	// vars
	$e = array();
	
	
	// loop through and render
	foreach( $attributes as $k => $v )
	{
		$e[] = $k . '="' . esc_attr( $v ) . '"';
	}
	
	
	// echo
	return implode(' ', $e);
}

endif;

if( !function_exists('acf_join_attr') ):

function acf_join_attr( $attributes = false )
{
	echo acf_get_join_attr( $attributes );
}

endif;


$atts = array(
	'class'		=> 'acf-flexible-content',
	'data-min'	=> $field['min'],
	'data-max'	=> $field['max']
);

$no_value_message = __('Click the "%s" button below to start creating your layout','acf');
$no_value_message = apply_filters('acf/fields/flexible_content/no_value_message', $no_value_message, $field);

?>
<div <?php acf_join_attr( $atts ); ?>>
	
	<div class="no_value_message" <?php if( $field['value'] ){ echo 'style="display:none;"'; } ?>>
		<?php printf( $no_value_message, $field['button_label'] ); ?>
	</div>
	
	<div class="clones">
	<?php 
	
	foreach( $layouts as $layout ){
		
		// $i = 'acfcloneindex';
		// $value = array();
		// $layout = $layout
		
		include( 'field-layout.php' );
		
	}
	
	?>
	</div>
	<div class="values">
	<?php 
	
	if( $field['value'] ){
		
		foreach( $field['value'] as $i => $value ){


			// validate
			if( !isset($layouts[ $value['acf_fc_layout'] ]) )
			{
				continue;
			}
			
			
			$layout = $layouts[ $value['acf_fc_layout'] ];
			
			
			// $i = $i;
			// $value = $value;
			// $layout = $layouts[ $value['acf_fc_layout'] ]
			
			include( 'field-layout.php' );
			
		}
		
	}
	
	?>
	</div>

	<ul class="hl clearfix flexible-footer">
		<li class="right">
			<a href="#" class="acf-button acf-fc-add"><?php echo $field['button_label']; ?></a>
		</li>
	</ul>
	
	<script type="text-html" class="tmpl-popup">
		<div class="acf-fc-popup">
			<ul>
				<?php foreach( $layouts as $layout ): 
					
					$atts = array(
						'data-layout'	=> $layout['name'],
						'data-min' 		=> $layout['min'],
						'data-max' 		=> $layout['max'],
					);
					
					?>
					<li>
						<a href="#" <?php acf_join_attr( $atts ); ?>><?php echo $layout['label']; ?><span class="status"></span></a>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="bit"></div>
			<a href="#" class="focus"></a>
		</div>
	</script>

</div>
		
