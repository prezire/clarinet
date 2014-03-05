<?php
  class Ad_Model extends CI_Model
  {
    public function __construct()
    {
      parent::__construct();
    }
    public final function incrementMetric($type, $id)
    {
      $this->db->where('id', $id);
      switch($type)
      {
        case 'Impression':
          $this->db->select('impressions');
          $metric = $this->db->get('ads')->row()->impressions;
        break;
        case 'Click':
          $this->db->select('clicks');
          $metric = $this->db->get('ads')->row()->clicks;
        break;
      }
      $this->db->where('id', $id);
      $this->db->update('ads', array('clicks' => $metric + 1));
    }
    private final function uploadBanner()
    {
      $this->load->library('upload');
      $a['upload_path'] = base_url('public/uploads/banners');
      $a['allowed_types'] = 'gif|jpg|png|swf';
      $a['encrypt_name'] = true;
      $this->load->library('upload', $a);
      $this->upload->do_upload('banner');
      //echo $this->upload->display_errors();
      //exit;
      $data = $this->upload->data();
      return $data['full_path'];
    }
    public final function index()
    {
      return $this->db->get('ads');
    }
    public final function create()
    {
      $i = $this->input;
      $b = $this->uploadBanner();
      $a = array
      (
        'name' => $i->post('name'),
        'description' => $i->post('description'),
        'tags' => $i->post('tags'),
        'banner_path' => $b['full_path'],
        'width' => $b['width'],
        'height' => $b['height'],
        'media_type' => $b['image_type'],
        'users_id' => $i->post('userId'),
        'date_from' => $i->post('dateFrom'),
        'date_to' => $i->post('dateTo'),
        'bid_amount' => $i->post('bidAmount'),
        'clickthrough_url' => $i->post('clickthroughUrl')
      );
      $this->db->insert('ads', $a);
      return $this->read($this->db->insert_id());
    }
    public final function read($id)
    {
      return $this->db->get_where('ads', array('id' => $id));
    }
    public final function update()
    {
      $i = $this->input;
      $b = $this->uploadBanner();
      $a = array
      (
        'name' => $i->post('name'),
        'description' => $i->post('description'),
        'tags' => $i->post('tags'),
        'banner_path' => $b['full_path'],
        'width' => $b['width'],
        'height' => $b['height'],
        'media_type' => $b['image_type'],
        'users_id' => $i->post('userId'),
        'date_from' => $i->post('dateFrom'),
        'date_to' => $i->post('dateTo'),
        'bid_amount' => $i->post('bidAmount'),
        'clickthrough_url' => $i->post('clickthroughUrl')
      );
      $this->db->where('id', $id);
      $this->db->update('ads', $a);
    }
    public final function delete($id)
    {
      $this->db->where('id', $id);
      $this->db->delete('ads');
      return $this->db->affected_rows() > 0;
    }
    public final function show($keywords)
    {
      $s = "SELECT * FROM " . 
      "ads MATCH($keywords) " . 
      "AGAINST(name, description, tags) " . 
      "ORDER by bid_amount DESC " . 
      "LIMIT 1";
      return $this->db->query($s);
    }
  }