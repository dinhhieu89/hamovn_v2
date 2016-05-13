<?php
/**
 * Create new table create_website on the database
 */
add_action( 'hamovn_create_website', 'hamovn_hook_create_website_tables', 1);

function hamovn_hook_create_website_tables() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'create_website';

    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql =  "CREATE TABLE " . $table_name . " (
                    id VARCHAR(255) NOT NULL,
                    title VARCHAR(255) DEFAULT NULL,
                    message TEXT NULL,
                    background TEXT NULL,
                    music_link VARCHAR(255) NULL,
                    video_link VARCHAR(255) NULL,
                    type VARCHAR(255) NULL,
                    send_by VARCHAR(255) NULL,
                    receiver VARCHAR(255),
                    PRIMARY KEY (id)
                )ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

do_action('hamovn_create_website');