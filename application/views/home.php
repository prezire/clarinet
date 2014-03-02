<div id="home">
  <img src="<?php echo base_url('public/images/logo.png'); ?>" />
  <section class="intro">
    A revolutionary app that spells convenience amidst the chaotic busy everyday life.
  </section>
  
  <section class="faq">
    <span class="header">FAQs</span>
    <div>
      <div class="subheader">Is it free?</div>
      <div>
        For public Moments, yes. For private Moments, no.
      </div>
    </div>
    <div>
      <div class="subheader">What is a private Moment?</div>
      <div>
        This is dedicated to businesses that offer services
        only to their special members. Let's say you have a 
        hospital busines that tracks outdoor patient status. 
        In order to avoid noisy pings and receive only requests 
        from patients who are enrolled in your system, have this 
        feature enabled. This is applicable for devices as well.
        <a href="#contact">Contact us</a>
        to enable this feature for your business.
      </div>
    </div>
    <div>
      <div class="subheader">What about security?</div>
      <div>
        Clarinet uses GPS to determine your location. 
        Cookies are used only for login purposes.
        <br />
        Read our <a>privacy policy</a>.
      </div>
    </div>
  </section>
  
  <section>
    <div class="header">Subscribe</div>
    <div>
      Join our newsletter and be the first to know the latest Moments.
    </div>
    <form>
      <input type="text" placeholder="Email" />
      <div class="row">
        <div class="large-2 medium-3 small-12 columns">
          <button>Sign Up</button>
        </div>
      </div>
    </form>
  </section>
  
  <section class="about">
    <div class="header">About</div>
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
              info@clarinet.com
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
    
  </section>
  
  <section class="contact row">
    <a><div class="header">Contact</div></a>
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
  </section>
  
  <div class="copyright">
    Copyright &copy; Clarinet 2014
  </div>
</div>
<script>$('.iframe').css('width', '100%'); </script>