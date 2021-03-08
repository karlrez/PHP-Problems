<?php
/*
Problem 1 Solution.
Karl Rezansoff

Running on online fiddle: https://www.w3schools.com/php/phptryit.asp?filename=tryphp_compiler

Steps for algorithm: 
 -Sort array in ascending order.
 -For each thru the array and append to array with lowest sum.
*/

// Initialize array of players skills and sort in descending order
$rankingsArray = array(8,5,6,9,3,8,2,4,6,10,8,5,6,1,7,10,5,3,7,6);
rsort($rankingsArray);
$rankingsArraySum = array_sum($rankingsArray);

// Creating two arrays to represent each team
$team1Array = array();
$team2Array = array();
// Sum of array values for each team
$team1Sum = 0;
$team2Sum = 0;

// Algorithm
foreach ($rankingsArray as $value) {
	if ($team1Sum > $team2Sum) {
    	array_push($team2Array, $value);
        $team2Sum += $value;
    } else {
    	array_push($team1Array, $value);
        $team1Sum += $value;
    }
}

// Returns array as String
function arrayToString(array $array) {
	$stringArray = "";
    
	foreach ($array as $value) {
    $stringArray = $stringArray . $value.',';
	}
    return $stringArray;
}

?>

<!DOCTYPE html>
<html>
<body>

<?php
echo '<h1>Problem 1 Solution</h1>';
echo '<p> Skills array: [8,5,6,9,3,8,2,4,6,10,8,5,6,1,7,10,5,3,7,6] sum: '.$rankingsArraySum.'</p>';

echo '<p>Team 1: ['.arrayToString($team1Array).'] sum: '.$team1Sum.'</p>';
echo '<p>Team 2: ['.arrayToString($team2Array).'] sum: '.$team2Sum.'</p>';
?>

</body>
</html>


