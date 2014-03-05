<div id="ad">
  <div class="read">
    <h6>Existing ad</h6>
    <?php $a = $ad->row(); ?>
    <table border="1">
      <tr>
        <td>Name</td>
        <td><?php echo $a->name; ?></td>
      </tr>
      <tr>
        <td>Description</td>
        <td><?php echo $a->description; ?></td>
      </tr>
      <tr>
        <td>Tags</td>
        <td><?php echo $a->tags; ?></td>
      </tr>
      <tr>
        <td>Banner</td>
        <td><img src="<?php echo $a->banner_path; ?>" /></td>
      </tr>
      <tr>
        <td>Date From</td>
        <td><?php echo $a->date_from; ?></td>
      </tr>
      <tr>
        <td>Date To</td>
        <td><?php echo $a->date_to; ?></td>
      </tr>
      <tr>
        <td>Bid Amount</td>
        <td><?php echo $a->bid_amount; ?></td>
      </tr>
      <tr>
        <td>Click-through URL</td>
        <td><?php echo $a->clickthrough_url; ?></td>
      </tr>
    </table>
    <div>
      <a href="<?php echo site_url('ad');?>">Back</a> | 
      <a href="<?php echo site_url('ad/update/' . $a->id);?>">Update</a>
    </div>
  </div>
</div>