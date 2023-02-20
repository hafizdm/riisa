
 <!-- Modal -->
 <div class="modal fade" id="myModalAdd" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><b>Form Add Talent</b></h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data" method="post" action="{{url("list-talent-pool/store")}}">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nik">Full name*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter fullname" required>
            </div>
            <div class="form-group">
                <label for="nik">Birthday*</label>
                <div class="row">
                    <div class="col-md-6 col-xs-6 col-lg-6">
                        <input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="Enter birth place" required>
                    </div>
                    <div class="col-md-6 col-xs-6 col-lg-6">
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="jk">Gender*</label>
                <select id="jk" name="jk" class="form-control select2" style="width: 100%" required>
                    <option value="">Select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Address*</label>
                <textarea class="form-control" rows="3" id="alamat" name="alamat" required>
                </textarea>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input class="form-control" id="city" name="city">
            </div>
            <div class="form-group">
                <label for="province">State/Province</label>
                <select class="form-control select2" id="state" name="state" style="width: 100%">
                    <option value="">Select state/province</option>
                    <option value="Aceh">Aceh</option>
                    <option value="Sumatera Utara">Sumatera Utara</option>
                    <option value="Sumatera Barat">Sumatera Barat</option>
                    <option value="Riau">Riau</option>
                    <option value="Kepulauan Riau">Kepulauan Riau</option>
                    <option value="Sumatera Selatan">Sumatera Selatan</option>
                    <option value="Kep.Bangka Belitung">Kepulauan Bangka Belitung</option>
                    <option value="Bengkulu">Bengkulu</option>
                    <option value="Lampung">Lampung</option>
                    <option value="DKI Jakarta">DKI Jakarta</option>
                    <option value="Jawa Barat">Jawa Barat</option>
                    <option value="Jawa Tengah">Jawa Tengah</option>
                    <option value="DI Yogyakarta">DI Yogyakarta</option>
                    <option value="Jawa Timur">Jawa Timur</option>
                    <option value="Bali">Bali</option>
                    <option value="NTT">Nusa Tenggara Timur</option>
                    <option value="NTB">Nusa Tenggara Barat</option>
                    <option value="Kalimantan Barat">Kalimantan Barat</option>
                    <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                    <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                    <option value="Kalimantan Timur">Kalimantan Timur</option>
                    <option value="Sulawesi Utara">Sulawesi Utara</option>
                    <option value="Gorontalo">Gorontalo</option>
                    <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                    <option value="Sulawesi Barat">Sulawesi Barat</option>
                    <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                    <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                    <option value="Maluku">Maluku</option>
                    <option value="Maluku Utara">Maluku Utara</option>
                    <option value="Papua Barat">Papua Barat</option>
                    <option value="Papua">Papua</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nik">Last Education*</label>
                <select class="form-control select2" id="pendidikan_terakhir" name="pendidikan_terakhir" style="width: 100%" required>
                    <option value="">Select last education</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Email*</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="nik">Phone Number*</label>
                <div class="row">
                    <div class="col-md-2 col-xs-2 col-lg-2">
                        <input type="text" class="form-control" id="kode_telepon" name="kode_telepon" value="+62" required disabled>
                        <!--{{-- <select name="kode_telepon" id="kode_telepon" class="form-control select2">-->
                        <!--    <option value=""></option>-->
                        <!--    @foreach ($dta as $item)-->
                        <!--        <option value="{{$item->phonecode}}">+{{$item->phonecode}}</option>-->
                        <!--    @endforeach-->
                        <!--</select> --}}-->
                    </div>
                    <div class="col-md-10 col-xs-10 col-lg-10">
                        <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Enter phone number" maxlength="13" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="nik">Linkedin</label>
                <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Enter linkedin">
            </div>
           
            <div class="form-group">
                <label for="nik">Total Work Years*</label>
                <input type="number" class="form-control" id="total_pengalaman_kerja" name="total_pengalaman_kerja" placeholder="Enter total work years" required>
            </div>
            <div class="form-group">
                <label for="nik">Position Applied*</label>
                {{-- <input type="text" class="form-control" id="jb_apply" name="jb_apply" placeholder="Enter position applied" required> --}}
                <select name="jb_apply" id="jb_apply" class="form-control select2" style="width: 100%">
                    <option disabled>Select position applied</option>
                    @foreach ($job_position as $item)
                        <option value="{{$item->nama}}">{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Upload CV/Resume</label>
                <input type="file" class="form-control" id="cv" name="cv" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
            </div>
            <div class="form-group">
                <label for="nik">Upload Photo</label>
                <input type="file" class="form-control" id="profile" name="profile" title="File max 2MB">
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
    </div>
</div>

@push('script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

    <script>
        $('.select2').select2();
    </script>
@endpush
