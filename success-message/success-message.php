<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class SuccessMessage extends \ElementorPro\Modules\Forms\Classes\Action_Base {


	public function get_name() {

		return 'custom-success-message';
	
	}


    public function get_label() {

		return esc_html__( 'Custom Success Message', 'elementor-custom-forms-actions' );

    }




	public function run( $record, $ajax_handler ) {

		$settings = $record->get( 'form_settings' );

		$conditionnal_fiel_id=$settings['conditionnal_field_id'];

		$conditionnal_field_target_value=$settings['conditionnal_field_target_value'];

		$conditionnal_field_values = $record->get_field( ['id' => $conditionnal_fiel_id] );
		$conditionnal_field_values = $conditionnal_field_values[$conditionnal_fiel_id]['value'];
		$conditionnal_field_values = explode(", ",$conditionnal_field_values);

		$is_conditionnal_value_unique=$settings['is_conditionnal_value_unique'];

		$meet_conditions=false;

		if (in_array($conditionnal_field_target_value,$conditionnal_field_values)) {

			$meet_conditions=true;

			if (($is_conditionnal_value_unique)&&(count($conditionnal_field_values)!=1)) {

				$meet_conditions=false;
			}
		}




	 	if ($meet_conditions) {

	 		if ($settings['conditionnal_txt_or_popup']=='yes') {

				$success_text=$settings['conditionnal_success_message'];

			} else {

				$success_popup=$settings['conditionnal_success_popup_id'];
			}

	 	} else {


	 		if ($settings['regular_txt_or_popup']=='yes') {

				$success_text=$settings['regular_success_message'];

			} else {

				$success_popup=$settings['regular_success_popup_id'];
			}

	 	}

		 $ajax_handler->add_response_data( 'success_text', $success_text);
		 $ajax_handler->add_response_data( 'success_popup', $success_popup);
		
	}




	public function register_settings_section( $widget ) {

		$widget->start_controls_section(
			'section_custom',
			[
				'label' => __( 'Custom Success Message', 'elementor-custom-forms-actions' ),
				'condition' => [
					'submit_actions' => $this->get_name(),
				
				],
			]
		);



		$widget->add_control(
			'regular_txt_or_popup',
			[
				'label' => esc_html__( 'Regular output success message format', 'elementor-custom-forms-actions' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Text', 'elementor-custom-forms-actions' ),
				'label_off' => esc_html__( 'Popup', 'elementor-custom-forms-actions' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);




		$widget->add_control(
			'regular_success_message',
			[
				'label' => __( 'Regular Success Message', 'elementor-custom-forms-actions' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter the regular text or HTML to be displayed after the form is submitted successfully.', 'elementor-custom-forms-actions' ),
				'condition' => [
				'regular_txt_or_popup' => 'yes',
		],
			]
		);

				$widget->add_control(
			'regular_success_popup_id',
			[
				'label' => __( 'Regular Success Popup ID', 'elementor-custom-forms-actions' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter the regular Popup ID to be displayed after the form is submitted successfully.', 'elementor-custom-forms-actions' ),
				'condition' => [
				'regular_txt_or_popup' => '',
		],
			]
		);



			$widget->add_control(
			'conditionnal_txt_or_popup',
			[
				'label' => esc_html__( 'Conditionnal output success message format', 'elementor-custom-forms-actions' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Text', 'elementor-custom-forms-actions' ),
				'label_off' => esc_html__( 'Popup', 'elementor-custom-forms-actions' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);




		$widget->add_control(
			'conditionnal_success_message',
			[
				'label' => __( 'Conditionnal Success Message', 'elementor-custom-forms-actions' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter the conditionnal text or HTML to be displayed after the form is submitted successfully.', 'elementor-custom-forms-actions' ),
				'condition' => [
				'conditionnal_txt_or_popup' => 'yes',
		],
			]
		);


		$widget->add_control(
			'conditionnal_success_popup_id',
			[
				'label' => __( 'Conditionnal Success Popup ID', 'elementor-custom-forms-actions' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter the conditionnal Popup ID to be displayed after the form is submitted successfully.', 'elementor-custom-forms-actions' ),
				'condition' => [
				'conditionnal_txt_or_popup' => '',
		],
			]
		);


		$widget->add_control(
			'conditionnal_field_id',
			[
				'label' => __( 'Field ID used for conditionnal test', 'elementor-custom-forms-actions' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter the field ID whose used for the conditionnal test.', 'elementor-custom-forms-actions' ),
			]
		);


		$widget->add_control(
			'conditionnal_field_target_value',
			[
				'label' => __( 'Field value target used for conditionnal test', 'elementor-custom-forms-actions' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'separator' => 'before',
				'description' => __( 'Enter the value wich must be contain in the target field for a TRUE conditionnal result', 'elementor-custom-forms-actions' ),
			]
		);



			$widget->add_control(
			'is_conditionnal_value_unique',
			[
				'label' => esc_html__( 'Is conditionnal value unique ?', 'elementor-custom-forms-actions' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementor-custom-forms-actions' ),
				'label_off' => esc_html__( 'No', 'elementor-custom-forms-actions' ),
				'description' => __('Must the conditionnal value be unique if coming from multiple values field ?'),
				'return_value' => 1,
				'default' => 1,
			]
		);

		$widget->end_controls_section();
	}


	
	public function on_export( $element ) {}

} // END CLASS