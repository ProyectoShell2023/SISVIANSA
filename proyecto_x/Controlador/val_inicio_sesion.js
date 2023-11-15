// Obtener el formulario de inicio de sesión por su ID
let form = document.getElementById("form_log");

// Agregar un manejador de eventos al formulario
form.addEventListener("submit", function(event) {
    // Prevenir el comportamiento predeterminado del formulario
    event.preventDefault();

    // Validar los datos del formulario
    if (!validarFormulario()) {
        return;
    }

    // Obtener los datos del formulario
    let formData = new FormData(form);

    // Enviar los datos al servidor para la autenticación
    fetch("../Modelo/val_inicio_sesion.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Inicio de sesión exitoso, redirigir al usuario
            alertify.success("Inicio de sesión exitoso!");

            if (sessionStorage.getItem('ID_Cliente') !== null) {
                window.location.href = "../index.html";
            }
            // Redireccionar al usuario a la página principal

        } else {
            // Inicio de sesión fallido, mostrar mensaje de error
            alertify.error(data.error);
        }
    });
});

// Función para validar los datos del formulario
function validarFormulario() {

// Validar el correo electrónico
let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
if (!regexEmail.test(document.getElementById("email_log").value)) {
    alertify.error("Correo electrónico inválido");
    return false;
}

    let email = document.getElementById("email_log").value;
    let password = document.getElementById("pass_log").value;

    if (email.trim() === "" || password.trim() === "") {
        alertify.error("Por favor, complete todos los campos.");
        return false;
    }

    return true;
}
