<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Listado de roles</h2>
                <div class="float-right">
                    <button class="btn btn-info btn-sm nuevo" title="Nuevo rol"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="formSave"></div>
                <div class="table-responsive">
                    <table id="listado" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Creado en</th>
                                <th>Modificado en</th>
                            </tr>
                        </thead>
                        <tbody>
                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./roles/rolesCtrl.js"></script>
<script>
    $(document).ready(rolesCtrl);
</script>