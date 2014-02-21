<div class="moments large-12 medium-12 small-12 columns">
  <?php $s = base_url('public/images') . '/'; ?>
  {moments}
    <div class="moment">
    
      <input type="hidden" name="id" value="{id}" />
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
      
      <div class="btnPing">
        <a href="{btnIconPath}" class="btnIcon">
          <img src="<?php echo $s; ?>{icon}" />
        </a>
      </div>
      <div class="details">
        <div class="row">
          <div class="title large-10 medium-6 small-6 columns">
            <a href="{btnTitlePath}" class="btnTitle">
              {name}
            </a>
          </div>
          <ul class="social large-2 medium-4 small-6 columns">
            <li>
              <a href="{btnFbPath}" 
                  class="btnFb" 
                  title="FB">
                <img src="<?php echo $s . 'social_fb.png'; ?>" />
              </a>
            </li>
            <li>
              <a href="{btnTwitterPath}" 
                  class="btnTwitter" 
                  title="Twitter">
                <img src="<?php echo $s . 'social_twitter.png'; ?>" />
              </a>
            </li>
            <li>
              <a href="{btnGplusPath}" 
                  class="btnGplus" 
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