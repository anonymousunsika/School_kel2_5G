<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('userid', 'NIM/Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $userid = $this->input->post('userid');
        $password = $this->input->post('password');

        $user = $this->db->query("SELECT * FROM user WHERE email = '" . $userid . "'")->row_array();
        if ($user == null)
            $user = $this->db->query("SELECT * FROM user WHERE npm = '" . $userid . "'")->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Email/NIM or password!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('npm', 'NIM', 'required|trim|is_natural|min_length[8]|is_unique[user.npm]', [
            'is_unique' => 'This NIM has already registered!',
            'is_natural' => 'NIM only contains numbers!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            "matches" => "Password don't match!",
            "min_length" => "Password too short!"
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $data['title'] = "User Registration";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'npm' => filter_var($this->input->post('npm'), FILTER_SANITIZE_NUMBER_INT),
                'avatar' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_BCRYPT),
                'role_id' => 2,
                'prodi_id' => null,
                'is_active' => 0,
                'date_created' => time()
            ];

            // siapkan token

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user_token', $user_token);

            $this->db->insert('user', $data);

            $this->db->insert('admin_message', [
                'message' => "New user register with <br>NIM : <br><b>" . $data['npm'] . "</b><br>Name : <br><b>" . $data['name'] . "</b>"
            ]);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Plase active your account, check your email!</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'anonimunsika@gmail.com',
            'smtp_pass' => 'anonimousunsika1',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('anonimunsika@gmail.com', 'ANONIMOUS');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="' .
                base_url() . 'auth/verify?email=' . $this->input->post('email')
                . '&token=' .  urlencode($token) . '">Active</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your account : <a href="' .
                base_url() . 'auth/reset?email=' . $this->input->post('email')
                . '&token=' .  urlencode($token) . '">Reset Password</a>');
        }


        if ($this->email->send())
            return true;
        else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token, 'email' => $email])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated. Please Login!</div>');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token Expired</div>');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed!</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed!</div>');
        }
        redirect('auth');
    }

    public function forgotpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                redirect('auth');
            }
        }
    }

    public function reset()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token, 'email' => $email])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->session->set_userdata('token', $token);
                    $this->changePassword();
                } else {
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset paswword failed! Token Expired</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Invalid token or email!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Invalid token or email!</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if ($this->session->userdata('reset_email') == null) {
            header("HTTP/1.1 404 Not Found");
            $data['heading'] = "404 Not Found";
            $data['message'] = "<p><p>The page you requested was not found.</p>";
            $this->load->view('errors/html/error_404.php', $data);
            return;
        }
        $this->form_validation->set_rules('password1', 'New password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Confirm new password', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_BCRYPT);
            $email = $this->session->userdata('reset_email');
            $token = $this->session->userdata('token');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->db->delete('user_token', ['token' => $token]);
            $this->session->unset_userdata('reset_email');
            $this->session->unset_userdata('token');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logout!</div>');
        redirect('auth');
    }
}
