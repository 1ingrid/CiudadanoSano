<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Listado de empleados</h2>
                <div class="float-right">
                    <button class="btn btn-info btn-sm nuevo" title="Nuevo empleado"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="formSave"></div>
                <div class="table-responsive">
                    <table id="listado" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>No documento</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Dirección</th>
                                <th>Telefono</th>
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
<script src="./my_employees/my_employeesCtrl.js"></script>
<script>
    $(document).ready(my_employeesCtrl);
</script>