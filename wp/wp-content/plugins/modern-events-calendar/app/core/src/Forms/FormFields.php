<?php

namespace MEC\Forms;

use MEC\Singleton;

class FormFields extends Singleton {

	public function input_key($key,$field_type, $values = array(), $prefix = 'reg'){

		$allowed_mapping_for = array(
			'text',
			'url',
			'date',
			'tel',
			'textarea',
			'checkbox',
			'select',
		);

		$html = '';
		if(false !== strpos($prefix,'_reg') && in_array($field_type,$allowed_mapping_for)){

			$v = isset( $values['mapping'] ) ? $values['mapping'] : '';
			$html = $this->get_wp_user_fields_dropdown(
				'mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mapping]',
				$v
			);
		}

		$html .= '<div>
				<input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][key]" placeholder="' . esc_attr__( 'Insert a key for this field', 'mec' ) . '" value="' . ( isset( $values['key'] ) ? esc_attr(stripslashes( $values['key'] )) : '' ) . '" />
			</div>';


		return $html;
	}

	/**
	 * Show text field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_text( $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '" class="mec_form_field_item">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Text', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="text" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
				' . $this->input_key( $key, 'text', $values, $prefix ) . '
            </div>
        </li>';
	}

	/**
	 * Show text field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_name( $key, $values = array(), $prefix = 'reg' ) {

		$type = $values['type'];
		switch($type){
			case 'first_name':

				$label = esc_html__( 'MEC First Name', 'mec' );
				break;
			case 'last_name':

				$label = esc_html__( 'MEC Last Name', 'mec' );
				break;
			default:

				$label = esc_html__( 'MEC Name', 'mec' );
				break;

		}

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
             <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
             <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html( $label ) . '</span>
             ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
             <p class="mec_' . esc_attr( $prefix ) . '_field_options" style="display:none">
                 <label>
                     <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" />
                     <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" checked="checked" disabled />
                     ' . esc_html__( 'Required Field', 'mec' ) . '
                 </label>
             </p>
             <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
             <div>
                 <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="'.esc_attr($type).'" />
                 <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
             </div>
         </li>';
	}

	/**
	 * Show text field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_first_name( $key, $values = array(), $prefix = 'reg' ) {

		return $this->field_name( $key, $values, $prefix );
	}

	/**
	 * Show text field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_last_name( $key, $values = array(), $prefix = 'reg' ) {

		return $this->field_name( $key, $values, $prefix );
	}

	/**
	 * Show text field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_mec_email( $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
             <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
             <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'MEC Email', 'mec' ) . '</span>
             ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
             <p class="mec_' . esc_attr( $prefix ) . '_field_options" style="display:none">
                 <label>
                     <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" />
                     <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" checked="checked" disabled />
                     ' . esc_html__( 'Required Field', 'mec' ) . '
                 </label>
             </p>
             <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
             <div>
                 <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="mec_email" />
                 <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
             </div>
         </li>';
	}

	/**
	 * Show email field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_email( $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Email', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="email" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
				' . $this->input_key( $key, 'email', $values, $prefix ) . '
            </div>
        </li>';
	}

	/**
	 * Show URL field options in forms
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_url( $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'URL', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="url" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
				' . $this->input_key( $key, 'url', $values, $prefix ) . '
            </div>
        </li>';
	}

	/**
	 * Show file field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_file( $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'File', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="file" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
            </div>
        </li>';
	}

	/**
	 * Show date field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_date( $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Date', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="date" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
				' . $this->input_key( $key, 'date', $values, $prefix ) . '
            </div>
        </li>';
	}

	/**
	 * Show tel field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_tel( $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Tel', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="tel" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
				' . $this->input_key( $key, 'tel', $values, $prefix ) . '
            </div>
        </li>';
	}

	/**
	 * Show textarea field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_textarea( $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Textarea', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="textarea" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
				' . $this->input_key( $key, 'textarea', $values, $prefix ) . '
            </div>
        </li>';
	}

	/**
	 * Show paragraph field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_p( $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Paragraph', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="p" />
                <textarea name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][content]">' . ( isset( $values['content'] ) ? htmlentities( stripslashes( $values['content'] ) ) : '' ) . '</textarea>
                <p class="description">' . esc_html__( 'HTML and shortcode are allowed.' ) . '</p>
            </div>
        </li>';
	}

	/**
	 * Show checkbox field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_checkbox( $key, $values = array(), $prefix = 'reg' ) {

		$i     = 0;
		$field = '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Checkboxes', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="checkbox" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
				' . $this->input_key( $key, 'checkbox', $values, $prefix ) . '
                <ul id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '_options_container" class="mec_' . esc_attr( $prefix ) . '_fields_options_container mec_fields_options_container">';

		if ( isset( $values['options'] ) and is_array( $values['options'] ) and count( $values['options'] ) ) {
			foreach ( $values['options'] as $option_key => $option ) {
				$i     = max( $i, $option_key );
				$field .= $this->field_option( $key, $option_key, $values, $prefix );
			}
		}

		$field .= '</ul>
                <button type="button" class="mec-' . esc_attr( $prefix ) . '-field-add-option mec-field-add-option" data-field-id="' . esc_attr( $key ) . '">' . esc_html__( 'Option', 'mec' ) . '</button>
                <input type="hidden" id="mec_new_' . esc_attr( $prefix ) . '_field_option_key_' . esc_attr( $key ) . '" value="' . ( $i + 1 ) . '" />
            </div>
        </li>';

		return $field;
	}

	/**
	 * Show radio field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_radio( $key, $values = array(), $prefix = 'reg' ) {

		$i     = 0;
		$field = '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Radio Buttons', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="radio" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
				' . $this->input_key( $key, 'radio', $values, $prefix ) . '
                <ul id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '_options_container" class="mec_' . esc_attr( $prefix ) . '_fields_options_container mec_fields_options_container">';

		if ( isset( $values['options'] ) and is_array( $values['options'] ) and count( $values['options'] ) ) {
			foreach ( $values['options'] as $option_key => $option ) {
				$i     = max( $i, $option_key );
				$field .= $this->field_option( $key, $option_key, $values, $prefix );
			}
		}

		$field .= '</ul>
                <button type="button" class="mec-' . esc_attr( $prefix ) . '-field-add-option mec-field-add-option" data-field-id="' . esc_attr( $key ) . '">' . esc_html__( 'Option', 'mec' ) . '</button>
                <input type="hidden" id="mec_new_' . esc_attr( $prefix ) . '_field_option_key_' . esc_attr( $key ) . '" value="' . ( $i + 1 ) . '" />
            </div>
        </li>';

		return $field;
	}

	/**
	 * Show select field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_select( $key, $values = array(), $prefix = 'reg' ) {

		$i     = 0;
		$field = '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Dropdown', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( isset( $values['mandatory'] ) and $values['mandatory'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][ignore]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][ignore]" value="1" ' . ( ( isset( $values['ignore'] ) and $values['ignore'] ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Consider first item as placeholder', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="select" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : '' ) . '" />
                ' . $this->input_key( $key, 'select', $values, $prefix ) . '
                <ul id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '_options_container" class="mec_' . esc_attr( $prefix ) . '_fields_options_container mec_fields_options_container">';

		if ( isset( $values['options'] ) and is_array( $values['options'] ) and count( $values['options'] ) ) {
			foreach ( $values['options'] as $option_key => $option ) {
				$i     = max( $i, $option_key );
				$field .= $this->field_option( $key, $option_key, $values, $prefix );
			}
		}

		$field .= '</ul>
                <button type="button" class="mec-' . esc_attr( $prefix ) . '-field-add-option mec-field-add-option" data-field-id="' . esc_attr( $key ) . '">' . esc_html__( 'Option', 'mec' ) . '</button>
                <input type="hidden" id="mec_new_' . esc_attr( $prefix ) . '_field_option_key_' . esc_attr( $key ) . '" value="' . ( $i + 1 ) . '" />
            </div>
        </li>';

		return $field;
	}

	/**
	 * Show agreement field options in booking form
	 *
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_agreement( $key, $values = array(), $prefix = 'reg' ) {

		// WordPress Pages
		$pages = get_pages();

		$i     = 0;
		$field = '<li id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '">
            <span class="mec_' . esc_attr( $prefix ) . '_field_sort mec_field_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span class="mec_' . esc_attr( $prefix ) . '_field_type mec_field_type">' . esc_html__( 'Agreement', 'mec' ) . '</span>
            ' . ( $prefix === 'event' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%event_field_' . esc_attr( $key ) . '%%</span>' : ( $prefix === 'bfixed' ? '<span class="mec_' . esc_attr( $prefix ) . '_notification_placeholder">%%booking_field_' . esc_attr( $key ) . '%%</span>' : '' ) ) . '
            <p class="mec_' . esc_attr( $prefix ) . '_field_options">
                <label>
                    <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="0" />
                    <input type="checkbox" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][mandatory]" value="1" ' . ( ( !isset( $values['mandatory'] ) or ( isset( $values['mandatory'] ) and $values['mandatory'] ) ) ? 'checked="checked"' : '' ) . ' />
                    ' . esc_html__( 'Required Field', 'mec' ) . '
                </label>
            </p>
            <span class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <div>
                <input type="hidden" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][type]" value="agreement" />
                <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this field', 'mec' ) . '" value="' . ( isset( $values['label'] ) ? stripslashes( $values['label'] ) : esc_attr__('I agree with %s', 'mec') ) . '" /><p class="description">' . esc_html__( 'Instead of %s, the page title with a link will be show.', 'mec' ) . '</p>
                <div>
                    <label for="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '_page">' . esc_html__( 'Agreement Page', 'mec' ) . '</label>
                    <select id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '_page" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][page]">';

		$page_options = '';
		foreach ( $pages as $page ) {
			$page_options .= '<option ' . ( ( isset( $values['page'] ) and $values['page'] === $page->ID ) ? 'selected="selected"' : '' ) . ' value="' . esc_attr( $page->ID ) . '">' . esc_html( $page->post_title ) . '</option>';
		}

		$field .= $page_options . '</select>
                </div>
                <div>
                    <label for="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '_status">' . esc_html__( 'Status', 'mec' ) . '</label>
                    <select id="mec_' . esc_attr( $prefix ) . '_fields_' . esc_attr( $key ) . '_status" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $key ) . '][status]">
                        <option value="checked" ' . ( ( isset( $values['status'] ) and $values['status'] === 'checked' ) ? 'selected="selected"' : '' ) . '>' . esc_html__( 'Checked by default', 'mec' ) . '</option>
                        <option value="unchecked" ' . ( ( isset( $values['status'] ) and $values['status'] === 'unchecked' ) ? 'selected="selected"' : '' ) . '>' . esc_html__( 'Unchecked by default', 'mec' ) . '</option>
                    </select>
                </div>
                <input type="hidden" id="mec_new_' . esc_attr( $prefix ) . '_field_option_key_' . esc_attr( $key ) . '" value="' . ( $i + 1 ) . '" />
            </div>
        </li>';

		return $field;
	}

	/**
	 * Show option tag parameters in booking form for select, checkbox and radio tags
	 *
	 * @param string $field_key
	 * @param string $key
	 * @param array  $values
	 * @param string $prefix
	 *
	 * @return string
	 */
	public function field_option( $field_key, $key, $values = array(), $prefix = 'reg' ) {

		return '<li id="mec_' . esc_attr( $prefix ) . '_fields_option_' . esc_attr( $field_key ) . '_' . esc_attr( $key ) . '" class="mec_fields_option">
            <span class="mec_' . esc_attr( $prefix ) . '_field_option_sort mec_field_option_sort">' . esc_html__( 'Sort', 'mec' ) . '</span>
            <span  class="mec_' . esc_attr( $prefix ) . '_field_remove mec_field_remove">' . esc_html__( 'Remove', 'mec' ) . '</span>
            <input type="text" name="mec[' . esc_attr( $prefix ) . '_fields][' . esc_attr( $field_key ) . '][options][' . esc_attr( $key ) . '][label]" placeholder="' . esc_attr__( 'Insert a label for this option', 'mec' ) . '" value="' . ( ( isset( $values['options'] ) and isset( $values['options'][ $key ] ) ) ? esc_attr( stripslashes( $values['options'][ $key ]['label'] ) ) : '' ) . '" />
        </li>';
	}

	public function get_wp_user_fields_dropdown( $name, $value ) {

		$fields = $this->get_wp_user_fields();

		$dropdown = '<select name="' . esc_attr( $name ) . '" title="' . esc_html__( 'Mapping with Profile Fields', 'mec' ) . '">';
		$dropdown .= '<option value="">-----</option>';
		foreach ( $fields as $key => $label ) {
			$dropdown .= '<option value="' . esc_attr( $key ) . '" ' . ( $value == $key ? 'selected="selected"' : '' ) . '>' . esc_html( $label ) . '</option>';
		}
		$dropdown .= '</select>';

		return $dropdown;
	}

	public function get_wp_user_fields() {

		$raw_fields = get_user_meta( get_current_user_id() );
		$forbidden  = array(
			'nickname',
			'syntax_highlighting',
			'comment_shortcuts',
			'admin_color',
			'use_ssl',
			'show_admin_bar_front',
			'wp_user_level',
			'user_last_view_date',
			'user_last_view_date_events',
			'wc_last_active',
			'last_update',
			'last_activity',
			'locale',
			'show_welcome_panel',
			'rich_editing',
			'nav_menu_recently_edited',
		);

		$fields = array();
		foreach ( $raw_fields as $key => $values ) {
			if ( substr( $key, 0, 1 ) === '_' ) {
				continue;
			}
			if ( substr( $key, 0, 4 ) === 'icl_' ) {
				continue;
			}
			if ( substr( $key, 0, 4 ) === 'mec_' ) {
				continue;
			}
			if ( substr( $key, 0, 3 ) === 'wp_' ) {
				continue;
			}
			if ( substr( $key, 0, 10 ) === 'dismissed_' ) {
				continue;
			}
			if ( in_array( $key, $forbidden ) ) {
				continue;
			}

			$value = ( isset( $values[0] ) ? $values[0] : null );
			if ( is_array( $value ) ) {
				continue;
			}
			if ( is_serialized( $value ) ) {
				continue;
			}

			$fields[ $key ] = trim( ucwords( str_replace( '_', ' ', $key ) ) );
		}

		return $fields;
	}

}