<?php
if (isset($_POST['calculate'])) {
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];

    // if 'a' is zero, then the equation is not linear
    if ($a == 0) {
        $error = "Coefficient 'a' cannot be zero.";
    } else {
        // calculate the solution
        $x = ($c - $b) / $a;
        $result = "The solution is x = $x";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linear Equation Solver</title>
    <link rel="stylesheet" href="linear.css">
</head>
<body>
    <div class="container">
        <h2>Linear Equation Solver</h2>
        <p>Solve equations in the form <strong>ax + b = c</strong></p>
        
        <form method="post">
            <input type="number" step="any" name="a" placeholder="Enter coefficient a" required>
            <input type="number" step="any" name="b" placeholder="Enter coefficient b" required>
            <input type="number" step="any" name="c" placeholder="Enter constant c" required>
            <button type="submit" name="calculate">Calculate x</button>
        </form>

        <?php if (isset($result)) { ?>
            <div class="result"><?php echo $result; ?></div>
        <?php } elseif (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</body>
</html>

