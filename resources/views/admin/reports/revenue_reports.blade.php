<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Báo cáo doanh thu</title>
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
                  <h2 class="h2-font mb-5">Báo cáo doanh thu</h2>
                </div>
                <div class="">
                    <label class="form-label font-weight-bold">Doanh thu theo nhân viên</label>
                    <table id="tableRvnEmployee" class="table table-hover border table-striped text-center mb-5">
                        <thead>
                          <tr class="bg-dark text-light">
                            <th scope="col">#</th>
                            <th scope="col">Nhân viên</th>
                            <th scope="col">Tổng doanh thu</th>
                            <th scope="col">Doanh thu offline</th>
                            <th scope="col">Doanh thu online</th>
                            <th scope="col">Doanh thu CTV - Sỉ</th>
                            <th scope="col">Số đơn hàng</th>
                          </tr>
                          <tbody>
                            @foreach($employeesReport as $index => $item)
                              <tr class="align-middle">
                                <td>{{$index+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{number_format($item->earning, 0, ",", ",");}}</td>
                                <td>{{number_format($item->offline, 0, ",", ",");}}</td>
                                <td>{{number_format($item->online, 0, ",", ",");}}</td>
                                <td>{{number_format($item->wholesale, 0, ",", ",");}}</td>
                                <td>{{$item->order_number}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </thead>
                      </table>
                </div>
                <div class="">
                    <label class="form-label font-weight-bold">Doanh thu theo thời gian</label>
                    <table id="tableRvnDate" class="table table-hover border table-striped text-center mb-5">
                        <thead>
                          <tr class="bg-dark text-light">
                            <th scope="col">Ngày</th>
                            <th scope="col">Tổng doanh thu</th>
                            <th scope="col">Doanh thu offline</th>
                            <th scope="col">Doanh thu online</th>
                            <th scope="col">Doanh thu CTV - Sỉ</th>
                            <th scope="col">Số đơn hàng</th>
                          </tr>
                          <tbody>
                            @foreach($dateReport as $item)
                              <tr class="align-middle">
                                  <td>{{$item->order_date}}</td>
                                  <td>{{number_format($item->earning, 0, ",", ",");}}</td>
                                  <td>{{number_format($item->offline, 0, ",", ",");}}</td>
                                  <td>{{number_format($item->online, 0, ",", ",");}}</td>
                                  <td>{{number_format($item->wholesale, 0, ",", ",");}}</td>
                                  <td>{{$item->order_number}}</td>
                              </tr>
                              @endforeach
                          </tbody>
                        </thead>
                      </table>
                </div>
                <div class="">
                    <label class="form-label font-weight-bold">Doanh thu theo sản phẩm</label>
                    <table id="tableRvnProducts" class="table table-hover border table-striped text-center mb-5">
                        <thead>
                          <tr class="bg-dark text-light">
                            <th scope="col">#</th>
                            <th scope="col">Mã SKU</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Nhóm sản phẩm</th>
                            <th scope="col">Tổng số sản phẩm</th>
                            <th scope="col">Tổng doanh thu</th>
                            <th scope="col">Số đơn hàng</th>
                          </tr>
                          <tbody>
                            @foreach($productRevenueData as $index => $item)
                              <tr class="align-middle">
                                <td>{{$index+1}}</td>
                                <td>{{$item->product_id}}</td>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->category_name}}</td>
                                <td>{{$item->total_quantity}}</td>
                                <td>{{number_format($item->total_revenue, 0, ",", ",");}}</td>
                                <td>{{$item->in_order}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </thead>
                      </table>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

  </body>


  @include('admin.js')
</html>