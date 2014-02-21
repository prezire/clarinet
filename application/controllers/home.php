<?php 
  if(!defined('BASEPATH')) exit('No direct script access allowed');
  class Home extends CI_Controller 
  {
    public function __construct()
    {
      parent::__construct();
      //validateSession();
    }
    public final function index(){showView('home');}
    public final function settings(){showView('settings');}
  }