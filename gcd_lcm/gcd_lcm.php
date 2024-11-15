<?php
function gcd($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

function lcm($a, $b) {
    return ($a * $b) / gcd($a, $b);
}

if (isset($_POST['calculate'])) {
    $num1 = intval($_POST['num1']);
    $num2 = intval($_POST['num2']);
    
    if ($num1 > 0 && $num2 > 0) {
        $gcdResult = gcd($num1, $num2);
        $lcmResult = lcm($num1, $num2);
        $result = "GCD of $num1 and $num2 is: $gcdResult<br>LCM of $num1 and $num2 is: $lcmResult";
    } else {
        $error = "Please enter positive integers for both numbers.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCD and LCM Calculator</title>
    <link rel="stylesheet" href="gcd_lcm.css">
</head>
<body>
    <div class="container">
        <h2>GCD and LCM Calculator</h2>
        <p>Calculate the Greatest Common Divisor (GCD) and Least Common Multiple (LCM) of two numbers</p>
        <form method="post">
            <input type="number" name="num1" placeholder="Enter first number" required>
            <input type="number" name="num2" placeholder="Enter second number" required>
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
