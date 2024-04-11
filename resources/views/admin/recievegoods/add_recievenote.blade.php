<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Thêm phiếu nhập hàng</title>
  </head>
  <body id="page-top">
    <div id="wrapper">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
      <!-- partial -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="container-fluid">
            <div class="">
                <div class="div-center">
                    <h2 class="h2-font mb-5">Khởi tạo phiếu nhập hàng</h2>
                    <form action="{{route('create.recienote')}}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Họ tên người giao</label>
                          <input type="text" class="form-control" name="deliverInfo" id="deliverInfo" required>
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Mã hoá đơn </label>
                          <input type="text" class="form-control" name="noteId" readonly>
                          </select>
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Hoá đơn số</label>
                          <input type="text" class="form-control" name="orderNum">
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Công ty</label>
                          <input type="text" class="form-control" name="companyName">
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Thời gian</label>
                          <input type="date" class="form-control" name="dateTime" id="dateTime">
                        </div>
                      
                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Nhập tại kho</label>
                          <input type="text" class="form-control" name="wareHouse">
                        </div>
                        


                        <div class="col-md-9 mx-3 mb-5">
                            <label class="form-label fw-bold">Thông tin sản phẩm</label>
                              <input type="text" class="form-control" name="productInfo" id="productInfo" placeholder="Tìm sản phẩm qua tên hoặc nhóm sản phẩm">
                              <ul id="product_list" class="dropdown-menu dropdown-selection"></ul>
                        </div>
                        
                        <table id="tableProduct" class="table table-bordered border col-md-11 mx-3 mb-5">
                            <thead>
                              <tr class="bg-dark text-light text-center">
                                <th rowspan="2">Tên sản phẩm</th>
                                <th rowspan="2">Ảnh</th>
                                <th rowspan="2">Mã sản phẩm</th>
                                <th rowspan="2">Nhóm sản phẩm</th>
                                <th colspan="2">Số lượng</th>
                                <th rowspan="2">Đơn giá</th>
                                <th rowspan="2">Thành tiền</th>
                                <th rowspan="2">Hành động</th>
                              </tr>
                              <tr>
                                <th>Số lượng theo chứng từ</th>
                                <th>Số lượng thực nhập</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot></tfoot>

                            <input type="hidden" name="productIds">
                            <input type="hidden" name="perDocQuantity">
                            <input type="hidden" name="perActQuantity">
                            <input type="hidden" name="amount">

                        </table>
                        <div class="col-md-9 mx-3 mb-5">
                          <label class="form-label fw-bold">Ghi chú</label>
                          <textarea name="note" class="form-control" rows="5"></textarea>
                        </div>
                        
                      </div>
                        <input type="submit"  name="submit" class="btn btn-primary mx-3 mb-3" value="Thêm phiếu nhập">
                    </form>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.js')
  </body>
</html>


