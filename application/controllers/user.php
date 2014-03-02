<?php 
  if(!defined('BASEPATH')) exit('No direct script access allowed');
  class User extends CI_Controller 
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('user_model');
    }
    public final function signup()
    {
      showView('users/signup');
    }
    //curl 'http://localhost/clarinet/index.php/user/searchByEmail/{}'
    /*
    * @param  $email    A url-encoded string.
    */
    public final function searchByEmail($email)
    {
      showJsonView
      (
        array
        (
          'user' => 
          $this->user_model->searchByEmail
          (
            $email
          )->result_array()
        )
      );
    }
    public final function subscribe()
    {
      if($this->input->post())
      {
        $this->user_model->subscribe();
      }
    }
    private final function getIsValidForm()
    {
      $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
      $this->form_validation->set_rules('password', 'Password', 'required');
      return $this->form_validation->run();
    }
    public final function create()
    {
      //validateSession();
      if($this->input->post())
      {
        if($this->getIsValidForm())
        {
          $id = $this->user_model->create()->result()->id;
          if($id > 0)
          {
            redirect(site_url('user/read/' . $id));
          }
          else
          {
            show_error('Error creating user.');
          }
        }
        else
        {
          showView('users/create');
        }
      }
      else
      {
        showView('users/create');
      }
    }
    public final function forgotPassword()
    {
      if($this->input->post())
      {
        $stat = $this->user_model->forgotPassword();
        if($stat)
        {
          //
        }
        else
        {
          //Show no record found page.
        }
      }
      else
      {
        showView('users/forgot_password');
      }
    }
    public final function resetPassword($id = null)
    {
      if($this->input->post())
      {
        $this->user_model->resetPassword();
      }
      else
      {
        showView('users/reset_password');
      }
    }
    public final function read($id)
    {
      //validateSession();
      showView
      (
        'users/read', 
        array('user' => $this->user_model->read($id))
      );
    }
    public final function update()
    {
      //validateSession();
      $i = $this->input;
      if($i->post())
      {
        if($this->getIsValidForm())
        {
          $u = $this->user_model->update();
          if($u)
          {
            redirect(site_url('user/read/' . $i->post('id')));
          }
          else
          {
            show_error('Something went wrong.');
          }
        }
        else
        {
          showView('users/update');
        }
      }
      else
      {
        showView('users/update');
      }
    }
    public final function delete($id)
    {
      //validateSession();
      showJsonView
      (
        array
        (
          'deleted' => 
          $this->user_model->delete($id)
        )
      );
    }
    public final function login()
    {
      if($this->input->post())
      {
        $u = $this->user_model->login()->row();
        if($u->id > 0)
        {
          $this->session->set_userdata(array('user' => $u));
          redirect(site_url('moment'));
        }
        else
        {
          showView
          (
            'users/login', 
            array('error' => 'Please check username and password.')
          );
        }
       }
      else
      {
        showView('users/login');
      }
    }
    public final function logout()
    {
      $this->session->sess_destroy();
      redirect(site_url('home'));
    }
    //
    public final function confirm($id, $state = true)
    {
      $this->user_model->confirm($id, $state);
    }
  }