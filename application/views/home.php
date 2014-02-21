<div id="home">
  <h4>Home</h4>
  
  <div class="intro">
    
  </div>
  
  <div class="help">
    <section>
      <section>
      <h5 class="subheader">Radius for end-users</h5>
      Looking for something near you? An Internet Cafe perhaps?
      <ol>
        <li>Type Internet Cafe in the text field and hit the enter key</li>
        <li>Drag radius slider</li>
        <li>Done</li>
      </ol>
      Now try looking for anything else besides Internet Cafes.
      </section>
      
      <section>
        <h5 class="subheader">Radius for business owners</h5>
        Generate reports to determine how effective your location is, for your business through search, along with metrics such as views, website conversions, location and network carrier per user.
      </section>
    </section>

    <section>
      <h5 class="subheader">Point</h5>
      Meeting your buddies in a foreign country? They don't know where you're at?
      <ol>
        <li>
          Fetch your location by clicking Get My Location button (no registration required)
        </li>
        <li>
          Click the Share button
        </li>
        <li>
          Your friends can now visit the URL, click the Plot Route button to know where you are
        </li>
        <li>Done</li>
      </ol>
    </section>
    
    <section>
      <h5 class="subheader">Moment</h5>
      We will soon create series of events using our Clarinet API dedicated to medical, NGOs, transportation, food and advertising. Join our newsletter and be the first to know when we launch this feature.
      <form>
        <input type="text" placeholder="Email" />
        <div class="row">
          <div class="large-2 medium-3 small-12 columns">
            <button>Sign Up</button>
          </div>
        </div>
      </form>
    </section>
    
  </div>
  
  <div class="about">
    <h4 class="subheader">About</h4>
    <div class="gmap">
      <iframe class="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7977.546787204957!2d103.85385269999995!3d1.3113344500000055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da19c660b099d9%3A0x9ca5f86dd6dd8f2f!2sRace+Course+Rd%2C+Singapore!5e0!3m2!1sen!2s!4v1391073566299" height="300" frameborder="0" style="border:0"></iframe>
    </div>
    <div class="details row">
      
      <div class="large-8 medium-12 small-12 columns">
        <div class="homeAddr">
          <div>Tessensohn Road, Farrer Park</div>
          <div>Singapore</div>
        </div>
        <div class="contact">
          <div>
            +65 000-0000
          </div>
          <div>
            <a href="mailto:info@travelexplorer.com">
              info@travelexplorer.com
            </a>
          </div>
        </div>
      </div>
      
      <div class="social large-4 medium-12 small-12 columns">
        <ul>
          <li>
            <a href="#">
              <img src="<?php echo base_url('public/images/social_fb.png'); ?>" />
            </a>
          </li>
          <li>
            <a href="#">
              <img src="<?php echo base_url('public/images/social_gplus.png'); ?>" />
            </a>
           </li>
          <li>
            <a href="#">
              <img src="<?php echo base_url('public/images/social_instagram.png'); ?>" />
            </a>
          </li>
          <li>
            <a href="#">
              <img src="<?php echo base_url('public/images/social_twitter.png'); ?>" />
            </a>
          </li>
        </ul>
      </div>
      
    </div>
    
  </div>
  
  <div class="contact row">
    <h5 class="subheader">Contact</h5>
    <?php 
      echo validation_errors(); 
      echo form_open('contact/create');
    ?>
      <input type="text" 
              name="title" 
              placeholder="Title*" 
              value="<?php echo set_value('title'); ?>" />
      <input type="text" 
              name="completeName" 
              placeholder="Complete Name" 
              value="<?php echo set_value('completeName'); ?>" />
      <input type="text" 
              name="email" 
              placeholder="Email*" 
              value="<?php echo set_value('email'); ?>" />
      <textarea name="message" placeholder="Message*"></textarea>
      <div class="large-1 medium-2 small-12 columns">
        <button>Send</button>
      </div>
    </form>
  </div>
  
  <div class="copyright">
    Copyright &copy; Clarinet 2014
  </div>
</div>
<script>$('.iframe').css('width', '100%'); </script>