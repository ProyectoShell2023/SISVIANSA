// Obtener el formulario por su ID
let form = document.getElementById("form_reg");

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

    // Enviar los datos al servidor
    fetch("../Modelo/val_primer_cliente.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {

            
            if (data.success) {
                alertify.success("Registro exitoso!");
                // Redireccionar al usuario a la página principal
                window.location.href = "../index.html";
            } else {
                alertify.error(data.error);
            }
        });
});



// Función para validar los datos del formulario
function validarFormulario() {
    // Validar el número de celular
    let cel = document.getElementById("cel_reg").value;
   cel = cel.trim();
    if (cel.length !== 9) {
        alertify.error("El número de celular debe tener 9 dígitos");
        return false; 
    }

    // Validar el correo electrónico
    let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
    if (!regexEmail.test(document.getElementById("email_reg").value)) {
        alertify.error("Correo electrónico inválido");
        return false;
    }

    // Validar la contraseña
    let pass = document.getElementById("pass_reg").value;
    pass = pass.trim();
    if (pass.length < 6) {
        alertify.error("La contraseña debe tener al menos 6 caracteres");
        return false;
    } else if (!pass.match(/[a-z]/)) {
        alertify.error("La contraseña debe tener al menos una letra minúscula");
        return false;
    } else if (!pass.match(/[A-Z]/)) {
        alertify.error("La contraseña debe tener al menos una letra mayúscula");
        return false;
    } else if (!pass.match(/[0-9]/)) {
        alertify.error("La contraseña debe tener al menos un número");
        return false;
    }

    return true;
}
