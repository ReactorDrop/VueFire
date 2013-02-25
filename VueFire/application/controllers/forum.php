<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller
{
	public function index()
	{
        // load what we need
        $this->load->model('forums_model');
        $this->load->model('template_model');

        $this->forums_model->get_forums_data();

        $this->output->enable_profiler(TRUE);

        // load our html
        $this->data['header'] = $this->template_model->header();
        $this->data['content'] = $this->parser->parse('templates/' . $this->settings_model->get('default_template') . '/forum_list', array(), true);
        $this->data['footer'] = $this->template_model->footer();

        $this->parser->parse('templates/' . $this->settings_model->get('default_template') . '/shell', $this->data);
	}
}

/* End of file forum.php */
/* Location: ./application/controllers/forum.php */