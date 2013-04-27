<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class VFA_Controller extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->output->enable_profiler(true); // temporary
    $this->load->model(array('admin_model'));
  }
}