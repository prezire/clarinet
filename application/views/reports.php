<div id="reports">
  <h4>Reports</h4>  
  <div>
    <div class="row">
      <div class="large-4 medium-4 small-12 columns">
        <select class="vertical">
          <option>Vertical</option>
          <?php 
            $vs = $verticals->result();
            foreach($vs as $v)
            {
              echo '<option>' . $v->name . '</option>';
            }
          ?>
        </select>
      </div>
      <div class="large-4 medium-4 small-12 columns">
        <select class="type">
          <option>Report Type</option>
          <option>Frequency</option>
          <option>Frequency By Location</option>
          <option>Frequency By Network Carrier</option>
        </select>
      </div>
      <div class="large-4 medium-4 small-12 columns">
        <select class="dateType">
          <option>Date Type</option>
          <option>Yearly</option>
          <option>Monthly</option>
          <option>Daily</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="large-4 medium-4 small-12 columns">
        <input type="text" 
                name="dateFrom" 
                placeholder="Date From" 
                class="dateFrom" />
      </div>
      <div class="large-4 medium-4 small-12 columns">
        <input type="text" 
                name="dateTo" 
                placeholder="Date To" 
                class="dateTo" />
      </div>
      <div class="large-4 medium-4 small-12 columns">
        <ul>
          <li>
            <a href="#" class="btnGenerate" title="Generate">
              Generate
            </a>
          </li>
          <li>
            <a href="#" class="btnPrint" title="Print">
              Print
            </a>
          </li>
          <li>
            <a href="#" class="btnDownload" title="Download">
              Download
            </a>
          </li>
        </ul>
      </div>
    </div>
    
  </div>
  
  <div class="charts">
    <div class="chart">
      <div class="row">
        <div class="large-12 columns">
          <div id="chartData"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  new Report();
</script>