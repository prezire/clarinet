<div id="moment create">
  <h4>Create a new moment</h4>
  <?php
    echo validation_errors();
    echo form_open(site_url('moment/create'));
  ?>
    <div class="row">
      
      <div class="large-6 medium-6 small-12 columns">
        <div>
          <label>Name:</label>
          <input type="text" 
                  name="name" 
                  class="txtName" />
        </div>
        <div>
          <label>Description:</label>
          <textarea name="description" 
                    class="taDescr"></textarea>
        </div>
        <div>
          <label>Vertical:</label>
            <?php
              $verticals = getVerticals()->result_array();
              echo form_dropdown('vertical', $verticals);
            ?>
        </div>
      </div>
      
      <div class="accessibility">
        <input type="checkbox" 
                class="cbAccessibility" 
                name="accessibility" 
                id="cbAccessibility" />
        <label for="cbAccessibility">Private</label>
        
        <div class="accessibilityOpts">
          <div>
            App Key:
            <input type="text" 
                    name="appKey" 
                    class="txtAppKey" />
          </div>
          
          <div>
            <h4>Responders</h4>
            <div class="responders">
              <div class="responder">
                <span>
                <input type="text" 
                        name="responders[]" 
                        class="txtResponder" />
                </span>
                <span>
                  <a class="button tiny btnRemResp">-</a>
                  <a class="button tiny btnAddResp">+</a>
                </span>
              </div>
            </div>
          </div>
          
          <div class="urls">
            <h4>Sample URLs</h4>
            <div>
              <label>Domain:</label>
              <input type="text" 
                      editable="false" 
                      class="domain" />
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
                <input type="checkbox" 
                      name="hasLimitedPingRadius" 
                      id="cbHasLimitedPingRad" />
                Limit ping radius to
              </label>
              <input type="text" 
                      value="5" 
                      name="limitPingRadius"
                      class="txtLimPingRad" /> KM
            </div>
            
            <div>
              <label for="cbLimitPongRad">
                <input type="checkbox" 
                      name="hasLimitedPongRadius" 
                      id="cbLimitPongRad" />
                Limit pong radius to
              </label>
              <input type="text" 
                      value="5" 
                      name="limitPongRadius"
                      class="txtLimPongRad" /> KM
            </div>
            
            <div>
              <label for="cbLimitMaxResponders">
                <input type="checkbox" 
                      name="limitMaxResponders" 
                      id="cbLimitMaxResponders" />
                Limit maximum responders to
              </label>
              <input type="text" 
                      value="3" 
                      name="limitMaxResponders"
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
              <input type="checkbox" 
                    name="allowOptionalMessageToResponder" 
                    id="cbAllowOptMsgToResponder" />
              Allow the sender to send 
              optional message to responder
            </label>
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
              </label>
            </div>
            
            <div>
              <label for="cbSndNotifMsgToSndr">
                <input type="checkbox" 
                        name="sendNotifyMessageToSender" 
                        id="cbSndNotifMsgToSndr" />
                Send a notification message to ping sender
              </label>
            </div>
            <div>
              <div>
                <label>Title:</label>
                <input type="text" 
                        name="notifyfMessageTitle"
                        class="txtNotifMsgTitle" />
              </div>
              <div>
                <label>Message:</label>
                <textarea name="notifyMessage" 
                          class="taNotifMsgTitle"></textarea>
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
                <textarea name="promptMessage" 
                          class="taPromptMsg"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
    </div>
    <div class="row">
      <div class="large-1 medium-1 small-12 columns">
        <button>Go</button>
      </div>
    </div>
  </form>
</div>