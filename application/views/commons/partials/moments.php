<div class="moments large-12 medium-12 small-12 columns">
  <?php 
    $s = base_url('public/images') . '/';
    $uId = $this->session->userdata('user')->id;
    //KLUDGE: Using loop instead of tmpl to parse through 
    //props and evaluate values properly esp with conditions.
    foreach($moments as $m)
    {
  ?>
    <div class="moment">
      <!-- 
        Hidden fields are for the other options such as
        popup windows for prompts, etc. Use this through
        JS and parse by relatively.
      -->
      <input type="hidden" 
              name="pingAllowSndOptMsg" 
              value="<?php echo $m->ping_allow_send_optional_message_to_responder; ?>" />
      <input type="hidden" 
              name="pingUseOptMsgAsSearchKwd" 
              value="<?php echo $m->ping_enable_use_optional_message_as_search_keyword; ?>" />
      <input type="hidden" 
              name="pongAutoSndRespDescr" 
              value="<?php echo $m->pong_enable_auto_send_responder_description; ?>" />
      <input type="hidden" 
              name="pongSndNotifMsgeToSndr" 
              value="<?php echo $m->pong_enable_send_notification_message_to_sender; ?>" />
      <input type="hidden" 
              name="pongNotifMsgTtl" 
              value="<?php echo $m->pong_notification_message_title; ?>" />
      <input type="hidden" 
              name="pongNotifMsg" 
              value="<?php echo $m->pong_notification_message; ?>" />
      <input type="hidden" 
              name="afterSrvSndPmtMsgToSndr" 
              value="<?php echo $m->after_service_enable_send_prompt_message_to_sender; ?>" />
      <input type="hidden" 
              name="afterSrvSndPmtMsgTtl" 
              value="<?php echo $m->after_service_prompt_message_title; ?>" />
      <input type="hidden" 
              name="afterSrvSndPmtMsg" 
              value="<?php echo $m->after_service_prompt_message; ?>" />
      
      <div class="pings">
        <a href="#" 
            id="<?php echo $m->id; ?>" 
            title="<?php echo $m->name; ?>" 
            icon="<?php echo $m->icon_path; ?>"
            class="btnIcon">
          <img src="<?php echo base_url('public/images/radius_generic_map_pin.png'); ?>" />
        </a>
      </div>
      <div class="details">
        <div class="row">
          <div class="title large-10 medium-6 small-6 columns">
            <a href="#" 
                id="<?php echo $m->id; ?>" 
                title="<?php echo $m->name; ?>" 
                class="btnTitle" 
                icon="<?php echo $m->icon_path; ?>">
              <?php echo $m->name; ?>
            </a>
          </div>
          <ul class="social large-2 medium-4 small-6 columns">
            <li>
              <a href="<?php echo site_url('moment/read'); ?>/<?php echo $m->id; ?>" 
                  class="btnRead" 
                  title="Read">
                <img src="<?php echo $s . 'pencil.png'; ?>" />
              </a>
            </li>
             <li>
              <?php
                $sTglState = site_url('moment/toggleUserState') . 
                '/' . $uId;
                //Automatically set null states as Senders. 
                //Refer to moment_model->index() comment.
                $sStateIco = 'user_state_sender';
                $sStateTooltip = 'You are a sender of this moment';
                if(isset($m->state))
                {
                  if($m->state == 'Responder')
                  {
                    $sStateIco = 'user_state_responder';
                    $sStateTooltip = 'You are a responder of this moment';
                  }
                }
              ?>
              <a href="<?php echo $sTglState; ?>"
                  momentId="<?php echo $m->id; ?>"
                  state="<?php echo $m->state; ?>"
                  class="btnToggleState" 
                  title="<?php echo $sStateTooltip; ?>">
                <img src="<?php echo $s . $sStateIco . '.png'; ?>" />
              </a>
            </li>
            <li>
              <a href="#" 
                  class="fb popup" 
                  title="FB">
                <img src="<?php echo $s . 'social_fb.png'; ?>" />
              </a>
            </li>
            <li>
              <a href="#" 
                  class="twitter popup" 
                  title="Twitter">
                <img src="<?php echo $s . 'social_twitter.png'; ?>" />
              </a>
            </li>
            <li>
              <a href="#" 
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
        <div class="descr"><?php echo $m->description; ?></div>
      </div>
    </div>
  <?php } ?>
</div>