<?php
// Start a session
session_start();

// Check if the user is a student
if ($_SESSION['user_type'] != 'student') {
	header("Location: dashboard.php");
	exit;
}

// Define an array of math problems and answers
$math_problems = [
    ['problem' => '2 + 2', 'answer' => 4],
    ['problem' => '5 - 3', 'answer' => 2],
    ['problem' => '6 * 8', 'answer' => 48],
    ['problem' => '15 / 3', 'answer' => 5],
    ['problem' => '9 + 6 - 3', 'answer' => 12]
];

// Get a random math problem from the array
$random_problem = $math_problems[array_rand($math_problems)];

// Check if the user submitted an answer
if (isset($_POST['answer'])) {
    $user_answer = $_POST['answer'];

    // Check if the user's answer is correct
    if ($user_answer == $random_problem['answer']) {
        // Increase the user's score by 1
        $_SESSION['score']++;
        // Get a new random math problem
        $random_problem = $math_problems[array_rand($math_problems)];
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Practice Academy</title>
</head>
<body>
	<h1>Practice Academy</h1>
	<p>Answer the following math problem:</p>
	<form method="post">
		<label><?= $random_problem['problem'] ?> = </label>
		<input type="text" name="answer">
		<button type="submit">Submit</button>
	</form>
	<p>Your current score: <?= $_SESSION['score'] ?? 0 ?></p>
</body>
</html>
