<!-- Modal -->
<?php 
 use Carbon\Carbon;
 $dt = Carbon::now();
?>
<div class="modal fade tambahspd"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center><h4 class="modal-title" id="exampleModalLabel"><b>Leave Request Form
        </div>
        
        <div class="modal-body">
            <form role="form" name="formdata" method="post" enctype="multipart/form-data" action="{{url("pengajuan-cuti/store")}}">
                @csrf
            <div class="row" style="font-weight: normal;">
                <div class="col-xs-12 col-xl-12 col-lg-12">
                    {{-- <div class="form-group">
                        <label>Date of Request</label>
                       
                    </div> --}}
                    <div class="form-group" id="asal">
                        <label>First Date*</label>
                        <input type="hidden" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan"  value="{{$dt->toDateString()}}" >
                        {{-- <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="dari_tanggal" name="dari_tanggal"  placeholder="yyyy/mm/dd" required > --}}
                        <div class="input-group date pickWeek">
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          <input type="text" class="form-control" id="dari_tanggal" name="dari_tanggal"/>
                        </div>
                    </div>

                    <div class="form-group" id="asal">
                        <label>Last Date*</label>
                        {{-- <input type="date" data-date-format="yyyy/mm/dd" class="form-control" id="sampai_tanggal" name="sampai_tanggal"  placeholder="yyyy/mm/dd" required > --}}
                        <div class="input-group date pickWeek">
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          <input type="text" class="form-control" id="sampai_tanggal" name="sampai_tanggal"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label> Type of Leave*</label>
                        <select class="form-control" name="jenis_cuti" id="jenis_cuti" style="width: 100%;" required>
                            <option disabled>--Type of leave--</option>
                            @foreach($kategori_cuti as $a )
                                <option value="{{ $a->id }}">{{ $a->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Additional Information</label>
                        <textarea id="description" name="description" rows="4" cols="50" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{url("pengajuan-cuti")}}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
      </div>
            </form>
        </div>
    </div>
  </div>

  @push('script')
  <script>
    $(function () {        
        $('.pickWeek').datepicker({
            locale: 'pt-br',
            format: "yyyy-mm-dd",
            autoclose: true,
            sideBySide: true,
            daysOfWeekDisabled: [0,6],
            todayBtn: "linked",
            todayHighlight : true,
        });
        // $('.select2').select2();
    });

  </script>
  @endpush