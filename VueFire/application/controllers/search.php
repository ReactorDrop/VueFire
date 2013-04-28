<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends VF_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * the initial searching
   * @return void
   */
  public function index()
  {
    // load what we need
    $this->load->model(array('forums_model', 'statistics_model', 'url_model'));
    $this->load->helper('url');

    // load data
    $strTerm = $this->input->get('q');



    // build our html
    $this->benchmark->mark('building_html_start');
    $this->data['title'] = 'Search - VueFire';
    $this->data['header'] = $this->template_model->header();
    $this->data['content'] = $this->parser->parse($this->template_model->get_template_path() . 'search_results', $arrData, array('show' => false, 'disable_includes' => true));
    $this->data['footer'] = $this->template_model->footer();
    $this->parser->parse($this->template_model->get_template_path() . 'shell', $this->data, array('show' => true));
    $this->benchmark->mark('building_html_end');
  }
}

/* End of file topic.php */
/* Location: ./application/controllers/topic.php */