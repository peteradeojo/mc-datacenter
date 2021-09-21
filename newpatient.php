<?php

require 'init.php';

$title = 'New Patient';
require 'header.php';
?>

<main>
  <div class="container pt-4">
    <h3>Register a New Casenote</h3>

    <div>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="regular-tab" data-bs-toggle="tab" data-bs-target="#regular" type="button" role="tab" aria-controls="regular" aria-selected="true">Regular</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="antenatal-tab" data-bs-toggle="tab" data-bs-target="#antenatal" type="button" role="tab" aria-controls="antenatal" aria-selected="false">Antenatal</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="family-tab" data-bs-toggle="tab" data-bs-target="#family" type="button" role="tab" aria-controls="family" aria-selected="false">Family</button>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane active container p-3" id="regular" role="tabpanel" aria-labelledby="regular-tab">
          <form action="/process/newpatient.php" method="post">
            <fieldset class="row border py-3">
              <legend>Biodata</legend>
              <div class="form-group col-sm-6 col-md-3">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control" required>
                  <option value="adult">Adult</option>
                  <option value="nhis">NHIS</option>
                  <option value="pediatrics">Pediatrics</option>
                  <option value="fertility">Fertility</option>
                  <option value="family">Family</option>
                </select>
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="hospital-no">Hospital Number</label>
                <input type="text" name="hosp-no" id="hospital-no" class="form-control" required>
              </div>
              <div class="form-group col-sm-6 col-md-5">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required="required" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="sex">Sex</label>
                <select name="sex" id="sex" required="required" class="form-control">
                  <option value="1">Male</option>
                  <option value="0">Female</option>
                </select>
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="origin">State of Origin</label>
                <input type="text" name="origin" id="origin" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="tribe">Tribe</label>
                <input type="text" name="tribe" id="tribe" class="form-control">
              </div>
              <div class="form-group col-12">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="religion">Religion</label>
                <select name="religion" id="religion" class="form-control">
                  <option value="Christianity">Christianity</option>
                  <option value="Muslim">Muslim</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="marital">Marital Status</label>
                <select name="marital" id="marital" class="form-control">
                  <option value="Single">Single</option>
                  <option value="Married">Married</option>
                  <option value="Divorced">Divorced</option>
                </select>
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="occupation">Occupation</label>
                <input type="text" name="occupation" id="occupation" class="form-control">
              </div>
              <div class="form-group col-sm-6">
                <label for="email">E-mail Address</label>
                <input type="email" name="email" id="email" class="form-control">
              </div>
              <div class="form-group col-sm-6">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control">
              </div>
              <div class="form-group col-sm-6">
                <label for="notes">Notes</label>
                <input type="text" name="notes" id="notes" class="form-control">
              </div>
            </fieldset>

            <fieldset class="row py-3 mt-4 border">
              <legend>Health Insurance Info</legend>
              <div class="form-group col-sm-6 col-md-4">
                <label for="company-name">Company/Organization Name</label>
                <input type="text" name="company-name" id="company-name" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="hmo-name">HMO Name</label>
                <input type="text" name="hmo-name" id="hmo-name" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="hmo-id">HMO Identification No</label>
                <input type="text" name="hmo-id" id="hmo-id" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="auth-code">Authorization Code</label>
                <input type="text" name="auth-code" id="auth-code" class="form-control">
              </div>
            </fieldset>
            <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>

        <!-- Antenatal Patients form -->
        <div class="tab-pane container p-3" id="antenatal" role="tabpanel" aria-labelledby="antenatal-tab">
          <form action="/process/newpatient.php" method="post" class="row">
            <fieldset class="row border py-3">
              <legend>Patient Biodata</legend>
              <div class="form-group col-sm-6 col-md-3">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" readonly="readonly" value="Antenatal" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="hospital-no">Hospital Number</label>
                <input type="text" name="hosp-no" id="hospital-no" class="form-control" required>
              </div>
              <div class="form-group col-sm-6 col-md-5">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required="required" class="form-control">
              </div>

              <div class="form-group col-sm-6 col-md-2">
                <label for="sex">Sex</label>
                <!-- <input type="text" name="sex" id="sex" readonly="readonly" required="required" value="0" class="form-control"> -->
                <select name="sex" id="sex" readonly="readonly" required="required" class="form-control">
                  <option value="0" selected>female</option>
                </select>
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="origin">Place of Origin</label>
                <input type="text" name="origin" id="origin" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="tribe">Tribe</label>
                <input type="text" name="tribe" id="tribe" class="form-control">
              </div>
              <div class="form-group col-12 col-md-9">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="religion">Religion</label>
                <select name="religion" id="religion" class="form-control">
                  <option value="christian">Christian</option>
                  <option value="islam">Islam</option>
                  <option value="traditional">Traditional</option>
                </select>
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="marital">Marital Status</label>
                <select name="marital" id="marital" class="form-control">
                  <option value="single">Single</option>
                  <option value="married">Married</option>
                  <option value="divorced">Divorced</option>
                </select>
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="occupation">Occupation</label>
                <input type="text" name="occupation" id="occupation" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="email">E-mail Address</label>
                <input type="email" name="email" id="email" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control">
              </div>
            </fieldset>
            <fieldset class="row py-3 my-5 border">
              <legend>Health Insurance</legend>
              <div class="form-group col-sm-6 col-md-4">
                <label for="company-name">Company/Organization Name</label>
                <input type="text" name="company-name" id="company-name" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="hmo-name">HMO Name</label>
                <input type="text" name="hmo-name" id="hmo-name" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="hmo-id">HMO Identification No</label>
                <input type="text" name="hmo-id" id="hmo-id" class="form-control">
              </div>
              <div class="form-group col-sm-6 col-md-3">
                <label for="auth-code">Authorization Code</label>
                <input type="text" name="auth-code" id="auth-code" class="form-control">
              </div>
            </fieldset>
            <fieldset class="row py-3 border">
              <legend>History</legend>
              <div class="form-group col-sm-6">
                <label for="gravidity">Gravidity</label>
                <input type="number" name="gravidity" id="gravidity" class="form-control" required="required">
              </div>
              <div class="form-group col-sm-6">
                <label for="parity">Parity</label>
                <input type="number" name="parity" id="parity" class="form-control" required="required">
              </div>
              <div class="form-group col-sm-6">

              </div>
            </fieldset>
            <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>

      </div>
    </div>

  </div>
</main>

<?php
require 'footer.php';
