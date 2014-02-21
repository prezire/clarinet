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
    public final function test()
    {
      $this->load->view('moments/test');
    }
    public final function index()
    {
      showView
      (
        'moments/index', 
        array
        (
          //TODO: Include verticals in the filter.
          'sort' => array
          (
            'All',
            'Featured',
            'Mostly Used',
            'Emergency'
          ),
          'moments' => $this->moment_model->index()
        )
      );
    }
    public final function generateAppKey($name, $password)
    {
      return $this->moment_model->generateAppKey($name, $password);
    }
    //Public ping/pong. Doesn't need integration. Everyone 
    //registered in the app can use this feature.
    /*
      curl 'http://localhost/clarinet/index.php/moment/ping/44'
    
      @param    $message            Optional. A message that 
      the sender can include on the broadcast. It could be a description of himself, note or a path to his avatar 
      to give the responder a clear idea about the sender.
      @param    $latLng             Separated by space.
      @param    $requestResponder   Boolean. Indicates that 
      responders who provide services will be notified 
      with this ping. Responders will then be able to accept 
      or decline the ping request.
    */
    public final function ping
    (
      $id, 
      $latLng = null,
      $requestResponder = null,
      $message = null
    )
    {
      showJsonView
      (
        array
        (
          'ping' => 
          $this->moment_model->ping($verticalId)->row()
        )
      );
    }
    //curl 'http://localhost/clarinet/index.php/moment/pong/3'
    public final function pong($id, $latLng)
    {
      showJsonView
      (
        array
        (
          'pong' => 
          $this->moment_model->pong($id, $latLng)->row()
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
      
      TODO: SQL and XSS security for message param.
    */
    /*
    * @param  $broadcastType  Either ping or pong.
    * @param  $message        Any text messsage. Must be URL-encoded 
    * @param  $latLng         The origin of the broadcast.
    * @param  $responderId    Used only during pong. Unique ID of the responder.
    * when passing special chars.
    */
    public final function integration
    (
      $broadcastType, 
      $appKey, 
      $latLng,
      $responderId = null, 
      $message = null
    )
    {
      switch($broadcastType)
      {
        case 'ping':
          $this->moment_model->createPrivatePing
          (
            $appKey, 
            $latLng, 
            $message
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
            )->row()->message
          );
        break;
      }
    }
    //curl --data 'private=1&name=moment1&description=descr1&verticalId=1' 'http://localhost/clarinet/index.php/moment/create'
    public final function create()
    {
      if($this->input->post())
      {
        $b = $this->getIsValidForm();
        if($b)
        {
          $id = $this->moment_model->create();
          if($id)
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
    public final function read($id)
    {
      showView
      (
        $this, 
        'moments/read', 
        array
        (
          'moment' => 
          $this->moment_model->read($id)
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
    //curl --data 'user_id=1&vertical_id=1' 'http://localhost/clarinet/index.php/moment/subscribeAsResponder'
    /*
    * A user that listens and responds using pongs to provide services for ping senders.
    */
    public final function subscribeAsResponder()
    {
      if($this->input->post())
      {
        //@param  $userId   Post.
        $this->moment_model->subscribeAsResponder();
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
        echo $this->load->view
        (
          'moments/update', 
          array
          (
            'moment' => 
            $this->moment_model->read($id)
          ), 
          true
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
  }