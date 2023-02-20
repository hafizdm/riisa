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
                <label>Category Option Plus</label>
                <select name="edit_id_kategoriA" id="edit_id_kategoriA" class="form-control" style="width: 100%" value="">
                    <option disabled>Select category</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                    @endforeach
                </select>
            </div>
            <hr>
            <div class="form-group">
                <label for="nik">Statement</label>
                <textarea class="form-control" id="edit_pernyataan" name="edit_pernyataan" rows="6" value=""> </textarea>
            </div>

            <hr>
            <div class="form-group">
                <input class="form-control fonts" name="id" id="id" value="" type="hidden"/>
                <label>Category Option Minus</label>
                <select name="edit_id_kategoriB" id="edit_id_kategoriB" class="form-control" style="width: 100%" value="">
                    <option disabled>Select category</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                    @endforeach
                </select>
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
