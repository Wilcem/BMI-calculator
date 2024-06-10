<?php

class BMICalculator {
  private $height;
  private $weight;
  private $birthdate;
  private $gender;

  public function __construct($height, $weight, $birthdate, $gender) {
    $this->height = $height;
    $this->weight = $weight;
    $this->birthdate = $birthdate;
    $this->gender = $gender;
  }

  public function calculateBMI() {
    $bmi = ($this->weight / ($this->height * 0.01 * $this->height * 0.01));
    return $bmi;
  }

  public function calculateAge() {
    $birthDate = new DateTime($this->birthdate);
    $currentDate = new DateTime();
    $age = $birthDate->diff($currentDate)->y;
    return $age;
  }

  public function getGender() {
    return $this->gender;
  }

  public function getBMIStatus() {
    $bmi = $this->calculateBMI();
    if ($bmi < 18.5) {
      return 'Berat badan kurang';
    } elseif ($bmi >= 18.5 && $bmi < 25) {
      return 'Berat badan normal';
    } elseif ($bmi >= 25 && $bmi < 30) {
      return 'Obesitas';
    } else {
      return 'Obesitas';
    }
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Kalkulator BMI</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    h2 {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="date"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .result {
      margin-top: 20px;
      padding: 10px;
      background-color: #f2f2f2;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Kalkulator BMI</h2>
    <form method="post" action="">
      <label>Tinggi (cm):</label>
      <input type="text" name="height" placeholder="Masukkan tinggi Anda">
      <label>Berat (kg):</label>
      <input type="text" name="weight" placeholder="Masukkan berat Anda">
      <label>Tanggal Lahir:</label>
      <input type="date" name="birthdate" placeholder="Masukkan tanggal lahir Anda">
      <label>Jenis Kelamin:</label>
      <select name="gender">
        <option value="male">Laki-laki</option>
        <option value="female">Perempuan</option>
      </select>
      <input type="submit" value="Hitung BMI">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $height = $_POST['height'];
      $weight = $_POST['weight'];
      $birthdate = $_POST['birthdate'];
      $gender = $_POST['gender'];

      $calculator = new BMICalculator($height, $weight, $birthdate, $gender);

      echo '<div class="result">';
      echo '<h3>Hasil</h3>';
      echo '<p>BMI Anda: ' . $calculator->calculateBMI() . '</p>';
      echo '<p>Status: ' . $calculator->getBMIStatus() . '</p>';
      echo '<p>Umur Anda: ' . $calculator->calculateAge() . ' tahun</p>';
      echo '<p>Jenis Kelamin: ' . $calculator->getGender() . '</p>';
      echo '</div>';
    }
    ?>
  </div>
</body>

</html>