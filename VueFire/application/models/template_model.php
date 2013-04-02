<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
  public function get_template_path()
  {
    if($this->agent->is_mobile() && file_exists($this->settings_model->get('default_template') . '/mobile'))
    {
      // switch to the mobile version - template has a mobile version
      return $this->settings_model->get('default_template') . '/mobile';
    }
    else
    {
      // use the default path
      return $this->settings_model->get('default_template');
    }
  }

  /**
   *
   */
  public function header()
  {
    // generic header
    return $this->parser->parse($this->get_template_path() . '/header', $this->data, array('show' => false, 'disable_includes' => true));
  }

  /**
   *
   */
  public function footer()
  {
    // generic footer
    return $this->parser->parse($this->get_template_path() . '/footer', $this->data, array('show' => false, 'disable_includes' => true));
  }

}