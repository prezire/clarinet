<?php 
  if(!defined('BASEPATH')) exit('No direct script access allowed');
  class Api extends CI_Controller 
  {
    public function __construct()
    {
      parent::__construct();
    }
    public final function getToken($vertical)
    {
      return md5(random() . date() . $vertical);
    }
    /*
      Sends a broadcast to all listening subscribers from certain
      verticals and awaits for their pong(). Once a pong is 
      received, the app will now wait for the confirm() 
      status of the pong responder. 
      
      Note: If there's too many pings without pongs, it's 
      another set of data for the Report that indicates 
      good business in the area that are not being addressed 
      properly.
      
      @param  $token    See getToken().
      @param  $sender   Contains $completeName, 
      $coordinates, description.
      @return A json containing boolean whether or not a ping
      was successfully saved in the DB.
    */
    public final function ping($token, $sender, $vertical)
    {
      //Save the ping for record purposes.
      $b = $this->api_model->createPing($token, $sender, $vertical);
      if($b)
      {
        /*
          Fetch at least 5 of the closest app_ping_subscribers 
          based on latlng relative to the sender's coordinates. 
          When the model returns the subscribers, the app will 
          now wait for 1 confirm() status using AJAX. Once the 
          sender gets the confirm() status from the responder 
          or app_ping_subscriber using the matched token, the 
          app will render both coordinates on the map with the 
          shortest path using JS.
        */
        $s = $this->api_model->getPingSubscribers($token)->result();
        $a = array('success' => $b, 'responders' => $s)
        showJsonView($this, $a);
      }
      else
      {
        showJsonView($this, array('success' => false));
      }
    }
    /*
      Used by AJAX to search for records of any pings related 
      to the subscriber's vertical.
      
      @param  $subscriber
    */
    public final function readPings($subscriber)
    {
      $this->api_model->readPings($subscriber);
    }
    /*
      A human-intervened answer to the ping(), based on the
      automated answer from the pong().
      
      KLUDGE: What if the responder confirms and the 
      sender has cancelled the request without informing 
      the responder? Can the responder track his IP and 
      flag him as unreliable sender?
      
      Or, what if the responder has responded but doesn't
      go to the sender? Can the sender flag him as 
      unreliable responder?
      
      @param  $confirmed  A boolean indicating that the 
      responder has accepted the request or not.
    */
    public final function confirm
    (
      $pingToken, 
      $responder, 
      $confirmed = true
    )
    {
      $this->api_model->confirm($pingToken, $responder, $confirmed);
    }
    /*
      Verifies if the service has ended. This is performed 
      by the responder.
      
      The system sends a notification the sender so he 
      can verify if the service has ended well or not.
      
      @param  $token
      @param  $hasEnded   
    */
    public final function serviceEnded($token, $hasEnded = true)
    {
      //
    }
  }