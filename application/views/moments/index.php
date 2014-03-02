<div id="moments">
  <div class="row">
    <div class="large-12 medium-12 small-12 columns map">
      <div class="focused">
        <a class="btnBroadcast" title="Click to request for responders.">
          <img class="icon" />
          <span class="title"></span>
        </a>
      </div>
      <div class="options">
        <a href="#" class="btnCollapse">X</a>
      </div>
      <div id="gmap"></div>
    </div>
    <div class="large-12 medium-12 small-12 columns">
      <?php 
        echo form_dropdown
        (
          'filter', 
          $filter, 
          0, 
          'class="filter"'
        );
      ?>
      <div>
        <div class="large-11 medium-10 small-9 columns">
          <input type="text" class="txtSearch" />
        </div>
        <div class="large-1 medium-2 small-3 columns">
          <button class="btnSearch">Search</button>
        </div>
      </div>
      <?php
        if(isSuperAdmin())
        {
      ?>
      <div class="createCntr large-12 medium-12 small-12 columns">
        <a href="<?php echo site_url('moment/create'); ?>" 
            class="btnCreate">
          Create a new moment
        </a>
      </div>
      <?php } ?>
      <?php 
        echo $this->parser->parse
        (
          'commons/partials/moments.php', 
          array('moments' => $moments->result()), 
          true
        );
      ?>
    </div>
  </div>
  <script>
    new Moment();
  </script>
</div>