<?php

add_action( 'wp_ajax_update_erp_settings', 'update_admin_erp_settings' );
function update_admin_erp_settings() {
    check_ajax_referer( 'ajaxnonce', 'security' );

    $valid_options = [
        'erp-username',
        'erp-password',
    ];
    
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] != 'POST') {
		$errors[] = 'ERROR: Method not allowed!';
	}
	if(!isset($_POST['action'])) {
		$errors[] = 'ERROR: Action not allowed!';
	}
	if(!isset($_POST['data'])) {
		$errors[] = 'ERROR: Data is non existing!';
    }

    foreach($_POST['data'] as $key => $check_post_data) {
        if (!in_array($key, $valid_options)) {
            $errors[] = 'ERROR: Required key is non existing!';
        }
    }

    if(empty($errors)) {
        foreach($_POST['data'] as $key => $value) {
            if (in_array($key, $valid_options)) {
                update_option( sanitize_text_field(str_replace('-', '_', $key)), sanitize_text_field( $value ), false );
            }
        }

        wp_send_json( ['status' => 'success', 'message' => 'Podatci su uspješno spremljeni. Stranica će se ponovno učitati.'] );
        wp_die();
    }

    wp_send_json( ['status' => 'error', 'message' => $errors] );
	wp_die();
}