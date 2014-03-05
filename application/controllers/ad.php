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
    //@param  $type   Either Impression or Click.
    public final function incrementMetric($type, $id)
    {
      $stat = $this->ad_model->incrementMetric($type, $id);
      showJsonView(array('status' => $stat));
    }
    private final function isValidForm()
    {
      return true;
    }
    public final function index()
    {
      $ads = $this->ad_model->index();
      showView('ads/index', array('ads' => $ads));
    }
    public final function create()
    {
      if($this->input->post())
      {
        if($this->isValidForm())
        {
          $ad = $this->ad_model->create();
          if($ad->id > 0)
          {
            redirect(site_url('ad/read/' . $ad->id));
          }
          else
          {
            show_error('Error creating an ad.');
          }
        }
        else
        {
          showView('ads/create');
        }
      }
      else
      {
        showView('ads/create');
      }
    }
    public final function read($id)
    {
      $ad = $this->ad_model->read($id);
      showView('ads/read', array('ad' => $ad));
    }
    public final function update($id = null)
    {
      if($this->input->post())
      {
        $ad = $this->ad_model->read($this->input->post('id'));
        if($this->isValidForm())
        {
          $ad = $this->ad_model->update();
          if($ad->id > 0)
          {
            redirect(site_url('ad/read/' . $ad->id));
          }
          else
          {
            show_error('Error updating ad.');
          }
        }
        else
        {
          showView('ads/update', array('ad' => $ad));
        }
      }
      else
      {
        $ad = $this->ad_model->read($id);
        showView('ads/update', array('ad' => $ad));
      }
    }
    public final function delete($id)
    {
      $b = $this->ad_model->delete($id);
      showJsonView(array('deleted' => $b));
    }
    //@param  $keywords   Word separated by commas.
    public final function show($momentName, $keywords)
    {
      $ad = $this->ad_model->show($keywords);
      showJsonView($ad);
    }
  }