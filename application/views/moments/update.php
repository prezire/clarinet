<div id="moments">
  <div class="update">
    <h6>Update a Moment</h6>
    <?php
      echo validation_errors();
      echo form_open_multipart('moment/update');
      //
      $m = $moment->row();
      $ico = base_url('public/images/uploads/moments/icons') . '/' . $m->icon_path;
      $name = set_value('name', $m->name);
      $descr = set_value('description', $m->description);
      $vert = set_value('vertical', $m->vertical);
      $appKey = set_value('appKey', $m->app_key);
      //senders.
      //
      //limitations.
      $bEnableLimMaxPingRad = set_value
      (
        'enableLimitedMaxPingRadius', 
        $m->enable_limited_max_ping_radius
      );
      $limMaxPingRad = set_value
      (
        'limitMaxPingRadius', 
        $m->limit_max_ping_radius
      );
      //
      $bEnableLimMaxPongRad = set_value
      (
        'enableLimitedMaxPongRadius', 
        $m->enable_limited_max_pong_radius
      );
      $limMaxPongRad = set_value
      (
        'limitMaxPongRadius', 
        $m->limit_max_pong_radius
      );
      //
      $bEnableLimMaxPingRspndrs = set_value
      (
        'enableLimitedMaxPingResponders', 
        $m->enable_limited_max_ping_responders
      );
      $limMaxRspndrs = set_value
      (
        'limitMaxPingResponders', 
        $m->limit_max_ping_responders
      );
      //ping.
      $bPingAllowSndOptMsgToRspndr = set_value
      (
        'pingAllowSendOptionalMessageToResponder', 
        $m->ping_allow_send_optional_message_to_responder
      );
      $bPingEnableUseOptMsgAsSrchKwd = set_value
      (
        'pingEnableUseOptionalMessageAsSearchKeyword', 
        $m->ping_enable_use_optional_message_as_search_keyword
      );
      //pong.
      $bPongEnableAutoSndRspndrDescr = set_value
      (
        'pongEnableAutoSendResponderDescription', 
        $m->pong_enable_auto_send_responder_description
      );
      $bPongEnableSendNotifMsgToSndr = set_value
      (
        'pongEnableSendNotificationMessageToSender', 
        $m->pong_enable_send_notification_message_to_sender
      );
      $pongNotifMsgTtl = set_value
      (
        'pongNotificationMessageTitle', 
        $m->pong_notification_message_title
      );
      $pongNotifMsg = set_value
      (
        'pongNotificationMessage', 
        $m->pong_notification_message
      );
      //after service.
      $bAftrServEnableSndPrmptMsgToSndr = set_value
      (
        'afterServiceEnableSendPromptMessageToSender', 
        $m->after_service_enable_send_prompt_message_to_sender
      );
      $afterServPrmptMsgTtl = set_value
      (
        'afterServicePromptMessageTitle', 
        $m->after_service_prompt_message_title
      );
      $afterServPrmptMsg = set_value
      (
        'afterServicePromptMessage', 
        $m->after_service_prompt_message
      );
    ?>
      <div>
        
        <div class="large-12 medium-12 small-12 columns">
          <div>
            Icon <img src="<?php echo $ico; ?>" />
            <input type="file" name="icon" />
          </div>
          <div>
            <label>Name</label>
            <input type="text" 
                    name="name" 
                    class="txtName"
                    value="<?php echo $name; ?>" />
          </div>
          <div>
            <label>Description</label>
            <textarea name="description" 
                      class="taDescr"><?php echo $descr; ?></textarea>
          </div>
          <div>
            <label>Vertical</label>
              <?php
                echo form_dropdown('vertical', getVerticals());
              ?>
          </div>
        </div>
        
        <div class="private">
          <label for="cbPrivate">
            <input type="checkbox" 
                  class="cbPrivate" 
                  name="private" 
                  id="cbPrivate" />
              Private
            </label>
          
          <div>
            <div>
              <label>App Key</label>
              <input type="hidden" 
                      name="appKey" 
                      class="appKey" />
              <span class="txtAppKey"></span>
            </div>
            
            <div class="sndrs row">
              <h6>Senders</h6>
              <!-- TODO: Integrate search with select2. -->
              <div class="large-11 medium-11 small-9 columns">
                <input type="text" 
                        class="txtSndrs"
                        placeholder="Search users by email" />
              </div>
            </div>
            
          </div>
        </div>
        
      </div>
      
      <div class="limitations">
        <h6>Limitations</h6>
        <div>
          <label for="cbLimitPingRad">
            <input type="checkbox" 
                    name="enableLimitedMaxPingRadius" 
                    id="cbLimitPingRad" />
            Limit ping radius to
          </label>
          <input type="text" 
                  value="5" 
                  name="limitMaxPingRadius"
                  class="txtLimitPingRad" /> KM
        </div>
        
        <div>
          <label for="cbLimitPongRad">
            <input type="checkbox" 
                    name="enableLimitedMaxPongRadius" 
                    id="cbLimitPongRad" />
            Limit pong radius to
          </label>
          <input type="text" 
                  value="5" 
                  name="limitMaxPongRadius"
                  class="txtLimitPongRad" /> KM
        </div>
        
        <div>
          <label for="cbLimitMaxRspndrs">
            <input type="checkbox" 
                  name="enableLimitedMaxPingResponders" 
                  id="cbLimitMaxRspndrs" />
            Limit maximum responders to
          </label>
          <input type="text" 
                  value="3" 
                  name="limitMaxPingResponders"
                  class="txtLimitMaxRspndrs" />
        </div>
      </div>
      
      <div>
        <div>
          <h6>During a ping</h6>
          <div>
            <label for="cbAllowSndOptMsgToResp">
              <input type="checkbox" 
                    name="pingAllowSendOptionalMessageToResponder" 
                    id="cbAllowSndOptMsgToResp" />
              Allow the sender to send 
              optional message to responder
            </label>
          </div>
          <div>
            <label for="cbUseAsSearchKwd">
              <input type="checkbox" 
                    name="pingEnableUseOptionalMessageAsSearchKeyword" 
                    id="cbUseAsSearchKwd" />
              Use optional sent message as search keyword
            </label>
          </div>            
        </div>
      </div>
      
      <div>
        <h6>During a pong</h6>
        <div>
          <label for="cbSndRespDescr">
            <input type="checkbox" 
                  name="pongEnableAutoSendResponderDescription" 
                  id="cbSndRespDescr" />
            For security, automatically send 
            responder's description to ping sender
          </label>
        </div>
        
        <div>
          <label for="cbSndNotifMsgToSndr">
            <input type="checkbox" 
                    name="pongEnableSendNotificationMessageToSender" 
                    id="cbSndNotifMsgToSndr" />
            Send a notification message to ping sender
          </label>
        </div>
        <div>
          <div>
            <label>Title:</label>
            <input type="text" 
                    name="pongNotificationMessageTitle"
                    class="txtNotifMsgTitle" />
          </div>
          <div>
            <label>Message:</label>
            <textarea name="notificationMessage" 
                      class="taNotifMsgTitle"></textarea>
          </div>
        </div>
      </div>
      
      <div>
        <h6>After service has been rendered</h6>
        <div>
          <label for="cbSndPromptToSndr">
            <input type="checkbox" 
                  name="afterServiceEnableSendPromptMessageToSender" 
                  id="cbSndPromptToSndr" />
            Send a prompt message to sender
          </label>
        </div>
        <div>
          <div>
            <label>Title:</label>
            <input type="text" 
                    name="promptMessageTitle" 
                    class="txtPromptMsgTitle" />
          </div>
          <div>
            <label>Message:</label>
            <textarea name="afterServicePromptMessage" 
                      class="taPromptMsg"></textarea>
          </div>
        </div>
      </div>
        
      </div>
      <div class="row">
        <div class="large-1 medium-1 small-12 columns">
          <button>Go</button>
          <a class="button small" 
              href="<?php echo site_url('moment/read/' . $m->id); ?>">
            Back
          </a>
        </div>
      </div>
    </form>
    </div>
    <script>
      var a = new Moment();
      a.setUserId("<?php echo $this->session->userdata('user')->id; ?>");
    </script>
</div>