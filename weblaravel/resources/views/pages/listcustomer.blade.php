@extends('index')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1  style="color: white">Danh Sách Khách Hàng</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a  style="color: white" href="#">Trang Chủ</a></li>
                    <li  style="color: white" class="breadcrumb-item active">Danh Sách Khách Hàng</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        {{-- @include('admin.users.alert') --}}
        @error('addemail')
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{$message}}',
                showConfirmButton: false,
                timer: 1500
                })
            })
        </script>
        {{-- <div class="alert alert-danger">{{ $message}}</div> --}}
        @enderror
        @error('updatemail')
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{$message}}',
                showConfirmButton: false,
                timer: 1500
                })
            })
        </script>
        {{-- <div class="alert alert-danger">{{ $message}}</div> --}}
        @enderror
        @if(Session::has('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{Session::get('error')}}',
                showConfirmButton: false,
                timer: 1500
                })
            })
        </script>
        @endif
        @if(Session::has('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function (event) {
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{Session::get('success')}}',
                    showConfirmButton: false,
                    timer: 1500
                    })
                })
            </script>
        @endif
        @if(Session::has('qtv'))
        <script>
            
            document.addEventListener("DOMContentLoaded", function (event) {
                Swal.fire({
                    icon: 'error',
                    title: 'Không thể truy cập',
                    text: '{{Session::get('qtv')}}',
                })
        })
        </script>
        @endif
        <div class="">
            <!-- left column -->
            
            <!--/.col (left) -->
            <!-- right column -->
            <div class="card card-primary">
            <div class="card-body" style="padding-bottom: 0;">
                <div style="text-align: center;">
                    <button title="Thêm Email Mới Cho Khách Hàng" style="color: white; margin: 0 20px 0 20px;height: 40px" type="button" id="addcustomer" class="btn btn-info btn-sm"><i class="fas fa-plus-square" style="margin-right: 5px;"></i>Thêm Email</button>
                    {{-- <button type="button" id="addcustomer" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-square"></i></button> --}}
                    <button title="Chỉnh Sửa Email Cho Khách Hàng" style="color: white; margin: 0 20px 0 20px;height: 40px" type="button" id="editcustomer" class="editbtn btn btn-warning btn-sm"><i class="fas fa-edit" style="margin-right: 5px;"></i>Chỉnh Sửa Email</button>
                    <a title="Xóa Khách Hàng" style="margin: 0 20px 0 20px; height: 40px" href="{{route('listcustomer')}}" id="deletechecked" class="btn btn-danger btn-sm"><i style="padding-top: 8px;" class="far fa-trash-alt" style="margin-right: 5px;"></i> Xóa Nhiều</a>
                    {{-- <button type="button" id="test" class="editbtn btn btn-success btn-sm"><i class="fas fa-edit"></i></button> --}}
                </div>
            </div>
            <div class="card-body" style="padding-top: 0;">
                    {{-- <div class="row">
                        <div class="col-sm-12">
                            <table id="myTable" class="table table-bordered table-striped dataTable dtr-inline"
                                style="text-align:center" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                
                                        <th><input type="checkbox" id="checkall"></th>
                                        <th  style="text-align:center" class="sorting sorting_asc">STT</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">Tên Khách Hàng</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">SĐT</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">Email</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">Địa Chỉ</th>
                                        <th  style="text-align:center" class="sorting sorting_asc">Trạng Thái</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($customer))
                                    @foreach ($customer as $key=> $item)
                                    <tr id="ids{{$item->id}}" class="odd">
                                     
                                        <td><input type="checkbox" name="id" class="checkbox" value="{{$item->id}}"></td>
                                        <td class="dtr-control sorting_1">{{$key+1}}</td>
                                        <td>{{$item->customer_name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>
                                            @foreach($mail as $email)
                                            @if(($item->id)==($email->customer_id))
                                                {{$email->mail}} <br> 
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>{{$item->address}}</td>
                                        <td>
                                          @if ($item->status==0)
                                          <span class="badge badge-success">Hoạt động</span>
                                          @else
                                          <span class="badge badge-danger">Không hoạt động</span>
                                          @endif
                                        </td>
                                       
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7">Không có người dùng</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                          
                        </div>
                    </div> --}}

                    <div class="event-schedule-area-two bg-color pad100">
                        <div class="container" style="max-width: 100%; margin: 10px 10px;">
                            <!-- row end-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade active show" id="home" role="tabpanel">
                                            <div class="table-responsive">
                                                <table id="myTable" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%;" class="text-center" scope="col"><input style="cursor: pointer;" type="checkbox" id="checkall"></th>
                                                            <th style="width: 43%;" class="text-center" scope="col">Thông Tin Khách Hàng</th>
                                                            <th style="width: 22%;" class="text-center" scope="col">Email</th>
                                                            <th style="width: 15%;" class="text-center" scope="col">Trạng Thái</th>
                                                            <th style="width: 15%;" class="text-center" scope="col"><a title="Thêm Khách Hàng Mới" href="{{route('addcustomer')}}" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> Thêm Khách Hàng</a></th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($customer))
                                                        @foreach ($customer as $key=> $item)
                                                        <tr id="ids{{$item->id}}" class="odd" class="inner-box">
                                                            <td class="text-center" scope="row">
                                                                <input style="cursor: pointer;" type="checkbox" name="id" class="checkbox" value="{{$item->id}}">
                                                            </td>
                                                            <td>
                                                                <div class="event-wrap">
                                                                    <h5 style=" margin-bottom: 0; color:#cf057c;">{{$item->customer_name}}</h5>
                                                                    <div class="meta">
                                                                        <div class="organizers">
                                                                            <i class="fas fa-phone-square-alt" style="padding: 5px 5px;color:green"></i><span>{{$item->phone}}</span>
                                                                        </div>
                                                                        <div class="time">
                                                                            <i class="fas fa-map-marker-alt" style="padding: 5px 5px;color:red"></i><span>{{$item->address}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div style="font-weight: 600; font-size: 17px;" class="r-no">
                                                                    {{-- {{$item->email}}<a title="Xóa Email" href="" data-id="{{$item->id}}" class="delete_email"><i style="color: red" class="far fa-trash-alt "></i></a> <br> --}}
                                                                    @foreach($mail as $email)
                                                                    @if(($item->id)==($email->customer_id))
                                                                        {{$email->mail}} <a title="Xóa Email" href="" data-id="{{$email->id}}" class="delete_email"><i style="color: red" class="far fa-trash-alt "></i></a> <br> 
                                                                    @else
                                                                    @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="r-no">
                                                                    @if ($item->status==0)
                                                                    <span class="badge badge-success" style="font-size: 13px;">Hoạt dộng</span>
                                                                    @else
                                                                    <span class="badge badge-danger" style="font-size: 13px;">Không hoạt động</span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                
                                                                <a title="Chỉnh Sửa Thông Tin Khách Hàng" href="{{route('customer_edit1',['id'=>$item->id])}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                                                                <a title="Xóa Khách Hàng" href="#" id="delete1" data-id="{{$item->id}}" class="delete1 btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Xóa</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="7">Không có người dùng</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /col end-->
                            </div>
                            <!-- /row end-->
                        </div>
                    </div>
            </div>
            <div class="card-body">
                <div id="map"></div>
            </div>
           
        </div>
        </div>
        <!--/.col (right) -->
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
{{-- model add --}}
<div id="addModal"  class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
            <div class="modal-header">
                <h3 class="modal-title">Thêm Email</h3>
                <button onclick="$('#addModal').modal('hide')" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{route('customer_postemail')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <label style="max-width: 35%; flex-basis: 35%;" for="inputEmail3" class="col-sm-2 col-form-label">Chọn Khách Hàng</label>
                        <div style="max-width: 65%" class="col-sm-10">
                            <select name="customer_id" class="form-control" id="exampleInputRoll" >
                                {{-- <option value="0">Chọn customer</option> --}}
                                @if(!empty($customer))
                                @foreach($customer as $key=>$item)
                                <option value="{{$item->id}}">{{$item->customer_name}}</option>
                                @endforeach
                                @else
                                <option value="null">Không có khách hàng</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label style="max-width: 35%; flex-basis: 35%;" for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                        <div style="max-width: 65%" class="col-sm-10">
                            <input type="email" class="form-control" name="addemail" id="inputPassword3" placeholder="Nhập Email" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <button type="submit" style="background-color:#5C5696; color: white; border-radius: 5px;border: 2px solid #5C5696;" class="btn btn-info">Lưu</button>
                    <button type="button" class="btn btn-default" style="border-radius: 5px;border: 2px solid #5C5696;" onclick="$('#addModal').modal('hide')">Hủy bỏ</button>
                </div>
                <!-- /.card-footer -->
            </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
{{-- model edit --}}
  <div id="editModal"  class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          
              <div class="modal-header">
                  <h3 class="modal-title">Sửa Email</h3>
                  <button onclick="$('#editModal').modal('hide')" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- <input type="text" id="checkbox" name="checkid" value=""> --}}
              <form class="form-horizontal" id="form_editcustomer" action="{{route('post_customer_edit')}}" method="POST">
                  {{ csrf_field() }}
                  <div class="modal-body">
                        <div class="form-group row">
                            <label style="max-width: 35%; flex-basis: 35%;" for="customername" class="col-sm-2 col-form-label">Khách Hàng</label>
                            <div style="max-width: 65%" class="col-sm-10">
                                <input type="text" class="form-control" name="customer_name" id="customername" placeholder="Customer Name" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label style="max-width: 35%; flex-basis: 35%;" for="inputEmail3" class="col-sm-2 col-form-label">Email Cần Sửa</label>
                            <div style="max-width: 65%" class="col-sm-10">
                                <select name="mail_id" class="form-control" id="listcustomermail" >
                                    {{-- <option value="0">Chọn mail cần update</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label style="max-width: 35%; flex-basis: 35%;" for="customername" class="col-sm-2 col-form-label">Email Sửa Thành</label>
                            <div style="max-width: 65%" class="col-sm-10">
                                <input type="email" class="form-control" name="updatemail" id="update_mail" placeholder="Nhập Email" required>
                                <span id="username_error"></span>
                            </div>
                        </div>
                    </div>
                  <!-- /.card-body -->
                  <div class="modal-footer">
                      <button type="submit" style="background-color:#5C5696; color: white; border-radius: 5px;border: 2px solid #5C5696;" class="btn btn-info">Lưu</button>
                      <button type="button" class="btn btn-default" style="border-radius: 5px;border: 2px solid #5C5696;" onclick="$('#editModal').modal('hide')">Hủy bỏ</button>
                  </div>
                  <!-- /.card-footer -->
              </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
{{-- test  --}}
<div id="testModal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Thêm Email</h3>
                <button onclick="$('#testModal').modal('hide')" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{route('customer_postemail')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <label style="max-width: 30%; flex-basis: 30%;" for="inputEmail3" class="col-sm-2 col-form-label">Khách Hàng</label>
                        <div style="max-width: 70%" class="col-sm-10">
                            <select name="customer_id" class="form-control" id="listcustomeradd" >
                                <option value="null" >Chọn customer</option>
                                <option value="null">Không có customer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label style="max-width: 30%; flex-basis: 30%;" for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                        <div style="max-width: 70%" class="col-sm-10">
                            <input type="email" class="form-control" name="addemail" id="inputPassword3" placeholder="Nhập Email" required>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="modal-footer">
                    <button type="submit" style="background-color:#5C5696; color: white; border-radius: 5px;border: 2px solid #5C5696;" class="btn btn-info">Lưu</button>
                    <button type="button" class="btn btn-default" style="border-radius: 5px;border: 2px solid #5C5696;" onclick="$('#testModal').modal('hide')">Hủy bỏ</button>
                </div>
                <!-- /.card-footer -->
            </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  
  
@endsection





