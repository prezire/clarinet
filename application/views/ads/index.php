<div id="ad">
  <div class="index">
    <h6>Ads</h6>
    <a href="<?php echo site_url('ad/create'); ?>">Create an ad</a>
    <?php
      $r = $ads->result();
      if(count($r) < 1)
      {
    ?>
        <div>There are no ads to display.</div>
    <?php
      }
      else
      {
    ?>
      <table border="1">
        <thead>
          <tr>
            <td>Name</td>
            <td>Width</td>
            <td>Height</td>
            <td>Media Type</td>
            <td>Date From</td>
            <td>Date To</td>
            <td>Impressions</td>
            <td>Clicks</td>
            <td>Options</td>
          </tr>
        </thead>
        <?php
          foreach($r as $a)
          {
        ?>
            <tr>
              <td><?php echo $a->name; ?></td>
              <td><?php echo $a->width; ?></td>
              <td><?php echo $a->height; ?></td>
              <td><?php echo $a->media_type; ?></td>
              <td><?php echo $a->date_from; ?></td>
              <td><?php echo $a->date_to; ?></td>
              <td><?php echo $a->impressions; ?></td>
              <td><?php echo $a->clicks; ?></td>
              <td>
                <a href="<?php echo site_url('ad/read/' . $a->id); ?>">View</a> | 
                <a href="<?php echo site_url('ad/delete/' . $a->id); ?>">Delete</a>
              </td>
            </tr>
        <?php
          }
        ?>
      </table>
    <?php
      }
    ?>
  </div>
</div>