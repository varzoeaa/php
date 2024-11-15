<?php
function addPolynomials($poly1, $poly2) {
    $result = [];
    $maxDegree = max(count($poly1), count($poly2));
    
    for ($i = 0; $i < $maxDegree; $i++) {
        $coef1 = isset($poly1[$i]) ? $poly1[$i] : 0;
        $coef2 = isset($poly2[$i]) ? $poly2[$i] : 0;
        $result[$i] = $coef1 + $coef2;
    }
    return $result;
}

function subtractPolynomials($poly1, $poly2) {
    $result = [];
    $maxDegree = max(count($poly1), count($poly2));
    
    for ($i = 0; $i < $maxDegree; $i++) {
        $coef1 = isset($poly1[$i]) ? $poly1[$i] : 0;
        $coef2 = isset($poly2[$i]) ? $poly2[$i] : 0;
        $result[$i] = $coef1 - $coef2;
    }
    return $result;
}

function multiplyPolynomials($poly1, $poly2) {
    $result = array_fill(0, count($poly1) + count($poly2) - 1, 0);
    
    for ($i = 0; $i < count($poly1); $i++) {
        for ($j = 0; $j < count($poly2); $j++) {
            $result[$i + $j] += $poly1[$i] * $poly2[$j];
        }
    }
    return $result;
}

function formatPolynomial($poly) {
    $terms = [];
    $degree = count($poly) - 1;
    
    foreach ($poly as $i => $coef) {
        if ($coef == 0) continue;
        $power = $degree - $i;
        $term = ($coef < 0 ? " - " : " + ") . abs($coef);
        if ($power > 0) $term .= "x";
        if ($power > 1) $term .= "^" . $power;
        $terms[] = $term;
    }
    
    $polynomial = implode('', $terms);
    return ltrim($polynomial, '+ ');
}

if (isset($_POST['calculate'])) {
    $poly1 = array_map('intval', explode(',', $_POST['poly1']));
    $poly2 = array_map('intval', explode(',', $_POST['poly2']));
    $operation = $_POST['operation'];

    switch ($operation) {
        case "add":
            $resultPoly = addPolynomials($poly1, $poly2);
            break;
        case "subtract":
            $resultPoly = subtractPolynomials($poly1, $poly2);
            break;
        case "multiply":
            $resultPoly = multiplyPolynomials($poly1, $poly2);
            break;
        default:
            $error = "Invalid operation selected.";
            break;
    }

    if (!isset($error)) {
        $result = "Resulting Polynomial: " . formatPolynomial($resultPoly);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polynomial Calculator</title>
    <link rel="stylesheet" href="poly.css">
</head>
<body>
    <div class="container">
        <h2>Polynomial Calculator</h2>
        <p>Enter the coefficients of two polynomials and choose an operation</p>
        
        <form method="post">
            <label for="poly1">Polynomial 1 (coefficients separated by commas):</label>
            <input type="text" name="poly1" id="poly1" placeholder="e.g., 1,-2,-3,2 for 1x^3 - 2x^2 - 3x + 2" required>
            
            <label for="poly2">Polynomial 2 (coefficients separated by commas):</label>
            <input type="text" name="poly2" id="poly2" placeholder="e.g., 3,2,-1 for 3x^2 + 2x - 1" required>

            <label for="operation">Operation:</label>
            <select name="operation" id="operation" required>
                <option value="add">Addition</option>
                <option value="subtract">Subtraction</option>
                <option value="multiply">Multiplication</option>
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
