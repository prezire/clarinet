<div class="user update">
  <h4>UPDATE PROFILE</h4>

  <?php 
    echo validation_errors();
    echo form_open('user/update');
    $l = $this->session->userdata('user');
  ?>
    <table border="1" cellpadding="0" cellspacing="3">
      <tr>
        <td>
          <label for="name">COMPLETE NAME*: </label>
        </td>
        <td>
          <input type="text" name="name" value="<?php echo $l->complete_name; ?>" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="email">EMAIL*: </label>
        </td>
        <td>
          <input type="text" name="email" value="<?php echo $l->email; ?>" />
        </td>
      </tr>
    </table>
    
    <div class="controls">
      <a href="<?php echo site_url('user/read'); ?>" 
          class="fi-previous" 
          title="BACK"></a>
      <button class="fi-pencil" title="GO"></button>
    </div>
    
  </form>
</div>