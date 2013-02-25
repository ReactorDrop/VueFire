<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class settings_Model extends CI_Model
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
        foreach($this->db->get('settings')->result_array() as $arrSetting)
        {
            $this->arrSettings[$arrSetting['settings_name']] = $arrSetting;
        }
    }

    /**
     *
     */
    function get($strSetting)
    {
        // check and return this setting
        if(isset($this->arrSettings[$strSetting]))
        {
            return $this->arrSettings[$strSetting]['settings_data'];
        }
        else
        {
            return null;
        }
    }

    /**
     *
     */
    function set()
    {

    }
}