<div class="radius update">
  <h4>Update</h4>
  <?php 
    $r = $radius->row();
    echo validation_errors();
    echo form_open('radius/update', '', array('id' => $r->id));
  ?>
    <div>
      <div>
        <h4>Organization Details</h4>
        
        <label>Name*</label>
        <input type="text" 
                name="name" 
                value="<?php echo set_value('name', $r->name); ?>" />
        
        <div class="verticalsCntr">
          <a href="#" class="btnVerticals">Verticals*</a>
          <?php echo $verticals; ?>
        </div>
        
        <label>Description</label>
        <textarea name="description"><?php echo set_value('description', $r->description); ?></textarea>
        
        <label>Address</label>
        <textarea name="address"><?php echo set_value('address', $r->address); ?></textarea>
        
        <label>Website</label>
        <input type="text" 
                name="website" 
                value="<?php echo set_value('website', $r->website); ?>" />
        
        <label>Landline or Mobile Phone</label>
        <input type="text"  
                name="phone"
                value="<?php echo set_value('phone', $r->phone); ?>" />
        
        <label>Company Email</label>
        <input type="text" 
                name="companyEmail"
                value="<?php echo set_value('email', $r->company_email); ?>" />
      </div>
      
    </div>
    
    <div class="row">
      <h4>Location Details</h4>
      <div class="gmap large-7 columns"></div>
      <div class="12 columns"">
        <input type="text" 
                  placeholder="Latitude*" 
                  name="latitude" 
                  class="lat"
                  value="<?php echo set_value('latitude', $r->latitude); ?>" />
          <input type="text" 
                  placeholder="Longitude*" 
                  name="longitude" 
                  class="lng"
                  value="<?php echo set_value('longitude', $r->longitude); ?>" />
      </div>
    </div>
    
    <div class="controls">
      <div class="row">
        <div class="large-1 column medium-2 small-12 columns">
          <button title="Update">Update</button>
        </div>
      </div>
    </div>
    
  </form>
</div>
<script>new Radius().initCrud();</script>