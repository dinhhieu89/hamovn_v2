<?php

/**
 * Get type of website from request _GET['id']
 * @return mixed
 */
function getWebTypeFromRequest() {
    $data = getWebDataFromRequest();
    return $data->type;
}

/**
 * Get data website from request _GET['id']
 * @return mixed
 */
function getWebDataFromRequest() {
    if ( !isset($_GET['id']) || $_GET['id'] == '') {
        header('Location: ' . get_home_url().'/tao-website-tang-nguoi-than/');
    } else {
        global $wpdb;

        $id = $_GET['id'];
        $table_name = $wpdb->prefix . 'create_website';
        $results = $wpdb->get_results("SELECT * FROM ". $table_name ." WHERE id='". $id ."'", OBJECT );

        if (count($results) < 0) {
            header('Location: ' . get_home_url().'/tao-website-tang-nguoi-than/');
        } else {
            $data = $results[0];
            return $data;
        }
    }
}