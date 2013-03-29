<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class forums_Model extends CI_Model
{
    private $arrStorage = array();

    private $arrForums = array();
    private $arrLatestPosts = array();
    private $arrStatistics = array();
    #private $arrSettings = array();

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
    public function get_forums_structure($intForumId = null)
    {
        // are we selecting all or just for this one forum?
        $this->arrForums = $this->db->get('forums')->result_array();
        $this->arrLatestPosts = $this->db->select(array('post_id', 'topic_id', 'forum_id', 'post_title', 'post_subject', 'post_user_id', 'post_time', 'user_name', 'user_id'))
                                         ->from('posts')
                                         ->join('users', 'users.user_id = posts.post_user_id')
                                         ->group_by('forum_id')
                                         ->order_by('post_time', 'desc')
                                         #->order_by('post_id', 'desc')
                                         ->get()
                                         ->result_array();
        $this->arrStatistics = $this->db->get_where('global_stats', array('obj_type' => 1))->result_array();

        // define
        $this->arrStorage['forums'] = array();

        // define our structure
        if(!empty($this->arrForums))
        {
            // reorder based on parent
            foreach($this->arrForums as $arrSection)
            {
                
            }


            foreach($this->arrForums as $arrSection)
            {
                print_r($arrSection);
                switch($arrSection['forum_type'])
                {
                    case 'category':
                        $this->arrStorage['forums'][$arrSection['forum_id']] = (isset($this->arrStorage['forums'][$arrSection['forum_id']]) ? array_merge($this->arrStorage['forums'][$arrSection['forum_id']], $arrSection) : $arrSection);
                        break;
                    case 'subforum':
                    case 'link':
                    case 'forum':
                        $this->arrStorage['forums'][$arrSection['forum_parent']]['forums'][$arrSection['forum_id']] = $arrSection;
                        break;
                }
                #$this->arrStorage['forums'];
            }
        }

        echo('<pre>' . print_r($this->arrStorage['forums'], true) . '</pre>');
        print_r($this->arrForums);
    }


}