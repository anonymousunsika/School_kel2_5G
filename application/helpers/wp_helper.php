<?php
defined('BASEPATH') or exit('No direct script access allowed');

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        show_404();
        return 1;
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            header("HTTP/1.1 403 Forbidden");
            $data['heading'] = "403 Forbidden";
            $data['message'] = "<p>You don't have permission to access the requested object. Contact the admin of for permission to open this page</p>";
            $ci->load->view('errors/html/error_404.php', $data);
            return 2;
        }
    }
}

function forbidden_page()
{
    $ci = get_instance();
    header("HTTP/1.1 403 Forbidden");
    $data['heading'] = "403 Forbidden";
    $data['message'] = "<p>You don't have permission to access the requested object. Contact the admin of for permission to open this page</p>";
    $ci->load->view('errors/html/error_404.php', $data);
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_open($id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('classroom', ['id' => $id])->row_array();

    if ($result['is_open'] == 1) {
        return "checked";
    }
}
