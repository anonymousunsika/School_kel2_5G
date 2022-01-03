<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{
    public function index()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "Schedule";

        $this->load->model('User_model', 'usr');

        $data['user'] = $this->usr->getUserData($this->session->userdata('email'));
        $data['classroom'] = $this->usr->getClassroomUser($data['user']['id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('student/index', $data);
        $this->load->view('templates/footer');
    }

    public function classroom()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "Classroom";

        $class_id = $this->input->get('i');

        $this->load->model('User_model', 'usr');

        $data['user'] = $this->usr->getUserData($this->session->userdata('email'));

        $class = $this->db->get_where('classroom_users', [
            'user_id' => $data['user']['id'],
            'classroom_id' => $class_id,
        ])->row_array();

        if ($class) {
            $data['class_id'] = $class_id;
            $data['classroom'] = $this->usr->getClassroom($class_id);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('student/classroom', $data);
            $this->load->view('templates/footer');
        } else {
            forbidden_page();
        }
    }

    public function studentAction()
    {
        if (is_logged_in() != 0) return;

        $this->load->model('Admin_model', 'adm');
        $this->load->model('User_model', 'usr');

        $user = $this->usr->getUserData($this->session->userdata('email'));

        $classId = $user['classroom_id'];

        if ($this->input->post('action') == 1) {
            // Get Schedule
            $timeGroup = $this->input->post('timeGroup');
            $class_id = $this->input->post('class_id');

            $data = $this->adm->getSchedule($class_id, $timeGroup);

            print_r(json_encode($data));
        } else if ($this->input->post('action') == 2) {
            // Set Time group
            $timeGroup = $this->input->post('time_group');
            $class_id = $this->input->post('class_id');

            $class = $this->db->get_where('classroom_users', [
                'user_id' => $user['id'],
                'classroom_id' => $class_id,
            ])->row_array();

            if ($class) {
                if ($class['accepted'] == 1 || strlen($timeGroup) == 0) {
                    forbidden_page();
                    return;
                } else {
                    $this->db->set('time_group', $timeGroup);
                    $this->db->where('user_id', $user['id']);
                    $this->db->where('classroom_id', $class_id);
                    $this->db->update('classroom_users');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Class Updated!</div>');
                }
            } else {
                forbidden_page();
                return;
            }
        } else if ($this->input->post('action') == 3) {
        } else if ($this->input->post('action') == 4) {
            // Get getTimeGroup
            $class_id = $this->input->post('class_id');

            $data = $this->adm->getTimeGroup($class_id);

            print_r(json_encode($data));
        }
    }
}
