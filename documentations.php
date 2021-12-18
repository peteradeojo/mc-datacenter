<?php

require 'init.php';
$title = 'Documentations';

require 'header.php';
?>

<main>
  <div class="container">
    <h3 class="py-4">Documentations</h3>

    <table id="documentation-table">
      <thead>
        <tr>
          <th></th>
          <th>Hospital Number</th>
          <th>Name</th>
          <th>Date</th>
          <th>Weight</th>
          <th>Temperature</th>
          <th>Pulse</th>
          <th>Respiration</th>
          <th>Blood Pressure</th>
          <th>Complaints</th>
          <th>Diagnosis</th>
          <th>Tests</th>
          <th>Treatments</th>
          <th>Admission Summary</th>
          <th>Admission Date</th>
          <th>Discharge Date</th>
        </tr>
      </thead>
    </table>
  </div>
</main>

<?php
require 'footer.php';
