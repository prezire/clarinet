<?php 
  if(!defined('BASEPATH')) exit('No direct script access allowed');
  class Moment extends CI_Controller 
  {
    public function __construct()
    {
      parent::__construct();
      //validateSession();
      $this->load->model('moment_model');
    }
    public final function test(){$this->load->view('moments/test');}
    /*
      Allow user to be a responder and 
      provide services per vertical.
      If the user doesn't want to be a
      responder, delete its state in the record.
      
      curl http://localhost/clarinet/index.php/moment/setUserState/1/1/Sender
    */
    public final function setUserState
    (
      $userId,
      $momentId,
      $state
    )
    {
      $b = $this->moment_model->setUserState
      (
        $userId,
        $momentId,
        $state
      )->row();
      showJsonView(array('details' => $b));
    }
    //curl http://localhost/clarinet/index.php/moment/readByFilter/1/Featured
    public final function readByFilter($userId, $filterName)
    {
      $m = $this->moment_model->readByFilter
      (
        $userId, 
        $filterName
      );
      echo $this->parser->parse
      (
        'commons/partials/moments.php', 
        array('moments' => $m->result()), 
        true
      );
    }
    public final function index()
    {
      showView
      (
        'moments/index', 
        array
        (
          'filters' => array
          (
            'All' => 'All',
            'Featured' => 'Featured',
            'Mostly used' => 'Mostly used',
            'For emergencies' => 'For emergencies',
            'I am the responder' => 'I am the responder'
          ),
          'moments' => $this->moment_model->index()
        )
      );
    }
    //curl 'http://localhost/clarinet/index.php/moment/generateAppKey'
    public final function generateAppKey()
    {
      echo $this->moment_model->generateAppKey();
    }
    /*
      Public ping/pong. Doesn't need integration. 
      Everyone registered in the app can use this feature.
    
      curl http://localhost/clarinet/index.php/moment/ping/5/1.3161467/103.8564607
    
      @param    $message  Optional. A message that 
      the sender can include on the broadcast.
      It could be a description of himself, note or a 
      path to his avatar to give the responder a clear 
      idea about the sender.
      @param    $latLng   Separated by space.
      @param    $requestResponder   Boolean. Indicates that 
      responders who provide services will be notified 
      with this ping. Responders will then be able to accept 
      or decline the ping request.
    */
    public final function ping
    (
      $id, 
      $latitude,
      $longitude,
      $requestResponder = false,
      $privateMessage = null
    )
    {
      showJsonView
      (
        array
        (
          'ping' => 
          $this->moment_model->ping
          (
            $id, 
            $latitude,
            $longitude,
            $requestResponder,
            $privateMessage
          )->row()
        )
      );
    }
    /*
      curl 'http://localhost/clarinet/index.php/moment/pong/3'
      @params   $latitude and $longitude    Determines if the 
      responder is close enough from the sender's location.
    */
    public final function pong($id, $latitude, $longitude)
    {
      showJsonView
      (
        array
        (
          'pong' => 
          $this->moment_model->pong
          (
            $id, 
            $latitude, 
            $longitude
          )->row()
        )
      );
    }
    public final function respond($id)
    {
      
    }
    /*
      Private ping / pong. Integration is optional.
      curl 'http://localhost/clarinet/index.php/moment/integration/ping/059727320a2a3c8293edf186bf112e5b/null/null/%7Bmessage:msg1%7D'
      curl 'http://localhost/clarinet/index.php/moment/integration/pong/059727320a2a3c8293edf186bf112e5b/1.2%203.4/1'
      
      TODO: SQL and XSS security for privateMessage param.
    */
    /*
    * @param  $broadcastType    Either ping or pong.
    * @param  $privateMessage   Any text messsage. Must be URL-encoded 
    * @param  $latLng           The origin of the broadcast.
    * @param  $responderId      Used only during pong. Unique ID of the responder.
    * when passing special chars.
    */
    public final function integration
    (
      $broadcastType, 
      $appKey, 
      $latLng,
      $responderId = null, 
      $privateMessage = null
    )
    {
      switch($broadcastType)
      {
        case 'ping':
          $this->moment_model->createPrivatePing
          (
            $appKey, 
            $latLng, 
            $privateMessage
          );
        break;
        case 'pong':
          echo urldecode
          (
            $this->moment_model->readPrivatePing
            (
              $appKey, 
              $responderId, 
              $latLng
            )->row()->private_message
          );
        break;
      }
    }
    //curl --data 'private=1&name=moment1&description=descr1&verticalId=1' 'http://localhost/clarinet/index.php/moment/create'
    public final function create()
    {
      if($this->input->post())
      {
        if($this->getIsValidForm())
        {
          $m = $this->moment_model->create();
          if($m->id > 0)
          {
            redirect(site_url('moment/read' . $id));
          }
          else
          {
            show_error('Error creating a Moment.');
          }
        }
        else
        {
          showView('moments/create');
        }
      }
      else
      {
        showView('moments/create');
      }
    }
    //curl 'http://localhost/clarinet/index.php/moment/read/1'
    public final function read($id)
    {
      showView
      (
        'moments/read', 
        array
        (
          'moment' => 
          $this->moment_model->read($id)->row()
        )
      );
    }
    public final function search($keywords)
    {
      return $this->moment_model->search($keywords);
    }
    public final function readByVertical($vertical)
    {
      showView
      (
        $this, 
        'moments/read_by_vertical', 
        array
        (
          'moment' => 
          $this->moment_model->readByVertical($vertical)
        )
      );
    }
    //A simple subscription from the home page.
    //Sends a newsletter to users for upcoming Moments.
    public final function subscribe()
    {
      if($this->input->post())
      {
        $this->moment_model->subscribe();
      }
      else
      {
        showView('moments/subscribe');
      }
    }
    public final function update($id = null)
    {
      if($this->input->post())
      {
        $b = $this->getIsValidForm();
        if($b)
        {
          $m = $this->moment_model->update();
          if($m)
          {
            redirect(site_url('moment/read' . $m->id));
          }
          else
          {
            show_error('Error updating Moment.');
          }
        }
      }
      else
      {
        showView
        (
          'moments/update', 
          array
          (
            'moment' => 
            $this->moment_model->read($id)
          )
        );
      }
    }
    public final function delete($id)
    {
      showJsonview
      (
        $this, 
        array
        (
          'success' => 
          $this->moment_model->delete($id)
        )
      );
    }
    private final function getIsValidForm()
    {
      return true;
    }
    //curl 'http://localhost/clarinet/index.php/moment/getRespondersWithinRadius/1/1/10/medical'
    public final function getRespondersWithinRadius
    (
      $longitude, 
      $latitude, 
      $radius, 
      $keywords
    )
    {
      $r = $this->moment_model->getRespondersWithinRadius
      (
        $longitude, 
        $latitude, 
        $radius, 
        $keywords
      );
    }
  }