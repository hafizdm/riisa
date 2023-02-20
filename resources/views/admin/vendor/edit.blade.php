@extends('templates.header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <span class="fonts header-style">
        <b>Edit Data Vendor</b>
    </span>
    <ol class="breadcrumb">
      <li><a href="{{url("")}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url("beban")}}">Vendor</a></li>
      <li class="active"><a href="#">Edit Data</a></li>
      
    </ol>
  </section>
      
    <div class="container">
            
        <div class="row">
                <div class="col-lg-6">
                <form role="form" name="formdata" method="post" action="{{route('updatevendor', $master_vendor->id)}}">
                    @method('PATCH') 
                    @csrf
                        
                        <div class="form-group">
                            <label for="nama"> Nama Vendor</label>
                            <input name="nama" type="text" class="form-control" id="nama" value="{{$master_vendor->nama}}" placeholder="Masukan Nama Beban" required>
                            <span class="help-block" >{{ $errors->first('nama') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat </label>
                            <textarea name="alamat" type="text" class="form-control" id="alamat" rows="4" cols="50" required>{{$master_vendor->alamat}}</textarea>
                            <span class="help-block" >{{ $errors->first('alamat') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="contact_person">Contact Person </label>
                            <input name="contact_person" type="text" class="form-control" id="contact_person" value="{{$master_vendor->contact_person}}" placeholder="Masukan Contact Person" required>
                            <span class="help-block" >{{ $errors->first('contact_person') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="phone_no">Nomor Hp </label>
                            <input name="phone_no" type="text" class="form-control" id="phone_no" value="{{$master_vendor->phone_no}}" placeholder="Masukan Nomor HP" required>
                            <span class="help-block" >{{ $errors->first('phone_no') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"value="{{$master_vendor->email}}" placeholder="nama@mail.com">
                            <span id="email" class="help-block" > {{ $errors->first('email') }} </span>
                        </div>
                        </div>
                        <div class="col-lg-5">
                        <div class="form-group">
                            <label for="bank_1">Bank 1</label>
                            <input name="bank_1" type="text" class="form-control" id="bank_1" value="{{$master_vendor->bank_1}}" placeholder="Masukan Nama Bank">
                            <span class="help-block" >{{ $errors->first('bank_1') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="bank_account_1">Bank Account 1 </label>
                            <input name="bank_account_1" type="text" class="form-control" id="bank_account_1" value="{{$master_vendor->bank_account_1}}" placeholder="Masukan Account Bank">
                            <span class="help-block" >{{ $errors->first('bank_account_1') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="bank_rekening_1">Bank Rekening 1 </label>
                            <input name="bank_rekening_1" type="number" class="form-control" id="bank_rekening_1" value="{{$master_vendor->bank_rekening_1}}" placeholder="Masukan Rekening Bank">
                            <span class="help-block" >{{ $errors->first('bank_rekening_1') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="bank_2">Bank 2 </label>
                            <input name="bank_2" type="text" class="form-control" id="bank_2" value="{{$master_vendor->bank_2}}" placeholder="Masukan Nama Bank">
                            <span class="help-block" >{{ $errors->first('bank_2') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="bank_account_2">Bank Account 2 </label>
                            <input name="bank_account_2" type="text" class="form-control" id="bank_account_2" value="{{$master_vendor->bank_account_2}}" placeholder="Masukan Account Bank">
                            <span class="help-block" >{{ $errors->first('bank_account_2') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="bank_rekening_2">Bank Rekening 2 </label>
                            <input name="bank_rekening_2" type="number" class="form-control" id="bank_rekening_2" value="{{$master_vendor->bank_rekening_2}}" placeholder="Masukan Rekening Bank">
                            <span class="help-block" >{{ $errors->first('bank_rekening_2') }} </span>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan </label>
                            <input name="keterangan" type="text" class="form-control" id="keterangan" value="{{$master_vendor->keterangan}}" placeholder="Keterangan">
                            <span class="help-block" >{{ $errors->first('keterangan') }} </span>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
	                      <a href="{{url("listVendor")}}" class="btn btn-danger">Batal</a>
	              
                </form>
                </div>
            </div>
    </div>  
    <!-- Main content -->
    <section class="content">
     
    @endsection

   
