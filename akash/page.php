<style>
    body 
    {
        background-color:blueviolet;
    }
</style>
<?php
/* [SEARCH FOR USERS] */
if (isset($_POST['search'])) {
  require "3-search.php";
}

/* [DISPLAY HTML] */ ?>
<!DOCTYPE html>
<html>
  <body>
    <!-- [SEARCH FORM] -->
    <form method="post">
      <h1>
        SEARCH FOR USERS
      </h1>
      <input type="text" name="search" required/>
      <input type="submit" value="Search"/>
    </form>

    <!-- [SEARCH RESULTS] -->
    <?php
    if (isset($_POST['search'])) {
      if (count($results) > 0) {
        foreach ($results as $r) {
          printf("<div>%s - %s</div>", $r['name'], $r['email']);
        }
      } else {
        echo "No results found";
      }
    }
    ?>
  </body>
</html>