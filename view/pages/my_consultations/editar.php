<form>
    <input type="hidden" id="id" name="id">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="control-label" for="client_id">
                    <strong class="text-danger">*</strong>Paciente
                </label>
                <div class="input-group">
                    <select class="form-control" id="client_id" name="client_id" value="">
                        <option value="">Seleccione un paciente...</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="control-label" for="reason">
                    <strong class="text-danger">*</strong>Motivo de consulta
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="reason" name="reason" placeholder="Motivo de la consulta" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="control-label" for="detail">
                    <strong class="text-danger">*</strong>Detalle de la consulta
                </label>
                <div class="input-group">
                    <textarea class="form-control" id="detail" name="detail" placeholder="Detalle de la consulta" cols="30" rows="10"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="control-label" for="formula">
                    <strong class="text-danger">*</strong>Formula medica
                </label>
                <div class="input-group">
                    <textarea class="form-control" id="formula" name="formula" placeholder="Medicamentos a mandar" cols="30" rows="10"></textarea>
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