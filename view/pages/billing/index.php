<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Modulo de facturación</h2>
                <div class="float-right">
                    <button class="btn btn-primary btn-sm" id="procesar" title="Finalizar venta"><i class="fas fa-save"></i></button>
                    <button class="btn btn-danger btn-sm" id="cancelar"  title="Cancelar venta"><i class="fas fa-ban"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Datos del cliente</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <input type="hidden" id="id" name="id">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label" for="no_document">
                                            <strong class="text-danger">*</strong>No documento
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="no_document" name="no_document" placeholder="Numero documento del cliente" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label" for="name">
                                            <strong class="text-danger">*</strong>Nombres
                                        </label>
                                        <div class="input-group">
                                            <input type="text" disabled class="form-control" id="name" name="name" placeholder="Nombres del cliente" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label" for="last_name">
                                            <strong class="text-danger">*</strong>Apellidos
                                        </label>
                                        <div class="input-group">
                                            <input type="text" disabled class="form-control" id="last_name" name="last_name" placeholder="Apellidos del cliente" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Datos del producto</h3>
                    </div>
                    <div class="card-body">
                        <table id="tablaP" class="table text-center">
                            <thead>
                            <tr>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Existencia</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Precio total</th>
                            <th>Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td><input type="text" name="product_id" id="product_id" style="width:50px;text-align-last:center;"></td>
                            <td id="name_product">-</td>
                            <td id="stock">-</td>
                            <td><input disabled type="text" name="count_product" id="count_product" style="width:70px;text-align-last:center;" value="0" min="1"></td>
                            <td id="price_sale" class="textringht">0.00</td>
                            <td id="price_sale_total" class="textringht">0.00</td>
                            <td><a href="#" id="add_product_sale" class="link_add"><i class="fas fa-plus"></i>Agregar</a></td>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de productos</h3>
                    </div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                            <tr>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Precio total</th>
                            <th>Accion</th>
                            </tr>
                            </thead>
                            <tbody id="tablaD">

                            </tbody>
                        </table>
                        <table class="table text-center">
                            <thead>
                            <tr>
                            <th>SubTotal</th>
                            <th>Iva</th>
                            <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td id="subTotal">COP 0</td>
                                <td id="iva">COP 0</td>
                                <td id="total">COP 0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./billing/billingCtrl.js"></script>
<script>
    $(document).ready(billingCtrl);
</script>