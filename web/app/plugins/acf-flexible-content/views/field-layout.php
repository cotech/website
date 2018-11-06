<?php

// vars
$order = is_numeric($i) ? ($i + 1) : 0;

?>
<div class="layout" data-layout="<?php echo $layout['name']; ?>">
			
	<div style="display:none">
		<input type="hidden" name="<?php echo $field['name'] ?>[<?php echo $i ?>][acf_fc_layout]" value="<?php echo $layout['name']; ?>" />
	</div>
	
	<ul class="acf-fc-layout-controlls hl clearfix">
		<li>
			<a href="#" class="acf-button-add acf-fc-add"></a>
		</li>
		<li>
			<a href="#" class="acf-button-remove acf-fc-remove"></a>
		</li>
	</ul>
		
	<div class="acf-fc-layout-handle">
		<span class="fc-layout-order"><?php echo $order; ?></span>. <?php echo $layout['label']; ?>
	</div>
	
	<table class="widefat acf-input-table <?php if( $layout['display'] == 'row' ): ?>row_layout<?php endif; ?>">
		<?php if( $layout['display'] == 'table' ): ?>
			<thead>
				<tr>
					<?php foreach( $layout['sub_fields'] as $sub_field_i => $sub_field): 
						
						// add width attr
						$attr = "";
						
						if( count($layout['sub_fields']) > 1 && isset($sub_field['column_width']) && $sub_field['column_width'] )
						{
							$attr = 'width="' . $sub_field['column_width'] . '%"';
						}
						
						// required
						$required_label = "";
						
						if( $sub_field['required'] )
						{
							$required_label = ' <span class="required">*</span>';
						}
						
						?>
						<th class="acf-th-<?php echo $sub_field['name']; ?> field_key-<?php echo $sub_field['key']; ?>" <?php echo $attr; ?>>
							<span><?php echo $sub_field['label'] . $required_label; ?></span>
							<?php if( isset($sub_field['instructions']) ): ?>
								<span class="sub-field-instructions"><?php echo $sub_field['instructions']; ?></span>
							<?php endif; ?>
						</th><?php
					endforeach; ?>
				</tr>
			</thead>
		<?php endif; ?>
		<tbody>
			<tr>
			<?php

			// layout: Row
			
			if( $layout['display'] == 'row' ): ?>
				<td class="acf_input-wrap">
					<table class="widefat acf_input">
			<?php endif; ?>
			
			
			<?php

			// loop though sub fields
			if( $layout['sub_fields'] ):
			foreach( $layout['sub_fields'] as $sub_field ): ?>
			
				<?php
				
				// attributes (can appear on tr or td depending on $field['layout'])
				$attributes = array(
					'class'				=> "field sub_field field_type-{$sub_field['type']} field_key-{$sub_field['key']}",
					'data-field_type'	=> $sub_field['type'],
					'data-field_key'	=> $sub_field['key'],
					'data-field_name'	=> $sub_field['name']
				);
				
				
				// required
				if( $sub_field['required'] )
				{
					$attributes['class'] .= ' required';
				}
				
				
				// value
				$sub_field['value'] = false;
				
				if( isset($value[ $sub_field['key'] ]) )
				{
					// this is a normal value
					$sub_field['value'] = $value[ $sub_field['key'] ];
				}
				elseif( isset($sub_field['default_value']) )
				{
					// no value, but this sub field has a default value
					$sub_field['value'] = $sub_field['default_value'];
				}
				
				
				// add name
				$sub_field['name'] = $field['name'] . '[' . $i . '][' . $sub_field['key'] . ']';
				
				
				// clear ID (needed for sub fields to work!)
				unset( $sub_field['id'] );
				
				
				
				// layout: Row
				
				if( $layout['display'] == 'row' ): ?>
					<tr <?php acf_join_attr( $attributes ); ?>>
						<td class="label">
							<label>
								<?php echo $sub_field['label']; ?>
								<?php if( $sub_field['required'] ): ?><span class="required">*</span><?php endif; ?>
							</label>
							<?php if( isset($sub_field['instructions']) ): ?>
								<span class="sub-field-instructions"><?php echo $sub_field['instructions']; ?></span>
							<?php endif; ?>
						</td>
				<?php endif; ?>
				
				<td <?php if( $layout['display'] != 'row' ){ acf_join_attr( $attributes ); } ?>>
					<div class="inner">
					<?php
					
					// create field
					do_action('acf/create_field', $sub_field);
					
					?>
					</div>
				</td>
				
				<?php
			
				// layout: Row
				
				if( $layout['display'] == 'row' ): ?>
					</tr>
				<?php endif; ?>
				
			
			<?php endforeach; ?>
			<?php endif; ?>
			<?php

			// layout: Row
			
			if( $layout['display'] == 'row' ): ?>
					</table>
				</td>
			<?php endif; ?>
											
			</tr>
		</tbody>
		
	</table>
	
</div>
