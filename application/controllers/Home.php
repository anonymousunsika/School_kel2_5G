<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/home_header', ['title' => "Home - Unsika", 'mId' => 0]);
        $this->load->view('index/index');
        $this->load->view('templates/home_footer');
    }

    public function sejarah()
    {
        $this->load->view('templates/home_header', ['title' => "Sejarah - Unsika", 'mId' => 2]);
        $this->load->view('index/sejarah');
        $this->load->view('templates/home_footer');
    }

    public function sambutan()
    {
        $this->load->view('templates/home_header', ['title' => "Sejarah - Unsika", 'mId' => 1]);
        $this->load->view('index/sambutan');
        $this->load->view('templates/home_footer');
    }
}
