<?php
  class Moment_Model extends CI_Model
  {
    public function __construct()
    {
      parent::__construct();
    }
    //1 to 1 record.
    public final function setAsResponder
    (
      $userId, 
      $latLng,
      $verticalId, 
      $state
    )
    {
      //Search for existing records.
      $this->db->select('id');
      $this->db->from('moment_responders');
      $this->db->where('users_id', $userId);
      $this->db->where('verticals_id', $verticalId);
      $q = $this->db->get();
      $i = $this->db->num_rows();
      $q->free_result();
      //
      if($i > 0)
      {
        //Wants to be a responder.
        if($state)
        {
          //Update only the $latLng.
          $this->db->where('users_id', $userId);
          $this->db->update
          (
            'moment_responders', 
            array('lat_lng' => $latLng)
          );
          return true;
        }
        else
        {
          //Delete any records as a responder.
          $this->db->where('users_id', $userId);
          $this->db->where('verticals_id', $verticalId);
          $this->db->delete('moment_responders');
          //No longer a responder.
          return false;
        }
      }
      else
      {
        //No records found. By default, not a responder.
        return false;
      }
    }
    public final function readByFilter($userId, $filterName)
    {
      $this->db->select('*');
      switch($filterName)
      {
        case 'All':
          //Do nothing.
        break;
        case 'Featured':
          //TODO: Implement ping_count in DB and show the top 4.
          //Enhance this algo.
          //$this->db->order_by('ping_count DESC');
          //$this->db->limit(4);
        break;
        case 'For Emergencies':
          $this->db->like('tags', 'emergency');
        break;
        case 'I am the responder':
          $this->db->join('moment_responders mr', 'm.id = mr.moments_id');
          $this->db->where('mr.users_id', $userId);
        break;
      }
      $this->from('moments m');
      return $this->db->get();
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
    public final function generateAppKey()
    {
      return md5
      (
        rand(1, 99999) . 
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
    private final function getPrivateValue()
    {
      $p = $this->input->post('private');
      return $p == 'on' ? 1 : 0;
    }
    public final function read($id)
    {
      $this->db->select('m.*, v.name vertical');
      $this->db->from('moments m');
      $this->db->join('verticals v', 'v.id = m.verticals_id');
      $this->db->where('m.id', $id);
      return $this->db->get();
    }
    public final function create()
    {
      $i = $this->input;
      $a = array
      (
        'private' => $this->getPrivateValue(),
        'name' => $i->post('name'),
        'description' => $i->post('description'),
        'app_key' => $i->post('appKey'),
        'vertical_id' => $i->post('verticalId')
      );
      $this->db->insert('moments', $a);
      return $this->read($this->db->insert_id());
    }
    private final function uploadIcon($name)
    {
      $this->load->library('upload');
      //TODO: Create folder to store multiple icons per Moment.
      //$this->load->helper('inflector');
      //$pre = strtolower(underscore($name));
      $a['upload_path'] = base_url('public/images/uploads/moments/icons');
      $a['allowed_types'] = 'gif|jpg|png';
      $a['max_width']  = '20';
      $a['max_height']  = '20';
      $a['encrypt_name'] = true;
      $this->load->library('upload', $a);
      $this->upload->do_upload();
      $data = $this->upload->data();
      return $data['full_path'];
    }
    public final function update()
    {
      $i = $this->input;
      $n = $i->post('name');
      $d = $i->post('description');
      $priv = $i->post('private');
      $ico = $this->uploadIcon($n);
      $a = array
      (
        'icon_path' => $ico,
        'private' => $priv,
        'name' => $n,
        'description' => $d,
        'app_key' => $this->generateAppKey($n, $d),
        'vertical_id' => $i->post('verticalId')
      );
      if($priv)
      {
        //Responders.
        foreach($i->post('responders[]') as $v => $p)
        {
          //
        }
      }
      //Limitations.
      $a['max_ping_radius'] = $i->post('maxPingRadius');
      $a['max_pong_radius'] = $i->post('maxPongRadius');
      $a['max_responders'] = $i->post('maxResponders');
      //Broadcasts.
      $a[''] = $i->post('allowSendOptionalMessageToResponder');
      $a[''] = $i->post('useAsSearchKeyword');
      $a[''] = $i->post('sendResponderDescription');
      $a[''] = $i->post('sendNotificationMessageToSender');
      $a['notification_message_title'] = $i->post('notificationMessageTitle');
      $a['notification_message'] = $i->post('notificationMessage');
      //After service.
      $a['after_service_prompt_message_to_sender'] = $i->post('sendPromptToSender');
      $a['after_service_prompt_title'] = $i->post('promptMessageTitle');
      $a['after_service_prompt_message'] = $i->post('promptMessage');
      return $this->db->update('moments', $a);
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
      "AGAINST(name, description, tags)";
      return $this->db->query($s);
    }
    public final function getRespondersWithinRadius
    (
      $longitude, 
      $latitude, 
      $radius, 
      $keywords
    )
    {
      $s = "SELECT m.*, v.name vertical, " . 
            "(6371 * acos(cos(radians($latitude)) " . 
            "* cos(radians(mr.latitude)) " . 
            "* cos(radians(mr.longitude) " . 
            "- radians($longitude)) " . 
            "+ sin(radians($latitude)) " . 
            "* sin(radians(mr.latitude)))) distance " . 
            "FROM moment_responders mr " . 
            "INNER JOIN moments m ON m.id = mr.moments_id " . 
            "INNER JOIN verticals v ON m.verticals_id = v.id " . 
            "INNER JOIN users u ON u.id = mr.users_id " . 
            "WHERE m.name LIKE '%$keywords%' OR " . 
            "v.name LIKE '%$keywords%' OR " . 
            "m.description LIKE '%$keywords%' OR " . 
            "m.tags LIKE '%$keywords%' OR " . 
            "m.private = 0 AND " . 
            "m.tags LIKE '%$keywords%' AND " . 
            "m.activated = 1 " . 
            "GROUP BY m.name " . 
            "HAVING distance < $radius " . 
            "ORDER BY distance " . 
            "LIMIT 0, 20";
      return $this->db->query($s);
    }
  }