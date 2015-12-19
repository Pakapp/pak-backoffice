<?php

$firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);

// --- storing an array ---
/*$test = array(
    "foo" => "bar",
    "i_love" => "lamp",
    "id" => 42
);*/
//$dateTime = new DateTime();
//$firebase->set(DEFAULT_PATH . '/' . $dateTime->format('c'), $test);

// --- storing a string ---
//$firebase->set(DEFAULT_PATH . '/name/contact001', "John Doe");

// --- reading the stored string ---
//$name = $firebase->get(DEFAULT_PATH . '/name/');
//print_r($name);
//die();

$farmsObj = $firebase->get('/farms');
$farms = json_decode($farmsObj);
?>
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-default" href="<?php echo HOST; ?>index.php?page=farm_add" title="Add new farm">New</a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Products</th>
            <th>Tools</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($farms) && $farms) {
              $i = 0;
              foreach ($farms as $value) {
                  ++$i;
                  ?>
            <tr>
              <td class="text-center"><?php echo $i;
                  ?></td>
              <td><?php echo $value->name;
                  ?></td>
              <td class="text-center"><?php echo count($value->products);
                  ?></td>
              <td class="text-center"></td>
            </tr>
            <?php

              }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
