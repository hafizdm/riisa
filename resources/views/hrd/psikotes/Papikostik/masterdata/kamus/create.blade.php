 <!-- Modal -->
 <div class="modal fade" id="myModalAdd" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><b>Form Add Dictionary</b></h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data" method="post" action="{{url("kamus-papikostik/store")}}">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nik">Category*</label>
                <select name="id_kategori" id="id_kategori" class="form-control select2" style="width: 100%">
                    <option disabled>Select category</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Value*</label>
                <input type="number" class="form-control" name="nilai" id="nilai">
            </div>

            <div class="form-group">
                <label for="nik">Description*</label>
                <textarea class="form-control" rows="6" name="keterangan" id="keterangan"> </textarea>
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
