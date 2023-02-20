 <!-- Modal -->
 <div class="modal fade" id="myModalAdd" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><b>Form Add Statement</b></h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data" method="post" action="{{url("statement-mbti/store")}}">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nik">Question of*</label>
                <input type="number" class="form-control" name="id_soal" id="id_soal" required>
            </div>

            <div class="form-group">
                <label for="nik">Category Option A*</label>
                <select name="id_kategoriA" id="id_kategoriA" class="form-control select2" style="width: 100%" required>
                    <option disabled>Select category</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Statement A*</label>
                <textarea class="form-control" rows="6" name="pernyataanA" id="pernyataanA" required> </textarea>
            </div>
            <hr>
            <div class="form-group">
                <label for="nik">Category Option B*</label>
                <select name="id_kategoriB" id="id_kategoriB" class="form-control select2" style="width: 100%" required> 
                    <option disabled>Select category</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nik">Statement B*</label>
                <textarea class="form-control" rows="6" name="pernyataanB" id="pernyataanB" required> </textarea>
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


