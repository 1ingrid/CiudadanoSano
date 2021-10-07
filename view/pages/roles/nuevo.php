<form>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="name">
                    <strong class="text-danger">*</strong>Nombre
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del rol" value="">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label" for="description">Descripción</label>
                <div class="input-group">
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Descripción del rol" value=""></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="control-label" for="permits">Permisos de usuario</label>
            <div class="input-group">
                <label><input type="checkbox" id="roles" name="roles" value="roles"> Roles</label>
            </div>
            <div class="input-group">
                <label><input type="checkbox" id="users" name="users" value="users"> Usuarios</label>
            </div>
            <div class="input-group">
                <label><input type="checkbox" id="countries" name="countries" value="countries"> Paises</label>
            </div>
            <div class="input-group">
                <label><input type="checkbox" id="cities" name="cities" value="cities"> Ciudades</label>
            </div>
            <div class="input-group">
                <label><input type="checkbox" id="headquarters" name="headquarters" value="headquarters"> Sedes</label>
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