<?php

namespace Patient;

use Exception;
use Patient\Database;


// Engaging Saving patients data in MySQL Database
class Patient extends Database
{
  private $cxn;

  function __construct(array $data)
  {
    $this->category = $data['category'];
    $this->extractData($data);
    if ($this->category === 'antenatal') {
      $this->extractAntenatalData($data);
    }
    if (@$data['hmo-id']) {
      $this->extractInsuranceData($data);
    }
  }

  function extractData(array $data)
  {
    // print_r($data);
    $this->hospital_number = strtoupper($data['hosp-no']);
    $this->name = $data['name'];
    $this->gender = @$data['sex'];
    $this->birthdate = @$data['dob'];
    $this->religion = @$data['religion'];
    $this->marital_status = @$data['marital'];
    $this->state_of_origin = @$data['origin'];
    $this->tribe = @$data['tribe'];
    $this->email_address = @$data['email'];
    $this->phone_number = @$data['phone'];
    $this->occupation = @$data['occupation'];
    $this->address = @$data['address'];
    $this->notes = @$data['notes'];
  }

  function extractAntenatalData(array $data)
  {
    $this->history['gravidity'] = @$data['gravidity'];
    $this->history['parity'] = @$data['parity'];
  }

  function extractInsuranceData(array $data)
  {
    $this->insurance['hmo_id'] = @$data['hmo-id'];
    $this->insurance['company'] = @$data['company-name'];
    $this->insurance['hmo'] = @$data['hmo-name'];
    $this->insurance['authorization_code'] = @$data['auth-code'];
  }

  private function collate(bool $updating = false)
  {
    // $this
    $rowval = [
      'biodata' => [
        'hospital_number' => $this->hospital_number,
        'category' => $this->category,
        'name' => $this->name,
        'gender' => $this->gender,
        'birthdate' => $this->birthdate,
        'phone_number' => $this->phone_number,
        'email_address' => $this->email_address,
        'religion' => $this->religion,
        'marital_status' => $this->marital_status,
        'state_of_origin' => $this->state_of_origin,
        'tribe' => $this->tribe,
        'occupation' => $this->occupation,
        'address' => $this->address,
        'notes' => $this->notes
      ]
    ];

    if ($this->category === 'antenatal' and !$updating) {
      $rowval['antenatal_history'] = [
        'hospital_number' => $this->hospital_number,
        'gravidity' => $this->history['gravidity'],
        'parity' => $this->history['parity']
      ];
    }

    if (@$this->insurance) {
      $rowval['insurance_data'] = [
        'hospital_number' => $this->hospital_number,
        'hmo_id' => $this->insurance['hmo_id'],
        'company' => $this->insurance['company'],
        'hmo_name' => $this->insurance['hmo'],
        'authorization_code' => $this->insurance['authorization_code'],
      ];
    }

    return $rowval;
  }

  function save()
  {
    // Insert into Database
    try {
      $this->insert($this->collate());
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }

  function update(bool $conditional = false)
  {
    try {
      $id = $this->select('biodata', rows: '*', where: "name='$this->name' OR hospital_number='$this->hospital_number'")[0];
      $this->updateRecord($this->collate(updating: true), where: "id='$id[id]'", conditionalInsert: $conditional);
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }
}
