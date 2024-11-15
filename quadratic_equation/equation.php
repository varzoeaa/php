<?php
if (isset($_POST['calculate'])) {
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    
    // if 'a' is zero, then the equation is not quadratic
    if ($a == 0) {
        $error = "Coefficient 'a' cannot be zero.";
    } else {
        // calculate the discriminant
        $discriminant = $b * $b - 4 * $a * $c;

        // Determine the type of roots based on the discriminant
        switch (true) {
            case ($discriminant > 0):
                // two real and different roots
                $root1 = (-$b + sqrt($discriminant)) / (2 * $a);
                $root2 = (-$b - sqrt($discriminant)) / (2 * $a);
                $result = "Roots are real and distinct: x₁ = $root1, x₂ = $root2";
                break;

            case ($discriminant == 0):
                // one real root
                $root = -$b / (2 * $a);
                $result = "Roots are real and equal: x = $root";
                break;

            case ($discriminant < 0):
                // complex roots
                $realPart = -$b / (2 * $a);
                $imaginaryPart = sqrt(-$discriminant) / (2 * $a);
                $result = "Roots are complex: x₁ = $realPart + {$imaginaryPart}i, x₂ = $realPart - {$imaginaryPart}i";
                break;

            default:
                $error = "Unexpected error in calculation.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quadratic Equation Solver</title>
    <link rel="stylesheet" href="equation.css">
</head>
<body>
    <div class="container">
        <h2>Quadratic Equation Solver</h2>
        <p>Solve equations in the form of <strong>ax² + bx + c = 0</strong></p>
        <form method="post">
            <input type="number" step="any" name="a" placeholder="Enter coefficient a" required>
            <input type="number" step="any" name="b" placeholder="Enter coefficient b" required>
            <input type="number" step="any" name="c" placeholder="Enter coefficient c" required>
            <button type="submit" name="calculate">Calculate Roots</button>
        </form>
        <?php if (isset($result)) { ?>
            <div class="result"><?php echo $result; ?></div>
        <?php } elseif (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</body>
</html>
