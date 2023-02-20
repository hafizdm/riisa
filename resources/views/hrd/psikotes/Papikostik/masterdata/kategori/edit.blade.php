 <!-- Modal -->
 <div class="modal fade" id="category_modal_" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><b>Form Edit Category</b></h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nik">Category*</label>
                <input class="form-control fonts" name="id" id="id" value="" type="hidden"/>
                <input type="text" class="form-control" id="edit_nama_kategori" name="edit_nama_kategori" placeholder="Enter category" value="" required>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="editCategoryBtn" value="Submit">Update</button>
        </div>
        </form>
    </div>
    </div>
</div>
