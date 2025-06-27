<?php include 'header.php'; ?>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="main-box">
        <div class="text-center mb-3">
            <h1 class="mb-2">Consulta de Expedientes</h1>
            <p class="small text-secondary">
                Este sistema permite consultar el estado de expedientes ingresados en el <b>Concejo Deliberante de Eldorado</b>.<br>
                Si tiene dudas, comuníquese con Mesa de Entradas al <b>(03751) 423888</b>.<br>
                Complete el formulario para realizar su consulta sobre expedientes legislativos.
            </p>
        </div>
        <form method="post" autocomplete="off">
            <div class="mb-3">
                <label class="form-label" for="tipo">Tipo de Expediente <span class="text-danger">*</span></label>
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="Proyecto de Ordenanza">Proyecto de Ordenanza</option>
                    <option value="Resolución">Resolución</option>
                    <option value="Declaración">Declaración</option>
                    <option value="Comunicación">Comunicación</option>
                    <option value="Pedido de Informe">Pedido de Informe</option>
                    <option value="Nota">Nota</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="anio">Año <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="anio" name="anio" min="2000" max="2100" required placeholder="Ej: 2025">
            </div>
            <div class="mb-3">
                <label class="form-label" for="letra">Letra</label>
                <select class="form-select" id="letra" name="letra">
                    <option value="">-</option>
                    <?php foreach(range('A','Z') as $letra) { echo "<option value=\"$letra\">$letra</option>"; } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="numero">Número <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="numero" name="numero" required placeholder="Ej: 1234">
            </div>
            <div class="mb-3 text-center">
                <span class="captcha-img mb-2 d-inline-block">H M h B d</span>
            </div>
            <div class="mb-3">
                <label class="form-label" for="captcha">
                    ¿Cuál es el código de la imagen? <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="captcha" name="captcha" required placeholder="Ingrese el código">
                <div class="form-text text-muted">Introduzca los caracteres mostrados en la imagen.</div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2">Buscar</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>