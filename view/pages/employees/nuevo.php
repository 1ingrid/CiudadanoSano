<form>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="name">
                    <strong class="text-danger">*</strong>Nombres
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombres del empleado" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
            <label class="control-label" for="last_name">
                    <strong class="text-danger">*</strong>Apellidos
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellidos del empleado" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="no_document">
                    <strong class="text-danger">*</strong>Cedula
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="no_document" name="no_document" placeholder="Cedula del empleado" value="">
                </div>
                <div id="alertDocu" class="input-group">
                    <label class="text-danger" for="no_document">The cedula already exists</label>
                </div>
            </div>
        </div>
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
    </div>
    <div class="row">
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
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="seat_id">
                    <strong class="text-danger">*</strong>Sede
                </label>
                <div class="input-group">
                    <select class="form-control" id="seat_id" name="seat_id" value="">
                        <option value="">Seleccione una sede...</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="control-label" for="address">
                    <strong class="text-danger">*</strong>Dirección
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Dirección del empleado" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="control-label" for="email">
                    <strong class="text-danger">*</strong>Email
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email del empleado" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="control-label" for="cell_phone">
                    <strong class="text-danger">*</strong>Telefono
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="cell_phone" name="cell_phone" placeholder="Telefono del empleado" value="">
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