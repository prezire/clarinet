<div id="moment update">
  <h4>Update a new moment</h4>
  <?php
    echo validation_errors();
    echo form_open(site_url('moment/update'));
    $m = $moment;
  ?>
    <div class="row">
      
      <div class="large-6 medium-6 small-12 columns">
        <div>
          <label>Name:</label>
          <input type="text" 
                  name="name" 
                  class="txtName"
                  value="<?php 
                    echo set_value
                    (
                      'name', 
                      $m->name
                    ); ?>" />
        </div>
        <div>
          <label>Description:</label>
          <textarea name="description" 
                    class="taDescr"><?php 
                      echo set_value
                      (
                        'description', 
                        $m->description
                      ); 
                    ?></textarea>
        </div>
        <div>
          <label>Vertical:</label>
            <?php
              $verticals = getVerticals()->result_array();
              echo form_dropdown
              (
                'vertical', 
                $verticals, 
                set_value('vertical', $m->vertical)
              );
            ?>
        </div>
      </div>
      
      <div class="accessibility">
        <input type="checkbox" 
                class="cbAccessibility" 
                name="accessibility" 
                id="cbAccessibility" />
        <label for="cbAccessibility">
          <?php
            echo form_checkbox
            (
              array
              (
                'name' => 'accessibility',
                'id' => 'cbAccessibility',
                'class' => 'cbAccessibility',
                'value' => set_value('accessibility)',
                'checked' => $m->private
              );
            );
          ?>
          Private
        </label>
        
        <div class="accessibilityOpts">
          <div>
            App Key:
            <input type="text" 
                    name="appKey" 
                    class="txtAppKey"
                    value="<?php 
                      echo set_value
                      (
                        'appKey', 
                        $m->app_key
                      ); ?>" />
          </div>
          
          <div>
            <h4>Responders</h4>
            <div class="responders">
              <div class="responder">
                <input type="text" 
                        name="responders[]" 
                        class="txtResponder" />
                <div>
                  <a class="btnRemResp">-</a>
                  <a class="btnAddResp">+</a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="urls">
            <h4>Sample URLs</h4>
            <div>
              <label>Domain:</label>
              <input type="text" 
                      editable="false" 
                      class="domain"
                      value="<?php 
                        echo site_url('moment/integration'); 
                      ?>" />
            </div>
            <div>
              <label>Ping:</label>
              <input type="text" 
                      editable="false" 
                      class="samplePing" />
            </div>
            <div>
              <label>Pong:</label>
              <input type="text" 
                      editable="false" 
                      class="samplePong" />
            </div>
          </div>
          
          <div>
            <h4>Limitations</h4>
            <div>
              <label for="cbLimitPingRad">
                <?php
                  echo form_checkbox
                  (
                    array
                    (
                      'name' => 'hasLimitedPingRadius',
                      'id' => 'cbHasLimitedPingRad',
                      'class' => 'cbHasLimitedPingRad',
                      'value' => set_value('hasLimitedPingRadius)',
                      'checked' => $m->has_limited_ping_radius
                    );
                  );
                ?>
                Limit ping radius to
              </label>
              <input type="text" 
                      name="limitPingRadius"
                      class="txtLimPingRad"
                      value="<?php 
                        echo set_value
                        (
                          'limitPingRadius', 
                          $m->limit_ping_radius
                        ); ?>" /> KM
            </div>
            
            <div>
              <label for="cbLimitPongRad">
                <?php
                  echo form_checkbox
                  (
                    array
                    (
                      'name' => 'hasLimitedPongRadius',
                      'id' => 'cbLimitPongRad',
                      'class' => 'cbLimitPongRad',
                      'value' => set_value('hasLimitedPongRadius)',
                      'checked' => $m->has_limited_pong_radius
                    );
                  );
                ?>
                Limit pong radius to
              </label>
              <input type="text" 
                      name="limitPongRadius"
                      class="txtLimPongRad" 
                      value="<?php 
                        echo set_value
                        (
                          'limitPongRadius', 
                          $m->limit_pong_radius
                        ); ?>" /> KM
            </div>
            
            <div>
              <input type="checkbox" 
                      name="limMaxResponders" 
                      id="cbLimitMaxResponders" />
              <label for="cbLimitMaxResponders">
                <?php
                  echo form_checkbox
                  (
                    array
                    (
                      'name' => 'hasLimitedMaxResponders',
                      'id' => 'cbHasLimitedMaxResponders',
                      'class' => 'cbHasLimitedMaxResponders',
                      'value' => set_value('hasLimitedMaxResponders)',
                      'checked' => $m->has_limited_max_responders
                    );
                  );
                ?>
                Limit maximum responders to
              </label>
              <input type="text" 
                      name="limitMaxResponders"
                      value="<?php 
                        echo set_value
                        (
                          'limitMaxResponders', 
                          $m->limit_max_responders
                        ); ?>" 
                      class="txtLimMaxResponders" />
            </div>
          </div>
          
        </div>
      </div>
      
      <div class="large-6 medium-6 small-12 columns">
        <div>
          <h4>During a ping</h4>
          <div>
            <label for="cbAllowOptMsgToResponder">
              <?php
                echo form_checkbox
                (
                  array
                  (
                    'name' => 'allowOptionalMessageToResponder',
                    'id' => 'cbAllowOptMsgToResponder',
                    'class' => 'cbAllowOptMsgToResponder',
                    'value' => set_value('allowOptionalMessageToResponder)',
                    'checked' => $m->allow_optional_message_to_responder
                  );
                );
              ?>
              Allow the sender to send 
              optional message to responder
            </label>
          </div>
          
          <h4>During a pong</h4>
          <div>
            <div>
              <label for="cbSndResponderDescr">
                <?php
                  echo form_checkbox
                  (
                    array
                    (
                      'name' => 'sendResponderDescription',
                      'id' => 'cbSndResponderDescr',
                      'class' => 'cbSndResponderDescr',
                      'value' => set_value('sendResponderDescription)',
                      'checked' => $m->send_responder_description
                    );
                  );
                ?>
                For security, automatically send 
                responder's description to ping sender
              </label>
            </div>
            
            <div>
              <label for="sndNotifMsg">
                <?php
                  echo form_checkbox
                  (
                    array
                    (
                      'name' => 'sendNotifyMessageToSender',
                      'id' => 'cbSndNotifMsgToSndr',
                      'class' => 'cbSndNotifMsgToSndr',
                      'value' => set_value('sendNotifyMessageToSender)',
                      'checked' => $m->send_notification_message_to_sender
                    );
                  );
                ?>
                Send a notification message to ping sender
              </label>
            </div>
            <div>
              <div>
                <label>Title:</label>
                <input type="text" 
                        name="notifyMessageTitle"
                        class="txtNotifMsgTitle"
                        value="<?php 
                          echo set_value
                          (
                            'notifyMessageTitle', 
                            $m->notify_message_title
                          ); ?>" />
              </div>
              <div>
                <label>Message:</label>
                <textarea name="notifyMessage" 
                          class="taNotifMsgTitle"><?php 
                            echo set_value
                            (
                              'notifyMessage', 
                              $m->notify_message
                            ); ?></textarea>
              </div>
            </div>
          </div>
          
          <h4>After service has been rendered</h4>
          <div>
            <div>
              <label for="cbSndPromptToSndr">
                <?php
                  echo form_checkbox
                  (
                    array
                    (
                      'name' => 'sendPromptToSender',
                      'id' => 'cbSndPromptToSndr',
                      'class' => 'cbSndPromptToSndr',
                      'value' => set_value('sendPromptToSender)',
                      'checked' => $m->send_prompt_to_sender
                    );
                  );
                ?>
                Send a prompt message to sender
              </label>
            </div>
            <div>
              <div>
                <label>Title:</label>
                <input type="text" 
                        name="promptMessageTitle" 
                        class="txtPromptMsgTitle"
                        value="<?php 
                          echo set_value
                          (
                            'promptMessageTitle', 
                            $m->prompt_message_title
                          ); ?>" />
              </div>
              <div>
                <label>Message:</label>
                <textarea name="promptMessage" 
                          class="taPromptMsg"><?php 
                          echo set_value
                          (
                            'promptMessage', 
                            $m->prompt_message
                          ); ?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
    </div>
    <div class="row">
      <div class="large-1 medium-1 small-12 columns">
        <button>Update</button>
      </div>
    </div>
  </form>
</div>