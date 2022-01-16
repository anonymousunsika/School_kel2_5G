<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "Edit Profile";

        $this->load->model('User_model', 'userm');

        $data['user'] = $this->userm->getUserData($this->session->userdata('email'));

        $this->form_validation->set_rules('current_password', 'Current password', 'trim');
        $this->form_validation->set_rules('new_password1', 'New password', 'trim|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm new password', 'trim|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            // $name = htmlspecialchars($this->input->post('name', true));
            $email = $data['user']['email'];
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            $new_password2 = $this->input->post('new_password2');

            if (!($current_password == $new_password && $new_password == $new_password2 && $new_password == '')) {
                if (!password_verify($current_password, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                    redirect('user/edit');
                } else {
                    if ($current_password == $new_password) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                        redirect('user/edit');
                    } else {
                        if (strlen($new_password) >= 3) {
                            $password_hash = password_hash($new_password, PASSWORD_BCRYPT);

                            $this->db->set('password', $password_hash);
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password to short!</div>');
                            redirect('user/edit');
                        }
                    }
                }
            }

            // cek jika ada agmbar diupload
            $upload_image = $_FILES['avatar']['name'];
            if ($upload_image) {

                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['upload_path'] = './assets/img/profile/';
                $config['max_size'] = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('avatar')) {
                    $old_image = $data['user']['avatar'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('avatar', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
                $new_password2 = $this->input->post('new_password2');
                if ($current_password == $new_password && $new_password == $new_password2 && $new_password == '') {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has no changed!</div>');
                    redirect('user');
                    die;
                }
            }

            // $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "Change Password";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm new password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_BCRYPT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
