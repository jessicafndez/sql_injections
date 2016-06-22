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
    include 'db_config.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    $conn->set_charset("utf8");

    $results_array = array();

    if(!$conn->connect_error) {
      $stmt = $conn->prepare('SELECT * FROM m_events WHERE e_title = ?');
      $stmt->bind_param('s', $s);

      $stmt->execute();

      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        // do something with $row
        $results_array[] = $row;
      }

      echo '<br>--RESULTS--<br>';
      print_r($results_array);
    }
  }

?>
