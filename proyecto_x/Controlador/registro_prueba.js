// Obtener datos del formulario Cliente Business
let formCB = document.querySelector("#form_reg_cb");

if (formCB) { // Verificar si el formulario existe

    let nombreCB = formCB.querySelector("#nombre_cb").value;
    let rutCB = formCB.querySelector("#rut_cb").value;
    let ciEnCB = formCB.querySelector("#ci_en_cb").value;
    let direccionCB = formCB.querySelector("#ubi_reg_cb").value;

    console.log("Cliente Business:");
    console.log("Nombre:", nombreCB);
    console.log("Rut:", rutCB);
    console.log("CI Encargado:", ciEnCB);
    console.log("Dirección:", direccionCB);
}

// Obtener datos del formulario Cliente Normal
let formCN = document.querySelector("#form_reg_cn");

if (formCN) { // Verificar si el formulario existe

    let nombreCN = formCN.querySelector("#nombre_cn").value;
    let ciCN = formCN.querySelector("#ci_cn").value;
    let direccionCN = formCN.querySelector("#ubi_reg_cn").value;

    console.log("Cliente Normal:");
    console.log("Nombre:", nombreCN);
    console.log("CI:", ciCN);
    console.log("Dirección:", direccionCN);
}

// Obtener datos del formulario común (compartido por ambos formularios)
let email_reg = document.querySelector("#email_reg").value;
let pass_reg = document.querySelector("#pass_reg").value;
let cel_reg = document.querySelector("#cel_reg").value;

console.log("Datos comunes:");
console.log("Email:", email_reg);
console.log("Contraseña:", pass_reg);
console.log("Celular:", cel_reg);
