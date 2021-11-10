<form>
    <input type="hidden" id="id" name="id">
    <div class="row">
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
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="date">
                    <strong class="text-danger">*</strong>Fecha
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="date" name="date" placeholder="Fecha de cita medica" value="">
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
        <button type="button" id="update" class="btn btn-info btn-sm float-right ml-1">Actualizar</button>
        <button type="button" id="close" class="btn btn-danger btn-sm float-right" title="Cancelar">Cancelar</button>
    </div>
</form>