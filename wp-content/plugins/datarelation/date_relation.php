<?php
/*
Plugin Name: Data relation
Plugin URI:
description: Show all the database table of wordpress no need to go phpmyadmin to see data inside table
Version: 1.0
Author: Mr. Manoj vashist
Author URI:
License: Gpl
*/
?>
<?php
add_action('admin_menu', 'date_relation');

function date_relation()
{
    add_menu_page('Date Relation', 'Date Relation', 'manage_options', 'date-relation', 'render_page');
}

function render_page()
{
    global $wpdb;
    $query = "SHOW tables";
    $data = $wpdb->get_results($query, ARRAY_A);
    $index = 0;

    echo '<h3> Database Relations</h3>';
    echo '<hr>';

    foreach ($data as $datas) {

        foreach ($datas as $key => $value) {
            echo '<div class="half-colume">';
            echo "<h3>$value</h3>";
            fetch_date($value);
            echo "</div>";
            if ($index % 2 == 1) {
                echo '<div class="spacer-table"></div>';
            }
            $index++;

        }

    }
}

function fetch_date($table_name)
{

    global $wpdb;
    $query = "SELECT * FROM " . $table_name;
    $table_data = $wpdb->get_results($query, ARRAY_A);

    echo "<div id='scrollmenu' style='overflow: auto'>";
    if (empty($table_data)) {
        echo '<div class="data-message">No Data inside the table</div>';
    }
    echo "<label class='c-name'> Column name </label>";
    echo "<label class='v-name'>Column value </label>";

    foreach ($table_data as $value) {

        foreach ($value as $key => $value_table) {

            echo "<div class='box-col'>";
            echo "<div class='vertical-key'>";
            echo $key;
            echo "</div>";
            echo "<div class='vertical-value'>";
            echo $value_table;
            echo "</div>";
            echo "</div>";

        }
        echo '<div class="spacer-between-table"></div>';
    }
    echo "</div>";
}

?>
<style>
    .box-col {
        border: 1px solid grey;
        padding: 7px;
    }

    .vertical-key {
        display: inline-block;
        width: 40%;
    }

    .vertical-value {
        display: inline-block;
        width: 40%;
    }

    .half-colume {
        width: 40%;
        display: inline-block;
        padding: 15px;
        overflow: auto;
        max-height: 300px;
    }

    .spacer-table {
        padding: 16px;
        border-bottom: 3px solid grey;
        width: 96%;
    }

    .c-name {
        float: left;
        font-size: 15px;
        font-weight: 600;
    }

    .v-name {
        margin-left: 150px;
        font-size: 15px;
        font-weight: 600;
    }

    .data-message {
        margin-top: 23px;
        position: absolute;
    }

    .spacer-between-table {
        border: 1px solid gainsboro;
        padding: 4px;
    }
</style>