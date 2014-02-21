<?php
  class Contact_Model extends CI_Model
  {
    public function __construct()
    {
      parent::__construct();
    }
    public final function create()
    {
      $i = $this->input;
      $a = array
      (
        'title' => $i->post('title'),
        'complete_name' => $i->post('completeName'),
        'email' => $i->post('email'),
        'message' => $i->post('message')
      );
      $this->db->insert('contacts', $a);
      return $this->db->insert_id();
    }
    public final function read($id)
    {
      return $this->db->get_where('contacts', array('id' => $id));
    }
    public final function update()
    {
      $i = $this->input;
      $a = array
      (
        'title' => $i->post('title'),
        'complete_name' => $i->post('completeName'),
        'email' => $i->post('email'),
        'message' => $i->post('message')
      );
      $this->db->where('id', $i->post('id'));
      $this->db->update('contacts', $a);
      return $this->db->affected_rows() > 0 ? $i->post('id') : null;
    }
    public final function delete($id)
    {
      return $this->db->delete('contacts', array('id' => $id));
    }
  }