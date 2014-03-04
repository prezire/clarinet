<?php 
  if(!defined('BASEPATH')) exit('No direct script access allowed');
  class Ad extends CI_Controller 
  {
    public function __construct()
    {
      parent::__construct();
      //validateSession();
      $this->load->model('ad_model');
    }
    public final function read($id){}
    //@param  $keywords   Word separated by commas.
    public final function show($momentName, $keywords)
    {
      $ad = $this->ad_model->show($keywords);
      showJsonView($ad);
    }
  }