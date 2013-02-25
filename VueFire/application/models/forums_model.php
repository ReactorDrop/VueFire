<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class forums_Model extends CI_Model
{
    private $arrForums = array();
    private $arrLatestPosts = array();
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
    public function get_forums_data($intForumId = null)
    {
        // are we selecting all or just for this one forum?
        if(is_int($intForumId))
        {

        }
        else
        {
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
        }
    }


}