<div id="ad">
  <div class="update">
    <h6>Update an ad</h6>
    <?php
      echo validation_errors();
      echo form_open_multipart('ad/update');
      $a = $ad->row();
    ?>
      <input type="hidden" 
              name="userId" 
              value="<?php 
                echo set_value('userId', $a->users_id);
              ?>" />
      <table border="1">
        <tr>
          <td><label>Name</label></td>
          <td><input type="text" 
                name="name" 
                value="<?php 
                  echo set_value('name', $a->name); 
                ?>" /></td>
        </tr>
        <tr>
          <td><label>Description</label></td>
          <td><textarea name="description"><?php 
            echo set_value
            (
              'description', 
              $a->description
            ); ?></textarea></td>
        </tr>
        <tr>
          <td><label>Tags</label></td>
          <td><input type="text" 
                  name="tags" 
                  value="<?php 
                    echo set_value('tags', $a->tags); 
                  ?>" /></td>
        </tr>
        <tr>
          <td><label>Banner</label></td>
          <td><img src="<?php echo $a->banner_path; ?>" />
          <input type="file" 
                  name="banner" 
                  value="<?php 
                    echo set_value('banner', $a->banner_path); 
                  ?>" /></td>
        </tr>
        <tr>
          <td><label>Date From</label></td>
          <td><input type="text" 
                  name="dateFrom" 
                  value="<?php 
                    echo set_value('dateFrom', $a->date_from); 
                  ?>" /></td>
        </tr>
        <tr>
          <td><label>Date To</label></td>
          <td><input type="text" 
                  name="dateTo" 
                  value="<?php 
                    echo set_value('dateTo', $a->date_to); 
                  ?>" /></td>
        </tr>
        <tr>
          <td><label>Bid Amount</label></td>
          <td><input type="text" 
                  name="bidAmount" 
                  value="<?php 
                    echo set_value('bidAmount', $a->bid_amount); 
                  ?>" /></td>
        </tr>
        <tr>
          <td><label>Clickthrough URL</label></td>
          <td><input type="text" 
                  name="clickthroughUrl" 
                  value="<?php 
                    echo set_value('clickthroughUrl', $a->clickthrough_url); 
                  ?>" /></td>
        </tr>
      </table>
      <div>
        <a href="<?php echo site_url('ad/read/' . $a->id);?>">Cancel</a> | 
        <button>Update</button>
      </div>
    </form>
  </div>
</div>