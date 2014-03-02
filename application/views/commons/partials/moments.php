<div class="moments large-12 medium-12 small-12 columns">
  <?php 
    $s = base_url('public/images') . '/';
    $uId = $this->session->userdata('user')->id;
  ?>
  {moments}
    <div class="moment">
    
      <!-- 
        Hidden fields are for the other options such as
        popup windows for prompts, etc. Use this through
        JS and parse by relatively.
      -->
      <input type="hidden" 
              name="pingAllowSndOptMsg" 
              value="{ping_allow_send_optional_message}" />
      <input type="hidden" 
              name="pingUseOptMsgAsSearchKwd" 
              value="{ping_use_optional_message_as_search_keyword}" />
      <input type="hidden" 
              name="pongAutoSndRespDescr" 
              value="{pong_auto_send_responder_description}" />
      <input type="hidden" 
              name="pongSndNotifMsgeToSndr" 
              value="{pong_send_notificiation_message_to_sender}" />
      <input type="hidden" 
              name="pongNotifMsgTtl" 
              value="{pong_notification_message_title}" />
      <input type="hidden" 
              name="pongNotifMsg" 
              value="{pong_notification_message}" />
      <input type="hidden" 
              name="afterSrvSndPmtMsgToSndr" 
              value="{after_service_send_prompt_message_to_sender}" />
      <input type="hidden" 
              name="afterSrvSndPmtMsgTtl" 
              value="{after_service_prompt_message_title}" />
      <input type="hidden" 
              name="afterSrvSndPmtMsg" 
              value="{after_service_prompt_message}" />
      
      <div class="pings">
        <a href="#" 
            id="{id}" 
            title="{name}" 
            icon="{icon}"
            class="btnIcon">
          <img src="{icon}" />
        </a>
      </div>
      <div class="details">
        <div class="row">
          <div class="title large-10 medium-6 small-6 columns">
            <a href="#" 
                id="{id}" 
                title="{name}" 
                class="btnTitle" 
                icon="{icon}">
              {name}
            </a>
          </div>
          <ul class="social large-2 medium-4 small-6 columns">
            <li>
              <a href="<?php echo site_url('moment/read'); ?>/{id}" 
                  class="btnRead" 
                  title="Read">
                <img src="<?php echo $s . 'pencil.png'; ?>" />
              </a>
            </li>
             <li>
              <?php 
                $sSetAsRspndr = site_url('moment/setAsResponder') . 
                '/' . $uId;
              ?>
              <a href="<?php echo $sSetAsRspndr; ?>/{verticals_id}/{state}"
                  class="btnSetAsRspndr" 
                  title="You are a responder of this moment.">
                <img src="<?php echo $s . 'responder_state_false.png'; ?>" />
              </a>
            </li>
            <li>
              <a href="{btnFbPath}" 
                  class="fb popup" 
                  title="FB">
                <img src="<?php echo $s . 'social_fb.png'; ?>" />
              </a>
            </li>
            <li>
              <a href="{btnTwitterPath}" 
                  class="twitter popup" 
                  title="Twitter">
                <img src="<?php echo $s . 'social_twitter.png'; ?>" />
              </a>
            </li>
            <li>
              <a href="{btnGplusPath}" 
                  class="gplus popup" 
                  title="Google+">
                <img src="<?php echo $s . 'social_gplus.png'; ?>" />
              </a>
            </li>
            <li>
              <a class="btnShowDescr">
                <img src="<?php echo $s . 'social_url.png'; ?>" />
              </a>
            </li>
          </ul>
        </div>
        <div class="descr">{description}</div>
      </div>
    </div>
  {/moments}
</div>