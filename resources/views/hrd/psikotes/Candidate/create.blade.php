 <!-- Modal -->
 <div class="modal fade" id="myModalAdd" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><b>Form Candidate</b></h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data" method="post" action="{{url("kandidat-psikotes/store")}}">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nik">Full Name*</label>
                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full name" required>
            </div>
            <div class="form-group">
                <label for="nik">Last Education*</label>
                <select name="last_education" id="last_education" class="form-control" style="width:100%" required>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Job Applied*</label>
                <input type="text" class="form-control" id="job_applied" name="job_applied" placeholder="Enter job applied" required>
            </div>
            <div class="form-group">
                <label for="nik">Test Schedule*</label>
                <input type="datetime-local" class="form-control" id="test_schedule" name="test_schedule" required>
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
