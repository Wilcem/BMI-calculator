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
