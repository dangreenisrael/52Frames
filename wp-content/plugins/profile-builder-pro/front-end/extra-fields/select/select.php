<?php
/* handle field output */
function wppb_select_handler( $output, $form_location, $field, $user_id, $field_check_errors, $request_data ){
	if ( $field['field'] == 'Select' ){
		$item_title = apply_filters( 'wppb_'.$form_location.'_select_custom_field_'.$field['id'].'_item_title', wppb_icl_t( 'plugin profile-builder-pro', 'custom_field_'.$field['id'].'_title_translation', $field['field-title'] ) );
		$item_description = wppb_icl_t( 'plugin profile-builder-pro', 'custom_field_'.$field['id'].'_description_translation', $field['description'] );
		$item_option_labels = wppb_icl_t( 'plugin profile-builder-pro', 'custom_field_'.$field['id'].'_option_labels_translation', $field['labels'] );

		$select_labels = explode( ',', $item_option_labels );
		$select_values = explode( ',', $field['options'] );

        if( $form_location != 'register' )
		    $input_value = ( ( wppb_user_meta_exists ( $user_id, $field['meta-name'] ) != null ) ? get_user_meta( $user_id, $field['meta-name'], true ) : $field['default-option'] );
        else
            $input_value = ( !empty( $field['default-option'] ) ? trim( $field['default-option'] ) : '' );

        $input_value = ( isset( $request_data[$field['meta-name']] ) ? trim( $request_data[$field['meta-name']] ) : $input_value );
		
		if ( $form_location != 'back_end' ){
			$error_mark = ( ( $field['required'] == 'Yes' ) ? '<span class="wppb-required" title="'.wppb_required_field_error($field["field-title"]).'">*</span>' : '' );
						
			if ( array_key_exists( $field['id'], $field_check_errors ) )
				$error_mark = '<img src="'.WPPB_PLUGIN_URL.'assets/images/pencil_delete.png" title="'.wppb_required_field_error($field["field-title"]).'"/>';

			$output = '
				<label for="'.$field['meta-name'].'">'.$item_title.$error_mark.'</label>
				<select name="'.$field['meta-name'].'" id="'.$field['meta-name'].'" class="custom_field_select">';
				
				foreach( $select_values as $key => $value){
					$output .= '<option value="'.trim( $value ).'" class="custom_field_select_option" name="'.$field['meta-name'].'" id="'.trim( $value ).'_'.$field['id'].'"';
					
					if ( $input_value === trim( $value ) )
						$output .= ' selected';

					$output .= '>'.( ( !isset( $select_labels[$key] ) || !$select_labels[$key] ) ? trim( $select_values[$key] ) : trim( $select_labels[$key] ) ).'</option>';
				}
				
				$output .= '
				</select>';
            if( !empty( $item_description ) )
                $output .= '<span class="wppb-description-delimiter">'.$item_description.'</span>';

		}else{
            $item_title = ( ( $field['required'] == 'Yes' ) ? $item_title .' <span class="description">('. __( 'required', 'profilebuilder' ) .')</span>' : $item_title );
			$output = '
				<table class="form-table">
					<tr>
						<th><label for="'.$field['meta-name'].'">'.$item_title.'</label></th>
						<td>
							<select name="'.$field['meta-name'].'" class="custom_field_select" id="'.$field['meta-name'].'">';
							
							foreach( $select_values as $key => $value){
								$output .= '<option value="'.trim( $value ).'" class="custom_field_select_option" name="'.$field['meta-name'].'" id="'.trim( $value ).'_'.$field['id'].'"';
								
								if ( $input_value === trim( $value ) )
									$output .= ' selected';

								$output .= '>'.( ( !isset( $select_labels[$key] ) || !$select_labels[$key] ) ? trim( $select_values[$key] ) : trim( $select_labels[$key] ) ).'</option>';
							}
							
							$output .= '</select>
							<span class="description">'.$item_description.'</span>
						</td>
					</tr>
				</table>';
		}
			
		return apply_filters( 'wppb_'.$form_location.'_select_custom_field_'.$field['id'], $output, $form_location, $field, $user_id, $field_check_errors, $request_data );
	}
}
add_filter( 'wppb_output_form_field_select', 'wppb_select_handler', 10, 6 );
add_filter( 'wppb_admin_output_form_field_select', 'wppb_select_handler', 10, 6 );


/* handle field save */
function wppb_save_select_value( $field, $user_id, $request_data, $form_location ){
	if( $field['field'] == 'Select' ){
		if ( isset( $request_data[$field['meta-name']] ) )
			update_user_meta( $user_id, $field['meta-name'], $request_data[$field['meta-name']] );
	}
}
add_action( 'wppb_save_form_field', 'wppb_save_select_value', 10, 4 );
add_action( 'wppb_backend_save_form_field', 'wppb_save_select_value', 10, 4 );


/* handle field validation */
function wppb_check_select_value( $message, $field, $request_data, $form_location ){
	if( $field['field'] == 'Select' ){
		if ( ( isset( $request_data[$field['meta-name']] ) && ( trim( $request_data[$field['meta-name']] ) == '' ) ) && ( $field['required'] == 'Yes' ) ){
			return wppb_required_field_error($field["field-title"]);
		}
	}

    return $message;
}
add_filter( 'wppb_check_form_field_select', 'wppb_check_select_value', 10, 4 );