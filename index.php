<?php
require 'init.php';
require './header.php';
?>

<main>
  <div class="container">
    <div class="row py-4">
      <div class="col-9">
        <h3>Patient List</h3>
      </div>
      <div class="col-3">
        <a href="/newpatient.php" class="btn btn-dark">Add Patient</a>
      </div>
    </div>

    <table id="patients-table">
      <thead>
        <tr>
          <th></th>
          <th>Hospital No.</th>
          <th>Name</th>
          <th>Category</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</main>

<?php
require 'footer.php';
