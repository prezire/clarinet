<div class="user read">
  <h6>User Profile</h6>
  <?php $l = $this->session->userdata('user'); ?>
  <div>
    Avatar
    <?php //echo $l->avatar; ?></td>
  </div>
  <div>
    Complete Name
    <?php echo $l->complete_name; ?></td>
  </div>
  <div>
    Email
    <?php echo $l->email; ?></td>
  </div>
  <div>
    Birth Date
    <?php //echo $l->birthDate; ?></td>
  </div>
  
  <div>
    Mobile
    <?php //echo $l->mobile; ?></td>
  </div>
  <div>
    Landline
    <?php //echo $l->landline; ?></td>
  </div>
  
  <div>
    Address
    <?php //echo $l->address; ?></td>
  </div>
  <div>
    City
    <?php //echo $l->city; ?></td>
  </div>
  <div>
    Country
    <?php //echo $l->country; ?></td>
  </div>
  
  <div class="controls">
    <a class="button small" 
        href="<?php echo site_url('user/update'); ?>">
      Edit
    </a>
  <a class="button small" href="<?php echo site_url('user/create'); ?>">
    Add new user
  </a>
  <a class="button small" href="<?php echo site_url('home/settings'); ?>">
    Back
  </a>
  </div>
</div>