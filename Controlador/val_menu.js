// Escuchar el clic en el botón
$('#submitForm').click(function() {
    // Desactivar el botón durante la solicitud
    $(this).prop('disabled', true);

    // Recopilar los datos del formulario
    const img_menu = $('#fileInput').prop('files')[0];
    const precio = Number($('#price').val());
    const nombre = $('#nombre').val();
    const tipo = $('#tipo').val();
    const descripcion = $('#descripcion').val();
    const stock = Number($('#stock').val());
    const stock_max = Number($('#stock_max').val());
    const stock_min = Number($('#stock_min').val());
    const vencimiento = new Date($('#vencimiento').val());
    const tiempo = $('#tiempo').val();
    const tamanio = $('#tamanio').val();

    // Validación de campos
    if (!img_menu || isNaN(precio) || !nombre || !tipo || !descripcion || isNaN(stock) || isNaN(stock_max) || isNaN(stock_min) || !vencimiento || !tiempo || !tamanio) {
        showError("Por favor, complete todos los campos requeridos.");
        enableButton();
        return;
    }

    // Otras validaciones...

    // Validación: Imagen seleccionada
    if (!img_menu) {
        showError("Por favor, seleccione una imagen.");
        enableButton();
        return;
    }
    // Validación: Precio mayor a 0
    else if (isNaN(precio) || precio <= 0) {
        showError("Por favor, ingrese un precio válido mayor a 0.");
    } 
    // Validación: Nombre solo letras y espacios
    else if (!/^[a-zA-Z\s]+$/.test(nombre)) {
        showError("Por favor, ingrese un nombre válido con solo letras y espacios.");
    } 
    // Validación: Descripción máximo 100 caracteres
    else if (descripcion.length > 100) {
        showError("La descripción debe tener un máximo de 100 caracteres.");
    } 
    // Validación: Stock, stock mínimo y stock máximo mayores a 0
    else if (isNaN(stock) || stock <= 0 || stock_min <= 0 || stock_max <= 0) {
        showError("Por favor, ingrese valores de stock, stock mínimo y stock máximo mayores a 0.");
    } 
    // Validación: Stock mínimo menor que stock máximo
    else if (stock_min >= stock_max) {
        showError("El stock mínimo debe ser menor que el stock máximo.");
    } 
    // Validación: Stock no inferior al stock mínimo
    else if (stock < stock_min) {
        showError("El stock no puede ser inferior al stock mínimo.");
    } 
    // Validación: Stock no supera el stock máximo
    else if (stock > stock_max) {
        showError("Ha superado el stock máximo permitido.");
    } 
    // Validación: Fecha de vencimiento posterior a la fecha actual
    else if (vencimiento <= new Date()) {
        showError("La fecha de vencimiento debe ser posterior a la fecha actual.");
    } 
    // Validación: Tiempo mayor a un minuto
    else if (!tiempo || tiempo.length < 2) {
        showError("Por favor, ingrese un tiempo válido mayor a un minuto.");
    } 
    // Todas las validaciones pasaron, enviar formulario
    else {
        const formData = new FormData();
        formData.append('img_menu', img_menu);
        formData.append('precio', precio);
        formData.append('nombre', nombre);
        formData.append('tipo', tipo);
        formData.append('descripcion', descripcion);
        formData.append('stock', stock);
        formData.append('stock_max', stock_max);
        formData.append('stock_min', stock_min);
        formData.append('vencimiento', vencimiento.toISOString());
        formData.append('tiempo', tiempo);
        formData.append('tamanio', tamanio);

        // Enviar los datos del formulario al servidor PHP utilizando fetch
        sendFormData(formData);
    }
});

// Función para mostrar mensajes de error
function showError(message) {
    alertify.error(message);
}

// Función para reactivar el botón
function enableButton() {
    $('#submitForm').prop('disabled', false);
}

// Función para enviar los datos del formulario al servidor PHP
function sendFormData(formData) {
    fetch("../Modelo/Insercion_Menu.php", {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data.message);
            alertify.success("Menú subido exitosamente.");
        } else {
            console.error(data.message);
            alertify.error("Error al subir el menú.");
        }
    })
    .catch(error => {
        console.error(error);
        alertify.error("Se produjo un error al procesar la solicitud.");
    })
    .finally(() => {
        enableButton();
    });
}
