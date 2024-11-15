<?php

function calculateDerivative($expression) {
    // split the expression into terms by + or - signs
    $terms = preg_split('/(?=\+|\-)/', str_replace(' ', '', $expression));

    $result = [];
    foreach ($terms as $term) {
        // match the coefficient and exponent of the term
        if (preg_match('/([+-]?\d*)x\^?(\d*)/', $term, $matches)) {
            $coefficient = $matches[1] ?: 1;
            $exponent = isset($matches[2]) ? (int)$matches[2] : 1;

            // calculate the derivative of the term
            $newCoefficient = $coefficient * $exponent;
            $newExponent = $exponent - 1;

            if ($newExponent == 0) {
                $result[] = $newCoefficient;
            } elseif ($newExponent == 1) {
                $result[] = "{$newCoefficient}x";
            } else {
                $result[] = "{$newCoefficient}x^{$newExponent}";
            }
        } elseif (preg_match('/([+-]?\d+)/', $term, $matches)) {
            // if the term is a constant number (no x)
            continue;
        }
    }

    return implode(' ', $result);
}

if (isset($_POST['calculate'])) {
    $function = $_POST['function'];

    if (!empty($function)) {
        $derivative = calculateDerivative($function);
        $result = "The derivative of $function is: $derivative";
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
    <title>Derivative Calculator</title>
    <link rel="stylesheet" href="derivative.css">
</head>
<body>
    <div class="container">
        <h2>Derivative Calculator</h2>
        <p>Enter a polynomial function to calculate its derivative.</p>

        <form method="post">
            <label for="function">Function (e.g., 3x^2 + 2x - 5):</label>
            <input type="text" name="function" id="function" placeholder="Enter function" required>

            <button type="submit" name="calculate">Calculate Derivative</button>
        </form>

        <?php if (isset($result)) { ?>
            <div class="result"><?php echo $result; ?></div>
        <?php } elseif (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</body>
</html>
