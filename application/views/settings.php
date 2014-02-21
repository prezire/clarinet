<div class="settings">
  <ul>
    <li>
      <?php $d = $this->session->userdata('user'); ?>
      <a href="<?php echo site_url('user/read/' . $d->id); ?>">
        User Settings
      </a>
    </li>
    <li>
      <a href="<?php echo site_url('radius/read/' . $d->radius_id); ?>">
        Company Profile Settings
      </a>
    </li>
    <li>
      <a href="<?php echo site_url('home/settings/view'); ?>">
        View Settings
      </a>
    </li>
  </ul>
</div>