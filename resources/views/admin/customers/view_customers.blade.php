<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Danh sách khách hàng</title>
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
                  <h2 class="h2-font mb-5">Danh sách khách hàng</h2>
                </div>
                <table id="tableProduct" class="table table-hover table-striped border text-center mt-5">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Tên khách hàng</th>
                      <th scope="col">Mã khách hàng</th>
                      <th scope="col">Nhóm khách hàng</th>
                      <th scope="col">Giới tính</th>
                      <th scope="col">Ngày sinh</th>
                      <th scope="col">SĐT</th>
                      <th scope="col">Địa chỉ</th>
                      <th scope="col">Hành động</th>
                    </tr>
                    <tbody>
                      @foreach ($customer as $index => $item)
                      <tr class="align-middle">
                        <td>{{$index +1}} </td>
                        <td>{{$item->customer_name}}</td>
                        <td>{{$item->customer_id}}</td>
                        <td>{{$item->type_name}}</td>
                        <td>{{ $item->gender == '1' ? 'Nữ' : 'Nam' }}</td>
                        <td>{{$item->birthdate}}</td>
                        <td>{{$item->phonenum}}</td>
                        <td>{{$item->address}}</td>
                        <td> 
                          <button type="button" onclick="" href="" title="Xem chi tiết" class="btn btn-success shadow-none btn-sm"><i class="fa-solid fa-eye"></i></button>
                          <button type="button" title="Sửa" value="{{$item->id}}" class="btn btn-primary shadow-none btn-sm edit"><i class="fa-solid fa-pencil"></i></button>               
                          <a type="button" onclick="return confirm('Bạn có chắc rằng muốn xoá? Dữ liệu sẽ không thể phục hồi.')" href="{{url('delete_customer', $item->id)}}" title="Xoá" class="btn btn-danger shadow-none btn-sm"><i class="fa-solid fa-trash"></i></a>
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
            <!-- Modal for editing customer -->
            <div  class="modal fade" id="editCustomerModal"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                  <form action="{{url('/update_customer')}}" autocomplete="off" method="POST"  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Thay đổi dữ liệu khách hàng</h5>
                          </div>
                          <div class="modal-body">
                      <div class="row">
                        <div class="col-md-11 mx-3 mb-4">
                          <label class="form-label fw-bold">Tên khách hàng</label>
                          <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Viết tên khách hàng" required>
                        </div>
                        <div class="col-md-5 mx-3 mb-4 ">
                          <label class="form-label fw-bold">Mã khách hàng</label>
                          <div class="d-flex">
                            <input type="text" class="form-control" name="customer_id" id="customer_id" placeholder="Mã khách hàng" readonly required>
                          </div>

                        </div>

                        <div class="col-md-5 mx-3 mb-4">
                          <label class="form-label fw-bold">Nhóm khách hàng</label>
                          <select class="form-control" name="type_id" id="type_id">
                            @foreach($type as $index => $item)
                            <option value="{{$item->id}}">{{$item->type_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-5 mx-3 mb-4">
                          <label class="form-label fw-bold">Giới tính</label>
                          <div class="form-check-label">
                            <input type="radio" name="gender" id="male" value="0" required>
                            <label class="form-check form-check-inline" for="male">Nam</label>
                            <input  type="radio" name="gender" id="female" value="1" required>
                            <label class="form-check form-check-inline" for="female">Nữ</label>
                          </div>

                        </div>
                        <div class="col-md-5 mx-3 mb-4">
                          <label class="form-label fw-bold">Số điện thoại</label>
                          <input type="text" class="form-control" name="phonenum" id="phonenum" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="col-md-5 mx-3 mb-4">
                          <label class="form-label fw-bold">Ngày sinh</label>
                          <input type="date" class="form-control" name="birthdate" id="birthdate" required>
                        </div>
                        <div class="col-md-11 mx-3 mb-4">
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
                          <input type="hidden" name="id" id="id">

                        </div>
                        <div class="col-md-11 mx-3 mb-4">
                          <label class="form-label fw-bold">Ghi chú</label>
                          <textarea name="note" id="note" class="form-control" rows="5"></textarea>
                        </div>
                        
                      </div>
      
                          </div>
      
                          <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ</button>
                              <button type="submit" class="btn btn-primary text-white shadow-none">Xác nhận</button>
                          </div>
                      </div>
                  </form>
              </div>
            </div> 
            {{-- Edit modal end --}}
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

  </body>

  <script>
    $(document).ready(function()
    {
      $(document).on('click', '.edit', function()
      {
        var id = $(this).val();
        $('#editCustomerModal').modal('show');

        $.ajax({
          type: "GET",
          url: "/customer/get_customer/" + id,
          success: function(response) 
          {
            
            $('#id').val(response.customer.id);
            $('#customer_name').val(response.customer.customer_name);
            $('#customer_id').val(response.customer.customer_id);
            $('#phonenum').val(response.customer.phonenum);
            $('#type_id').val(response.customer.type_id);
            response.customer.gender == 0 ? $('#male').prop('checked', true) : $('#female').prop('checked', true);;
            $('#birthdate').val(response.customer.birthdate);
            $('#note').val(response.customer.note);
          }
        })
      });
    });
  </script>

  @include('admin.js')
  @include('admin.customers.js.customer_js')
</html>