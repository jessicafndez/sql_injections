<?php
  function checkInjectors($tname, $tfield) {
    require_once 'database_conf.php';

    $results = array();
    $injector_array = array();

    $fh = fopen('injection_template.txt','r');
    while ($line = fgets($fh)) {
       array_push($injector_array, $line);
    }
    fclose($fh);

    //DB
    $conn = new mysqli($servername, $username, $password, $dbname);

    $conn->set_charset("utf8");

    if(!$conn->connect_error) {
      foreach ($injector_array as $injector) {
        $sqlQuery = "SELECT * FROM $tname WHERE $tfield='$injector';";
        echo "<br>QUERY: " . $sqlQuery . '<br>';

        $sqlIn = $conn->query($sqlQuery);

        if ($sqlIn->num_rows > 0) {
          $results[$injector] = "True";
        }
        else {
          $results[$injector] = "False";
        }
      }
    }

    ?>
    <div id="search_results">
      <div id="mytable">
        <table>
          <tr>
            <td><b>Injector<b></td>
            <td><b>Result<b></td>
          </tr>
            <?php
              foreach ($results as $key => $value) {
                # code...
                ?>
                  <tr>
                    <td><?php  echo $key; ?></td>
                    <?php
                      if($value=="True") {
                        ?>
                          <td><font color="red"><?php  echo $value; ?></font></td>
                        <?
                      }
                      else {
                        ?>
                          <td><font color="green"><?php  echo $value; ?></font></td>
                        <?
                      }
                     ?>
                  </tr>
                <?
              }
              ?>
          </table>
      </div>
    </div>

    <?
  }
?>
