<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Thêm sản phẩm</title>
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
                    <h2 class="h2-font mb-5">Khởi tạo đơn hàng</h2>
                    <form action="{{route('create.order')}}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Thông tin khách hàng</label>
                          <div class="d-flex">
                            <input type="text" class="form-control" name="customerInfo" id="customerInfo" placeholder="Tìm khách hàng qua SĐT hoặc Mã khách hàng" required>
                            <span class="data-clear-input" id="clearInput" style="display: none;"><i class="fas fa-times"></i></span>
                          </div>

                          <ul class="dropdown-menu dropdown-selection" id="customerList"></ul>
                          <input type="hidden" name="customerId" id="customerId">
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Nguồn thu</label>
                          <select class="form-control" name="accountSource">
                            @foreach($accountsoures as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option> 
                            @endforeach
                          </select>
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Thời gian</label>
                          <input type="datetime-local" class="form-control" name="dateTime" id="dateTime">
                        </div>
                      
                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Nhân viên</label>
                          <select class="form-control" name="employee">
                            @foreach($employees as $item)
                                <option value="{{ $item->id }}" {{ $employeeForCurrentUser && $item->id == $employeeForCurrentUser->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                          </select>
                        </div>
                        
                        <div class="col-md-3 mx-3 mb-5">
                          <label for="accountCollect" class="form-label fw-bold">Hình thức thu tiền</label>
                          <select name="accountCollect" class="form-control" required="">
                            @foreach($accountcollect as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option> 
                            @endforeach
                          </select>
                        </div>


                        <div class="col-md-3 mx-3 mb-5">
                          <label class="form-label fw-bold">Loại giao dịch</label>
                          <select name="orderType" class="form-control" required>
                            <option value="1">Bán online</option>
                            <option value="0">Bán offline</option>
                            <option value="2">Thu tiền CTV/Sỉ</option>
                          </select>
                        </div>

                        <div class="col-md-3 mx-3 mb-5">
                          <label class="form-label fw-bold">Hàng đặt</label>
                            <select name="preOrder" class="form-control" required>
                              <option value="0">Không</option>
                              <option value="1">Đúng</option>
                            </select>
                        </div>

                        <div class="col-md-9 mx-3 mb-5">
                            <label class="form-label fw-bold">Thông tin sản phẩm</label>
                              <input type="text" class="form-control" name="productInfo" id="productInfo" placeholder="Tìm sản phẩm qua tên hoặc nhóm sản phẩm">
                              <ul id="product_list" class="dropdown-menu dropdown-selection"></ul>
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
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="text-center"></tbody>
                            <input type="hidden" id="productIds" name="productIds">
                            <input type="hidden" name="perQuantity">
                            <input type="hidden" name="perDiscount">
                            <input type="hidden" name="totalDiscount">
                            <input type="hidden" name="totalAmount">
                            <tfoot>
                            </tfoot>
                        </table>
                        <div class="col-md-9 mx-3 mb-5">
                          <label class="form-label fw-bold">Ghi chú</label>
                          <textarea name="note" class="form-control" rows="5"></textarea>
                        </div>
                        
                      </div>
                        <input type="submit"  name="submit" class="btn btn-primary mx-3 mb-3" value="Thêm đơn hàng">
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

  @include('admin.orders.js.order_js')
</html>

