<div class="user read">
  <h4>Settings</h4>
  <?php $l = $this->session->userdata('user'); ?>
  <table border="1" cellpadding="0" cellspacing="3">
    <tr>
      <td><label for="name">Complete Name*</label></td>
      <td><?php echo $l->complete_name; ?></td>
    </tr>
    <tr>
      <td><label for="email">Email*</label></td>
      <td><?php echo $l->email; ?></td>
    </tr>
  </table>
  <div class="controls">
    <!--a href="<?php echo site_url('user/create'); ?>">
      Add new user
    </a-->
    <a href="<?php echo site_url('user/update'); ?>" 
        class="fi-pencil" 
        title="Update"></a>
  </div>
</div>