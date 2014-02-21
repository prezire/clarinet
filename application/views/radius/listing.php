<div class="listing">
  <table border="1" 
        cellpadding="3" 
        cellspacing="0">
    <thead>
      <tr>
        <td>Name</td>
        <td>Description</td>
        <td>Latitude</td>
        <td>Longitude</td>
        <td>Options</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $locs = $radius->result();
        foreach($locs as $l)
        {
      ?>
          <tr>
            <td><?php echo $l->name; ?></td>
            <td><?php echo $l->description; ?></td>
            <td><?php echo $l->longitude; ?></td>
            <td><?php echo $l->latitude; ?></td>
            <td>
              <?php 
                if(isset($user->id)){ 
              ?>
              <a href="<?php echo site_url('radius/delete/' . $l->id); ?>">
                <img src="<?php echo base_url('public/images/x_mark.png'); ?>" />
              </a>
              <?php 
                } 
              ?>
              <a href="<?php echo site_url('radius/read/' . $l->id); ?>">
                <img src="<?php echo base_url('public/images/eye.png'); ?>" />
              </a>
            </td>
          </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>