<?php

// **Menyertakan file koneksi**
include 'BMI calculator.html';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Height = $_POST['height'];
    $HeightUnit = $_POST['heightUnit'];
    $Weight = $_POST['weight'];
    $WeightUnit = $_POST['weightUnit'];

    if ($Height == '' || $Weight == '' || $HeightUnit == '' || $WeightUnit == '') {
        $Error = "The input values are required.";
    } elseif (filter_var($Height, FILTER_VALIDATE_FLOAT) === false || filter_var($Weight, FILTER_VALIDATE_FLOAT) === false) {
        $Error = "The input value must be a number only.";
    } else {
        // Convert cm to inch -> foot to inch -> meter to inch
        $HInches = ($HeightUnit == 'centimeter') ? $Height * 0.393701 : (($HeightUnit == 'foot') ? $Height * 12 : (($HeightUnit == 'meter') ? $Height * 39.3700787 : $Height));

        // Convert kg to pound
        $WPound = ($WeightUnit == 'kilogram') ? $Weight * 2.2 : $Weight;

        $BMIIndex = round($WPound / ($HInches * $HInches) * 703, 2);

        // Set Message
        if ($BMIIndex < 18.5) {
            $Message = "Underweight";
        } elseif ($BMIIndex <= 24.9) {
            $Message = "Normal";
        } elseif ($BMIIndex <= 29.9) {
            $Message = "Overweight";
        } else {
            $Message = "Obese";
        }
    }
} else {
    $Error = "";
    $Message = "";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>BMI Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <h1>BMI Calculator</h1>
    <form method="post">
        <label for="height">Height:</label>
        <input type="number" id="height" name="height" required><br><br>
        <label for="heightUnit">Height Unit:</label>
        <select id="heightUnit" name="heightUnit">
            <option value="centimeter">Centimeter</option>
            <option value="foot">Foot</option>
            <option value="meter">Meter</option>
        </select><br><br>
        <label for="weight">Weight:</label>
        <input type="number" id="weight" name="weight" required><br><br>
        <label for="weightUnit">Weight Unit:</label>
        <select id="weightUnit" name="weightUnit">
            <option value="kilogram">Kilogram</option>
            <option value="pound">Pound</option>
        </select><br><br>
        <input type="submit" value="Calculate BMI">
    </form>

    <?php if (!empty($Error)) : ?>
        <p style="color: red;"><?php echo $Error; ?></p>
    <?php endif; ?>

    <?php if (!empty($Message)) : ?>
        <p>Your BMI is: <?php echo $BMIIndex; ?> and you are classified as <?php echo $Message; ?>.</p>
    <?php endif; ?>

