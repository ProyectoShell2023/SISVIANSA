// Importa la clase newUser
import dataUser from '../Registrar_cliente.js';

// Validaciones para el formulario de registro
const cel_reg = document.getElementById("cel_reg");
const email_reg = document.getElementById("email_reg");
const pass_reg = document.getElementById("pass_reg");
const form_reg = document.getElementById("form_reg");

// Variables para almacenar los datos validados
let cel_reg_validado = "";
let email_reg_validado = "";
let pass_reg_validado = "";
let direccion_reg_validado = "proximamente ...";

form_reg.addEventListener("submit", (event) => {
    event.preventDefault();

    let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
    let entrar = false;

    // Validacion de longitud de la contraseña
    if (pass_reg.value.length < 4) {
        alertify.alert("Contraseña muy corta").set('onok', function(){
        });
        entrar = true;
    } else {
        pass_reg_validado = pass_reg.value; // Almacenar la contraseña validada
    }

    // Validacion del correo electrónico
    if (!regexEmail.test(email_reg.value)) {
        alertify.alert("Correo electrónico invalido").set('onok', function(){
        });
        entrar = true;
    } else {
        email_reg_validado = email_reg.value; // Almacenar el correo electrónico validado
    }

    // Validacion del teléfono
    if (cel_reg.value.length !== 9) {
        alertify.alert("Numero de teléfono debe tener 9 digitos").set('onok', function(){
        });
        entrar = true;
    } else {
        cel_reg_validado = cel_reg.value; // Almacenar el teléfono validado
    }

    // Validación de campos no vacíos
    if (cel_reg.value.trim() === "" || email_reg.value.trim() === "" || pass_reg.value.trim() === "") {
        alertify.alert("Por favor complete todos los campos").set('onok', function(){
        });
        entrar = true;
    }

    // Si algún campo es inválido, no se envía el formulario
    if (!entrar) {
        window.location.href = "../../Vista/reg_detallado.html" ; 

        // Crear una instancia de dataUser con los datos validados
        const cliente = new dataUser(cel_reg_validado, email_reg_validado, pass_reg_validado, direccion_reg_validado);

        // Imprimir los valores en la consola (descomenta las líneas según sea necesario)
        // console.log("Teléfono válido:", cliente.newCel);
        // console.log("Correo electrónico válido:", cliente.newEmail);
        // console.log("Contraseña válida:", cliente.newContra);    
    }
});

// Validaciones para el formulario de inicio de sesión
const email_log = document.getElementById("email_log");
const pass_log = document.getElementById("pass_log");
const form_log = document.getElementById("form_log");

form_log.addEventListener("submit", (event) => {
    event.preventDefault();

    let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
    let entrar = false;

    // Validacion del correo electrónico
    if (!regexEmail.test(email_log.value)) {
        alertify.alert("Correo electrónico incorrecto").set('onok', function(){
        });
        entrar = true;
    }

    // Validación de campos no vacíos
    if (email_log.value.trim() === "" || pass_log.value.trim() === "") {
        alertify.alert("Por favor complete todos los campos").set('onok', function(){
        });
        entrar = true;
    }

    // Si algún campo es inválido, no se envía el formulario
    if (!entrar) {
        window.location.href = "../../index.html";
    }
});
