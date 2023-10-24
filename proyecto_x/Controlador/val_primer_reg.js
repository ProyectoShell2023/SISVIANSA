// Validaciones para el formulario de registro
const cel_reg = document.getElementById("cel_reg");
const email_reg = document.getElementById("email_reg");
const pass_reg = document.getElementById("pass_reg");
const form_reg = document.getElementById("form_reg");

const regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
let entrar = false;

// Evento de envío del formulario
form_reg.addEventListener("submit", function (event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    // Validación de correo electrónico
    if (!regexEmail.test(email_reg.value)) {
        alertify.alert("Correo electrónico inválido");
        entrar = true;
    }

    // Validación del teléfono
    if (cel_reg.value.length !== 9) {
        alertify.alert("Número de teléfono debe tener 9 dígitos");
        entrar = true;
    }

    // Validación de campos no vacíos
    if (cel_reg.value.trim() === "" || email_reg.value.trim() === "" || pass_reg.value.trim() === "") {
        entrar = true;
    } else {
        // Si todos los campos son válidos, enviar los datos al servidor
        const formData = new FormData();
        formData.append("cel_reg", cel_reg.value);
        formData.append("email_reg", email_reg.value);
        formData.append("pass_reg", pass_reg.value);

        // Enviar los datos al servidor a través de una solicitud AJAX (fetch)
        fetch("../Modelo/val_primer_cliente.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.exito) {
                // Redirigir al usuario a la página de inicio de sesión
                window.location.href = "index.html";
            } else if (response.status === 409) {
                alertify.alert("El correo electrónico ya está registrado");
            } else {
                alertify.alert("Error al registrar al cliente");
            }
        })
        .catch(error => {
            console.error("Error en la solicitud AJAX:", error);
        });
    }
});
