var swiper = new Swiper(".mySwiper-1", {
    slidesPerView: 1,
    spaceBetween : 30,
    loop: true,
    pagination: {
        el:".swiper-pagination",
        clickable: true, 
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    }
})

var swiper = new Swiper(".mySwiper-2", {
    slidesPerView: 3,
    spaceBetween : 30,
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    breakpoints: {
        0: {
            slidesPerView: 1
        },
        520: {
            slidesPerView: 2
        },
        950: {
            slidesPerView: 3
        }
    }
})

/*Recoleta los Id de los menus que eligue el cliente*/
var menus_elegidos = [];  

//Carrito - En un futuro se pasara esta funcionalidad a php 
const carrito = document.getElementById('carrito');
const elementos1 = document.getElementById('lista-1');
const elementos2 = document.getElementById('lista-2');
const elementos3 = document.getElementById('lista-3');
const lista = document.querySelector('#lista-carrito tbody');
//Falta Impleentar
//const vaciarCarritoBtn = document.getElementById('vaciar-carrito');

cargarEventListeners();

function cargarEventListeners() {
    // Desvincular eventos previos (si los hay)
    elementos1.removeEventListener('click', comprarElemento);
    elementos2.removeEventListener('click', comprarElemento);
    elementos3.removeEventListener('click', comprarElemento);
    carrito.addEventListener('click', eliminarElemento);

    // Volver a vincular eventos
    elementos1.addEventListener('click', comprarElemento);
    elementos2.addEventListener('click', comprarElemento);
    elementos3.addEventListener('click', comprarElemento);


    document.addEventListener('click', function(e) {
        // console.log('Elemento clicado:', e.target);

        if (e.target.classList.contains('agregar-carrito')) {
            const elemento = e.target.parentElement.parentElement;
            leerDatosElemento(elemento);
            // console.log('Elemento agregado al carrito');
        } else if (e.target.classList.contains('btn-3')) {
            window.location.href = 'Vista/hacer_pedido.html';
            // console.log('Redirigiendo a hacer_pedido.html');
        } else if (e.target.classList.contains('borrar')) {
            const elemento = e.target.parentElement.parentElement;
            const id = elemento.querySelector('a').getAttribute('data-id');

            // Elimina el id del arreglo
            eliminarElementoDelArreglo(id);

            // Elimina el elemento de la interfaz
            elemento.remove();
            actualizarTotal();
        }
    });

    // Otras acciones...
}

function comprarElemento(e) {
    // console.log('Función comprarElemento ejecutada');
    e.stopPropagation();
    if (e.target.classList.contains('agregar-carrito')) {
        const elemento = e.target.parentElement.parentElement;
        leerDatosElemento(elemento);
        // console.log('Elemento agregado al carrito');
    } else if (e.target.classList.contains('btn-3')) {
        window.location.href = 'Vista/hacer_pedido.html';
        // console.log('Redirigiendo a hacer_pedido.html');
    }
}


function leerDatosElemento(elemento) {
    const infoElemento = {
        imagen: elemento.querySelector('img').src,
        titulo: elemento.querySelector('h3').textContent,
        precio: elemento.querySelector('.precio').textContent,
        id: elemento.querySelector('a').getAttribute('data-id')
    }

    insertarCarrito(infoElemento);
}

function insertarCarrito(elemento) {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>
            <img src="${elemento.imagen}" width=100>
        </td>
        <td>
            ${elemento.titulo}
        </td>
        <td>
            ${elemento.precio}
        </td>
        <td>
            <a href="#" class="borrar" data-id="${elemento.id}">Eliminar</a>
        </td>
    `;

    // Agrega el id al arreglo
    menus_elegidos.push(elemento.id);
    console.log(menus_elegidos);

    // Agrega el elemento a la lista
    lista.appendChild(row);
    actualizarTotal();
}

function eliminarElementoDelArreglo(id) {
    const index = menus_elegidos.indexOf(id);

    if (index !== -1) {
        menus_elegidos.splice(index, 1);
        // console.log(`Elemento con id ${id} eliminado del arreglo`);
        console.log(menus_elegidos); 
    } else {
        console.log(`Elemento con id ${id} no encontrado en el arreglo`);
    }
}

function eliminarElemento(e) {
    e.preventDefault();
    if (e.target.classList.contains('borrar')) {
        const elemento = e.target.parentElement.parentElement;
        const id = elemento.querySelector('a').getAttribute('data-id');

        // Elimina el id del arreglo
        eliminarElementoDelArreglo(id);

        // Elimina el elemento de la interfaz
        elemento.remove();
        actualizarTotal();
    }
}


function vaciarCarrito() {
    while (lista.firstChild) {
        lista.removeChild(lista.firstChild);
    }
    actualizarTotal();
    return false;
}

function actualizarTotal() {
    // Aquí puedes implementar la lógica para calcular y mostrar el total del carrito.
}

/*Exporta el arreglo menus_elegidos*/
export default menus_elegidos ; 

/*Barra lateral*/
const btnToggle = document.querySelector('.toggle-btn');
btnToggle.addEventListener('click', function () {
    //console.log('clik')
    document.getElementById('sidebar').classList.toggle('active');
    // console.log(document.getElementById('sidebar'))
});