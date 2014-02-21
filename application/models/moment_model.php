<?php
  class Moment_Model extends CI_Model
  {
    public function __construct()
    {
      parent::__construct();
    }
    public final function index()
    {
      $this->db->select('*');
      $this->db->from('moments m');
      $this->db->order_by('name ASC');
      return $this->db->get();
    }
    public final function incrementBogusLevel()
    {
      //Number of pings over ponged?
    }
    public final function generateAppKey($name, $password)
    {
      return md5
      (
        $name . 
        $password . 
        rand() . 
        date("D F d Y", time())
      );
    }
    //Public ping / pong broadcasts.
    public final function ping($id, $latLng, $message)
    {
      $mId = $this->db->get_where
      (
        'moments', 
        array('id' => $id)
      )->row()->id;
      $a = array
      (
        'moments_id' => $mId,
        'lat_lng' => $latLng,
        'message' => $message
      );
      return $this->db->insert('moment_pings', $a);
    }
    //Returns only Moments that are public 
    //closest to the responder's origin.
    public final function pong($id, $latLng)
    {
      $s = "SELECT *, (6371 * acos(cos(radians($latitude)) * " .
      "cos(radians(latitude)) * cos(radians(longitude) - " . 
      "radians($longitude)) + sin(radians($latitude)) * " . 
      "sin(radians(latitude)))) AS distance " . 
      "FROM moment_pings mp " . 
      "INNER JOIN moments m " . 
      "ON m.id = mp.moments_id" . 
      "WHERE m.id = $id AND m.private = 0" . 
      "GROUP BY m.name " . 
      "HAVING distance < m.max_distance " . 
      "ORDER BY distance " . 
      "LIMIT 0, m.max_responders";
      return $this->db->query($s);
    }
    //
    //Creates or updates a ping if it exists.
    public final function createPrivatePing
    (
      $appKey, 
      $latLng, 
      $message
    )
    {
      //Check if moment exists.
      $mId = $this->db->get_where
      (
        'moments', 
        array('app_key' => $appKey)
      )->row()->id;
      if($mId)
      {
        //Update prev ping.
        $this->db->where('moments_id', $mId);
        return $this->db->update
        (
          'moment_pings', 
          array
          (
            'lat_lng' => $latLng,
            'message' => $message
          )
        );
      }
      else
      {
        //Insert a new ping.
        $a = array
        (
          'message' => $message,
          'moments_id' => $mId
        );
        return $this->db->insert('moment_pings', $a);
      }
    }
    public final function readPrivatePing
    (
      $appKey, 
      $responderId, 
      $latLng
    )
    {
      //Flag moment has been ponged.
      $mId = $this->db->get_where
      (
        'moments', 
        array('app_key' => $appKey)
      )->row()->id;
      $this->db->where('moments_id', $mId);
      $this->db->update
      (
        'moment_pings', 
        array('ponged' => true)
      );
      //
      $mId = $this->db->get_where
      (
        'moments', 
        array
        (
          'app_key' => $appKey
        )
      )->row()->id;
      //TODO: Update only latest timestamp.
      $this->db->where('moments_id', $mId);
      $this->db->update
      (
        'moment_pings p', 
        array('ponged' => 1)
      );
      //Set the last origin of responder.
      $this->db->where('id', $responderId);
      $this->db->update
      (
        'moment_ping_responders', 
        array('lat_lng' => $latLng)
      );
      //
      $this->db->select('p.message, p.timestamp');
      $this->db->from('moment_pings p');
      $this->db->join('moments m', 'm.id = p.moments_id');
      $this->db->where('m.app_key', $appKey);
      $this->db->order_by('timestamp DESC');
      $this->db->limit(1);
      return $this->db->get();
    }
    public final function create()
    {
      $i = $this->input;
      $n = $i->post('name');
      $d = $i->post('description');
      return $this->db->insert
      (
        'moments', 
        array
        (
          'private' => $i->post('private'),
          'name' => $n,
          'description' => $d,
          'app_key' => $this->generateAppKey($n, $d),
          'vertical_id' => $i->post('verticalId')
        )
      );
    }
    //one to one.
    public final function subscribeAsResponder()
    {
      $i = $this->input;
      $this->db->insert
      (
        'moment_ping_responders', 
        array
        (
          'vertical_id' => $i->post('verticalId'),
          'user_id' => $i->post('userId')
        )
      );
    }
    //
    public final function readRecentlyAdded($limit = 2)
    {
      $this->db->select('*');
      $this->db->from('moments');
      $this->db->limit($limit);
      $this->db->order_by('timestamp DESC');
      return $this->db->get();
    }
    public final function readMostUsed(){}
    public final function readForEmergencies(){}
    //
    public final function readByVertical($vertical)
    {
      $this->db->select('*');
      $this->db->from('moments m');
      $this->db->join('verticals v', 'm.vertical_id = v.id');
      $this->db->where('v.name', $vertical);
      return $this->db->get();
    }
    public final function search($keywords)
    {
      $s = "SELECT * FROM moments m" . 
      "INNER JOIN moment_pings mp " . 
      "ON m.id = mp._moments_id" . 
      "WHERE MATCH($keywords) " . 
      "AGAINST(name, description)";
      return $this->db->query($s);
    }
  }