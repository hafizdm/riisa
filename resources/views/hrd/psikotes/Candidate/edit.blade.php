 <!-- Modal -->
 <div class="modal fade" id="candidate_modal_" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><b>Form Edit Candidate</b></h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nik">Full Name*</label>
                <input class="form-control fonts" name="id" id="id" value="" type="hidden"/>
                <input type="text" class="form-control" id="edit_full_name" name="edit_full_name" value="" required>
            </div>
            <div class="form-group">
                <label for="nik">Last Education*</label>
                <select name="edit_last_education" id="edit_last_education" class="form-control" style="width:100%" required>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Job Applied*</label>
                <input type="text" class="form-control" id="edit_job_applied" name="edit_job_applied" value="" required>
            </div>

            <div class="form-group">
                <label for="nik">Test Schedule*</label>
                <input type="datetime-local" class="form-control" id="edit_test_schedule" name="edit_test_schedule" value="" required>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="editCandidateBtn" value="Submit">Update</button>
        </div>
        </form>
    </div>
    </div>
</div>
