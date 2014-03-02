<div id="moments">
  <div class="create">
    <h6>Create a new moment</h6>
    <?php
      echo validation_errors();
      echo form_open(site_url('moment/create'));
    ?>
      <div>
        
        <div class="large-12 medium-12 small-12 columns">
          <div>
            <label>Name</label>
            <input type="text" 
                    name="name" 
                    class="txtName" />
          </div>
          <div>
            <label>Description</label>
            <textarea name="description" 
                      class="taDescr"></textarea>
          </div>
          <div>
            <label>Vertical</label>
              <?php echo form_dropdown('verticalId', getVerticals()); ?>
          </div>
        </div>
        
        <div class="private">
          <label for="cbPrivate">
            <input type="checkbox" 
                  class="cbPrivate" 
                  name="private" 
                  id="cbPrivate" checked />
              Private
            </label>
          
          <div>
            <div>
              <label>App Key</label>
              <input type="hidden" 
                      name="appKey" 
                      class="appKey" />
              <span class="txtAppKey"></span>
            </div>
          </div>
        </div>
        
      </div>
       
      </div>
      <div class="row">
        <div class="large-1 medium-1 small-12 columns">
          <button>Go</button>
        </div>
      </div>
    </form>
    </div>
    <script>
      var a = new Moment();
      a.setAppKey();
      a.setUserId("<?php echo $this->session->userdata('user')->id; ?>");
    </script>
</div>