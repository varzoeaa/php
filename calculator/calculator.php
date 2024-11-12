<?php
if (isset($_POST['calculate'])) { 
    $first = $_POST['first_number'];
    $second = $_POST['second_number'];
    $operation = $_POST['calculate'];

    if ($operation == "/" && ($first == 0 || $second == 0)) {
        $error = "Can't divide by zero";
    } else {
        switch ($operation) {
            case "+":
                $result = $first + $second;
                break;
            case "-":
                $result = $first - $second;
                break;
            case "x":
                $result = $first * $second;
                break;
            case "/":
                $result = $first / $second;
                break;
            default:
                $error = "Invalid operation";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Calculator in PHP</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="calculator.css">
</head>
<body>
<div class="calculator">
    <form method="post">
        <h2>Calculator</h2>
        <div class="display">
            <input type="text" name="first_number" placeholder="First Number" required value="<?php echo isset($first) ? $first : ''; ?>" pattern="[0-9]+" title="only numbers">
            <input type="text" name="second_number" placeholder="Second Number" required value="<?php echo isset($second) ? $second : ''; ?>" pattern="[0-9]+" title="only numbers">
        </div>
        <div class="buttons">
            <input type="submit" name="calculate" value="+" class="btn btn-primary">
            <input type="submit" name="calculate" value="-" class="btn btn-primary">
            <input type="submit" name="calculate" value="x" class="btn btn-primary">
            <input type="submit" name="calculate" value="/" class="btn btn-primary">
        </div>
        <?php if (isset($result) && is_numeric($result)): ?>
            <h4 class="result">Result: <?php echo $result; ?></h4>
        <?php elseif (isset($error)): ?>
            <h5 class="error">Error: <?php echo $error; ?></h5>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
