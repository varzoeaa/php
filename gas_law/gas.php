<?php
function calculateIdealGasLaw($knownValues, $pressureUnit, $volumeUnit) {
    // Set ideal gas constant for Pascal and m³
    $R = 8.314; // Ideal gas constant in Pa·m³/(mol·K)

    // Convert inputs to common units (Pa for pressure, m³ for volume)
    $pressure = isset($knownValues['pressure']) ? floatval($knownValues['pressure']) : null;
    $volume = isset($knownValues['volume']) ? floatval($knownValues['volume']) : null;
    $moles = isset($knownValues['moles']) ? floatval($knownValues['moles']) : null;
    $temperature = isset($knownValues['temperature']) ? floatval($knownValues['temperature']) : null;

    // Adjust for pressure unit
    if ($pressureUnit === 'atm' && !is_null($pressure)) {
        $pressure *= 101325; // Convert atm to Pa
    }

    // Adjust for volume unit
    if ($volumeUnit === 'L' && !is_null($volume)) {
        $volume /= 1000; // Convert L to m³
    }

    // Calculate the unknown value based on the ideal gas law formula
    if (is_null($pressure)) {
        $pressure = ($moles * $R * $temperature) / $volume;
        $result = "Calculated Pressure: " . round($pressure, 2) . " Pa";
    } elseif (is_null($volume)) {
        $volume = ($moles * $R * $temperature) / $pressure;
        $result = "Calculated Volume: " . round($volume, 2) . " m³";
    } elseif (is_null($temperature)) {
        $temperature = ($pressure * $volume) / ($moles * $R);
        $result = "Calculated Temperature: " . round($temperature, 2) . " K";
    } elseif (is_null($moles)) {
        $moles = ($pressure * $volume) / ($R * $temperature);
        $result = "Calculated Moles: " . round($moles, 2) . " mol";
    } else {
        $result = "Please leave one field empty for calculation.";
    }

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $knownValues = [
        'pressure' => $_POST['pressure'] ?? null,
        'volume' => $_POST['volume'] ?? null,
        'moles' => $_POST['moles'] ?? null,
        'temperature' => $_POST['temperature'] ?? null,
    ];

    $pressureUnit = $_POST['pressure_unit'];
    $volumeUnit = $_POST['volume_unit'];
    
    $result = calculateIdealGasLaw($knownValues, $pressureUnit, $volumeUnit);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ideal Gas Law Calculator</title>
    <link rel="stylesheet" href="gas.css">
</head>
<body>
    <div class="container">
        <h2>Ideal Gas Law Calculator</h2>
        <p>Use the ideal gas law equation \( PV = nRT \) to solve for one missing variable. Supports SI.</p>

        <form method="post">
            <div class="form-group">
                <label for="pressure">Pressure:</label>
                <input type="number" step="any" name="pressure" id="pressure" placeholder="Leave blank to calculate">
                <select name="pressure_unit">
                    <option value="Pa">Pa</option>
                    <option value="atm">atm</option>
                </select>
            </div>

            <div class="form-group">
                <label for="volume">Volume:</label>
                <input type="number" step="any" name="volume" id="volume" placeholder="Leave blank to calculate">
                <select name="volume_unit">
                    <option value="m³">m³</option>
                    <option value="L">L</option>
                </select>
            </div>

            <div class="form-group">
                <label for="moles">Moles (mol):</label>
                <input type="number" step="any" name="moles" id="moles" placeholder="Leave blank to calculate">
            </div>

            <div class="form-group">
                <label for="temperature">Temperature (K):</label>
                <input type="number" step="any" name="temperature" id="temperature" placeholder="Leave blank to calculate">
            </div>

            <button type="submit">Calculate</button>
        </form>

        <?php if (isset($result)) { ?>
            <div class="result">
                <h3>Result:</h3>
                <p><?php echo $result; ?></p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
