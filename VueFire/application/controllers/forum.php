<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller
{
  /**
   *
   */
  public function index()
  {
    $this->output->enable_profiler(true); // temporary
    // load what we need
    $this->load->model(array('forums_model', 'template_model', 'statistics_model', 'url_model'));
    $this->load->helper('url');

    // load data
    $arrData['forums_structure'] = $this->forums_model->get_forums_structure();

    // build our html
    $this->data['header'] = $this->template_model->header();
    $this->data['content'] = $this->parser->parse($this->settings_model->get('default_template') . '/forum_list', $arrData, array('show' => false, 'disable_includes' => true));
    $this->data['footer'] = $this->template_model->footer();
    $this->parser->parse($this->settings_model->get('default_template') . '/shell', $this->data, array('show' => true));
  }

  public function view($intForumId)
  {
    //
    echo($intForumId);
  }
}

/* End of file forum.php */
/* Location: ./application/controllers/forum.php */