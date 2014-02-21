<?php 
  if(!defined('BASEPATH')) exit('No direct script access allowed');
  class Radius extends CI_Controller 
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('radius_model');
      $this->load->model('user_model');
    }
    public final function help()
    {
      showView($this, 'help');
    }
    public final function listing()
    {
      showView
      (
        $this, 
        'radius/listing', 
        array
        (
          'user' => $this->session->userdata('user'), 
          'radius' => $this->radius_model->listing()
        )
      );
    }
    public final function index()
    {
      showView
      (
        $this, 
        'radius/index', 
        array
        (
          'verticals' => 
          $this->radius_model->getVerticals()->result()
        )
      );
    }
    public final function create()
    {
      $aData = array('verticals' => $this->radius_model->getVerticals());
      $sView = $this->load->view('commons/partials/verticals', $aData, true);
      $aView = array('verticals' => $sView);
      if($this->input->post())
      {
        $b = $this->getIsValidForm();
        if($b)
        {
          $i = $this->radius_model->create();
          if($i)
          {
            $u = $this->user_model->create();
            if($u)
            {
              $ra = $this->radius_model->createAdmin($i, $u);
              if($ra)
              {
                redirect(site_url('user/login'));
              }
              else
              {
                show_error('Error creating Radius administrator.');
              }
            }
            else
            {
              show_error('Error creating new user.');
            }
          }
          else
          {
            show_error('Error creating Radius.');
          }
        }
        else
        {
          showView($this, 'radius/create', $aView);
        }
      }
      else
      {
        showView($this, 'radius/create', $aView);
      }
    }
    public final function read($id)
    {
      showView
      (
        $this, 
        'radius/read', 
        array('radius' => $this->radius_model->read($id))
      );
    }
    public final function update($id = null)
    {
      $tmpId = $this->input->post() ? $this->input->post('id') : $id;
      $r = $this->radius_model->read($tmpId);
      $savedVerts = explode(',', $r->row()->verticals);
      $aData = array
      (
        'verticals' => 
        $this->radius_model->getVerticals(),
        'savedVerticals' => $savedVerts
      );
      $sView = $this->load->view('commons/partials/verticals', $aData, true);
      $aView = array('verticals' => $sView);
      if($this->input->post())
      {
        $b = $this->getIsValidForm(false);
        if($b)
        {
          $i = $this->radius_model->update();
          if($i)
          {
            redirect(site_url('radius/read/' . $i));
          }
          else
          {
            show_error('Unable to update Radius.');
          }
        }
        else
        {
          showView
          (
            $this, 
            'radius/update', 
            array
            (
              'radius' => $r,
              'verticals' => $sView
            )
          );
        }
      }
      else
      {
        showView
        (
          $this, 
          'radius/update', 
          array
          (
            'radius' => $r,
            'verticals' => $sView
          )
        );
      }
    }
    public final function delete($id)
    {
      if($this->radius_model->delete($id))
      {
        redirect(site_url('radius/listing'));
      }
      else
      {
        show_error('Something went wrong');
      }
    }
    private final function getIsValidForm($isCreate = true)
    {
      $this->form_validation->set_rules('completeName', 'Complete Name', 'required');
      if($isCreate)
      {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
      }
      $this->form_validation->set_rules('organizationName', 'Organization Name', 'required');
      $this->form_validation->set_rules('verticals[]', 'Verticals', 'required');
      $this->form_validation->set_rules('website', 'Website', 'required');
      $this->form_validation->set_rules('latitude', 'Latitude', 'required|decimal');
      $this->form_validation->set_rules('longitude', 'Longitude', 'required|decimal');
      return $this->form_validation->run();
    }
	public final function search($keywords)
	{
		showJsonView($this, array('result' => $this->radius_model->search($keywords)->result()));
	}
    //@param    $distance   In KM.
    public final function getAllWithinRadius
    (
      $longitude, 
      $latitude, 
      $distance, 
      $keywords
    )
    {
      $r = $this->radius_model->getAllWithinRadius
      (
        $longitude, 
        $latitude, 
        $distance,
        $keywords
      )->result();
      //
      $this->load->model('report_model');
      $this->report_model->create($r->id, 'search');
      //
      showJsonView
      (
        $this,
        array
        (
          //TODO: locations   Rename to radius.
          'locations' => 
          $r
        )
      );
    }
  }