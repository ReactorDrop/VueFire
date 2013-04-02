<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
    $this->arrStatistics = $this->statistics_model->get_global_statistics();

    // define
    $this->arrStorage['forums'] = array();

    // define our structure
    if (!empty($this->arrForums))
    {
      // grab our last posts
      $this->get_latest_posts();

      // reorder based on parent
      $arrForumsTemp = array();

      foreach ($this->arrForums as &$arrSection)
      {
        // add in statistics
        if(isset($this->arrStatistics['forum'][$arrSection['forum_id']]))
        {
          $arrSection['statistics'] = $this->arrStatistics['forum'][$arrSection['forum_id']];
        }

        $arrSection['forum_name_url'] = $this->url_model->forum($arrSection['forum_id'], $arrSection['forum_name']);
        $arrForumsTemp[$arrSection['forum_id']] = $arrSection;
      }

      // loop through latest posts and assign to a forum
      foreach($this->arrLatestPosts as $arrLastPost)
      {
        if(isset($arrForumsTemp[$arrLastPost['forum_id']]))
        {
          $arrForumsTemp[$arrLastPost['forum_id']]['latest_post'] = $arrLastPost;
        }
      }

      // reset and clean
      $this->arrForums = $arrForumsTemp;
      unset($arrForumsTemp, $this->arrLatestPosts);

      // loop through to build our forum structure
      foreach ($this->arrForums as $intKey => $arrSection)
      {
        if ($arrSection['forum_parent'] === null)
        {
          $this->arrStorage['forums'][$intKey] = $arrSection;
          $this->arrStorage['forums'][$intKey]['forums'] = $this->find_children($arrSection['forum_id']);
        }
      }
    }

    // cleanup and return
    unset($this->arrForums);
    echo('<pre>' . print_r($this->arrStorage['forums'], true) . '</pre>');
    return $this->arrStorage['forums'];
  }

  /**
   * find the children of that parent (infinite reference)
   *
   * @param integer $intParentId the parent id of the forum to find children for
   * @return array a blank array or an array containing the typical structure
   */
  private function &find_children($intParentId)
  {
    $arrTempData = array();
    foreach ($this->arrForums as $arrSection)
    {
      if ($arrSection['forum_parent'] === $intParentId)
      {
        $arrTempData[$arrSection['forum_id']] = $arrSection;
        unset($this->arrForums[$arrSection['forum_id']]);

        $arrTempData[$arrSection['forum_id']]['forums'] = $this->find_children($arrSection['forum_id']);
      }
    }

    return $arrTempData;
  }

  /**
   *
   */
  public function get_latest_posts($intForumId = null)
  {
    $this->arrLatestPosts = $this->db->select(array('post_id', 'topic_id', 'forum_id', 'post_title', 'post_subject', 'post_user_id', 'post_time', 'user_name', 'user_id'))
      ->from('posts')
      ->join('users', 'users.user_id = posts.post_user_id')
      ->group_by('forum_id')
      ->order_by('post_time', 'desc')
      #->order_by('post_id', 'desc')
      ->get()
      ->result_array();

    return $this->arrLatestPosts;
  }

}