<!-- Modal -->
<div class="modal fade tambahspd"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center><h4 class="modal-title" id="exampleModalLabel"><b>Submission of
              <br>
                Official Travel Document Form (SPD) </b></h4></center>
                <br>
        </div>
        
        <div class="modal-body">
            <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{url("pengajuan-spd/store")}}">
                @csrf
            <div class="row">
                <div class="col-xs-12 col-xl-6 col-lg-6">
                    <div class="form-group">
                        <label for="tgl_keberangkatan">Form Date</label>
                        <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="form_date" name="form_date"  placeholder="yyyy/mm/dd" required >
                        <span class="help-block" >{{ $errors->first('tgl_keberangkatan') }} </span>
                    </div>
                    <div class="form-group">
                        <label for="nama">Name*</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{Auth::user()->user_login->nama}}" placeholder="" readonly >
                        <span id="nama" class="help-block" > {{ $errors->first('nama') }} </span>
                    </div>
                    <div class="form-group" id="nik">
                        <label for="nik">Employee Number*</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{Auth::user()->user_login->nik}}" placeholder="" readonly >
                        <span id="nik" class="help-block" > {{ $errors->first('nik') }} </span>
                    </div>

                    <div class="form-group">
                        <label for="divisi_nama">Position*</label>
                            <input type="text" class="form-control" id="divisi_nama" name="divisi_nama" value="{{Auth::user()->user_login->divisi_id != 0 ? Auth::user()->user_login->divisi->nama : '-'}}" placeholder="" readonly >
                            <input type="hidden" class="form-control" id="divisi_id" name="divisi_id" value="{{Auth::user()->user_login->divisi_id}}">
                            <span id="divisi_nama" class="help-block" > {{ $errors->first('divisi_nama') }} </span>
                    </div>

                    <div class="form-group">
                        <label for="travel_type"> Travel Type*</label>
                        <select class="form-control select2" name="travel_type" id="travel_type" style="width: 100%;" required>
                        <option selected disabled>Travel Type</option>
                        <option value='Domestic'>Domestic</option>
                        <option value='International'>International</option>
                        </select>
                        <span id="travel_type" class="help-block" > {{ $errors->first('travel_type') }} </span>
                    </div>

                    <div class="form-group eat_per_day">
                        <label for="eat_per_day">Eat Perday</label>
                        <input type="text" id="eat_per_day" value="{{ Auth::user()->user_login->jabatan->eat_per_day_domestic }}" name="eat_per_day_domestic"  class="form-control domestic" disabled/>
                        <input type="text" id="eat_per_day" value="{{ Auth::user()->user_login->jabatan->eat_per_day_international }}" name="eat_per_day_international"  class="form-control international" disabled/>
                    </div>
                    <div class="form-group allowance_per_day">
                        <label for="allowance_per_day">Allowance Perday</label>
                        <input type="text" id="allowance_per_day" value="{{ Auth::user()->user_login->jabatan->allowance_per_day_domestic }}" name="allowance_per_day_domestic"  class="form-control domestic" disabled/>
                        <input type="text" id="allowance_per_day" value="{{ Auth::user()->user_login->jabatan->allowance_per_day_international }}" name="allowance_per_day_international"  class="form-control international" disabled/>
                    </div>

                    <div class="form-group">
                        <label for="assignment_type"> Assignment Type*</label>
                        <select class="form-control select2" name="assignment_type" id="assignment_type" style="width: 100%;" required>
                        <option selected disabled>Assignment Type</option>
                        <option value='Normal'>Normal</option>
                        <option value='On Duty 24 Hours'>On Duty 24 Hours</option>
                        <option value='Visit'>Visit</option>
                        </select>
                        <span id="assignment_type" class="assignment_type" > {{ $errors->first('assignment_type') }} </span>
                    </div>

                    <div class="form-group" id="purpose">
                        <label for="purpose">Purpose*</label>
                        <textarea id="purpose" name="purpose" rows="4" cols="50" class="form-control" required></textarea>
                        {{-- <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="" > --}}
                        <span id="purpose" class="help-block" > {{ $errors->first('purpose') }} </span>
                    </div>

                    <div class="form-group" id="asal">
                        <label for="asal">From*</label>
                        <input type="text" id="asal" name="asal" rows="4" cols="50" class="form-control" required/>
                        {{-- <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="" > --}}
                        <span id="asal" class="help-block" > {{ $errors->first('asal') }} </span>
                    </div>

                    <div class="form-group" id="tujuan">
                        <label for="tujuan">Destination*</label>
                        <input type="text" id="tujuan" name="tujuan" rows="4" cols="50" class="form-control" required/>
                        {{-- <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="" > --}}
                        <span id="tujuan" class="help-block" > {{ $errors->first('tujuan') }} </span>
                    </div>
                </div>
              <!-- end of bilah kiri -->

              <!-- bilah tengah -->
                <div class="col-xs-12 col-xl-6 col-lg-6">
                    <div class="form-group" id="tgl_keberangkatan">
                        <label for="tgl_keberangkatan">Date Departure*</label>
                        <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_keberangkatan" name="tgl_keberangkatan"  placeholder="yyyy/mm/dd" required >
                        <span class="help-block" >{{ $errors->first('tgl_keberangkatan') }} </span>
                    </div>

                    <div class="form-group" id="tgl_pulang">
                        <label for="tgl_pulang">Date Return*</label>
                        <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="tgl_pulang" name="tgl_pulang"  placeholder="yyyy/mm/dd" required >
                        <span class="help-block" >{{ $errors->first('tgl_pulang') }} </span>
                    </div>

                    <div class="form-group" id="travel_by">
                        <label for="travel_by">Travel By*</label>
                        <input type="tavel_by" name="travel_by" rows="4" cols="50" class="form-control" required/>
                        <span id="travel_by" class="help-block" > {{ $errors->first('travel_by') }} </span>
                    </div>

                    <div class="form-group">
                        <label for="advance_payment"> Advance Payment*</label>
                        <select class="form-control select2" name="advance_payment" id="advance_payment" style="width: 100%;" required>
                        <option selected disabled>Advance Payment</option>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>
                        </select>
                        <span id="advance_payment" class="help-block" > {{ $errors->first('advance_payment') }} </span>
                    </div>

                    <div class="form-group" id="idr">
                        <label for="idr">Additional Cost</label>
                        <input type="idr" name="idr" rows="4" cols="50" class="form-control" placeholder="don't use (.) or(,) Ex: 1000000" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
                        <span id="idr" class="help-block" > {{ $errors->first('idr') }} </span>
                    </div>

                    <div class="form-group" id="sign_received">
                        <label for="sign_received">Sign Received</label>
                        <input type="sign_received" name="sign_received" rows="4" cols="50" class="form-control"/>
                        {{-- <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="" > --}}
                        <span id="sign_received" class="help-block" > {{ $errors->first('sign_received') }} </span>
                    </div>

                    <div class="form-group" id="note">
                        <label for="note">Note</label>
                        <textarea id="note" name="note" rows="4" cols="50" class="form-control"></textarea>
                        {{-- <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="" > --}}
                        <span id="note" class="help-block" > {{ $errors->first('note') }} </span>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{url("pengajuan-spd")}}" class="btn btn-danger">Cancel</a>
            </div>
      </div>
            </form>
        </div>
    </div>
  </div>

  <!-- End Off Modal -->