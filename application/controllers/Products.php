<?php
class Products extends CI_Controller
{

    public function index($num)
    {
        echo "Hello";
    }

    public function shoes($sandals, $id)
    {
        echo $sandals;
        echo $id;
    }

    public function _remap($method, $params = array())
    {
        $method = $method;
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }
        echo "Not found";
    }
}
