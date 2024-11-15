<?php
function calculateWaveSpeed($frequency, $wavelength) {
    return $frequency * $wavelength;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $frequency = isset($_POST['frequency']) ? floatval($_POST['frequency']) : null;
    $wavelength = isset($_POST['wavelength']) ? floatval($_POST['wavelength']) : null;

    if ($frequency && $wavelength) {
        $waveSpeed = calculateWaveSpeed($frequency, $wavelength);
        $result = "Calculated Wave Speed: " . round($waveSpeed, 2) . " m/s";
    } else {
        $error = "Please enter valid values for both frequency and wavelength.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wave Speed Calculator</title>
    <link rel="stylesheet" href="wave.css">
</head>
<body>
    <div class="container">
        <h2>Wave Speed Calculator</h2>
        <p>Calculate the speed of a wave using the formula \( v = f \lambda \), where \( v \) is wave speed, \( f \) is frequency, and \( \lambda \) is wavelength.</p>

        <form method="post">
            <div class="form-group">
                <label for="frequency">Frequency (Hz):</label>
                <input type="number" step="any" name="frequency" id="frequency" placeholder="Enter frequency in Hz" required>
            </div>

            <div class="form-group">
                <label for="wavelength">Wavelength (m):</label>
                <input type="number" step="any" name="wavelength" id="wavelength" placeholder="Enter wavelength in meters" required>
            </div>

            <button type="submit">Calculate Wave Speed</button>
        </form>

        <?php if (isset($result)) { ?>
            <div class="result">
                <h3>Result:</h3>
                <p><?php echo $result; ?></p>
            </div>
        <?php } elseif (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <div class="examples">
            <h3>Example Wave Speeds:</h3>
            <ul>
                <li>Sound in air (20°C): 343 m/s</li>
                <li>Light in a vacuum: 3 x 10<sup>8</sup> m/s</li>
                <li>Water waves: approximately 1.5 m/s</li>
            </ul>
        </div>
    </div>
</body>
</html>
