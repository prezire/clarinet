<div id="verticals" class="verticals reveal-modal" data-reveal>
  <h4>What's the nature of your business?</h4>
  <div class="row">
    <ul class="columns small-block-grid-1 medium-block-grid-2 large-block-grid-4">
      <?php
        $vs = $verticals->result();
        if(isset($savedVerticals))
        {
          //KLUDGE: CI doesn't render multiple CBs properly.
          //Using our own custom default checked values during radius update.
          foreach($vs as $v)
          {
            $s = $v->name;
            $b = in_array($s, $savedVerticals);
            $t = form_checkbox('verticals[]', $s, $b);
            echo "<li>$t<label>$s</label></li>";
          }
        }
        else
        {
          //BUG: Validation erases selected list during create.
          foreach($vs as $v)
          {
            $s = $v->name;
            $t = form_checkbox('verticals[]', $s);
            echo "<li>$t<label>$s</label></li>";
          }
        }
      ?>
    </ul>
  </div>
  <a class="close-reveal-modal">&#215;</a>
</div>