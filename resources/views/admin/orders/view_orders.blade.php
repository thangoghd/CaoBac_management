<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Danh sách đơn hàng</title>
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
                  <h2 class="h2-font mb-5">Danh sách đơn hàng</h2>
                </div>
                <table id="tableProduct" class="table table-hover border table-striped text-center mt-5">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Ngày tạo đơn</th>
                      <th scope="col">Mã đơn hàng</th>
                      <th scope="col">Khách hàng</th>
                      <th scope="col">Nhân viên</th>
                      <th scope="col">Hình thức thu tiền</th>
                      <th scope="col">Nguồn thu tiền</th>
                      <th scope="col">Tổng số lượng</th>
                      <th scope="col">Tiền cần thanh toán</th>
                      <th scope="col">Hành động</th>
                    </tr>
                    <tbody>
                        @foreach($orders as $index => $item)
                        <tr class="align-middle">
                            <td>{{$index+1}}</td>
                            <td>{{$item->datetime}}</td>
                            <td>{{$item->order_id}}</td>
                            <td>{{$item->customer_name}}</td>
                            <td>{{$item->employee_name}}</td>
                            <td>{{$item->accountcollect_name}}</td>
                            <td>{{$item->accountsource_name}}</td>
                            <td>{{array_sum(array_map('intval', explode(', ', $item->quantity)));}}</td>
                            <td>{{number_format($item->payment_amount, 0, ",", ",");}}</td>
                            <td> 
                              <a href="{{ route('detailed.order', ['id' => $item->id])}}" title="Xem chi tiết" class="btn btn-success shadow-none btn-sm"><i class="fa-solid fa-eye"></i></a>
                              <button type="button" title="Sửa" class="btn btn-primary shadow-none btn-sm edit"><i class="fa-solid fa-pencil"></i></button>               
                              <a type="button" onclick="return confirm('Bạn có chắc rằng muốn xoá? Dữ liệu sẽ không thể phục hồi.')" href="" title="Xoá" class="btn btn-danger shadow-none btn-sm"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </thead>
                </table>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>

      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

  </body>

  <script>

  </script>

  @include('admin.js')
</html>