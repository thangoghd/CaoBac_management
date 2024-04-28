<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Danh sách sản phẩm</title>
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
                  <h2 class="h2-font mb-5">Danh sách sản phẩm</h2>
                </div>
                <table id="tableProduct" class="table table-hover border table-striped text-center mt-5">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Tên sản phẩm</th>
                      <th scope="col">Ảnh</th>
                      <th scope="col">Tồn kho thực tế</th>
                      <th scope="col">Tồn kho ảo</th>
                      <th scope="col">Nhóm sản phẩm</th>
                      <th scope="col">Giá bán lẻ</th>
                      <th scope="col">Tag</th>
                      <th scope="col">Trạng thái</th>
                      <th scope="col">Hành động</th>
                    </tr>
                    <tbody>
                      @foreach ($products as $index => $item)
                      
                      <tr class="align-middle">
                        <td>{{$index +1}} </td>
                        <td style="max-width: 250px">{{$item->product_name}}</td>
                        <td><img src="/product/{{$item->image}}" width="160px" height="240px"></td>
                        <td>{{$item->actual_inventory}}</td>
                        <td>{{$item->virtual_inventory}}</td>
                        <td>{{$item->category_name}}</td>
                        <td>{{number_format($item->price, 0, ",", ",");}}</td>
                        <td>{{$item->tag}}</td>
                        <td>{{ $item->status == '1' ? 'Còn hàng' : 'Hết hàng' }}</td>
                        <td> 
                          <button type="button" onclick="" href="" title="Xem chi tiết" class="btn btn-success shadow-none btn-sm"><i class="fa-solid fa-eye"></i></button>
                          <button type="button" title="Sửa" value="{{$item->id}}" class="btn btn-primary shadow-none btn-sm edit"><i class="fa-solid fa-pencil"></i></button>               
                          <a type="button" onclick="return confirm('Bạn có chắc rằng muốn xoá? Dữ liệu sẽ không thể phục hồi.')" href="{{route('delete.product', $item->id)}}" title="Xoá" class="btn btn-danger shadow-none btn-sm"><i class="fa-solid fa-trash"></i></a>
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
            <!-- Modal for editing product -->
            <div  class="modal fade" id="editProductModal"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                  <form action="{{route('update.product', ['id' => $item->id])}}" autocomplete="off" method="POST"  enctype="multipart/form-data">

                  @csrf
                  @method('PUT')
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Sửa dữ liệu sản phẩm</h5>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-12 mb-3">
                                      <label class="form-label fw-bold">Tên sản phẩm</label>
                                      <input type="text" name="product_name" id="product_name" class="form-control shadow-none" required>
                                  </div>

                                  <div class="col-md-6 mb-3">
                                      <label class="form-label fw-bold">Nhóm sản phẩm</label>
                                      <select class="form-control" name="category_id" id="category_id">
                                        @foreach($category as $index =>$item)
                                        <option value="{{$item->id}}">{{$item->category_name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  <div class="col-md-6 mb-3">
                                      <label class="form-label fw-bold">Giá</label>
                                      <input type="number" name="price" id="price" class="form-control shadow-none" required>
                                  </div>
                                  <div class="col-12 mb-3">
                                  <label class="form-label fw-bold">Decription</label>
                                      <textarea name="decription" id="decription" rows="6" class="form-control shadow-"></textarea>
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
        $('#editProductModal').modal('show');

        $.ajax({
          type: "GET",
          url: "/product/get_product/" + id,
          success: function(response) 
          {
            $('#product_name').val(response.product.product_name);
            $('#price').val(response.product.price);
            $('#category_id').val(response.product.category_id).change();
            $('#decription').val(response.product.decription);
          }
        })
      });
    });
  </script>

  @include('admin.js')
</html>