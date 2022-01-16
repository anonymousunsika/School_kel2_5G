<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function adminAction()
    {
        if (is_logged_in() != 0) return;
        $action = $this->input->post('action');

        if ($action == 1) {
            $message = array_reverse($this->db->get('admin_message')->result_array());

            print_r(json_encode($message));
        } else if ($action == 2) {
            $idmessage = $this->input->post('message_id');

            $this->db->delete('admin_message', ['id' => $idmessage]);
        }
    }

    public function role()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "Role Access";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        if (is_logged_in() != 0) return;
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function test1()
    {
        echo "Hai agung";
    }

    public function userManager()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "User Management";

        $this->load->model('Admin_model', 'members');

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['members'] = $this->members->getMembers();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user-manager', $data);
        $this->load->view('templates/footer');
    }

    public function userAction()
    {
        if (is_logged_in() != 0) return;
        if ($this->input->get('id') != null) {
            $id = $this->input->get('id');

            $userCheck = $this->db->get_where('user', ['id' => $id, 'role_id' => 2])->row_array();
            if (!$userCheck) {
                forbidden_page();
                return;
            }
            $data['title'] = "Edit User";

            $this->load->model('Admin_model', 'members');

            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['useredit'] = $this->db->query("SELECT * FROM user WHERE id = '" . $id . "' AND role_id = 2")->row_array();

            //$data['useredit'] = $this->db->get_where('user', ['id' => $id, 'role_id' => 2])->row_array();
            $data['prodi'] = $this->db->get('prodi')->result_array();

            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('fakultas', 'Fakultas', 'required|trim');
            $this->form_validation->set_rules('year', 'Join Year', 'required|trim|is_natural');
            $this->form_validation->set_rules('prodi', 'Prodi', 'is_natural');
            $this->form_validation->set_rules('npm', 'NIM', 'required|trim|is_natural|min_length[8]');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/edit-user', $data);
                $this->load->view('templates/footer');
            } else {
                $npm = htmlspecialchars($this->input->post('npm', true));
                $name = htmlspecialchars($this->input->post('name', true));
                $fakultas = htmlspecialchars($this->input->post('fakultas', true));
                $prodi = htmlspecialchars($this->input->post('prodi', true));
                $password = htmlspecialchars($this->input->post('password', true));
                $year = $this->input->post('year');
                $is_active = $this->input->post('is_active');
                // cek jika ada agmbar diupload
                $upload_image = $_FILES['avatar']['name'];
                if ($upload_image) {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['upload_path'] = './assets/img/profile/';
                    $config['max_size'] = '2048';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('avatar')) {
                        $old_image = $data['useredit']['avatar'];
                        if ($old_image != 'default.png') {
                            unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        }

                        $new_image = $this->upload->data('file_name');
                        $this->db->set('avatar', $new_image);
                    } else {
                        echo $this->upload->display_errors();
                    }
                }

                if ($npm != $data['useredit']['npm']) {
                    $userMatch = $this->db->get_where('user', ['npm' => $npm])->row_array();
                    if (!$userMatch)
                        $this->db->set('npm', $npm);
                }

                $this->db->set('name', $name);
                $this->db->set('fakultas', $fakultas);
                if ($prodi != 0)
                    $this->db->set('prodi_id', $prodi);
                else
                    $this->db->set('prodi_id', null);
                $this->db->set('year_join', $year);
                $this->db->set('is_active', $is_active == "on");
                if ($password != "") {
                    if (strlen(trim($password)) >= 3) {
                        $this->db->set('password', password_hash(trim($password), PASSWORD_BCRYPT));
                    }
                }
                $this->db->where('role_id', 2);
                $this->db->where('id', $id);
                $this->db->update('user');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User profile has been updated!</div>');
                redirect('admin/usermanager');
            }
        } else {
            $npm = $this->input->post('npm');
            $action = $this->input->post('action');

            if ($action == 1) {
                $data = $this->db->get_where('user', ['npm' => $npm, 'role_id' => 2])->row_array();
                unlink(FCPATH . 'assets/img/profile/' . $data['avatar']);
                $this->db->delete('user', ['npm' => $npm, 'role_id' => 2]);
            }
        }
    }

    public function classroom()
    {
        if (is_logged_in() != 0) return;
        $opt = $this->input->get('s');
        $data['title'] = "Classroom Management";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Admin_model', 'adm');

        $this->form_validation->set_rules('name', 'Class Name', 'required|trim|max_length[10]');
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim|is_natural');
        $this->form_validation->set_rules('prodi_id', 'Prodi', 'required|trim|is_natural');

        if ($this->form_validation->run() == true) {
            $dataInsert = [
                'name' => $this->input->post('name'),
                'semester' => $this->input->post('semester'),
                'prodi_id' => $this->input->post('prodi_id'),
                'is_open' => 1
            ];

            $this->db->insert('classroom', $dataInsert);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Class has been added!</div>');
        }
        $data['semester'] = $this->adm->getSemester();
        $data['classroom'] = $this->adm->getClassroom();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['opt'] = $opt == "" ? null : $opt;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/classroom-manager', $data);
        $this->load->view('templates/footer');
    }

    public function classroomAction()
    {
        if (is_logged_in() != 0) return;
        if ($this->input->post('action') == 1) {
            $classid = $this->input->post('classId');
            $is_open = $this->input->post('is_open');

            $this->db->set('is_open', $is_open == 'true' ? 1 : 0);
            $this->db->where('id', $classid);
            $this->db->update('classroom');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Updated!</div>');
        } else if ($this->input->post('action') == 2) {
            $classid = $this->input->post('classId');

            $this->db->delete('classroom', ['id' => $classid]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Class has been deleted!</div>');
        }
    }

    public function schedule()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "Course Schedule";

        $this->load->model('Admin_model', 'adm');

        $this->form_validation->set_rules('classId', 'Class ID', 'required|trim');
        $this->form_validation->set_rules('time_start', 'Time Start', 'required|trim|regex_match[/^\d{2}\:\d{2}\:\d{2}$/i]', [
            'regex_match' => 'The Time End field is not in the correct time format.'
        ]);
        $this->form_validation->set_rules('time_end', 'Time End', 'required|trim|regex_match[/^\d{2}\:\d{2}\:\d{2}$/i]', [
            'regex_match' => 'The Time End field is not in the correct time format.'
        ]);
        $this->form_validation->set_rules('day', 'Day', 'required|trim');
        $this->form_validation->set_rules('timeGroup', 'Time Group', 'required|trim|max_length[1]');
        $this->form_validation->set_rules('course_id', 'Course', 'required|trim|is_natural');

        if ($this->form_validation->run() == true) {
            $data_form = [
                'classroom_id' => $this->input->post('classId'),
                'time_start' => $this->input->post('time_start'),
                'time_end' => $this->input->post('time_end'),
                'day' => htmlspecialchars($this->input->post('day', true)),
                'course_id' => $this->input->post('course_id'),
                'timeGroup' => $this->input->post('timeGroup')
            ];

            $this->db->insert('schedule', $data_form);
        }

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['semester'] = $this->adm->getSemester();
        $data['courses'] = $this->db->get('course')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/schedule', $data);
        $this->load->view('templates/footer');
    }

    public function scheduleAction()
    {
        if (is_logged_in() != 0) return;

        $this->load->model('Admin_model', 'adm');

        if ($this->input->post('action') == 1) {
            // Get Schedule
            $classId = $this->input->post('classId');
            $timeGroup = $this->input->post('timeGroup');

            $data = $this->adm->getSchedule($classId, $timeGroup);

            print_r(json_encode($data));
        } else if ($this->input->post('action') == 2) {
            // Delete Schedule
            $schedule = $this->input->post('scheduleId');

            $this->db->delete('schedule', ['id' => $schedule]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Schedule has been deleted!</div>');
        } else if ($this->input->post('action') == 3) {
            // Get Classroom
            $semester = $this->input->post('semester');

            $data = $this->adm->getClassroom($semester);

            print_r(json_encode($data));
        } else if ($this->input->post('action') == 4) {
            // Get getTimeGroup
            $classId = $this->input->post('classId');

            $data = $this->adm->getTimeGroup($classId);

            print_r(json_encode($data));
        }
    }

    public function student()
    {
        if (is_logged_in() != 0) return;
        $data['title'] = "Student Room";

        $this->load->model('Admin_model', 'adm');

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['semester'] = $this->adm->getSemester();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/student', $data);
        $this->load->view('templates/footer');
    }

    public function studentAction()
    {
        if (is_logged_in() != 0) return;

        $this->load->model('Admin_model', 'adm');

        if ($this->input->post('action') == 1) {
            // Get Student
            $classId = $this->input->post('classId');

            $data = $this->adm->getStudents($classId);

            print_r(json_encode($data));
        } else if ($this->input->post('action') == 2) {
            // Remove
            $id = $this->input->post('id');

            $this->db->delete('classroom_users', ['id' => $id]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Student has been removed!</div>');
        } else if ($this->input->post('action') == 3) {
            // Get Semester
            $semester = $this->input->post('semester');

            $data = $this->adm->getClassroom($semester);

            print_r(json_encode($data));
        } else if ($this->input->post('action') == 4) {
            // Insert student
            $time_groups = $this->input->post('time_group');

            $message = [
                'id' => 1,
                'message' => 'Student added!'
            ];

            if (strlen($time_groups) == 1) {

                $data_match = [
                    'user_id' => $this->input->post('userId'),
                    'classroom_id' => $this->input->post('classId'),
                ];

                $user = $this->db->get_where('classroom_users', $data_match)->row_array();

                if ($user) {
                    $message = [
                        'id' => 2,
                        'message' => 'Student already exist in this class!'
                    ];
                } else {
                    $data_insert = [
                        'user_id' => $this->input->post('userId'),
                        'classroom_id' => $this->input->post('classId'),
                        'time_group' => $time_groups == 0 ? null : $time_groups,
                        'accepted' => 0,
                        'date_accepted' => null
                    ];

                    $this->db->insert('classroom_users', $data_insert);
                }
            } else {
                $message = [
                    'id' => 2,
                    'message' => 'Failed to add student!'
                ];
            }

            print_r(json_encode($message));
        } else if ($this->input->post('action') == 5) {
            // Accept student
            $accepted = $this->input->post('accepted');
            $userId = $this->input->post('userId');

            $this->db->set('accepted', $accepted == 'true' ? 1 : 0);
            $this->db->set('date_accepted', $accepted == 'true' ? date('Y:m:d') : null);
            $this->db->where('id', $userId);
            $this->db->update('classroom_users');
        } else if ($this->input->post('action') == 6) {
            // Search member
            $contain = $this->input->post('contain');

            $data = $this->adm->getMembers($contain);

            print_r(json_encode($data));
        }
    }

    public function berita()
    {
        if (is_logged_in() != 0) return;
        $this->load->model('User_model', 'usr');

        $data['title'] = "Berita";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->usr->getUserMenu($data['user']['role_id']);
        $data['berita'] = $this->db->get('berita')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/berita', $data);
        $this->load->view('templates/footer');
    }

    public function editor()
    {
        if (is_logged_in() != 0) return;
        $this->load->model('User_model', 'usr');

        if (is_numeric($this->input->get('action'))) {
            $action = $this->input->get('action');

            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['menu'] = $this->usr->getUserMenu($data['user']['role_id']);
            if ($action == 1) {
                $data['title'] = "Tambah Berita";
                $data['action'] = $this->input->get('action');
            } else if ($action == 2) {
                $id = $this->input->get('id');
                $data['title'] = "Edit Berita";
                if (is_numeric($id)) {
                    $data['id'] = $id;
                    $data['berita'] = $this->db->get_where('berita', ['id' => $id])->row_array();
                } else {
                    redirect('staff/berita');
                }
                $data['action'] = $this->input->get('action');
            } else if ($action == 3) {
                $id = $this->input->get('id');
                if (is_numeric($id)) {
                    $this->db->delete('berita', ['id' => $id]);
                    set_flashdata('message', createSuccessAlert('Data berhasil dihapus'));
                }
                redirect('admin/berita');
            }

            $this->form_validation->set_rules('judul', 'Judul', 'required|trim|min_length[3]|max_length[256]');
            $this->form_validation->set_rules('content', 'Isi', 'required|trim|max_length[20000]');
            $this->form_validation->set_rules('penulis', 'Penulis', 'required|trim|min_length[3]|max_length[128]');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/editor', $data);
                $this->load->view('templates/footer');
            } else {
                if ($action == 1) {
                    $data_insert = [
                        'judul' => html_escape($this->input->post('judul', true)),
                        'isi' => $this->input->post('content', true),
                        'penulis' => html_escape($this->input->post('penulis', true)),
                        'tanggal' => time()
                    ];
                    $this->db->insert('berita', $data_insert);

                    set_flashdata('message', createSuccessAlert('Data berhasil ditambahkan'));
                } else if ($action == 2) {
                    $this->db->set('judul', $this->input->post('judul'));
                    $this->db->set('isi', $this->input->post('content', true));
                    $this->db->set('penulis', $this->input->post('penulis'));
                    $this->db->where('id', $this->input->get('id'));

                    $this->db->update('berita');

                    set_flashdata('message', createSuccessAlert('Data berhasil diedit'));
                }
                redirect('admin/berita');
            }
        } else {
            redirect('admin/berita');
        }
    }
}
