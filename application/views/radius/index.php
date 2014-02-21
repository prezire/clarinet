<div class="radius">
  <div class="row">
    <div class="large-6 medium-6 small-12 columns">
    <?php
      foreach($verticals as $v)
      {
        echo '<option>' . $v->name . '</option>';
      }
    ?>
	  <div class="keywords"></div>
    </div >
  </div>
  <div id="gmap"></div>
</div>
<script>new Radius().init();</script>