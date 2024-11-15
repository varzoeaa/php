<?php
if (isset($_POST['calculate'])) {
    $event_type = isset($_POST['event_type']) ? $_POST['event_type'] : '';   // get selected event type or default to empty string

    if ($event_type == "simple") {
        // simple probability: P(A) = favorable outcomes / total outcomes
        $favorable = intval($_POST['favorable']);
        $total = intval($_POST['total']);
        
        if ($favorable < 0 || $total <= 0 || $favorable > $total) {
            $error = "Please enter a valid number of outcomes for simple probability.";
        } else {
            $probability = $favorable / $total;
            $percentage = round($probability * 100, 2);
            $result = "The probability of the event is: $probability (or $percentage%)";
        }

    } elseif ($event_type == "independent") {
        // independent events: P(A and B) = P(A) * P(B)
        $prob_a = floatval($_POST['prob_a']);
        $prob_b = floatval($_POST['prob_b']);
        
        if ($prob_a < 0 || $prob_a > 1 || $prob_b < 0 || $prob_b > 1) {
            $error = "Please enter valid probabilities for independent events.";
        } else {
            $result_probability = $prob_a * $prob_b;
            $percentage = round($result_probability * 100, 2);
            $result = "The probability of both independent events occurring is: $result_probability (or $percentage%)";
        }

    } elseif ($event_type == "dependent") {
        // dependent events: P(A and B) = P(A) * P(B|A)
        $prob_a = floatval($_POST['prob_a']);
        $prob_b_given_a = floatval($_POST['prob_b_given_a']);
        
        if ($prob_a < 0 || $prob_a > 1 || $prob_b_given_a < 0 || $prob_b_given_a > 1) {
            $error = "Please enter valid probabilities for dependent events.";
        } else {
            $result_probability = $prob_a * $prob_b_given_a;
            $percentage = round($result_probability * 100, 2);
            $result = "The probability of both dependent events occurring is: $result_probability (or $percentage%)";
        }

    } elseif ($event_type == "conditional") {
        // conditional probability: P(B|A) = P(A and B) / P(A)
        $prob_a_and_b = floatval($_POST['prob_a_and_b']);
        $prob_a = floatval($_POST['prob_a']);
        
        if ($prob_a <= 0 || $prob_a > 1 || $prob_a_and_b < 0 || $prob_a_and_b > $prob_a) {
            $error = "Please enter valid probabilities for conditional probability.";
        } else {
            $conditional_prob = $prob_a_and_b / $prob_a;
            $percentage = round($conditional_prob * 100, 2);
            $result = "The conditional probability of B given A is: $conditional_prob (or $percentage%)";
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complex Probability Calculator</title>
    <link rel="stylesheet" href="probability.css">
    <script>
        function toggleInputs() {
            var eventType = document.getElementById("event_type").value;
            document.getElementById("simple_inputs").style.display = eventType == "simple" ? "block" : "none";
            document.getElementById("independent_inputs").style.display = eventType == "independent" ? "block" : "none";
            document.getElementById("dependent_inputs").style.display = eventType == "dependent" ? "block" : "none";
            document.getElementById("conditional_inputs").style.display = eventType == "conditional" ? "block" : "none";
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Complex Probability Calculator</h2>
        <p>Calculate probabilities for simple, independent, dependent, and conditional events.</p>

        <form method="post">
            <label for="event_type">Select Event Type:</label>
            <select id="event_type" name="event_type" onchange="toggleInputs()" required>
                <option value="simple">Simple Probability</option>
                <option value="independent">Independent Events</option>
                <option value="dependent">Dependent Events</option>
                <option value="conditional">Conditional Probability</option>
            </select>

            <div id="simple_inputs" style="display: block;">
                <input type="number" name="favorable" placeholder="Favorable outcomes" min="0">
                <input type="number" name="total" placeholder="Total outcomes" min="1">
            </div>

            <div id="independent_inputs" style="display: none;">
                <input type="number" step="any" name="prob_a" placeholder="Probability of A (0-1)" min="0" max="1">
                <input type="number" step="any" name="prob_b" placeholder="Probability of B (0-1)" min="0" max="1">
            </div>

            <div id="dependent_inputs" style="display: none;">
                <input type="number" step="any" name="prob_a" placeholder="Probability of A (0-1)" min="0" max="1">
                <input type="number" step="any" name="prob_b_given_a" placeholder="Probability of B given A (0-1)" min="0" max="1">
            </div>

            <div id="conditional_inputs" style="display: none;">
                <input type="number" step="any" name="prob_a_and_b" placeholder="Probability of A and B (0-1)" min="0" max="1">
                <input type="number" step="any" name="prob_a" placeholder="Probability of A (0-1)" min="0" max="1">
            </div>

            <button type="submit" name="calculate">Calculate Probability</button>
        </form>

        <?php if (isset($result)) { ?>
            <div class="result"><?php echo $result; ?></div>
        <?php } elseif (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</body>
</html>


