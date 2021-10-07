<form>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="control-label" for="name">
                    <strong class="text-danger">*</strong>Nombre
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la sede" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="country_id">
                    <strong class="text-danger">*</strong>País
                </label>
                <div class="input-group">
                    <select class="form-control" id="country_id" name="country_id" value="">
                        <option value="">Seleccione un pais...</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="city_id">
                    <strong class="text-danger">*</strong>Ciudad
                </label>
                <div class="input-group">
                    <select class="form-control" id="city_id" name="city_id" value="">
                        <option value="">Seleccione una ciudad...</option>
                    </select>
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