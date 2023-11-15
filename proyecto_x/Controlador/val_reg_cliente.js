// Declarar variables globales para los formularios
let formCB, formCN, activeForm;

document.addEventListener("DOMContentLoaded", function () {
    // Agrega un event listener para el envío del formulario de Cliente Business
    formCB = document.getElementById("form_reg_cb");
    formCB.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        activeForm = this;
        if (!validarFormularioCB()) {
            return;
        }
        // Crea un objeto FormData a partir del formulario
        let formData = new FormData(this);
        // Obtiene los datos comunes del formulario (correo, contraseña y celular)
        let email = formData.get("email_reg");
        let password = formData.get("pass_reg");
        let cel = formData.get("cel_reg");
        // Validar y enviar los datos al servidor
        validarYEnviarDatos(this, email, password, cel);
    });

    // Agrega un event listener para el envío del formulario de Cliente Normal
    formCN = document.getElementById("form_reg_cn");
    formCN.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita que el formulario se envíe normalmente
        activeForm = this;
        if (!validarFormularioCN()) {
            return;
        }
        // Crea un objeto FormData a partir del formulario
        let formData = new FormData(this);
        // Obtiene los datos comunes del formulario (correo, contraseña y celular)
        let email = formData.get("email_reg");
        let password = formData.get("pass_reg");
        let cel = formData.get("cel_reg");
        // Validar y enviar los datos al servidor
        validarYEnviarDatos(this, email, password, cel);
    });

    // Resto del código ...
});

// Función para validar y enviar datos
function validarYEnviarDatos(formulario, email, password, cel) {
    // Verificar si el formulario es el activo antes de proceder
    if (formulario !== activeForm) {
        return;
    }

    if (validarDatosComunes(email, password, cel)) {
        // Crear un objeto FormData para enviar al servidor
        let formData = new FormData(formulario);

        // Establecer la URL del servidor según el formulario
        let url = (formulario === formCB) ? "../Modelo/Cliente_Emp.php" : "../Modelo/Cliente_Nor.php";

        // Mostrar alerta con los datos antes de enviar
        alert("Datos antes de enviar: Email - " + email + ", Password - " + password + ", Cel - " + cel);

        // Realizar la solicitud fetch al servidor
        fetch(url, {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alertify.success("Registro exitoso!");
                    window.location.href = "../index.html";
                } else {
                    alertify.error(data.error);
                }
            });
    }
}

// Función para validar los datos comunes (correo, contraseña y celular)
function validarDatosComunes(email, password, cel) {
    // Validar el número de celular
    cel = cel.trim();
    if (cel.length !== 9) {
        alertify.error("El número de celular debe tener 9 dígitos");
        return false;
    }

    // Validar el correo electrónico
    let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
    if (!regexEmail.test(email)) {
        alertify.error("Correo electrónico inválido");
        return false;
    }

    // Validar la contraseña
    password = password.trim();
    if (password.length < 6 || !/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
        alertify.error("La contraseña no cumple con los requisitos");
        return false;
    }

    return true; // Retorna true si todas las validaciones son exitosas
}

// Función para validar el formulario de Cliente Business
function validarFormularioCB() {
    // Obtener los datos específicos del formulario de Cliente Business
    let nombreCB = formCB.querySelector("#nombre_cb").value;
    let rutCB = formCB.querySelector("#rut_cb").value;
    let ciEnCB = formCB.querySelector("#ci_en_cb").value;
    let direccionCB = formCB.querySelector("#ubi_reg_cb").value;

    // Realizar validaciones específicas para Cliente Business
    if (!nombreCB || !rutCB || !ciEnCB || !direccionCB) {
        alertify.error("Completa todos los campos obligatorios para Cliente Business");
        return false;
    }

    // Validar Nombre
    if (!validarNombreConNumeros(nombreCB)) {
        return false;
    }

    // Validar RUT
    rutCB = rutCB.trim();
    if (rutCB.length !== 12) {
        alertify.error("El RUT ingresado no es correcto");
        return false;
    }

    // Validar Cedula del Encargado
    ciEnCB = ciEnCB.trim();
    if (ciEnCB.length !== 8) {
        alertify.error("La cedula ingresada no es correcta");
        return false;
    }

    // Validar la Direccion
    // ...

    return true; // Retorna true si todas las validaciones son exitosas
}

// Función para validar el formulario de Cliente normal
function validarFormularioCN() {
    // Obtener los datos específicos del formulario de Cliente normal
    let nombreCN = formCN.querySelector("#nombre_cn").value;
    let ciCN = formCN.querySelector("#ci_cn").value;
    let direccionCN = formCN.querySelector("#ubi_reg_cn").value;

    // Realizar validaciones específicas para Cliente normal
    if (!nombreCN || !ciCN || !direccionCN) {
        alertify.error("Completa todos los campos obligatorios para Cliente normal");
        return false;
    }

    // Validar Cedula
    ciCN = ciCN.trim();
    if (ciCN.length !== 8) {
        alertify.error("La cedula ingresada no es correcta");
        return false;
    }

    // Validar Nombre
    if (!validarNombreConNumeros(nombreCN)) {
        return false;
    }

    // Validar la Direccion
    // ...

    return true; // Retorna true si todas las validaciones son exitosas
}

// Función para validar un campo de nombre que permite letras, espacios y números
function validarNombreConNumeros(nombre) {
    nombre = nombre.trim();
    if (nombre === "") {
        alertify.error("El nombre no puede estar vacío");
        return false;
    }

    // Utiliza una expresión regular para permitir letras, espacios y números
    let regexNombre = /^[A-Za-zÁáÉéÍíÓóÚúÜüñÑ\s0-9]+$/;
    if (!regexNombre.test(nombre)) {
        alertify.error("El nombre solo puede contener letras, espacios y números");
        return false;
    }

    return true;
}
