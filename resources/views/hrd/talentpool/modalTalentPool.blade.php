{{-- Modal Score --}}
<div class="modal fade" id="modalAddScore" role="dialog" aria-labelledby="modalAddScoreLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalAddScoreLabel">Add Score Interview</h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <input class="form-control" name="id_score" id="id_score" type="hidden"/>
                <label>Score Interview HRD</label>
                <input type="number" class="form-control" id="interview_hrd" name="interview_hrd" placeholder="Enter score here" required>
            </div>
            <div class="form-group">
                <label>Score Interview User</label>
                <input type="number" class="form-control" id="interview_user" name="interview_user" placeholder="Enter score here" required>
            </div>
            <div class="form-group">
                <label>Score Interview BOD</label>
                <input type="number" class="form-control" id="interview_bod" name="interview_bod" placeholder="Enter score here" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnAddScore">Save</button>
        </div>
        </form>
        </div>
    </div>
</div>

{{-- Modal Contact Information --}}
<div class="modal fade" id="modalContactInformation" role="dialog" aria-labelledby="modalContactInformationLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalContactInformationLabel">Edit Contact Information</h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label>Phone number</label>
                <input class="form-control" name="id_contact" id="id_contact" type="hidden"/>
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="kode_telp" name="kode_telp" required>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Enter phone number" maxlength="13" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label>Linkedin</label>
                <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Enter linkedin" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnUpdateContact">Save</button>
        </div>
        </form>
        </div>
    </div>
</div> 

{{-- Modal Upload CV --}}
<div class="modal fade" id="modalUploadCV" role="dialog" aria-labelledby="modalUploadCVLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalUploadCVLabel">Upload CV/Resume</h4>
        </div>
        <form id="formuploadCV" name="formdata" enctype="multipart/form-data">
         {{-- {{ csrf_field() }} --}}
        <div class="modal-body">
            <div class="form-group">
                <label>CV/Resume</label>
                <input class="form-control" name="id_upload" id="id_upload" value="" type="hidden"/>
                <input type="file" class="form-control" name="file_cv" id="file_cv" value="" required accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnUploadCV">Save</button>
        </div>
        </form>
        </div>
    </div>
</div>

{{-- Modal Change Profile --}}
<div class="modal fade" id="changeProfile" role="dialog" aria-labelledby="modalChangeProfileLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalChangeProfileLabel">Change Photo Profile</h4>
        </div>
        <form name="formdata" enctype="multipart/form-data" id="formChangeProfile">
        <div class="modal-body">
            <div class="form-group">
                <input class="form-control" name="id_photo" id="id_photo" value="" type="hidden"/>
                <center>
                    @if($talent_pool->profile != null)
                        <img src="{{asset('uploads/Talentpool')."/".$talent_pool->id."/".$talent_pool->profile}}" style="height: 100px" id="talent_img" name="talent_img" class="img-circle">
                    @else
                        <img src="{{ asset('AdminLTE-2.3.11/dist/img/avatar.png') }}" style="height: 100px" id="talent_img" name="talent_img" class="img-circle">
                    @endif
                    <div style="padding-bottom:10px">
                    </div>
                    <label for="foto_karyawan">Upload photo*</label>
                    <input type="file" name="profile" id="profile" value="" class="form-control">
                </center>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" value="Submit" id="btnChangeProfile">Save</button>
        </div>
        </form>
        </div>
    </div>
</div>


{{-- Modal Interview HRD --}}
<div class="modal fade" id="interviewHRD" role="dialog" aria-labelledby="modalinterviewHRDLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalinterviewHRDLabel">Upload File Score</h4>
        </div>
        <form name="formdata" enctype="multipart/form-data" id="formUploadScoreHRD">
        {{-- @csrf --}}
        <div class="modal-body">
            <div class="form-group">
                <label for="foto_karyawan">File*</label>
                <input type="hidden" name="id_file_hrd" id="id_file_hrd" class="form-control" value="">
                <input type="file" name="file_score_hrd" id="file_score_hrd" class="form-control" value="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="btnUploadScoreHRD" class="btn btn-primary">Save</button>
        </div>
        </form>
        </div>
    </div>
</div>


{{-- Modal Interview User --}}
<div class="modal fade" id="interviewUser" role="dialog" aria-labelledby="modalinterviewUserLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalinterviewUserLabel">Upload File Score</h4>
        </div>
        <form name="formdata" enctype="multipart/form-data" id="formUploadScoreUser">
        {{-- @csrf --}}
        <div class="modal-body">
            <div class="form-group">
                <label for="foto_karyawan">File*</label>
                <input type="hidden" name="id_file_user" id="id_file_user" class="form-control" value="">
                <input type="file" name="file_score_user" id="file_score_user" class="form-control" value="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="btnUploadScoreUser" class="btn btn-primary">Save</button>
        </div>
        </form>
        </div>
    </div>
</div>

{{-- Modal Interview BOD --}}
<div class="modal fade" id="interviewBOD" role="dialog" aria-labelledby="modalinterviewBODLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalinterviewBODLabel">Upload File Score</h4>
        </div>
        <form name="formdata" enctype="multipart/form-data" id="formUploadScoreBOD">
        {{-- @csrf --}}
        <div class="modal-body">
            <div class="form-group">
                <label for="foto_karyawan">File*</label>
                <input type="hidden" name="id_file_bod" id="id_file_bod" class="form-control" value="">
                <input type="file" name="file_score_bod" id="file_score_bod" class="form-control" value="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnUploadScoreBOD">Save</button>
        </div>
        </form>
        </div>
    </div>
</div>

{{-- Modal Personal Information --}}
<div class="modal fade" id="modalPersonalInfo" role="dialog" aria-labelledby="modalPersonalInfoLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalPersonalInfoLabel">Personal Information</h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label>Full name</label>
                <input class="form-control" name="id_personalinfo" id="id_personalinfo" type="hidden"/>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required>
            </div>

            <div class="form-group">
                <label>Birthday</label>
                <div class="row">
                    <div class="col-md-6">
                         <input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="Enter birth place" required>
                    </div>
                    <div class="col-md-6">
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="jk" id="jk" class="form-control" style="width:100%">
                    <option value="">Select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input class="form-control" id="city" name="city">
            </div>

            <div class="form-group">
                <label for="province">State/Province</label>
                <select class="form-control" id="state" name="state" style="width:100%">
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
                <label>Last Education</label>
                <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control" style="width:100%">
                    <option value="">Select last education</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>

            <div class="form-group">
                <label>Total Work Years</label>
                <input type="number" class="form-control" id="total_pengalaman_kerja" name="total_pengalaman_kerja" placeholder="Enter total work years" required>
            </div>
            <div class="form-group">
                <label>Position Applied</label>
                {{-- <input type="text" class="form-control" id="jb_apply" name="jb_apply" placeholder="Enter position applied" required> --}}
                <select name="jb_apply" id="jb_apply" class="form-control" style="width: 100%">
                    <option disabled>Select position applied</option>
                    @foreach ($job_position as $item)
                        <option value="{{$item->nama}}">{{$item->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnUpdatePersonalInfo">Save</button>
        </div>
        </form>
        </div>
    </div>
</div>

@push('script')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> --}}

<script>
    // $('#pendidikan_terakhir').select2();
    // $('#state').select2();
    // $('#jk').select2();

    $(document).ready(function(){
        $('#profile').change(function(){
                preview_foto(this);
            });
    });

    function preview_foto(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#talent_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
