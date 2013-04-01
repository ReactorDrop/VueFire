<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class statistics_Model extends CI_Model
{
  private $arrStorage = array();

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
  function get_global_statistics()
  {
    $arrStats = $this->db->get_where('global_stats', array('obj_type' => 1))->result_array();

    //
    foreach($arrStats as $arrStat)
    {
      #$this->arrStorage['global']['forums'] =
      #$this->arrStorage['global']['general'] =
    }
  }
}