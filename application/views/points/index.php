<div class="point">
  <input type="hidden" class="lat" />
  <input type="hidden" class="lng" />
  <div>
    <ul>
      <li>
        <button title="Get my location" class="getLoc">
          <img src="<?php echo base_url('public/images/get_location.png'); ?>" />
        </button>
      </li>
      <li class="shares">
        <button class="shareLoc" title="Share My Location">
          <img src="<?php echo base_url('public/images/social.png'); ?>" />
        </button>
        <div class="share">
          <ul>
            <li class="shareUrl">
              <a href="#" title="Share URL">
                <img src="<?php echo base_url('public/images/social_url.png'); ?>" />
              </a>
              <div class="sharedUrl">
                <input type="text" placeholder="Loading..." />
              </div>
            </li>
            <li>
              <a class="fb popup" 
                  href="#" title="Facebook">
                <img src="<?php echo base_url('public/images/social_fb.png'); ?>" />
              </a>
            </li>
            <li>
              <a href="#"
                  class="gplus popup" 
                  title="Google Plus">
                <img src="<?php echo base_url('public/images/social_gplus.png'); ?>" />
              </a>
            </li>
            <li>
              <a class="twitter popup" 
                  href="#" title="Twitter">
                <img src="<?php echo base_url('public/images/social_twitter.png'); ?>" />
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li>
        <button class="plotRoute" title="Plot Route">
          <img src="<?php echo base_url('public/images/point.png'); ?>" />
        </button>
      </li>
    </ul>
    
  </div>
  <div id="gmap"></div>
</div>
<script>
  $(document).ready(function(){new Point().init();});
</script>