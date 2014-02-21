<div class="radius read">
  <h4>Read</h4>

  <?php $l = $radius->row(); ?>
    <table border="1" cellpadding="3" cellspacing="0">
      <tr>
        <td><label>Name</label></td>
        <td><?php echo $l->name; ?></td>
      </tr>
      <tr>
        <td><label>Verticals</label></td>
        <td><?php echo $l->verticals; ?></td>
      </tr>
      <tr>
        <td><label>Description</label></td>
        <td><?php echo $l->description; ?></td>
      </tr>
      <tr>
        <td><label>Address</label></td>
        <td><?php echo $l->address; ?></td>
      </tr>
      <tr>
        <td><label>Website</label></td>
        <td>
        <?php
          if(strlen($l->website) > 0)
          {
            echo '<a href="' . 
              $l->website . 
              '" target="_blank">' . 
              $l->website . 
              '</a>';
          }
        ?>
        </td>
      </tr>
      <tr>
        <td><label>Phone</label></td>
        <td><?php echo $l->phone; ?></td>
      </tr>
      <tr>
        <td><label>Company Email</label></td>
        <td><?php echo $l->company_email; ?></td>
      </tr>
      <tr>
        <td><label>Latitude</label></td>
        <td><?php echo $l->latitude; ?></td>
      </tr>
      <tr>
        <td><label>Longitude</label></td>
        <td><?php echo $l->longitude; ?></td>
      </tr>
    </table>
    
    <div id="gmap">
      <!-- Check coords. -->
    </div>
    
    <div class="controls">
      <a href="<?php echo site_url('home/settings'); ?>" 
          title="Back">
        Back
      </a>
      <?php
        $user = $this->session->userdata('user');
        if(isset($user->id))
        {
      ?>
      <a href="<?php echo site_url('radius/update/' . $l->id); ?>" 
          title="Edit">Edit</a>
      <a href="<?php echo site_url('radius/delete/' . $l->id); ?>" 
          title="Delete">Delete</a>
      <?php
        }
      ?>
    </div>
</div>
<script>new Radius().initCrud();</script>