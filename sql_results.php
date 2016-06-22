<h1>This is result SQLinjection web page</h1>
<?php
  if(isset($_POST["submit"])) {
    echo "Searching: " . $_POST['mySearch'] . '<br>';
    $search  = $_POST['mySearch'];
    searchInDB($_POST['mySearch']);
  }
  else {
    echo "No Form searchs";
  }

  function searchInDB($s) {
    include '../hack/db_config.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    $conn->set_charset("utf8");

    if(!$conn->connect_error) {
      $sqlQuery = "SELECT * FROM m_events WHERE e_title='$s';";
      echo "<br>QUERY: " . $sqlQuery . '<br>';

      $result = $conn->query($sqlQuery);
      $results_array = array();

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $results_array[] = $row;
        }
      }
      echo '<br>--RESULTS--<br>';
      print_r($results_array);

      //Save results
      saveJSON($results_array);
    }
    else {
      die("Connection error: " . $conn->connect_error);
    }
  }

  //Search DB PART
  function saveJSON($array) {
        //If we r attacking some DB, we want to save our attack results in someplace
        $file = fopen('results.json', 'w');
        fwrite($file, json_encode($array));
      //  fwrite($file, json_encode($array2));
        fclose($file);
    }
?>
