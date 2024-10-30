<?php

/*
Plugin Name: Custom Forms Actions For Elementor
Text Domain: custom-forms-actions-for-elementor
Description: Allow displaying conditionnal and regular alternatives messages or popups when a Elementor form is successfully sent.
Author: Webinart Communication
Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action('wp_enqueue_scripts', 'webcom_cfae_load_form_action_success_message_scripts');

function webcom_cfae_load_form_action_success_message_scripts() {

	wp_enqueue_script('webcom-cfae', plugins_url('/success-message/js/success-message.js', __FILE__), 'jquery','1.0.0', TRUE);
	wp_enqueue_style('webcom-cfae', plugins_url('/success-message/css/success-message.css', __FILE__),'1.0.0');


}

add_action( 'elementor_pro/forms/actions/register', 'webcom_cfae_register_custom_forms_actions' );

function webcom_cfae_register_custom_forms_actions( $form_actions_registrar ) {

    require_once( __DIR__ . '/success-message/success-message.php' );

    $form_actions_registrar->register( new \SuccessMessage() );

}



add_filter( 'elementor/widget/render_content', 'webcom_cfae_change_form_widget_content', 10, 2 );

function webcom_cfae_change_form_widget_content( $widget_content, $widget ) {

	if ( 'form' === $widget->get_name() ) {

		$form_ending_position=strpos($widget_content,'</form>');

		$to_insert='<div class="custom_success_action"></div>';

		$widget_content = substr_replace($widget_content, $to_insert, $form_ending_position, 0);
	
	}

	return $widget_content;
}
