<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $data = array(
            'location' => array(
                'fb_location_id' => '',
                    'lat' => 0,
                    'long' => 0,
            ),
            'name' => $_POST['name'],
            'packages' => array(),
            'products' => array(),
        );
        if (isset($_POST['productName'][0])) {
            foreach ($_POST['productName'] as $key => $value) {
                if ($_POST['productName'][$key] != '') {
                    $data['products'][$_POST['productName'][$key]] = array(
                    'amount' => $_POST['productAmount'][$key],
                    'per' => $_POST['productPer'][$key],
                    'unit' => $_POST['productUnit'][$key],
                );
                }
            }
            $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
            $firebase->set('/farms/'.$_GET['id'], $data);
            redirect(HOST.'farms/');
        }
    }
}
if (isset($_GET['id'])) {
    $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
    $farmObject = $firebase->get('/farms/'.$_GET['id']);
    $farm = json_decode($farmObject);
}
?>
  <form name="farm" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <div class="form-group">
      <label class="control-label">Name</label>
      <div>
        <input type="text" class="form-control" name="name" value="<?php echo $farm->name; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Products</label>
      <div>
        <div class="btn btn-default" title="Add Product" onclick="addProducts();">New</div>
      </div>
      <div class="row" id="addProducts">
        <?php
        if (isset($farm->products)) {
            foreach ($farm->products as $key => $value) {
                ?>
        <div class="col-sm-6 col-md-4">
          <input type="hidden" name="productId[]" value="<?php echo $key;
                ?>">
          <div class="form-group">
            <label class="control-label">Name</label>
            <div>
              <input type="text" class="form-control" name="productName[]" value="<?php echo $key;
                ?>">
            </div>
            <label class="control-label">Capacity - Amount</label>
            <div>
              <input type="text" class="form-control" name="productAmount[]" value="<?php echo $value->amount;
                ?>">
            </div>
            <label class="control-label">Per</label>
            <div>
              <select class="form-control" name="productPer[]">
                <option value="day" <?php echo $value->per == 'day' ? 'selected' : '';
                ?>>Day</option>
                <option value="week" <?php echo $value->per == 'week' ? 'selected' : '';
                ?>>Week</option>
                <option value="month" <?php echo $value->per == 'month' ? 'selected' : '';
                ?>>Month</option>
              </select>
            </div>
            <label class="control-label">Unit</label>
            <div>
              <input type="text" class="form-control" name="productUnit[]" value="<?php echo $value->unit;
                ?>">
            </div>
          </div>
        </div>
        <?php

            }
        }
        ?>
      </div>
      <div class="form-group">
        <label class="control-label"></label>
        <div>
          <button type="submit" class="btn btn-default">Save</button>
        </div>
      </div>
    </div>
  </form>
  <script>
    function addProducts() {
      $('#addProducts').append(
        '<div class="col-sm-6 col-md-4">\
          <input type="hidden" name="productId[]">\
          <div class="form-group">\
            <label class="control-label">Name</label>\
            <div>\
              <input type="text" class="form-control" name="productName[]">\
            </div>\
            <label class="control-label">Capacity - Amount</label>\
            <div>\
              <input type="text" class="form-control" name="productAmount[]">\
            </div>\
            <label class="control-label">Per</label>\
            <div>\
              <select class="form-control" name="productPer[]">\
                <option value="day">Day</option>\
                <option value="week">Week</option>\
                <option value="month">Month</option>\
              </select>\
            </div>\
            <label class="control-label">Unit</label>\
            <div>\
              <input type="text" class="form-control" name="productUnit[]">\
            </div>\
          </div>\
        </div>'
      );
    }
  </script>
