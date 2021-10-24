<form>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="name">
                    <strong class="text-danger">*</strong>Nombres
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del proveedor" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="nit">
                    <strong class="text-danger">*</strong>Nit
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="nit" name="nit" placeholder="No documento del proveedor" value="">
                </div>
                <div id="alertNit" class="input-group">
                    <label class="text-danger" for="nit">The nit already exists</label>
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
                    <input type="text" class="form-control" id="address" name="address" placeholder="Dirección del proveedor" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="control-label" for="email">
                    <strong class="text-danger">*</strong>Email
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email del proveedor" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="control-label" for="cell_phone">
                    <strong class="text-danger">*</strong>Telefono
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="cell_phone" name="cell_phone" placeholder="Telefono del proveedor" value="">
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