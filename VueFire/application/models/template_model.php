<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class template_Model extends CI_Model
{
    private $arrSettings = array();

    /**
     *
     *
     */
    function __construct()
    {
        // inherit
        parent::__construct();

        // get all the settings from the database
        $this->db->select(array('settings_name', 'settings_data', 'settings_id', 'settings_area'));
        $this->arrSettings = $this->db->get('settings')->result_array();
    }

    /**
     *
     */
    function get()
    {


    }

    /**
     *
     */
    function set()
    {

    }
}