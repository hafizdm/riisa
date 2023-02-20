 <!-- Modal -->
 <div class="modal fade" id="statement_modal_" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><b>Form Edit Statement</b></h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nik">Question of</label>
                <input type="number" class="form-control" name="edit_id_soal" id="edit_id_soal"> </textarea>
            </div>

            <div class="form-group">
                <input class="form-control fonts" name="id" id="id" value="" type="hidden"/>
                <label>Category Option</label>
                <input type="hidden" class="form-control" name="edit_id_kategoriA" id="edit_id_kategoriA" value="1">
                <input type="text" class="form-control" value="A" disabled required>
            </div>
            <hr>
            <div class="form-group">
                <label for="nik">Statement A</label>
                <textarea class="form-control" id="edit_pernyataanA" name="edit_pernyataanA" rows="6" value=""> </textarea>
            </div>

            <hr>
            <div class="form-group">
                <input class="form-control fonts" name="id" id="id" value="" type="hidden"/>
                <label for="nik">Category Option</label>
                <input type="hidden" class="form-control" name="edit_id_kategoriB" id="edit_id_kategoriB" value="2">
                <input type="text" class="form-control" value="B" disabled required>
            </div>

            <div class="form-group">
                <label for="nik">Statement B</label>
                <textarea class="form-control" id="edit_pernyataanB" name="edit_pernyataanB" rows="6" value=""> </textarea>
            </div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="editStatementBtn" value="Submit">Update</button>
        </div>
        </form>
    </div>
    </div>
</div>
