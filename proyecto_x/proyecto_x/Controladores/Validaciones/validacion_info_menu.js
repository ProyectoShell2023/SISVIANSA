const cantidad = document.getElementById("input-quantity") ;
const form_sig = document.getElementById("form_sig") ; 

//Valida y almacen los datos validados 
let cantidad_validada = "" ; 

form_sig.addEventListener ("submit" , (event) => {
    event.preventDefault() ;

    let entrar = false ;

    // Validacion de longitud de la contraseña
    if (cantidad.value.length < 0) {
        console.log("error, cantidad inferior a 1") ;
        entrar = true;
    } else {
        console.log("good") ;
    }
})   
