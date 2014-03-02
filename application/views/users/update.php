<div class="user update">
  <h6>Update Profile</h6>

  <?php 
    echo validation_errors();
    echo form_open('user/update');
    $l = $this->session->userdata('user');
  ?>
    <table border="1" cellpadding="0" cellspacing="3">
      <tr>
        <td>
          <label>
            Avatar
          </label>
        </td>
        <td>
          
        </td>
      </tr>
      <tr>
        <td>
          <label for="name">
            Complete Name*
          </label>
        </td>
        <td>
          <input type="text" 
                  name="name" 
                  value="<?php echo $l->complete_name; ?>" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="email">
            Email*
          </label>
        </td>
        <td>
          <input type="text" 
                  name="email" 
                  value="<?php echo $l->email; ?>" />
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Birth Date
          </label>
        </td>
        <td>
          
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Mobile
          </label>
        </td>
        <td>
          
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Landline
          </label>
        </td>
        <td>
          
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Address
          </label>
        </td>
        <td>
          
        </td>
      </tr>
      <tr>
        <td>
          <label>
            City
          </label>
        </td>
        <td>
          
        </td>
      </tr>
      <tr>
        <td>
          <label>
            Country
          </label>
        </td>
        <td>
          
        </td>
      </tr>
    </table>
    
    <div class="controls">
      <button>GO</button>
      <a href="<?php echo site_url('user/read/' . $l->id); ?>" 
         class="button small">
          Back
      </a>
    </div>
    
  </form>
</div>