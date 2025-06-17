<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function check_login() {
    $CI =& get_instance();
    if (!$CI->session->userdata('logged_in')) {
        $CI->session->set_flashdata('error', 'Please login first!');
        redirect('welcome');
    }
}

function check_admin() {
    $CI =& get_instance();
    check_login();
    if ($CI->session->userdata('role') != 'admin') {
        $CI->session->set_flashdata('error', 'Access denied! Admin only.');
        redirect('welcome');
    }
}

function check_kasir() {
    $CI =& get_instance();
    check_login();
    if ($CI->session->userdata('role') != 'kasir') {
        $CI->session->set_flashdata('error', 'Access denied! Kasir only.');
        redirect('welcome');
    }
}