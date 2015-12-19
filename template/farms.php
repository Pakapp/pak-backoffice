<?php

$firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);

$farmsObj = $firebase->get('/farms');
$farms = json_decode($farmsObj);
?>
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-default" href="<?php echo HOST; ?>farm_add/" title="Add new farm">New</a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Products</th>
            <th class="text-center">Packages</th>
            <th class="text-center">Tools</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($farms) && $farms) {
              $i = 0;
              foreach ($farms as $key=>$value) {
                  ++$i;
                  ?>
            <tr>
              <td class="text-center"><?php echo $i;
                  ?></td>
              <td><?php echo $value->name;
                  ?></td>
              <td class="text-center"><?php echo count((array)$value->products);
                  ?></td>
              <td class="text-center"><?php echo isset($value->packages)?count((array)$value->packages):'0';
                  ?></td>
              <td class="text-center"><a href="<?php echo HOST; ?>farm_edit/<?php echo $key; ?>/">Edit</a></td>
            </tr>
            <?php
              }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
