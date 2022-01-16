<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data['berita'] = $this->db->get('berita')->result_array();
        $this->load->view('templates/home_header', ['title' => "Home - Unsika", 'mId' => 0]);
        $this->load->view('index/index', $data);
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
        $this->load->view('templates/home_header', ['title' => "Sambutan - Unsika", 'mId' => 1]);
        $this->load->view('index/sambutan');
        $this->load->view('templates/home_footer');
    }

    public function berita()
    {
        $data['berita'] = $this->db->get('berita')->result_array();
        $this->load->view('templates/home_header', ['title' => "Berita - Unsika", 'mId' => 3]);
        $this->load->view('index/berita', $data);
        $this->load->view('templates/home_footer');
    }

    public function page($id)
    {
        $data['berita'] = $this->db->get_where('berita', ['id' => $id])->row_array();
        if ($data['berita'] != null) {
            $this->load->view('templates/home_header', ['title' =>  $data['berita']['judul'] . " - Unsika", 'mId' => 3]);
            $this->load->view('index/page', $data);
            $this->load->view('templates/home_footer');
        } else {
            $this->load->view('templates/home_header', ['title' => "Not Found - Unsika", 'mId' => 3]);
            $this->load->view('index/404');
            $this->load->view('templates/home_footer');
        }
    }
}
