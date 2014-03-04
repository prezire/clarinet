<?php
  class Ad_Model extends CI_Model
  {
    public function __construct()
    {
      parent::__construct();
    }
    public final function show($keywords)
    {
      $s = "SELECT * FROM " . 
      "ads MATCH($keywords) " . 
      "AGAINST(name, description, tags) " . 
      "ORDER by bid_amount DESC " . 
      "LIMIT 1";
      return $this->db->query($s);
    }
  }