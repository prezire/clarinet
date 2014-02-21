<?php
  class Report_Model extends CI_Model
  {
    public $type;
    public $verticals;
    public $dateType;
    public $dateFrom;
    public $dateTo;
    public function __construct()
    {
      parent::__construct();
    }
    public final function create
    (
      $radiusId,
      $metricType, 
      $country,
      $networkCarrier
    )
    {
      $this->load->library('user_agent');
      $i = $this->input;
      $a = array
      (
        'radius_id' => $radiusId,
        'metric_type' => $metricType, 
        'country' => $country,
        'network_carrier' => $networkCarrier,
        'is_mobile' => $this->agent->is_mobile(),
        'platform' => $this->agent->platform(),
        'browser_type' => $i->user_agent()
      );
      $this->db->insert('reports', $a);
      return $this->db->insert_id();
    }
    public final function read($model)
    {
      $m = $model;
      $radiusId = 17; //$this->session->userdata('user')->radius_id;
      $type = $m->type;
      $dateType = $model->dateType;
      //
      $sRepType = 'rep.frequency, ';
      switch($type)
      {
        case 'Frequency By Location':
          $sRepType .= 'rep.location, ';
        break;
        case 'Frequency By Network Carrier':
          $sRepType .= 'rep.network, ';
        break;
      }
      //
      switch($dateType)
      {
        case 'Yearly':
          $this->db->select
          (
            'count(rep.id) as y, MONTHNAME(rep.timestamp) label', 
            false
          );
        break;
        case 'Monthly':
          $this->db->select
          (
            'count(rep.id) as y, DAY(rep.timestamp) label', 
            false
          );
        break;
        case 'Hourly':
          $this->db->select
          (
            'count(rep.id) as y, HOUR(rep.timestamp) label', 
            false
          );
        break;
      }
      $searches = $this->getResult($m);
      $expansions = $this->getResult($m, 'Expansion');
      return $this->toChartDataPts
      (
        $m->type, 
        $searches, 
        $expansions
      );
    }
    private final function getResult
    (
      $model, 
      $metricType = 'Search'
    )
    {
      $this->db->from('reports rep');
      $this->db->join('radius rad', 'rep.radius_id = rad.id');
      $this->db->where_in('rad.verticals', $model->verticals);
      $this->db->where('rep.radius_id', 17);//$this->session->userdata('user')->radius_id
      $this->db->where('rep.metric_type', $metricType);
      $this->db->where('rep.timestamp >=', $model->dateFrom);
      $this->db->where('rep.timestamp <=', $model->dateTo);
      $r = $this->db->get()->result();
      //echo $this->db->last_query(); exit;
      return $r;
    }
    private final function toChartDataPts
    (
      $type, 
      $searches, 
      $expansions
    )
    {
      $a = array
      (
        'title' => array('text' => $type),
        'data' => array
        (
          array
          (
            'type' => 'spline',
            'name' => 'Searches',
            'showInLegend' => true,
            'dataPoints' => $searches
          ),
          array
          (
            'type' => 'spline',
            'name' => 'Conversions',
            'showInLegend' => true,
            'dataPoints' => $expansions
          )
        )
      );
      return $a;
    }
    public final function getVerticals()
    {
      return $this->db->get('verticals');
    }
    public final function download()
    {
      return $this->db->get('reports');
    }
  }