<script>
  var csrf_token = "{{ csrf_token() }}";
  $(document).ready(function() {          
    // Process click the product in drop-down menu
    $('#productInfo').keyup(function() {
    var input = $(this).val();
    if(input !== '') {
        // Send AJAX request
        $.ajax({
            url: "/order/search_product",
            method: 'POST',
            data: {
                '_token': csrf_token,
                'input': input
            },
            success: function(data) {
                // Clear old data items in list
                $('#product_list').empty();
                // Add new items in list
                $.each(data, function(index, product) {
                    $('#product_list').append('<li class="dropdown-item">' + product.product_name + ' - ' + product.category_name + ' - ' + product.product_id + '</li>');
                });
                $('#product_list').show();
            }
        });
    } else {
        $('#product_list').hide();
        return;
    }
    });


    function formatMoney(amount) {
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Declare an array to store product ids
    var productIds = [];
    var list = [1, 2, 3];

    $('#product_list').on('click', '.dropdown-item', function() {

        
        var parts = $(this).text().split(' - ');

        var productId = parts[parts.length - 1];

        productId = $.trim(productId);
        
        $.ajax({
            url: "/order/get_detailed_product",
            method: 'POST',
            data: {
                '_token': csrf_token,
                'input': productId
            },
            success: function(data)
            {
                
                $.each(data, function(index, product) {
                    // Add product ids to the productIds array
                    productIds.push(product.product_id);

                    // Add this product info to the table
                    $('#tableProduct tbody').append('<tr><td style="max-width: 150px">' + product.product_name + '</td><td>' +  "<img src='/product/"+product.image+"' width='160px' height='240px'> "+ '</td><td>' +
                      product.product_id + '</td><td>' +
                      product.category_name + '</td><td>' +
                      '<i class="mx-2 quantity-input" data-input-type="quantity">1</i>' + '</td><td>' +
                      '<i class="discount-input" data-input-type="discount">1</i>' + 
                      '</td><td class="price">' + formatMoney(product.price) + '</td><td>' + '</td><td>' + 
                      "<a type='button' href='#' class='btn btn-danger shadow-none btn-sm remove-table-row'>Xoá</a>" + '</td></tr>');
                });
                $('#tableProduct tfoot').html('<tr class="table-light text-dark "><td colspan="2"></td><td colspan="4" class="font-weight-bold">Tổng</td><td colspan="4" class="font-weight-bold total-amount"></td></tr>');
                updateTotalAmount();
                // Update the value of the hidden input productIds
                updateHiddenInputProIds();
            }
        });
        $('#product_list').hide();
        $('#productInfo').val('');
    });

    // The function updates the value of the hidden input productIds
    function updateHiddenInputProIds() {

        // Convert the array of productIds to a character string, separated by commas
        var productIdsString = productIds.join(', ');

        // Assign the value of the hidden input productIds
        $('input[name="productIds"]').val(productIdsString);
    }

    // Process the event when the "Delete" button is pressed
    $('#tableProduct').on('click', '.remove-table-row', function() {
        // Determine the index of the row in the table
        var rowIndex = $(this).closest('tr').index();

        // Delete the corresponding row from the table
        $(this).closest('tr').remove();

        // Delete the corresponding element in the productIds array
        productIds.splice(rowIndex, 1);

        // Update the value of the hidden input productIds
        updateHiddenInputProIds();

        // Update the value of the toltal amount
        updateTotalAmount();
    });
    
    //Double click to display input
    $(document).on('dblclick', '.quantity-input, .discount-input', function() {
        var currentValue = parseInt($(this).text());
        var inputType = $(this).data('input-type');

        // Create an input and set the initial value
        var inputElement = $('<input type="number" class="small-input">').val(currentValue);

        // Replace current text with input
        $(this).html(inputElement);

        // Focus on the input and select the entire content
        inputElement.focus().select();

        // When the user finishes typing
        inputElement.on('blur', function() {
            var newValue = parseInt($(this).val());
            if (!isNaN(newValue)) {
                $(this).closest('tr').find('.' + inputType + '-input').text(newValue);
                // Activate updateTotalAmount function
                updateTotalAmount(); 
            } else {
                $(this).closest('tr').find('.' + inputType + '-input').text(currentValue);
            }
        });

        // When user hit Enter button
        inputElement.on('keypress', function(e) {
            if (e.which === 13) {
                // Activate blur event
                $(this).blur(); 
            }
        });
    });

    // Double click event handler for price column
    $(document).on('dblclick', '.price', function() {        
        // Replacing commas and converting to integer
        var numericPrice = parseInt($(this).text().replace(/,/g, ''));
        
        // Creating input field with numeric value
        var inputField = $('<input type="number" class="form-control">').val(numericPrice);
        
        $(this).html(inputField);
        inputField.focus();
        
        // On input blur, restore original price value
        inputField.blur(function() {
            // Getting new price value
            var newPrice = $(this).val();
            
            // Replacing input field with new price value
            $(this).parent().text(formatMoney(newPrice.toLocaleString()));
            updateTotalAmount();
        });
        
        
    });


    // Function to update total amount
    function updateTotalAmount() {
        var totalSum = 0
        var listAmount = [];
        var perDocQuantity = [];
        var perActQuantity = [];
        $('#tableProduct tbody tr').each(function() {
            var quantity = parseInt($(this).find('.quantity-input').text());
            perDocQuantity.push(quantity);

            var actual = parseInt($(this).find('.discount-input').text());
            perActQuantity.push(actual);
            var price = parseFloat($(this).find('.price').text().replace(/[^\d.-]/g, ''));
            listAmount.push(price);

            var amount = quantity * price;
            totalSum += amount;
            // Insert the value into the "Thành tiền" column and reformat it
            $(this).find('td:eq(7)').text(formatMoney(amount));
        });
        $('#tableProduct tfoot .total-amount').text(formatMoney(totalSum) + ' đồng.');

        // Assign value to hidden input
        $('input[name="perDocQuantity"]').val(perDocQuantity.join(', '));
        $('input[name="perActQuantity"]').val(perActQuantity.join(', '));
        $('input[name="amount"]').val(listAmount.join(', ')); 
    }
  });
</script>