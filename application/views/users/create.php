<div class="user create">
  <h4>REGISTER</h4>

  <?php 
    echo validation_errors();
    echo form_open('user/create'); 
  ?>

    <input type="text" 
            placeholder="COMPLETE NAME*" 
            name="completeName" 
            value="<?php echo set_value('completeName'); ?>" />
    <input type="text" 
            placeholder="EMAIL*" 
            name="email" 
            value="<?php echo set_value('email'); ?>" />
    <input type="password" 
            placeholder="PASSWORD*" 
            name="password" 
            value="<?php echo set_value('password'); ?>" />
    <div class="controls">
      <a href="<?php echo site_url('Radius'); ?>" 
          title="BACK" 
          class="fi-previous"></a>
      <button class="fi-save" title="GO"></button>
    </div>
  </form>
</div>