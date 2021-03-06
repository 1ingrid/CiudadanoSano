<form>
    <input type="hidden" id="id" name="id">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="type_contract_id">
                    <strong class="text-danger">*</strong>Tipo de contrato
                </label>
                <div class="input-group">
                    <select class="form-control" id="type_contract_id" name="type_contract_id" value="">
                        <option value="">Seleccione un tipo de contrato...</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="employe_id">
                    <strong class="text-danger">*</strong>Empleado
                </label>
                <div class="input-group">
                    <select class="form-control" id="employe_id" name="employe_id" value="">
                        <option value="">Seleccione un empleado...</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="profession_id">
                    <strong class="text-danger">*</strong>Profesión
                </label>
                <div class="input-group">
                    <select class="form-control" id="profession_id" name="profession_id" value="">
                        <option value="">Seleccione una profesión...</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="date_init">
                    <strong class="text-danger">*</strong>Fecha de inicio
                </label>
                <div class="input-group">
                    <input type="date" class="form-control" id="date_init" name="date_init" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="control-label" for="date_end">
                    Fecha final
                </label>
                <div class="input-group">
                    <input type="date" class="form-control" id="date_end" name="date_end" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="control-label" for="duration">
                    Duración
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="duration" name="duration" placeholder="Duración del contrato" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="control-label" for="salary">
                    <strong class="text-danger">*</strong>Salario
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="salary" name="salary" placeholder="Salario del contrato" value="">
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