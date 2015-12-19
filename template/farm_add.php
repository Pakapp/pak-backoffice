<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    //[{"location":{"fb_location_id":456265245354,"lat":324,"long":76},"name":"Sansai Organic","packages":[true],"products":{"carrots":{"capacity":{"amount":30,"per":"week","unit":"ea"}}}}]
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
            $data['products'][$_POST['productName'][$key]] = array(
                'amount' => $_POST['productAmount'][$key],
                'per' => $_POST['productPer'][$key],
                'unit' => $_POST['productUnit'][$key],
            );
        }
        $firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);
        print_r($data);
        $firebase->push('/farms', $data);
        //$firebase->set('/farms', $data);
        redirect(HOST.'index.php?page=farms');
    }
}
?>
  <form name="farm" method="post">
    <div class="form-group">
      <label class="control-label">Name</label>
      <div>
        <input type="text" class="form-control" name="name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label">Products</label>
      <div>
        <div class="btn btn-default" title="Add Product" onclick="addProducts();">New</div>
      </div>
      <div class="row" id="addProducts">
        <div class="col-sm-6">
          <div class="form-group">
            <label class="control-label">Name</label>
            <div>
              <input type="text" class="form-control" name="productName[]">
            </div>
            <label class="control-label">Capacity - Amount</label>
            <div>
              <input type="text" class="form-control" name="productAmount[]">
            </div>
            <label class="control-label">Per</label>
            <div>
              <select class="form-control" name="productPer[]">
                <option value="day">Day</option>
                <option value="week">Week</option>
                <option value="month">Month</option>
              </select>
            </div>
            <label class="control-label">Unit</label>
            <div>
              <input type="text" class="form-control" name="productUnit[]">
            </div>
          </div>
        </div>
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
        '<div class="col-sm-6">\
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
