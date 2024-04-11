<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <title>Danh sách phiếu nhập kho</title>
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
                  <h2 class="h2-font mb-5">Danh sách phiếu nhập kho</h2>
                </div>
                <table id="tableProduct" class="table table-hover border table-striped text-center mt-5">
                  <thead>
                    <tr class="bg-dark text-light">
                      <th scope="col">#</th>
                      <th scope="col">Tên sản phẩm</th>
                      <th scope="col">Ảnh</th>
                      <th scope="col">Mã sản phẩm</th>
                      <th scope="col">Tồn kho thực tế</th>
                      <th scope="col">Tồn kho ảo</th>
                      <th scope="col">Nhóm sản phẩm</th>
                      <th scope="col">Giá bán lẻ</th>
                      <th scope="col">Tag</th>
                      <th scope="col">Trạng thái</th>
                      <th scope="col">Hành động</th>
                    </tr>
                    <tbody>
                      @foreach ($product as $index => $item)
                      
                      <tr class="align-middle">
                        <td>{{$index +1}} </td>
                        <td style="max-width: 250px">{{$item->product_name}}</td>
                        <td><img src="/product/{{$item->image}}" width="160px" height="240px"></td>
                        <td>{{$item->product_id}}</td>
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
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

  </body>


  @include('admin.js')
</html>