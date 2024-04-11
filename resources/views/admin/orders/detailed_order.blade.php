<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Chi tiết đơn hàng</title>
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
                  <div class="mb-3">
                    <a href="{{route('view.orders')}}"><i class="fa-solid fa-chevron-left"></i> Danh sách đơn hàng</a>
                  </div>
                   
                  <h2 class="h2-font mb-5">Chi tiết đơn hàng mã {{$order->order_id}}</h2>
                  <form action="" method="POST">

                    @csrf
                    <div class="row">
                      <div class="col-md-5 mx-3 mb-5">
                        <label class="form-label font-weight-bold">Thông tin khách hàng: </label>
                        {{$order->customer_name}}
                      </div>

                      <div class="col-md-5 mx-3 mb-5">
                        <label class="form-label font-weight-bold">Nguồn thu: </label>
                        {{$order->accountsource_name}}
                      </div>


                      <div class="col-md-5 mx-3 mb-5">
                        <label class="form-label font-weight-bold">Thời gian: </label>
                        {{$order->datetime}}
                      </div>
                    
                      <div class="col-md-5 mx-3 mb-5">
                        <label class="form-label font-weight-bold">Nhân viên: </label>
                        {{$order->employee_name}}
                      </div>
                      
                      <div class="col-md-3 mx-3 mb-5">
                        <label for="accountCollect" class="form-label font-weight-bold">Hình thức thu tiền: </label>
                        {{$order->accountcollect_name}}
                      </div>


                      <div class="col-md-3 mx-3 mb-5">
                        <label class="form-label font-weight-bold">Loại giao dịch: </label>
                        @if($order->order_type == 0)
                            Bán trực tiếp
                        @elseif($order->order_type == 1)
                            Bán trực tuyến
                        @else
                            Bán sỉ
                        @endif
                      </div>

                      <div class="col-md-3 mx-3 mb-5">
                        <label class="form-label font-weight-bold">Hàng đặt: </label>
                        {{ $order->preorder == '0' ? 'Không' : 'Có' }}
                      </div>

                      <div class="col-md-9 mx-3 mb-3">
                        <label class="form-label font-weight-bold">Thông tin sản phẩm</label>

                      </div>

                      <table id="tableProduct" class="table table-hover border table-striped col-md-11 mx-3 mb-5">
                        <thead>
                            <tr class="bg-dark text-light text-center">
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Mã sản phẩm</th>
                                <th scope="col">Nhóm sản phẩm</th>
                                <th scope="col">Giá bán lẻ</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Chiết khấu lẻ (%)</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>


                        <tbody class="text-center">
                          @php
                            // Convert string to array using explode() function to separate each value separately
                            $per_discount_array = explode(', ', $order->per_discount);
                            $quantity_array = explode(', ', $order->quantity);
                          @endphp
                          @foreach($products as $index => $item)
                          <tr>
                            <td>{{$item->product_name}}</td>
                            <td><img src='/product/{{$item->image}}' width='160px' height='240px'></td>
                            <td>{{$item->product_id}}</td>
                            <td>{{$item->category_name}}</td>
                            <td>{{number_format($item->price, 0, ",", ",");}}</td>
                            <td>{{$quantity_array[$index]}}</td>
                            <td>{{$per_discount_array[$index]}}</td>
                            <td></td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr class="table-success"><td colspan="5"></td><td colspan="4" class="font-weight-bold total-quantity" id="quantity">Tổng số lượng: </td></tr>
                          <tr class="table-success"><td colspan="5"></td><td colspan="4" class="font-weight-bold total-sum">Tổng số tiền: </td></tr>
                          <tr class="table-success">
                            <td colspan="5"></td>
                            <td colspan="4" class="font-weight-bold ">Chiết khấu tổng đơn (%): {{$order->total_discount}}</td>
                          </tr>
                          <tr class="table-success">
                            <td colspan="5"></td>
                            <td colspan="4" class="font-weight-bold total-amount">
                              Tiền phải trả: {{number_format($order->payment_amount, 0, ",", ",");}} đồng.
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                      
                      <div class="col-md-11 mx-3 mb-5">
                        <label class="form-label font-weight-bold">Ghi chú</label>
                        <textarea name="note" class="form-control" rows="5" readonly>{{$order->note}}</textarea>
                      </div>
                    </div>
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
  $(document).ready(function() {

      var totalQuantity = 0;
      var totalSum = 0;

      $('#tableProduct tbody tr').each(function() {
          var quantity = parseInt($(this).find('td:eq(5)').text());
          var price = parseFloat($(this).find('td:eq(4)').text().replace(/[^\d.-]/g, ''));
          var discount = parseInt($(this).find('td:eq(6)').text());

          // Insert the total price each products value into the "Thành tiền" column and reformat it
          var total = quantity * price - Math.ceil(price*(discount/100));
          $(this).find('td:eq(7)').text(number_format(total, 0, ",", ","));

          totalSum += total;
          totalQuantity += quantity;

          $('.total-quantity').text('Tổng số lượng: ' + totalQuantity);
          $('.total-sum').text('Tổng số tiền: ' + totalSum.toLocaleString() + ' đồng');
      });
  });
</script>
