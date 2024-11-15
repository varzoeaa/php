<?php
function addMatrices($matrix1, $matrix2) {
    $result = [];
    for ($i = 0; $i < count($matrix1); $i++) {
        for ($j = 0; $j < count($matrix1[0]); $j++) {
            $result[$i][$j] = $matrix1[$i][$j] + $matrix2[$i][$j];
        }
    }
    return $result;
}

function subtractMatrices($matrix1, $matrix2) {
    $result = [];
    for ($i = 0; $i < count($matrix1); $i++) {
        for ($j = 0; $j < count($matrix1[0]); $j++) {
            $result[$i][$j] = $matrix1[$i][$j] - $matrix2[$i][$j];
        }
    }
    return $result;
}

function multiplyMatrices($matrix1, $matrix2) {
    $result = [];
    for ($i = 0; $i < count($matrix1); $i++) {
        for ($j = 0; $j < count($matrix2[0]); $j++) {
            $result[$i][$j] = 0;
            for ($k = 0; $k < count($matrix1[0]); $k++) {
                $result[$i][$j] += $matrix1[$i][$k] * $matrix2[$k][$j];
            }
        }
    }
    return $result;
}

if (isset($_POST['calculate'])) {
    $matrix1 = json_decode($_POST['matrix1'], true);
    $matrix2 = json_decode($_POST['matrix2'], true);
    $operation = $_POST['operation'];
    
    // Check for valid input sizes
    if ($operation == 'add' || $operation == 'subtract') {
        if (count($matrix1) != count($matrix2) || count($matrix1[0]) != count($matrix2[0])) {
            $error = "For addition and subtraction, both matrices must have the same dimensions.";
        } else {
            $resultMatrix = ($operation == 'add') ? addMatrices($matrix1, $matrix2) : subtractMatrices($matrix1, $matrix2);
        }
    } elseif ($operation == 'multiply') {
        if (count($matrix1[0]) != count($matrix2)) {
            $error = "For multiplication, the number of columns in Matrix 1 must equal the number of rows in Matrix 2.";
        } else {
            $resultMatrix = multiplyMatrices($matrix1, $matrix2);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrix Calculator</title>
    <link rel="stylesheet" href="matrix.css">
</head>
<body>
    <div class="container">
        <h2>Matrix Calculator</h2>
        <p>Enter two matrices in JSON format and select an operation (Addition, Subtraction, or Multiplication)</p>
        
        <form method="post">
            <h3>Matrix 1</h3>
            <textarea name="matrix1" placeholder="Enter Matrix 1 in JSON format (e.g., [[1,2],[3,4]])" required></textarea>
            
            <h3>Matrix 2</h3>
            <textarea name="matrix2" placeholder="Enter Matrix 2 in JSON format (e.g., [[5,6],[7,8]])" required></textarea>

            <h3>Select Operation</h3>
            <select name="operation" required>
                <option value="add">Addition</option>
                <option value="subtract">Subtraction</option>
                <option value="multiply">Multiplication</option>
            </select>

            <button type="submit" name="calculate">Calculate</button>
        </form>
        
        <?php if (isset($resultMatrix)) { ?>
            <h3>Result:</h3>
            <table>
                <?php foreach ($resultMatrix as $row) { ?>
                    <tr>
                        <?php foreach ($row as $value) { ?>
                            <td><?php echo $value; ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
        <?php } elseif (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</body>
</html>

