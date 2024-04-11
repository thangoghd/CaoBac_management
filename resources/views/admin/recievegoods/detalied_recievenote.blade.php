<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Chi tiết phiếu nhập</title>
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
                  <div class="mb-3 d-flex justify-content-between">
                    <a href="{{route('view.recienotes')}}"><i class="fa-solid fa-chevron-left"></i>Danh sách phiếu nhập </a>
                    <a href="{{route('pdf.recienote',  ['id' => $recievenote->id])}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                      class="fas fa-download fa-sm text-white-50"></i> Xuất báo cáo
                    </a>
                  </div>
                    <h2 class="h2-font mb-5">Phiếu nhập hàng  {{$recievenote->note_id}}</h2>

                      <div class="row">
                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label font-weight-bold">Họ tên người giao: </label>
                          {{$recievenote->deliver_name}}
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label font-weight-bold">Hoá đơn số: </label>
                          {{$recievenote->order_num}}
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label font-weight-bold">Công ty: </label>
                          {{$recievenote->company_name}}
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label font-weight-bold">Thời gian: </label>
                          {{$recievenote->datetime}}
                        </div>
                      
                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label font-weight-bold">Nhập tại kho: </label>
                          {{$recievenote->warehouse}}
                        </div>
                        


                        <div class="col-md-9 mx-3 mb-2">
                            <label class="form-label font-weight-bold">Thông tin sản phẩm</label>
                        </div>
                        
                        <table id="tableProduct" class="table table-bordered table-striped col-md-11 mx-3 mb-5">
                            <thead>
                              <tr class="bg-dark text-light text-center">
                                <th rowspan="2">Tên sản phẩm</th>
                                <th rowspan="2">Ảnh</th>
                                <th rowspan="2">Mã sản phẩm</th>
                                <th rowspan="2">Nhóm sản phẩm</th>
                                <th colspan="2">Số lượng</th>
                                <th rowspan="2">Đơn giá</th>
                                <th rowspan="2">Thành tiền</th>
                              </tr>
                              <tr>
                                <th>Số lượng theo chứng từ</th>
                                <th>Số lượng thực nhập</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                                // Convert string to array using explode() function to separate each value separately
                                $perDiscountArray = explode(', ', $recievenote->document_quantity);
                                $actualAuantityArray = explode(', ', $recievenote->actual_quantity);
                                $priceArray = explode(', ', $recievenote->amountper_product);
                                $totalAmount = 0;
                              @endphp
                              @foreach($products as $index => $item)
                              <tr>
                                <td style="max-width: 250px">{{$item->product_name}}</td>
                                <td><img src='/product/{{$item->image}}' width='160px' height='240px'></td>
                                <td>{{$item->product_id}}</td>
                                <td>{{$item->category_name}}</td>
                                <td>{{$perDiscountArray[$index]}}</td>
                                <td>{{$actualAuantityArray[$index]}}</td>
                                <td>{{ number_format($priceArray[$index], 0, ",", ",");}}</td>
                                <td>{{ number_format($perDiscountArray[$index] * $priceArray[$index], 0, ",", ",");}}</td>
                              </tr>
                              @php
                                $totalAmount += $perDiscountArray[$index] * $priceArray[$index];
                              @endphp
                              @endforeach
                            </tbody>
                            <tfoot>
                              <tr class="table-light text-dark ">
                                <td colspan="2"></td>
                                <td colspan="4" class="font-weight-bold">Tổng</td>
                                <td colspan="4" class="font-weight-bold total-amount">{{ number_format($totalAmount, 0, ",", ",");}} đồng.</td>
                              </tr>
                            </tfoot>
                        </table>
                        <div class="col-md-11 mx-3 mb-5">
                          <label class="form-label font-weight-bold">Ghi chú</label>
                          <textarea name="note" class="form-control" rows="5" readonly>{{$recievenote->note}}</textarea>
                        </div>
                      </div>
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