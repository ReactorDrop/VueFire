<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller
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
  public function index()
  {
    // load what we need
    $this->load->model(array('forums_model', 'template_model', 'statistics_model', 'url_model'));
    $this->load->helper('url');

    // load data
    $arrData['forums_structure'] = $this->forums_model->get_forums_structure();

    // build our html
    $this->benchmark->mark('building_html_start');
    $this->data['title'] = 'Home - VueFire';
    $this->data['header'] = $this->template_model->header();
    $this->data['content'] = $this->parser->parse($this->template_model->get_template_path() . 'forum_list', $arrData, array('show' => false, 'disable_includes' => true));
    $this->data['footer'] = $this->template_model->footer();
    $this->parser->parse($this->template_model->get_template_path() . 'shell', $this->data, array('show' => true));
    $this->benchmark->mark('building_html_end');
  }

  /**
   * @param $intForumId forum id that we're "in"
   * @return void
   */
  public function view($intForumId)
  {
    // load what we need
    $this->load->model(array('forums_model', 'template_model', 'url_model'));
    $this->load->helper('url');

    //
    $arrForumInfo = $this->forums_model->get_info($intForumId);
print_r($arrForumInfo);


    // load data
    $arrData['topics'] = $this->forums_model->get_forum_topics($intForumId);

    // build our html
    $this->benchmark->mark('building_html_start');
    $this->data['title'] = 'Home - VueFire';
    $this->data['header'] = $this->template_model->header();
    $this->data['content'] = $this->parser->parse($this->template_model->get_template_path() . 'topic_list', $arrData, array('show' => false, 'disable_includes' => true));
    $this->data['footer'] = $this->template_model->footer();
    $this->parser->parse($this->template_model->get_template_path() . 'shell', $this->data, array('show' => true));
    $this->benchmark->mark('building_html_end');


    //
    echo($intForumId);
    echo('<pre>');
    print_r($this->forums_model->get_forum_topics($intForumId));
    echo('</pre>');
  }
}

/* End of file forum.php */
/* Location: ./application/controllers/forum.php */