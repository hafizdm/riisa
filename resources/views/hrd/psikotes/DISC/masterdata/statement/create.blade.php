 <!-- Modal -->
 <div class="modal fade" id="myModalAdd" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><b>Form Add Statement</b></h4>
        </div>
        <form role="form" name="formdata" enctype="multipart/form-data" method="post" action="{{url("statement-disc/store")}}">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nik">Question of*</label>
                <input type="number" class="form-control" name="id_soal" id="id_soal" required>
            </div>

            {{-- <div class="form-group">
                <label for="nik">Category (+)*</label>
                <select name="id_kategoriA" id="id_kategoriA" class="form-control select2" style="width: 100%" required>
                    <option disabled>Select category</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="row">
                <div class="col-md-3 col-3">
                    <div class="form-group">
                        <label for="kategori_plus">Category A(+)*</label>
                        <select name="kategori_plus1" id="kategori_plus1" class="form-control select2" style="width: 100%" required>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pernyataan">Statement A*</label>
                        <textarea class="form-control" rows="2" name="pernyataan1" id="pernyataan1" required> </textarea>
                    </div>
                </div>
                <div class="col-md-3 col-3">
                    <div class="form-group">
                        <label for="kategori_minus">Category A(-)*</label>
                        <select name="kategori_minus1" id="kategori_minus1" class="form-control select2" style="width: 100%" required>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-3">
                    <div class="form-group">
                        <label for="kategori_plus">Category B(+)*</label>
                        <select name="kategori_plus2" id="kategori_plus2" class="form-control select2" style="width: 100%" required>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pernyataan">Statement B*</label>
                        <textarea class="form-control" rows="2" name="pernyataan2" id="pernyataan2" required> </textarea>
                    </div>
                </div>
                <div class="col-md-3 col-3">
                    <div class="form-group">
                        <label for="kategori_minus">Category B(-)*</label>
                        <select name="kategori_minus2" id="kategori_minus2" class="form-control select2" style="width: 100%" required>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-3">
                    <div class="form-group">
                        <label for="kategori_plus">Category C(+)*</label>
                        <select name="kategori_plus3" id="kategori_plus3" class="form-control select2" style="width: 100%" required>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pernyataan">Statement C*</label>
                        <textarea class="form-control" rows="2" name="pernyataan3" id="pernyataan3" required> </textarea>
                    </div>
                </div>
                <div class="col-md-3 col-3">
                    <div class="form-group">
                        <label for="kategori_plus">Category C(-)*</label>
                        <select name="kategori_minus3" id="kategori_minus3" class="form-control select2" style="width: 100%" required>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-3">
                    <div class="form-group">
                        <label for="kategori_plus">Category D(+)*</label>
                        <select name="kategori_plus4" id="kategori_plus4" class="form-control select2" style="width: 100%" required>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pernyataan">Statement D*</label>
                        <textarea class="form-control" rows="2" name="pernyataan4" id="pernyataan4" required> </textarea>
                    </div>
                </div>
                <div class="col-md-3 col-3">
                    <div class="form-group">
                        <label for="kategori_plus">Category D(-)*</label>
                        <select name="kategori_minus4" id="kategori_minus4" class="form-control select2" style="width: 100%" required>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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


