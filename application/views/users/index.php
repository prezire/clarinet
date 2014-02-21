<div class="radius">
  <input type="text" 
        name="keywords" 
        class="keywords" 
        placeholder="ENTER SEARCH KEYWORDS AND CLICK ON THE MAP" />
  <span class="option">
    <a href="<?php echo site_url('radius/listing'); ?>" 
        class="fi-list-thumbnails" 
        title="LISTING"></a>
    <?php
      $u = $this->session->userdata('user');
      if($u)
      {
    ?>
    <a href="<?php echo site_url('radius/settings'); ?>" 
        title="SETTINGS" 
        class="fi-widget"></a>
    <a href="<?php echo site_url('radius/logout'); ?>" 
        title="LOGOUT <?php echo $this->session->userdata('user')->complete_name;?>" 
        class="fi-minus-circle"></a>
    <?php
      }
      else
      {
    ?>
    <a href="<?php echo site_url('radius/login'); ?>" class="fi-flag" title="LOGIN"></a>
    <?php
      }
    ?>
  </span>
  <div id="gmap"></div>
</div>
<script>
  $(document).ready(function(){new TravelExplorer().initradius();});
</script>