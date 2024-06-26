$(document).ready(function() {

    // Get the current time
    var currentDate = new Date();
    
    // Adjust the time zone to GMT +7
    currentDate.setHours(currentDate.getHours() + 7);

    // Format the current time to a string of the form "YYYY-MM-DDTHH:MM"
    var currentDateTimeString = currentDate.toISOString().slice(0, 16);

    // Set default value to input datetime
    $('#dateTime').val(currentDateTimeString);


    $('#customerInfo').keyup(function() {
        var input = $(this).val();

        if(input !== '') {
            // Send AJAX request
            $.ajax({
                url: "/order/search_customer",
                method: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'input': input
                },
                success: function(data) {
                    // Clear old data items in list
                    $('#customerList').empty();
                    // Add new items in list
                    $('#customerList').append('<li data-bs-toggle="modal" data-bs-target="#quickCreateCustomer" class="dropdown-item">Tạo mới khách hàng</li>');
                    $.each(data, function(index, customer) {
                        $('#customerList').append('<li class="dropdown-item">' + customer.customer_name + ' - ' + customer.phonenum + '</li>');
                    });
                    $('#customerList').show();
                }
            });
        } else {
            $('#customerList').hide();
            return;
        }
    });
    
    // Handle the event when selecting an item from customerList
    $(document).on('click', '#customerList li', function() {
        // Check if the element has the data-bs-toggle attribute
        if ($(this).attr('data-bs-toggle')) {
            // If present, prevent the browser's default action
            event.preventDefault();
            event.stopPropagation();
            // Open modal
            $('#quickCreateCustomer').modal('show');
        } else {
            var selectedCustomer = $(this).text();
            var parts = $(this).text().split(' - ');
            var customerId = $.trim(parts[parts.length - 1]);
            
            $('#customerId').val(customerId);
            // Set input to read-only status
            $('#customerInfo').val(selectedCustomer).prop('readonly', true); 
            $('#clearInput').show();
            $('#customerList').hide();
        }
    });

    // Process the event after click "X"
    $(document).on('click', '#clearInput', function() {
        // Clear string in input and set to inputable
        $('#customerInfo').val('').prop('readonly', false);
        $(this).hide();
    });
        
    // Process click the product in drop-down menu
    $('#productInfo').keyup(function() {
    var input = $(this).val();
    if(input !== '') {
        // Send AJAX request
        $.ajax({
            url: "/order/search_product",
            method: 'POST',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'input': input
            },
            success: function(data) {
                // Clear old data items in list
                $('#product_list').empty();
                // Add new items in list
                $.each(data, function(index, product) {
                    $('#product_list').append('<li class="dropdown-item" data-product-id="' + product.id + '">' + product.product_name + ' - ' + product.category_name + '</li>');
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


    $('#product_list').on('click', '.dropdown-item', function() {

        
        var productId = $(this).data('product-id');

        $.ajax({
            url: "/order/get_detailed_product",
            method: 'POST',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'input': productId
            },
            success: function(data)
            {
                $.each(data, function(product) {    
                    // Add this product info to the table
                    $('#tableProduct tbody').append('<tr><td style="max-width: 150px">' + product.product_name + '</td><td>' +  "<img src='/product/"+product.image+"' width='160px' height='240px'> "+ '</td><td>' +
                        product.category_name + '</td><td class="price">' + formatMoney(product.price) + '</td><td>' +
                            '<i class="fa-solid fa-circle-chevron-left decrement-quantity"></i><i class="mx-2 quantity-input" data-input-type="quantity">1</i><i class="fa-solid fa-circle-chevron-right increment-quantity"></i>' + '</td><td>' +
                            '<i class="discount-input" data-input-type="discount">0</i>' + '</td><td>' +  '</td><td>' +
                            "<a type='button' href='#' class='btn btn-danger shadow-none btn-sm remove-table-row'>Xoá</a>" + '</td></tr>');
                });
                $('#tableProduct tfoot').html('<tr class="table-success"><td colspan="6"></td><td colspan="4" class="font-weight-bold total-quantity" id="quantity">Tổng số lượng: </td></tr>'
                + '<tr class="table-success"><td colspan="6"></td><td colspan="4" class="font-weight-bold total-sum">Tổng số tiền: </td></tr>'
                + '<tr class="table-success"><td colspan="6"></td><td colspan="4" class="font-weight-bold ">Chiết khấu tổng đơn (%): <i class="totaldiscount-input" data-input-type="totaldiscount">0</i></td></tr>'
                + '<tr class="table-success"><td colspan="6"></td><td colspan="4" class="font-weight-bold total-amount" id="paymentAmount">Tiền cần trả: </td></tr>');
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

    $(document).on('click', '.decrement-quantity', function() {
        var quantityElement = $(this).closest('tr').find('.quantity-input');
        var quantity = parseInt(quantityElement.text());
        if (quantity > 1) {
            quantity -= 1;
            quantityElement.text(quantity);
        }
    });

    $(document).on('click', '.increment-quantity', function() {
        var quantityElement = $(this).closest('tr').find('.quantity-input');
        var quantity = parseInt(quantityElement.text());
        quantity += 1;
        quantityElement.text(quantity);
    });
    
    //Double click to display input
    $(document).on('dblclick', '.quantity-input, .discount-input, .totaldiscount-input', function() {
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

    // Update total amount when quantity changes
    $(document).on('click', '.increment-quantity, .decrement-quantity', function() {
        updateTotalAmount();
    });

    // Function to update total amount
    function updateTotalAmount() {
        var totalQuantity = 0;
        var totalSum = 0
        var totalAmount = 0;
        var totalDiscount = 0;
        var perQuantity = [];
        var perDiscount = [];
        $('#tableProduct tbody tr').each(function() {
            var quantity = parseInt($(this).find('.quantity-input').text());
            perQuantity.push(quantity);

            var discount = parseInt($(this).find('.discount-input').text());
            perDiscount.push(discount);
            var price = parseFloat($(this).find('.price').text().replace(/[^\d.-]/g, ''));
            totalQuantity += quantity;
            totalSum += quantity * price - Math.ceil(price*(discount/100));
            // Insert the value into the "Thành tiền" column and reformat it
            $(this).find('td:eq(6)').text(formatMoney(totalSum));
        });
        totalDiscount = parseInt($('.totaldiscount-input').text());
        totalAmount = totalSum - Math.ceil(totalSum*(totalDiscount/100))
        $('#tableProduct tfoot .total-quantity').text('Tổng số lượng: ' + totalQuantity);
        $('#tableProduct tfoot .total-sum').text('Tổng số tiền: ' + formatMoney(totalSum) + ' đồng.');
        $('#tableProduct tfoot .total-amount').text('Tiền phải trả: ' + formatMoney(totalAmount) + ' đồng.');
    }

    $(document).on('submit', '#quickCreateCustomer form', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                $('#customerInfo').val(response.customer_name + ' - ' + response.phonenum).prop('readonly', true);
                $('#customerInfo').data('customer-phone', response.phonenum);

                alert(response.message);

                $('#quickCreateCustomer').modal('hide');
                $('#clearInput').show();
                $('#customerList').hide();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#saveDataBtn').click(function() {
        var tableData = [];
        $('#tableProduct tbody tr').each(function(row, tr) {
            var rowData = {
                quantity: $(tr).find('td:eq(4)').text().trim(),
                amunt: $(tr).find('td:eq(6)').text().trim(),
            };
            tableData.push(rowData);
        });
        console.log(tableData);
    });

});