<?php 
  if(!defined('BASEPATH')) exit('No direct script access allowed');
  class Report extends CI_Controller 
  {
    public function __construct()
    {
      parent::__construct();
      $this->load->model('report_model');
    }
    public final function index()
    {
      showView
      (
        $this, 
        'reports', 
        array
        (
          'verticals' => 
          $this->report_model->getVerticals()
        )
      );
    }
    public final function create
    (
      $radiusId, 
      $metricType, 
      $country,
      $networkCarrier
    )
    {
      $this->report_model->create
      (
        $radiusId, 
        $metricType, 
        $country,
        $networkCarrier
      );
    }
    public final function download()
    {
      $this->load->dbutil();
      $query = $this->report_model->download();
      echo $this->dbutil->csv_from_result($query);
    }
    //curl 'http://localhost/clarinet/index.php/report/generate/Adult/Frequency/Yearly/2014-01-27%2009:57/2014-01-29%2009:57'
    //curl 'http://localhost/clarinet/index.php/report/generate/Adult/Frequency/Yearly/2014%2F01%2F28%2021%3A38/2014%2F01%2F30%2021%3A38'
    public final function generate
    (
      $verticals, 
      $type,
      $dateType,
      $dateFrom, 
      $dateTo
    )
    {
      $m = $this->report_model;
      $m->type = $type;
      $m->verticals = $verticals; 
      $m->dateType = $dateType;
      $m->dateFrom = $dateFrom;
      $m->dateTo = $dateTo;
      //print_r($m); exit;
      $charts = $this->report_model->read($m);
      showJsonView($this, $charts);
    }
    private final function setFormValidation(){}
  }