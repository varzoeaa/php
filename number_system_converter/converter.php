<?php
if (isset($_POST['convert'])) {
    $inputNumber = $_POST['number'];
    $fromBase = $_POST['from_base'];
    $toBase = $_POST['to_base'];
    
    // validate the input number
    if (!ctype_alnum($inputNumber) || intval($inputNumber, $fromBase) == 0 && $inputNumber !== "0") {
        $error = "Please enter a valid number for the selected base.";
    } else {
        // convert to decimal first and then to the target base
        $decimalNumber = base_convert($inputNumber, $fromBase, 10);
        $convertedNumber = base_convert($decimalNumber, 10, $toBase);
        $result = "Converted number: $convertedNumber (Base $toBase)";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number System Converter</title>
    <link rel="stylesheet" href="converter.css">
</head>
<body>
    <div class="container">
        <h2>Number System Converter</h2>
        <p>Convert numbers between binary, decimal, octal, and hexadecimal systems.</p>
        
        <form method="post">
            <input type="text" name="number" placeholder="Enter number" required>
            
            <label for="from_base">From Base:</label>
            <select name="from_base" id="from_base" required>
                <option value="2">Binary (Base 2)</option>
                <option value="8">Octal (Base 8)</option>
                <option value="10">Decimal (Base 10)</option>
                <option value="16">Hexadecimal (Base 16)</option>
            </select>

            <label for="to_base">To Base:</label>
            <select name="to_base" id="to_base" required>
                <option value="2">Binary (Base 2)</option>
                <option value="8">Octal (Base 8)</option>
                <option value="10">Decimal (Base 10)</option>
                <option value="16">Hexadecimal (Base 16)</option>
            </select>

            <button type="submit" name="convert">Convert</button>
        </form>
        
        <?php if (isset($result)) { ?>
            <div class="result"><?php echo $result; ?></div>
        <?php } elseif (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</body>
</html>
