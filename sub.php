<html>
<font size="18"><a href="index.php">craigscan</a></font><br><br>
</html>

<?php
	$phone = $_POST['phone'];
	$location = $_POST['location'];
	$search = $_POST['search'];
	$category = $_POST['category'];
	$nearby = $_POST['nearby'];
	$price =  $_POST['price'];
	$carrier = $_POST['carrier'];
	if (strlen((int) $phone) != 10){
		echo "Invalid phone number. <a href=index.php>Go back</a>";
		return;
	}
	if (strlen((int) $price) != strlen($price)){
		echo "Invalid price. <a href=index.php>Go back</a>";
		return;
	}
	if (strlen($search) == 0){
		echo "You must search something! <a href=index.php>Go back</a>";
		return;
	}
	
	$db_connection = mysql_connect("localhost", "asdf", "asdf");
	mysql_select_db("craig", $db_connection);
	$query = "INSERT INTO users (phone, location, search, category, nearby, price, sent, carrier) VALUES(";
	$query = $query . $phone . ", ";
	$query = $query . "'" . $location . "', ";
	$query = $query . "'" . $search . "', ";
	$query = $query . "'" . $category . "', ";
	if ($nearby == "yes")
		$query = $query . "TRUE, ";
	else
		$query = $query . "FALSE, ";
	$query = $query . $price . ", ";
	$query = $query . "FALSE, '";
	$query = $query . $carrier . "');";
	$rs = mysql_query($query, $db_connection);
	echo "Successful! You will receive a text message when a listing matching the keywords '";
	echo "<b>" . $search . "</b>" . "' is available.";
	mysql_close($db_connection);
?>
