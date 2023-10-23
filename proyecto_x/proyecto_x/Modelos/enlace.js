// Importa la clase newUser
import dataUser from '../../Controladores/Registrar_cliente.js';

const formulario = document.getElementById("form_reg");
const res = document.getElementById("res");

formulario.addEventListener("submit", async (event) => {
    event.preventDefault();

    // Obtén los datos del formulario
    const cel_reg = document.getElementById("cel_reg").value;
    const email_reg = document.getElementById("email_reg").value;
    const pass_reg = document.getElementById("pass_reg").value;

    // Crear una instancia de dataUser con los datos del formulario
    const cliente = new dataUser(cel_reg, email_reg, pass_reg, "proximamente ...");

    // Crear un objeto con los datos de la instancia de dataUser
    const datos = {
        cel_reg_validado: cliente.newCel,
        email_reg_validado: cliente.newEmail,
        pass_reg_validado: cliente.newContra,
        direccion_reg_validado: cliente.newDireccion,
    };

    try {
        // Realiza una solicitud POST a enlace.php
        const response = await fetch("enlace.php", {
            method: "POST",
            body: JSON.stringify(datos),
            headers: {
                "Content-Type": "application/json",
            },
        });

        if (response.ok) {
            const data = await response.json();
            console.log(data);
            if (data === "error") {
                res.innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        Error
                    </div>
                `;
            } else {
                res.innerHTML = `
                    <div class="alert alert-primary" role="alert">
                        Éxito
                    </div>
                `;
            }
        } else {
            console.error("Error en la respuesta del servidor:", response.statusText);
        }
    } catch (error) {
        console.error("Error al realizar la solicitud:", error);
    }
});
