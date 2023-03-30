@extends('index')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1  style="color: white">Cập Nhật Nhân Viên</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a  style="color: white" href="#">Trang Chủ</a></li>
            <li  style="color: white" class="breadcrumb-item active">Cập Nhật Nhân Viên</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      {{-- @include('admin.users.alert') --}}
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
              <div class="card-body" >
                <div class="form-group">
                  <div class="avatar-wrapper">
                    <img class="profile-pic" name="anhdaidien" src="{{old('anhdaidien') ?? $edit->avatar}}" />
                    <div class="upload-button">
                      <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                    </div>
                    <input class="file-upload" type="file" name="avatar" id="exampleInputAvatar" accept="image/*"/>
                    <input type="hidden" name="file" id="file" value="{{$edit->avatar}}">
                  </div>
                  @error('file')
                  <div style="text-align: center;">
                    <span style="color: red">* {{$message}}</span>
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputFullname">Họ Tên Nhân Viên:</label>
                  <input type="text" value="{{old('name') ?? $edit->name}}" name="name" class="form-control"  placeholder="Enter Full name">
                  {{-- @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->name() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif --}}
                  @error('name')
                  <span style="color: red">* {{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPhone">SĐT:</label>
                  <input type="text" inputmode="numeric"  name="phone" value="{{old('phone') ?? $edit->phone}}" class="form-control" id="exampleInputPhone" placeholder="Enter Phone">
                  @error('phone')
                  <span style="color: red">* {{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email" value="{{old('email') ?? $edit->email}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  @error('email')
                  <span style="color: red">* {{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputAddress">Địa Chỉ:</label>
                  <input type="text" name="address" class="form-control" value="{{old('address') ?? $edit->address}}" id="exampleInputAddress" placeholder="Enter email">
                  @error('address')
                  <span style="color: red">* {{$message}}</span>
                  @enderror
                </div>
                {{-- <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" value="{{old('password')}}" id="exampleInputPassword1" placeholder="Password">
                  @error('password')
                    <div class="alert alert-danger">{{ $message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputCfPassword1">Confirm Password</label>
                  <input type="password" name="confirm_password" class="form-control" value="{{old('confirm_password') }}" id="exampleInputCfPassword1" placeholder="Password">
                  @error('confirm_password')
                    <div class="alert alert-danger">{{ $message}}
                    </div>
                  @enderror
                </div> --}}
                {{-- <div class="form-group">
                  <label for="exampleInputAvatar">Ảnh Đại Diện:</label><br>
                  <input type="file" name="avatar" id="exampleInputAvatar">
                  <div id="image_show" style="padding-top: 10px">

                  </div>
                  <input type="hidden" name="file" id="file">
                  @error('file')
                  <span style="color: red">* {{$message}}</span>
                  @enderror
                </div> --}}
                <div class="form-group">
                  <label for="exampleInputRoll">Vai trò</label>
                  {{-- <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> --}}
                  {{-- <input type="radio" name="Admim" value="0" class="form-control" checked="checked" />
                  <input type="radio" name="Employe" value="1" class="form-control" id="exampleInputRoll/> --}}
                  <select name="roll" class="form-control" id="exampleInputRoll">
                    @if($edit->roll==0){
                      <option value="0">QTV</option>
                      <option value="1">NV</option>
                    }
                    @elseif($edit->roll==1){
                      <option value="1">NV</option>
                      <option value="0">QTV</option>
                    }
                    @endif
                </select>
                </div>
              <!-- /.card-body -->
              <div class="card-footer row" style="justify-content: flex-end; background-color: white; padding-top: 24px;">
                <button style="background-color:#5C5696;width: 70px; margin-right: 20px;color: white; border-radius: 5px;border: 2px solid #5C5696;" type="submit" class="btn btn-primary">Lưu</button>
                <input style="width: 85px" type="button" style="border-radius: 5px;border: 2px solid #5C5696;" onclick="location.href='{{route('listemploye')}}'" value="Hủy bỏ">
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