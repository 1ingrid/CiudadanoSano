<form>
    <input type="hidden" id="id" name="id">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="name">
                    <strong class="text-danger">*</strong>Nombres
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombres del usuario" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="last_name">
                    <strong class="text-danger">*</strong>Apellidos
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellidos del usuario" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="rol_id">
                    Rol
                </label>
                <div class="input-group">
                    <select class="form-control" id="rol_id" name="rol_id" value="">
                        <option value="">Seleccione un rol...</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="email">
                    <strong class="text-danger">*</strong>Email
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email del usuario" value="">
                </div>
                <div id="alertEmail" class="input-group">
                    <label class="text-danger" for="email">The email already exists</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="password">
                    Password
                </label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password del usuario" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="confir_password">
                    Confirmar password
                </label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confir_password" name="confir_password" placeholder="Confirmar el password del usuario" value="">
                </div>
            </div>
        </div>
    </div>
    <div id="alert" class="alert alert-danger text-center" role="alert">
        Unfilled fields please, place them.
    </div>
    <div id="alertPass" class="alert alert-danger text-center" role="alert">
        Passwords do not match
    </div>
    <div class="col-lg-12">
        <strong class="text-secondary float-left">
            <label class="text-danger">*</label>Fields required
        </strong>
        <button type="button" id="update" class="btn btn-info btn-sm float-right ml-1">Actualizar</button>
        <button type="button" id="close" class="btn btn-danger btn-sm float-right" title="Cancelar">Cancelar</button>
    </div>
</form>