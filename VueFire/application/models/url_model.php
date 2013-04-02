<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class url_Model extends CI_Model
{
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
    public function forum($intForumId, $strForumName)
    {
      return 'f' . (int)$intForumId . '-' . (string)url_title($strForumName, '_', true) . '.html';
    }
}