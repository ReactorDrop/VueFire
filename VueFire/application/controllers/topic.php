<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->output->enable_profiler(true); // temporary
  }

  /**
   *
   * @return void
   */
  public function view($intTopicId)
  {
    echo($intTopicId);
  }
}

/* End of file topic.php */
/* Location: ./application/controllers/topic.php */