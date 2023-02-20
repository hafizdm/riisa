 <!-- Modal -->
 <div class="modal fade" id="kamus_modal_" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><b>Form Edit Dictionary</b></h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <input class="form-control fonts" name="id" id="id" value="" type="hidden"/>
                <label>Category</label>
                <select name="edit_id_kategori" id="edit_id_kategori" class="form-control" style="width: 100%" value="">
                    <option disabled>Select category</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Value</label>
                <input type="number" class="form-control" id="edit_nilai" name="edit_nilai" value="">
            </div>

            <div class="form-group">
                <label for="nik">Description</label>
                <textarea class="form-control" id="edit_keterangan" name="edit_keterangan" rows="6" value=""> </textarea>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="editKamusBtn" value="Submit">Update</button>
        </div>
        </form>
    </div>
    </div>
</div>
