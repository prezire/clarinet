<div id="moments">
  <div class="read">
    <h6>Moment Details</h6>
      <?php 
        $m = $moment;
        $sIco = $m->icon_path;
        $sName = $m->name;
        $sDescr = $m->description;
        $sVert = $m->vertical;
        $bPriv = $m->private;
        $sAppKey = $m->app_key;
        $bLimMaxPingRad = $m->enable_limited_max_ping_radius;
        $bLimMaxPongRad = $m->enable_limited_max_pong_radius;
        $sLimMaxPongRad = $m->limit_max_pong_radius;
        $bLimMaxPingRspndrs = $m->enable_limited_max_ping_responders;
        $sLimMaxPingRspndrs = $m->limit_max_ping_responders;
        $sPingAllowSndOptMsgToRspndr = $m->ping_allow_send_optional_message_to_responder;
        $bPingUseOptMsgAsSrchKwd = $m->ping_enable_use_optional_message_as_search_keyword;
        $bPongAutoSndRspndrDescr = $m->pong_enable_auto_send_responder_description;
        $bPongSndNotifMsgToSndr = $m->pong_enable_send_notification_message_to_sender;
        $sPongNotifMsgTtl = $m->pong_notification_message_title;
        $sPongNotifMsg = $m->pong_notification_message;
        $bAftSvcSndPmtMsgToSndr = $m->after_service_enable_send_prompt_message_to_sender;
        $sAftSvcPmtMsgTtl = $m->after_service_prompt_message_title;
        $sAftSvcPmtMsg = $m->after_service_prompt_message;
      ?>
      <div>
        
        <div class="large-12 medium-12 small-12 columns">
          <div>
            Icon <img src="<?php echo $sIco; ?>" />
          </div>
          <div>
            Name <?php echo $sName; ?>
          </div>
          <div>
            Description <?php echo $sDescr; ?>
          </div>
          <div>
            Vertical <?php echo $sVert; ?>
          </div>
        </div>
        
        <div class="private">
          <div>
            <?php echo form_checkbox('', '', $bPriv); ?>
            Private
          </div>
          <div>
          <div>
            App Key <?php echo $sAppKey; ?>
          </div>
          <div class="sndrs row">
            <h6>Senders</h6>
            <!-- TODO: Integrate search with select2. -->
            <div class="large-11 medium-11 small-9 columns">
            </div>
          </div>
          </div>
        </div>
        
      </div>
      
      <div class="limitations">
        <h6>Limitations</h6>
        <div>
          <?php echo form_checkbox('', '', $bLimMaxPingRad); ?>
          Limit ping radius to
          <?php echo $m->limit_max_ping_radius; ?> KM
        </div>
        
        <div>
          <?php echo form_checkbox('', '', $bLimMaxPongRad); ?>
          Limit pong radius to
          <?php echo $sLimMaxPongRad; ?> KM
        </div>
        
        <div>
          <?php echo form_checkbox('', '', $bLimMaxPingRspndrs); ?>
          Limit maximum ping responders to
          <?php echo $sLimMaxPingRspndrs; ?>
        </div>
      </div>
      
      <div>
        <div>
          <h6>During a ping</h6>
          <div>
            <?php echo form_checkbox('', '', $sPingAllowSndOptMsgToRspndr); ?>
            Allow the sender to send 
            optional message to responder
          </div>
          <div>
            <?php echo form_checkbox('', '', $bPingUseOptMsgAsSrchKwd); ?>
            Use optional sent message as search keyword
          </div>            
        </div>
      </div>
      
      <div>
        <h6>During a pong</h6>
        <div>
          <?php echo form_checkbox('', '', $bPongAutoSndRspndrDescr); ?>
          For security, automatically send 
          responder's description to ping sender
        </div>
        
        <div>
          <?php echo form_checkbox('', '', $bPongSndNotifMsgToSndr); ?>
          Send a notification message to ping sender
        </div>
        <div>
          <div>
            Title <?php echo $sPongNotifMsgTtl; ?>
          </div>
          <div>
            Message <?php echo $sPongNotifMsg; ?>
          </div>
        </div>
      </div>
      
      <div>
        <h6>After service has been rendered</h6>
        <div>
          <?php echo form_checkbox('', '', $bAftSvcSndPmtMsgToSndr); ?>
          Send a prompt message to sender
        </div>
        <div>
          <div>
            Title <?php echo $sAftSvcPmtMsgTtl; ?>
          </div>
          <div>
            Message <?php echo $sAftSvcPmtMsg; ?>
          </div>
        </div>
      </div>
        
      </div>
      <div class="row">
        <div class="large-12 medium-12 small-12 columns">
          <a class="button small" href="<?php echo site_url('moment'); ?>">Back</a>
          <a class="button small" href="<?php echo site_url('moment/update/' . $m->id); ?>">Edit</a>
        </div>
      </div>
    </form>
    </div>
    <script>
      var a = new Moment();
      a.setUserId("<?php echo $this->session->userdata('user')->id; ?>");
    </script>
</div>