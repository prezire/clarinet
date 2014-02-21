<?php
  class User_Model extends CI_Model
  {
    public function __construct()
    {
      parent::__construct();
    }
    public final function subscribe()
    {
      $this->db->insert
      (
        'users', 
        array
        (
          'email' => 
          $this->input->post('email')
        )
      );
      return $this->db->insert_id();
    }
    public final function forgotPassword()
    {
      $this->db->where
      (
        'email', 
        $this->input->post('email')
      );
      return $this->db->update
      (
        'users', 
        array('password_forgotten' => true)
      );
    }
    public final function resetPassword()
    {
      $this->db->where
      (
        'id', 
        $this->input->post('id')
      );
      return $this->db->update
      (
        'users', 
        array('password' => $this->input->post('password'))
      );
    }
    public final function login()
    {
      //TODO: Check if pwd forgotten.
      $i = $this->input;
      $this->db->select('u.id, u.complete_name, u.email, r.id radius_id');
      $this->db->from('radius r');
      $this->db->join('radius_admins ra', 'r.id = ra.radius_id');
      $this->db->join('users u', 'u.id = ra.user_id');
      $this->db->where
      (
        array
        (
          'email' => $i->post('email'), 
          'password' => $i->post('password'),
          'confirmed' => true
        )
      );
      return $this->db->get();
    }
    public final function index()
    {
      //
    }
    public final function create()
    {
      $i = $this->input;
      $name = $i->post('completeName');
      $email = $i->post('email');
      $pass = $i->post('password');
      $a = array
      (
        'complete_name' => $name,
        'email' => $email,
        'password' => $pass
      );
      $this->db->insert('users', $a);
      $id = $this->db->insert_id();
      //$this->sendConfirmationEmail($id);
      return $id;
    }
    //TODO: Transf to ctrl.
    public final function sendConfirmationEmail($id)
    {
      $i = $this->input;
      $this->load->library('email');
      $this->email->from('info@travelexplorer.com');
      $this->email->to($i->post('email'));
      $this->email->bcc('prezire@gmail.com');
      $this->email->subject('Clarinet - Confirm Registration');
      $a = array
      (
        'confirmUrl' => site_url("user/confirm/$id"),
        'unConfirmUrl' => site_url("user/confirm/$id/false"),
        'completeName' => $i->post('completeName')
      );
      $s = $this->parser->parse
      (
        'commons/partials/confirm_registration', 
        $a, 
        true
      );
      $this->email->message($s);
      $this->email->send();
    }
    public final function read($id)
    {
      return $this->db->get_where('users', array('id' => $id));
    }
    public final function update()
    {
      $i = $this->input;
      $a = array
      (
        'complete_name' => $i->post('completeName'),
        'avatar' => $i->post('avatar'),
        'address' => $i->post('address'),
        'birthdate' => $i->post('birthdate'),
        'email' => $i->post('email'),
        'password' => $i->post('password')
      );
      $this->db->update('users', $a);
      return $this->read($this->session->userdata('user')->id);
    }
    public final function confirm($id, $state = true)
    {
      $this->db->where('id', $id);
      $this->db->update('users', array('confirmed' => $state));
    }
    public final function delete($id)
    {
      return $this->db->delete('users', array('id' => $id));
    }
  }