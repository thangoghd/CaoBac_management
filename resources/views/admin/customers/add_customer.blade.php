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
                    <h2 class="h2-font mb-5">Thêm khách hàng</h2>
                    <form action="{{url('/create_customer')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-md-8 mx-3 mb-5">
                          <label class="form-label fw-bold">Tên khách hàng</label>
                          <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Viết tên khách hàng" required>
                        </div>
                        <div class="col-md-4 mx-3 mb-5 ">
                          <label class="form-label fw-bold">Mã khách hàng</label>
                          <div class="d-flex">
                            <input type="text" class="form-control" name="customer_id" id="customer_id" placeholder="Mã khách hàng" readonly required>
                            <button class="btn" onclick="generateRandomCode()"><i class="fa-solid fa-shuffle"></i></button>
                          </div>

                        </div>

                        <div class="col-md-4 mx-3 mb-5">
                          <label class="form-label fw-bold">Nhóm khách hàng</label>
                          <select class="form-control" name="type_id" id="type_id">
                            @foreach($type as $index => $item)
                            <option value="{{$item->id}}">{{$item->type_name}}</option>
                            @endforeach
                          </select>
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
                        <div class="col-md-4 mx-3 mb-5">
                          <label class="form-label fw-bold">Số điện thoại</label>
                          <input type="text" class="form-control" name="phonenum" id="phonenum" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="col-md-4 mx-3 mb-5">
                          <label class="form-label fw-bold">Ngày sinh</label>
                          <input type="date" class="form-control" name="birthdate" id="birthdate" required>
                        </div>
                        <div class="col-md-9 mx-3 mb-5">
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
                        <div class="col-md-9 mx-3 mb-5">
                          <label class="form-label fw-bold">Ghi chú</label>
                          <textarea name="note" class="form-control" rows="5"></textarea>
                        </div>
                        
                      </div>
                        <input type="submit"  name="submit" class="btn btn-primary mx-3 mb-3" value="Thêm khách hàng">
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
    @include('admin.customers.js.customer_js')
  </body>
</html>

