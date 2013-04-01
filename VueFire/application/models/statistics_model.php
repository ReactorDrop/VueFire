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
      switch($arrStat['obj_type'])
      {
        case 'general':
          $this->arrStorage['global']['general'][$arrStat['obj_name']] = $arrStat;
          break;
        case 'forum':
          echo($arrStat['obj_name']);
          $arrPieces = explode('_', $arrStat['obj_name']);

          $this->arrStorage['global']['forum'][$arrPieces[0]][$arrPieces[1]] = $arrStat['obj_data'];

          break;
      }
    }

    unset($arrStats);
    return $this->arrStorage['global'];
  }
}