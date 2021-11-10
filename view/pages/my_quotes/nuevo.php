<form>
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
                <label class="control-label" for="type_quote">
                    <strong class="text-danger">*</strong>Tipo de cita medica
                </label>
                <div class="input-group">
                    <select class="form-control" id="type_quote" name="type_quote" value="">
                        <option value="">Seleccione un tipo de consulta...</option>
                        <option value="4">Consulta General</option>
                        <option value="3">Consulta Odontologica</option>
                        <option value="8">Consulta Optometria</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="employe_id">
                    <strong class="text-danger">*</strong>Medico
                </label>
                <div class="input-group">
                    <select class="form-control" id="employe_id" name="employe_id" value="">
                        <option value="">Seleccione un medico...</option>
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
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="hour">
                    <strong class="text-danger">*</strong>Hora
                </label>
                <div class="input-group">
                    <select class="form-control" id="hour" name="hour"></select>
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