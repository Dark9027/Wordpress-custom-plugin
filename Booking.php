<?php

/*
Plugin Name: Appointment
Plugin URL: null
Description: Appointment Booking
Author: Sagar Juneja
Author URL: null
Version: 1.0
*/

register_activation_hook(__FILE__,'Booking_activate');
register_deactivation_hook(__FILE__,'Booking_deactivate');


function Booking_activate(){
    global $wpdb;
    global $table_prefix;
  
  $table=$table_prefix."clinic";

    $sql="CREATE TABLE $table (
        `Clinic` text NOT NULL
      );";
  $wpdb->query($sql);
  $table2=$table_prefix."Doctors";

    $sql2="CREATE TABLE $table2 (
        `Clinic` text NOT NULL,
        `Doctors` text NOT NULL,
        `dt` DATE NOT NULL
      );";
  $wpdb->query($sql2);

  global $wpdb;
    global $table_prefix;
    $table3=$table_prefix."Appointment";
    $sql3="CREATE TABLE $table3 (
      `Clinic` text NOT NULL,
      `Doctor` text NOT NULL,
      `name` text NOT NULL,
      `email` text NOT NULL,
      `phone` int(10) NOT NULL,
      `date` date NOT NULL,
      `time` time(6) NOT NULL
    )";
  $wpdb->query($sql3);

}

function Booking_deactivate(){
    // global $wpdb;
    // global $table_prefix;
    // $table=$table_prefix."Clinic";
    // $sql="DROP TABLE $table";
    // $wpdb->query($sql);
}

add_action('admin_menu', 'Appointment_Menu');

function Appointment_Menu(){
  add_menu_page('Appointment','Appointment',8,__FILE__,'Appointment_back');
}

add_shortcode('Appointment_shortcode', 'Appointment_list');



function  Appointment_list() {
  include('Appointment.php');
}


function  Appointment_back() {
  include('Appointment_back.php');
}

?>
