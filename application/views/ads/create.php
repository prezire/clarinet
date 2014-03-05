<div id="ad">
  <div class="create">
    <h6>Create a new ad</h6>
    <?php
      echo validation_errors();
      echo form_open_multipart('ad/create');
    ?>
      <input type="hidden" 
              name="userId" 
              value="<?php 
                echo $this->session->userdata('user')->id; 
              ?>" />
      <table border="1">
        <tr>
          <td><label>Name</label></td>
          <td><input type="text" name="name" /></td>
        </tr>
        <tr>
          <td><label>Description</label></td>
          <td><textarea name="description"></textarea></td>
        </tr>
        <tr>
          <td><label>Tags</label></td>
          <td><input type="text" name="tags" /></td>
        </tr>
        <tr>
          <td><label>Banner</label></td>
          <td><input type="file" name="banner" /></td>
        </tr>
        <tr>
          <td><label>Date From</label></td>
          <td><input type="text" name="dateFrom" /></td>
        </tr>
        <tr>
          <td><label>Date To</label></td>
          <td><input type="text" name="dateTo" /></td>
        </tr>
        <tr>
          <td><label>Bid Amount</label></td>
          <td><input type="text" name="bidAmount" /></td>
        </tr>
        <tr>
          <td><label>Clickthrough URL</label></td>
          <td><input type="text" name="clickthroughUrl" /></td>
        </tr>
      <table>
      <div>
        <a href="<?php echo site_url('ad');?>">Cancel</a>
        <button>Create</button>
      </div>
    </form>
  </div>
</div>