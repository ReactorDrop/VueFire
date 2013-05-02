<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class VF_Controller extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->output->enable_profiler(true); // temporary
    $this->load->model(array('template_model'));

    // global variables
    $this->data['template_name'] = $this->template_model->get_template_name();
  }
}

/**
 * i dislike the following code, will need to look for a better solution
 * @todo look for better solution!
 */
class VFA_Controller extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->output->enable_profiler(true); // temporary
    $this->load->model(array('admin_model'));
  }
}