@extends('templates.header')

@section('content')

<section class="content"> 

<div class="row">
        <div class="col-xs-12 col-xl-8 col-lg-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title fonts"><b>Tambah Data Asset</b></h3>
            </div>
            <div class="box-body">
              <div id="notif" ></div>
              <!-- form karyawan -->
              <div class="row">
                  <!-- bilah kiri -->
                <div class="col-xs-12 col-xl-12 col-lg-12">
                    <form role="form" name="formdata" method="post" action="{{url("list-asset/store")}}" enctype="multipart/form-data">
                        {{csrf_field()}}   
                        <div class="form-group">
                            <label for="id">Kategori Asset*</label>
                            <select name="asset_category" type="text" class="form-control" id="asset_category"  style="width: 100%;" onchange="jenisAsset(this.options[this.selectedIndex].value)" required>
                                <option selected disabled>Pilih Kategori Asset</option>
                                @foreach($asset_category as $a )
                                    <option value="{{$a->id }}">{{ $a->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="div1" style="display: none;">
                            <div class="form-group">
                              <label>Jenis Asset*</label>
                              <select name="jenis_asset" type="text" class="form-control" id="jenis_asset"  style="width: 100%;" onchange="merkLaptop(this.options[this.selectedIndex].value)" required>
                                  <option selected disabled>Pilih Jenis Asset</option>
                                  <option value="1">Laptop</option>
                                  <option value="2">Printer</option>
                                  <option value="3">Mouse</option>
                                  <option value="4">Router</option>
                                  <option value="5">TV</option>
                                  <option value="6">Proyektor</option>
                                  <option value="8">HT</option>
                                  <option value="7">Lainnya</option>
                              </select>
                            </div>
                        </div>
                        <div id="div2" style="display: none;">
                         <div class="form-group">
                            <label>Merk Laptop*</label>
                            <select name="no_asset_laptop" type="text" class="form-control" id="no_asset_laptop"  style="width: 100%;" required>
                                <option selected disabled>Pilih Jenis Asset</option>
                                <option value="HP">HP</option>
                                <option value="DELL">Dell</option>
                                <option value="SM">Tab Samsung</option>
                                <option value="LNV">Lenovo</option>
                                <option value="MAC">Mac</option>
                                <option value="AS">Asus</option>
                                <option value="XX">Lainnya</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="asset_name">Nama Asset*</label>
                            <input type="text" class="form-control" id="asset_name" name="asset_name" placeholder="Masukkan Nama Asset" required>
                        </div>

                        <div class="form-group">
                            <label for="acquisition_date">Acquisition Date</label>
                            <input type="date" class="form-control" id="acquisition_date" name="acquisition_date">
                        </div>

                        <div class="form-group">
                            <label>Initial Cost</label>
                            <input type="text" class="form-control" name="initial_cost" id="initial_cost" pattern="^\Rp\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="initial_cost" placeholder="Rp.1,000,000.00">
                        </div>

                        <div class="form-group">
                            <label>Nama Pengguna</label>
                            <input type="text" class="form-control" id= "nama_pengguna" name="nama_pengguna" placeholder="Masukkan nama pengguna(optional)">
                        </div>

                        {{-- <div class="form-group">
                            <label for="acquisition_depreciation">Acquisition Depreciation</label>
                            <input type="text" class="form-control" name="acquisition_depreciation" id="acquisition_depreciation" pattern="^\Rp\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="acquisition_depreciation" placeholder="Rp.1,000,000.00">
                        </div>

                        <div class="form-group">
                            <label for="book_value">Book Value</label>
                            <input type="text" class="form-control" name="book_value" id="book_value" pattern="^\Rp\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="book_value" placeholder="Rp.1,000,000.00">
                        </div> --}}

                        <button type="submit" class="btn btn-primary">Simpan</button>
	                      <a href="{{url('list-asset')}}" class="btn btn-danger">Batal</a>
	              
                </form>
              <!-- end of form karyawan -->
            </div>
          </div>
        </div>
      </div>
      </div>
</div>
      </section>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script type="text/javascript">
    
function reset(){
    $('.select2').val(null).trigger('change');
}

//Initialize Select2 Elements
$('.select2').select2()

$('.datepicker').datepicker({
    format: 'yyyy/mm/dd',
      autoclose: true
})

function jenisAsset(val){
    if(val == 3){
        document.getElementById("div1").style.display = "block";
    }
    else{
        document.getElementById("div2").style.display = "none";
        document.getElementById("div1").style.display = "none";
    }
}

function merkLaptop(val){
    if(val == 1){
        document.getElementById("div2").style.display = "block";
    }
    else{
        document.getElementById("div2").style.display = "none";
    }
}

$("input[data-type='initial_cost']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});

// $("input[data-type='acquisition_depreciation']").on({
//     keyup: function() {
//       formatCurrency($(this));
//     },
//     blur: function() { 
//       formatCurrency($(this), "blur");
//     }
// });

// $("input[data-type='book_value']").on({
//     keyup: function() {
//       formatCurrency($(this));
//     },
//     blur: function() { 
//       formatCurrency($(this), "blur");
//     }
// });


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "Rp" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "Rp" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}



</script>
@endpush
