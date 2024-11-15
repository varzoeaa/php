<?php
function calculateIntegral($expression) {
    // split the expression into terms by + or - signs
    $terms = preg_split('/(?=\+|\-)/', str_replace(' ', '', $expression));

    $result = [];
    foreach ($terms as $term) {
        if (preg_match('/([+-]?\d*)x\^?(\d*)/', $term, $matches)) {
            $coefficient = $matches[1] ?: 1;
            $exponent = isset($matches[2]) ? (int)$matches[2] : 1;

            $newExponent = $exponent + 1;
            $newCoefficient = $coefficient / $newExponent;

            if ($newExponent == 1) {
                $result[] = "{$newCoefficient}x";
            } else {
                $result[] = "{$newCoefficient}x^{$newExponent}";
            }
        } elseif (preg_match('/([+-]?\d+)/', $term, $matches)) {
            // constant term (no x) has an implicit exponent of 1
            $coefficient = $matches[1];
            $result[] = "{$coefficient}x";
        }
    }

    return implode(' ', $result) . " + C";
}

if (isset($_POST['calculate'])) {
    $function = $_POST['function'];

    if (!empty($function)) {
        $integral = calculateIntegral($function);
        $result = "The integral of $function is: $integral";
    } else {
        $error = "Please enter a valid function.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integral Calculator</title>
    <link rel="stylesheet" href="integral.css">
</head>
<body>
    <div class="container">
        <h2>Integral Calculator</h2>
        <p>Enter a polynomial function to calculate its indefinite integral.</p>

        <form method="post">
            <label for="function">Function (e.g., 3x^2 + 2x - 5):</label>
            <input type="text" name="function" id="function" placeholder="Enter function" required>

            <button type="submit" name="calculate">Calculate Integral</button>
        </form>

        <?php if (isset($result)) { ?>
            <div class="result"><?php echo $result; ?></div>
        <?php } elseif (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</body>
</html>

