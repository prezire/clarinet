<div class="radius create">
  <h4>Register</h4>
  <?php 
    echo validation_errors();
    echo form_open('radius/create'); 
  ?>
    <div class="row">
      <div class="large-5 medium-5 small-12 columns">
        <h5 class="subheader">Tell us about yourself.</h5>
        <input type="text" 
                placeholder="Complete Name*" 
                name="completeName" 
                value="<?php echo set_value('completeName'); ?>" />
        <div class="row">
          <div class="large-6 medium-6 small-12 columns">
            <input type="text" 
                    placeholder="Email*" 
                    name="email" 
                    value="<?php echo set_value('email'); ?>" />
          </div>
          <div class="large-6 medium-6 small-12 columns">
            <input type="password" 
                    placeholder="Password*" 
                    name="password" 
                    value="<?php echo set_value('password'); ?>" />
          </div>
        </div>
      </div>

      <div class="large-6 medium-6 small-12 columns">
        <h5 class="subheader">What's your business?</h5>
        <input type="text" 
                placeholder="Name*" 
                name="organizationName" 
                value="<?php echo set_value('organizationName'); ?>" />
        
        <div class="row">
          <div class="large-2 medium-3 small-12 columns">
            <div class="verticalsCntr">
              <a href="#" class="btnVerticals" data-reveal-id="verticals">
                Verticals*
              </a>
              <?php echo $verticals; ?>
            </div>
          </div>
          <div class="large-10 medium-9 small-12 columns">
            <input type="text" 
                    placeholder="Website*" 
                    name="website" 
                    value="<?php echo set_value('website'); ?>" />
          </div>
        </div>
        
      </div>
      
    </div>
    
    <div class="large-12 medium-12 small-12 columns">
      <h5 class="subheader">Where's your businesses located?</h5>
      <div class="gmap"></div>
      <input type="hidden" 
                name="latitude" 
                class="lat"
                value="3.3"
                value="<?php echo set_value('latitude'); ?>" />
        <input type="hidden" 
                name="longitude" 
                class="lng"
                value="3.3"
                value="<?php echo set_value('longitude'); ?>" />
      <div class="large-1 medium-12 small-12 columns">
          <button title="Go">Go</button>
      </div>
      
    </div>
    
  </form>
</div>
<script>new Radius().initCrud();</script>