<?php
  class Point_Model extends CI_Model
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }
    public final function create()
    {
      $i = $this->input;
      $a = array
      (
        'longitude' => $i->post('longitude'),
        'latitude' => $i->post('latitude'),
        'code' => do_hash(rand())
      );
      $this->db->insert('points', $a);
      return $this->read($this->db->insert_id());
    }
    public final function read($id)
    {
      return $this->db->get_where('points', array('id' => $id));
    }
    public final function update()
    {
      $i = $this->input;
      $lng = $i->post('longitude');
      $lat = $i->post('latitude');
      $a = array
      (
        'longitude' => $i->post('longitude'),
        'latitude' => $i->post('latitude'),
        'name' => $i->post('name'),
        'password' => do_hash($i->post('password')),
        'description' => $i->post('description')
      );
      $this->db->where('id', $i->post('id'));
      $this->db->where('password', do_hash($i->post('password')));
      $this->db->update('points', $a);
      return $this->db->affected_rows() > 0 ? $i->post('id') : null;
    }
    public final function delete($id)
    {
      return $this->db->delete('points', array('id' => $id));
    }
    public final function locate($code)
    {
      $s = "SELECT name, description, longitude, latitude, code FROM points WHERE code = '$code'";
      return $this->db->query($s);
    }
  }