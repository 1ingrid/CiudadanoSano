<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Listado de formulas</h2>
            </div>
            <div class="card-body">
                <div id="formSave"></div>
                <div class="table-responsive">
                    <table id="listado" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Codigo</th>
                                <th>Paciente</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Creado en</th>
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
<script src="./my_formulas/my_formulasCtrl.js"></script>
<script>
    $(document).ready(my_formulasCtrl);
</script>