	<?php
	include_once('config.php');
	include 'services.php';

	//Action to insert the data
	if ($_POST['action'] && $_POST['action'] == 'add_data') {

		$a_table = $_POST['a_table'];
		$b_table = $_POST['b_table'];
		$c_table = $_POST['c_table'];


		$minLength = 1;
		$maxLength = 255;
		if ($a_table) {

			$valueStrLen = strlen($a_table);
			if ($valueStrLen < $minLength) {

				$errormsg =  "minimum is $minLength characters ($maxLength max).";
				$response = array('error' => $errormsg, 'value' => 0);
				echo json_encode($response);
				exit();
			} elseif ($valueStrLen > $maxLength) {
				$errormsg =  "maximum is $maxLength characters.";
				$response = array('error' => $errormsg, 'value' => 0);
				echo json_encode($response);
				exit();
			}

			$table_name = 'a';
			$data_values['name'] = $a_table;
			$last_id = insert($table_name, $data_values, $conn);
			if ($last_id) {
				$flag = 1;
			}
		} elseif ($b_table) {

			if (preg_match('#[^0-9]#', $b_table)) {
				$errormsg =  "Value is not a number";
				$response = array('error' => $errormsg, 'value' => 0);
				echo json_encode($response);
				exit();
			}

			$table_name = 'b';
			$data_values['name'] = $b_table;
			$last_id = insert($table_name, $data_values, $conn);
			if ($last_id) {
				$flag = 1;
			}
		} elseif ($c_table) {

			$valueStrLen = strlen($c_table);
			if ($valueStrLen < $minLength) {

				$errormsg =  "minimum is $minLength characters ($maxLength max).";
				$response = array('error' => $errormsg, 'value' => 0);
				echo json_encode($response);
				exit();
			} elseif ($valueStrLen > $maxLength) {
				$errormsg =  "maximum is $maxLength characters.";
				$response = array('error' => $errormsg, 'value' => 0);
				echo json_encode($response);
				exit();
			}

			$table_name = 'c';
			$data_values['name'] = $c_table;
			$last_id = insert($table_name, $data_values, $conn);
			if ($last_id) {
				$flag = 1;
			}
		}

		if ($flag == 1) {
			$msg = "success";
			$data = "1";
			$response = array('success' => $msg, 'value' => $data);
			echo json_encode($response);
		}
	}

	//Action to show the data of table a
	if ($_POST['action'] && $_POST['action'] == 'btn_a') {

		$query = "SELECT id,name from a";
		$result = mysqli_query($conn, $query);
		$rows = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$rows[] = $row;
			}
		}
		$json = json_encode($rows);
		echo $json;
	}

	//Action to show the data of table a,b,c
	if ($_POST['action'] && $_POST['action'] == 'btn_abc') {
		$query = "SELECT id,name FROM a  UNION SELECT id,name FROM b UNION SELECT id,name FROM c";
		$result = mysqli_query($conn, $query);
		$rows = array();
		if ($result) {
			$i = 1;
			while ($row = mysqli_fetch_assoc($result)) {
				$rows[] = array(
					"id" => $i,
					"name" => $row['name']
				);
				$i++;
			}
		}
		$json = json_encode($rows);
		echo $json;
	}

	//Action to show the data of table c,b
	if ($_POST['action'] && $_POST['action'] == 'btn_cb') {
		$query = "SELECT id,name FROM c  UNION SELECT id,name FROM b";
		$result = mysqli_query($conn, $query);
		$rows = array();
		if ($result) {
			$i = 1;
			while ($row = mysqli_fetch_assoc($result)) {
				$rows[] = array(
					"id" => $i,
					"name" => $row['name']
				);
				$i++;
			}
		}
		$json = json_encode($rows);
		echo $json;
	}

	//Action to show the data of table b in asc order
	if ($_POST['action'] && $_POST['action'] == 'btn_basc') {
		$query = "SELECT id,name FROM b";
		$result = mysqli_query($conn, $query);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$rows[] = $row;
			}
		}
		$json = json_encode($rows);
		echo $json;
	}

	//Action to show the data of table b in desc order
	if ($_POST['action'] && $_POST['action'] == 'btn_bdesc') {
		$query = "SELECT id,name FROM b ORDER BY id DESC";
		$result = mysqli_query($conn, $query);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$rows[] = $row;
			}
		}
		$json = json_encode($rows);
		echo $json;
	}
