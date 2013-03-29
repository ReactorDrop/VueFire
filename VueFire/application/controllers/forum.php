<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller
{
    /**
     *
     */
    public function index()
	{
        $this->output->enable_profiler(TRUE); // temporary
        // load what we need
        $this->load->model('forums_model');
        $this->load->model('template_model');

        // load data
        $arrData = $this->forums_model->get_forums_structure();
        echo('<pre>' . print_r($arrData, true) . '</pre>');
        // load our html
        $this->data['header'] = $this->template_model->header();
        $this->data['content'] = $this->parser->parse($this->settings_model->get('default_template') . '/forum_list', array(), array('show' => false, 'disable_includes' => true));
        $this->data['footer'] = $this->template_model->footer();

        $this->parser->parse($this->settings_model->get('default_template') . '/shell', $this->data, array('show' => true));
	}
}

/* End of file forum.php */
/* Location: ./application/controllers/forum.php */