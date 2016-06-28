<html>
  <head>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
  </head>
  <body>


    <h1>Simple app to test your web injection</h1><br><br>

    <div id="search_type" ng-app="">
      <label id="myTitle">Your actual query is:</label>
      <label id="myQuery">SELECT * FROM {{table}} WHERE {{field}} = ?</label><br><br>
      <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
        <div id="search_field">
          <label>Necessary table_name:</label>
          <input type="text" name="searchTable" ng-model="table" placeholder="Enter table name here"></input><br>
          <label>If Necessary table_field:</label>
          <input type="text" name="searchField" ng-model="field" placeholder="Enter field name here"></input><br>
        </div>
        <div id="search_type_box">
          <label for="searchType">Select * from <i>table_name</i></label><br>
          <input type="radio" name="searchType" value="simpleSearch" checked="checked">simple injection</input>
        </div>
        <div id="search_type_box">
          <label for="searchType">Select * from <i>table_name</i> where <i>table_field</i> = value</label>
          <input type="radio" name="searchType" value="whereSearch">Where injection</>
        </div><br>
        <div id="search_box">
          <input type="submit" name="submit" value="Inject"></input>
        </div>
      </form>
    </div><br>
    <?php
     //injector
     if(isset( $_POST['submit'])) {

       /*Load all results*/
       include 'load_results.php';
       $results = checkInjectors($_POST['searchTable'], $_POST['searchField']);
     }

     ?>


  </body>

<!--
<form method="POST" action="sql_results.php">
   <label for="mySearch">Search:</label><br>
   <input type="text" name="mySearch"/>
   <input type="submit" value="Search" name="submit"/>
 </form>
 -->
