<form>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="name">
                    <strong class="text-danger">*</strong>Nombre
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del producto" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="provider_id">
                    <strong class="text-danger">*</strong>Proveedor
                </label>
                <div class="input-group">
                    <select class="form-control" id="provider_id" name="provider_id" value="">
                        <option value="">Seleccione un proveedor...</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="presentation">
                    <strong class="text-danger">*</strong>Presentación
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="presentation" name="presentation" placeholder="Presentación del producto" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="img">
                    <strong class="text-danger">*</strong>Imagen
                </label>
                <div class="input-group">
                    <input type="file" class="form-control" id="img" name="img" value="">
                </div>
                <div id="alertImgSize" class="input-group">
                    <label class="text-danger" for="hour">Peso maximo de 2MB</label>
                </div>
                <div id="alertImgType" class="input-group">
                    <label class="text-danger" for="hour">Solo se puede subir imagenes</label>
                </div>
            </div>
        </div>
    </div>
    <div id="alert" class="alert alert-danger text-center" role="alert">
        Unfilled fields please, place them.
    </div>
    <div class="col-lg-12">
        <strong class="text-secondary float-left">
            <label class="text-danger">*</label>Fields required
        </strong>
        <button type="button" id="create" class="btn btn-info btn-sm float-right ml-1">Guardar</button>
        <button type="button" id="close" class="btn btn-danger btn-sm float-right" title="Cancelar">Cancelar</button>
    </div>
</form>