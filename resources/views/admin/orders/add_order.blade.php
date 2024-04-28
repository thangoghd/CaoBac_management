<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Thêm sản phẩm</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <form>
                      <div class="row">
                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Thông tin khách hàng</label>
                          <div class="d-flex">
                            <input type="text" class="form-control" name="customerInfo" id="customerInfo" placeholder="Tìm khách hàng qua SĐT hoặc Mã khách hàng" required>
                            <span class="data-clear-input" id="clearInput" style="display: none;"><i class="fas fa-times"></i></span>
                          </div>

                          <ul class="dropdown-menu dropdown-selection" id="customerList">
                          </ul>
                          
                          <input type="hidden" name="customerId" id="customerId">
                        </div>

                        <div class="col-md-5 mx-3 mb-5">
                          <label class="form-label fw-bold">Thời gian</label>
                          <input type="datetime-local" class="form-control" name="dateTime" id="dateTime">
                        </div>


                        <div class="col-md-3 mx-3 mb-5">
                          <label class="form-label fw-bold">Loại giao dịch</label>
                          <select name="orderType" class="form-control" required>
                            <option value="1">Tiền mặt Hà Nội 1</option>
                            <option value="2">VIB Trường</option>
                            <option value="3">Nam Á Bank</option>
                            <option value="4">Vietinbank Trường</option>
                            <option value="5">VCB Thủy</option>
                            <option value="8">POS HP về VCB</option>
                            <option value="9">ACB Thủy</option>
                            <option value="10">Airpay HP về VCB</option>
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
                        <input type="submit" id="saveDataBtn" class="btn btn-primary mx-3 mb-3" value="Thêm đơn hàng">
                    </form>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->

        <!-- Modal create a new customer-->
        <div class="modal fade" id="quickCreateCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form action="{{route('quick.customer')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Thêm khách hàng</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-11 mx-3 mb-5">
                      <label class="form-label fw-bold">Tên khách hàng</label>
                      <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Viết tên khách hàng" required>
                    </div>
    
                    <div class="col-md-4 mx-3 mb-5">
                      <label class="form-label fw-bold">Giới tính</label>
                      <div class="form-check-label">
                        <input type="radio" name="gender" id="male" value="0" required>
                        <label class="form-check form-check-inline" for="male">Nam</label>
                        <input  type="radio" name="gender" id="female" value="1" required>
                        <label class="form-check form-check-inline" for="female">Nữ</label>
                      </div>
    
                    </div>
                    <div class="col-md-7 mx-3 mb-5">
                      <label class="form-label fw-bold">Số điện thoại</label>
                      <input type="text" class="form-control" name="phonenum" id="phonenum" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="col-md-4 mx-3 mb-5">
                      <label class="form-label fw-bold">Ngày sinh</label>
                      <input type="date" class="form-control" name="birthdate" id="birthdate" required>
                    </div>
                    <div class="col-md-11 mx-3 mb-5">
                      <label class="form-label fw-bold">Địa chỉ</label>
                      <div class="d-flex align-items-center">
                        <select class="form-control" id="city" aria-label=".form-select-sm">
                        <option value="" selected>Chọn tỉnh thành</option>           
                        </select>
                                  
                        <select class="form-control mx-5" id="district" aria-label=".form-select-sm">
                        <option value="" selected>Chọn quận huyện</option>
                        </select>
                        
                        <select class="form-control" id="ward" aria-label=".form-select-sm">
                        <option value="" selected>Chọn phường xã</option>
                        </select>
                      </div>
                      <input type="hidden" name="address" id="address">
    
                    </div>
                    <div class="col-md-11 mx-3 mb-5">
                      <label class="form-label fw-bold">Ghi chú</label>
                      <textarea name="note" class="form-control" rows="5"></textarea>
                    </div>
                    
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="submit"  name="submit" class="btn btn-primary mx-3 mb-3" value="Thêm khách hàng">
                </div>
              </div>


            </form>
          </div>
        </div>
        <!-- Modal end -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.js')
  </body>
</html>

<script src="{{asset('admin/js/order/order.js')}}"></script>
<script src="{{asset('admin/js/customer/customer.js')}}"></script>

