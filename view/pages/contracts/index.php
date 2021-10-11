<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Listado de contratos</h2>
                <div class="float-right">
                    <button class="btn btn-info btn-sm nuevo" title="Nuevo contrato"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="formSave"></div>
                <div class="table-responsive">
                    <table id="listado" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Codigo</th>
                                <th>Tipo de contrato</th>
                                <th>No documento</th>
                                <th>Empleado</th>
                                <th>Profesión</th>
                                <th>Fecha de inicio</th>
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
<script src="./contracts/contractsCtrl.js"></script>
<script>
    $(document).ready(contractsCtrl);
</script>