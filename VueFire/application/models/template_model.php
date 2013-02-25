<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class template_Model extends CI_Model
{
    /**
     *
     *
     */
    function __construct()
    {
        // inherit
        parent::__construct();
    }

    /**
     *
     */
    public function header()
    {
        // generic header
        return 'header';
    }

    /**
     *
     */
    public function footer()
    {
        // generic footer
        return 'footer';
    }

}