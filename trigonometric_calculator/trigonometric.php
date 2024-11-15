<?php
if (isset($_POST['calculate'])) {
    $angle = floatval($_POST['angle']);
    $unit = $_POST['unit'];
    $function = $_POST['function'];

    // radians = degrees * pi / 180
    if ($unit === "degrees") {
        $angle = deg2rad($angle);
    }

    // calculate trigonometric function
    switch ($function) {
        case "sin":
            $result = sin($angle);
            break;
        case "cos":
            $result = cos($angle);
            break;
        case "tan":
            if (cos($angle) == 0) {
                $error = "Tangent is undefined for this angle.";
            } else {
                $result = tan($angle);
            }
            break;
        case "sec":
            if (cos($angle) == 0) {
                $error = "Secant is undefined for this angle.";
            } else {
                $result = 1 / cos($angle);
            }
            break;
        case "csc":
            if (sin($angle) == 0) {
                $error = "Cosecant is undefined for this angle.";
            } else {
                $result = 1 / sin($angle);
            }
            break;
        case "cot":
            if (sin($angle) == 0) {
                $error = "Cotangent is undefined for this angle.";
            } else {
                $result = 1 / tan($angle);
            }
            break;
        default:
            $error = "Invalid function selected.";
    }

    if (!isset($error)) {
        $result = "The result of $function($angle) is: " . round($result, 4);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trigonometric Calculator</title>
    <link rel="stylesheet" href="trigonometric.css">
</head>
<body>
    <div class="container">
        <h2>Trigonometric Calculator</h2>
        <p>Calculate trigonometric functions for a given angle</p>

        <form method="post">
            <input type="number" step="any" name="angle" placeholder="Enter angle" required>
            
            <label for="unit">Angle Unit:</label>
            <select name="unit" id="unit" required>
                <option value="degrees">Degrees</option>
                <option value="radians">Radians</option>
            </select>

            <label for="function">Function:</label>
            <select name="function" id="function" required>
                <option value="sin">Sine (sin)</option>
                <option value="cos">Cosine (cos)</option>
                <option value="tan">Tangent (tan)</option>
                <option value="sec">Secant (sec)</option>
                <option value="csc">Cosecant (csc)</option>
                <option value="cot">Cotangent (cot)</option>
            </select>

            <button type="submit" name="calculate">Calculate</button>
        </form>

        <?php if (isset($result)) { ?>
            <div class="result"><?php echo $result; ?></div>
        <?php } elseif (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</body>
</html>
