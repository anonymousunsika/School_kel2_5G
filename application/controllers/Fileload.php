<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fileload extends CI_Controller
{
    function assets()
    {
        $segments = join($separator = '/', $array = array_slice($this->uri->segment_array(), 1));
        $target = "protected_upload/" . $segments;
        if (file_exists($target)) {
            if (is_file($target)) {
                $fileName = explode('.', $this->uri->segment_array()[$this->uri->total_segments()]);
                if ($fileName[count($fileName) - 1] == 'css') {
                    header("Content-Type: text/css");
                    readfile($target);
                } else if ($fileName[count($fileName) - 1] == 'js') {
                    header("Content-Type: text/javascript");
                    readfile($target);
                } else {
                    header("Content-Type: " . mime_content_type($target));
                    readfile($target);
                }
            } else
                show_404();
        } else
            show_404();
        die;
    }

    function vendor()
    {
        $segments = join($separator = '/', $array = array_slice($this->uri->segment_array(), 1));
        $target = "protected_upload/vendor2/" . $segments;
        if (file_exists($target)) {
            if (is_file($target)) {
                $fileName = explode('.', $this->uri->segment_array()[$this->uri->total_segments()]);
                if ($fileName[count($fileName) - 1] == 'css') {
                    header("Content-Type: text/css");
                    readfile($target);
                } else if ($fileName[count($fileName) - 1] == 'js') {
                    header("Content-Type: text/javascript");
                    readfile($target);
                } else {
                    header("Content-Type: " . mime_content_type($target));
                    readfile($target);
                }
            } else
                show_404();
        } else
            show_404();
        die;
    }
}
