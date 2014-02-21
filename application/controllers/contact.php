<?php 
  if(!defined('BASEPATH')) exit('No direct script access allowed');
  class Contact extends CI_Controller 
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('contact_model');
    }
    private final function getIsValidForm()
    {
      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('message', 'Message', 'required');
    }
    public final function create()
    {
      $i = $this->input;
      if($i->post())
      {
        $this->getIsValidForm();
        if($this->form_validation->run())
        {
          $b = $this->contact_model->create();
          if($b)
          {
            redirect(site_url('main/info'));
            $this->sendEmailToAdmin();
          }
          else
          {
            show_error('Something went wrong.');
          }
        }
        else
        {
          showView($this, 'info');
        }
      }
    }
    public final function read($id)
    {
      return $this->contact_model->read($id)->row();
    }
    public final function delete($id)
    {
      return $this->contact_model->delete($id);
    }
    private final function sendEmailToAdmin()
    {
      $i = $this->input;
      $this->load->library('email');
      //
      $this->email->from($i->post('email'), $i->post('completeName'));
      $this->email->to('contact@travelexplorer.com');
      //
      $this->email->subject($i->post('title'));
      $this->email->message($i->post('message'));
      $this->email->send();
    }
  }