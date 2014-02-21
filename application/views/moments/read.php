<div id="moment read">
  <h4>Moment</h4>
    <div class="row">
      <div class="large-6 medium-6 small-12 columns">
        <div>
          Name:
          <?php 
            $m = $moment;
            echo $m->name;
          ?>
        </div>
        <div>
          Description: <?php echo $m->description; ?>
        </div>
        <div>
          Vertical: <?php echo $m->vertical; ?>
        </div>
      </div>
      
      <div class="accessibility">
        <label for="cbAccessibility">
          <input type="checkbox" 
                  class="cbAccessibility" 
                  name="accessibility" 
                  id="cbAccessibility" />
          Private
        </label>
        <div class="accessibilityOpts">
          <div>
            App Key: <?php echo $m->appKey; ?>
          </div>
          
          <div>
            <h4>Responders</h4>
            <div class="responders">
              <?php foreach($m->responders as $r){ ?>
              <div class="responder">
                <?php echo $r->name; ?>
              </div>
              <?php } ?>
            </div>
          </div>
          
          <div class="urls">
            <h4>Sample URLs</h4>
            <div>
              Domain:
              <?php echo site_url('moment/integration'); ?>
            </div>
            <div>
              Ping:
              <input type="text" 
                      editable="false" 
                      class="samplePing" />
            </div>
            <div>
              Pong:
              <input type="text" 
                      editable="false" 
                      class="samplePong" />
            </div>
          </div>
          
          <div>
            <h4>Limitations</h4>
            <div>
              <label for="cbLimitPingRad">
                <input type="checkbox" 
                      name="hasLimitedPingRadius" 
                      id="cbHasLimitedPingRad" />
                Limit ping radius to
                <?php echo $m->limit_ping_radius; ?> KM
            </div>
            
            <div>
              <label for="cbLimitPongRad">
                <input type="checkbox" 
                      name="hasLimitedPongRadius" 
                      id="cbLimitPongRad" />
                Limit pong radius to
                <?php echo $m->limit_pong_radius; ?> KM
            </div>
            
            <div>
              <label for="cbLimitMaxResponders">
                <input type="checkbox" 
                      name="limitMaxResponders" 
                      id="cbLimitMaxResponders" />
                Limit maximum responders to
                <?php echo $m->limit_max_responders; ?>
            </div>
          </div>
          
        </div>
      </div>
      
      <div class="large-6 medium-6 small-12 columns">
        <div>
          <h4>During a ping</h4>
          <div>
            <label for="cbAllowOptMsgToResponder">
              <input type="checkbox" 
                    name="allowOptionalMessageToResponder" 
                    id="cbAllowOptMsgToResponder" />
              Allow the sender to send 
              optional message to responder
          </div>
          
          <h4>During a pong</h4>
          <div>
            
            <div>
              <input type="checkbox" 
                      name="sendResponderDescription" 
                      id="cbSndResponderDescr" />
              <label for="cbSndResponderDescr">
                For security, automatically send 
                responder's description to ping sender
            </div>
            
            <div>
              <label for="cbSndNotifMsgToSndr">
                <input type="checkbox" 
                        name="sendNotifyMessageToSender" 
                        id="cbSndNotifMsgToSndr" />
                Send a notification message to ping sender
            </div>
            <div>
              <div>
                Title:
                <?php echo $m->notify_message_title; ?>
              </div>
              <div>
                Message:
                <?php echo $m->notify_message; ?>
              </div>
            </div>
          </div>
          
          <h4>After service has been rendered</h4>
          <div>
            <div>
              <label for="cbSndPromptToSndr">
                <input type="checkbox" 
                      name="sendPromptToSender" 
                      id="cbSndPromptToSndr" />
                Send a prompt message to sender
            </div>
            <div>
              <div>
                Title:
                <?php echo $m->prompt_message_title; ?>
              </div>
              <div>
                Message:
                <?php echo $m->prompt_message; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
    </div>
    <div class="row">
      <div class="large-1 medium-1 small-12 columns">
        <a href="<?php echo site_url('moment'); ?>">Back</a>
        <a href="<?php echo site_url('moment/update'); ?>">Edit</a>
      </div>
    </div>
</div>