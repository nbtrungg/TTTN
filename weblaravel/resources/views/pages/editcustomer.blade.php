@extends('index')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="color: white">Cập Nhật Khách Hàng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a  style="color: white" href="#">Trang chủ</a></li>
            <li  style="color: white" class="breadcrumb-item active">Cập Nhật Khách Hàng</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      {{-- @include('admin.users.alert') --}}
      @if(Session::has('success'))
      <div class="alert alert-success">
          {{Session::get('success')}}
      </div>
      @endif
      @if(Session::has('error'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
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
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary" style="width: 50%; margin-left: 25%">
            {{-- <div class="card-header">
              <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
            </div> --}}
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm" action="" method="POST">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputFullname">Họ Tên Khách Hàng:</label>
                  <input type="text" value="{{old('name') ?? $edit->customer_name}}" name="name" class="form-control"  placeholder="Nhập họ tên khách hàng">
                  @error('name')
                  <span style="color: red">* {{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPhone">SĐT:</label>
                  <input type="text" inputmode="numeric"  name="phone" value="{{old('phone') ?? $edit->phone}}" class="form-control" id="exampleInputPhone" placeholder="Nhập SĐT">
                  @error('phone')
                  <span style="color: red">* {{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputAddress">Địa Chỉ:</label>
                  <input type="text" name="address" class="form-control" value="{{old('address') ?? $edit->address}}" id="exampleInputAddress" placeholder="Nhập địa chỉ">
                  @error('address')
                    <span style="color: red">* {{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputRoll">Trạng Thái</label>
                  {{-- <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> --}}
                  {{-- <input type="radio" name="Admim" value="0" class="form-control" checked="checked" />
                  <input type="radio" name="Employe" value="1" class="form-control" id="exampleInputRoll/> --}}
                  <select name="status" class="form-control" id="exampleInputRoll" >
                    @if($edit->status==0)
                    <option value="0">Hoạt động</option>
                    <option value="1">Không hoạt động</option>
                    @elseif($edit->status==1)
                    <option value="1">Không hoạt động</option>
                    <option value="0">Hoạt động</option>
                    @endif
                  </select>
                  @error('status')
                    <span style="color: red">* {{$message}}</span>
                  @enderror
                </div>
              <!-- /.card-body -->
              <div class="card-footer row" style="justify-content: flex-end; background-color: white;padding-top: 24px;">
                <button style="background-color:#5C5696;margin-right: 20px;width: 70px;color: white; border-radius: 5px;border: 2px solid #5C5696;" type="submit" class="btn btn-primary">Lưu</button>
                <input style="width: 85px" type="button" class="btn btn-secondary" style="border-radius: 5px;border: 2px solid #5C5696;" onclick="location.href='{{route('listcustomer')}}'" value="Hủy bỏ">
              </div>
              @csrf
              
            </form>
          </div>
          <!-- /.card -->
          </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  @endsection