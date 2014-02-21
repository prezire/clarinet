<div id="moments">
  <div class="row">
    <?php 
      echo form_dropdown
      (
        'sort', 
        $sort, 
        0, 
        'class="sort"'
      );
    ?>
    <div class="search large-12 medium-12 small-12 columns">
      <input type="text" class="txtSearch" />
      <button class="btnSearch">Search</button>
    </div>
    <div class="moment create large-12 medium-12 small-12 columns">
      <a href="<?php echo site_url('moment/create'); ?>" 
          class="btnCreate">
        Create a new moment
      </a>
    </div>
    <?php 
      echo $this->parser->parse
      (
        'commons/partials/moments.php', 
        array('moments' => $moments->result()), 
        true
      );
    ?>
    <div class="map large-12 medium-12 small-12 columns">
      <div class="options">
        <a href="#" class="btnExpand">Expand</a>
        <a href="#" class="btnCollapse">Collapse</a>
      </div>
      test
    </div>
  </div>
  <script>
    var a = new Moment();
    a.setUserId(<?php echo $this->session->userdata('user')->id; ?>);
  </script>
</div>