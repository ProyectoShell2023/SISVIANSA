const one = document.querySelector(".one");
const two = document.querySelector(".two");
const three = document.querySelector(".three");
const four = document.querySelector(".four");
const five = document.querySelector(".five");
const six = document.querySelector(".six"); // Agregado para el estado 6

const select = document.getElementById("progressSelect");

select.addEventListener("change", function () {
    const selectedValue = select.value;

    // Elimina todas las clases "active" de los elementos de la barra de progreso
    one.classList.remove("active");
    two.classList.remove("active");
    three.classList.remove("active");
    four.classList.remove("active");
    five.classList.remove("active");
    six.classList.remove("active"); // Agregado para el estado 6

    // Utiliza un switch para agregar la clase "active" al elemento correspondiente
    switch (selectedValue) {
        case "1":
            one.classList.add("active");
            break;
        case "2":
            one.classList.add("active");
            two.classList.add("active");
            break;
        case "3":
            one.classList.add("active");
            two.classList.add("active");
            three.classList.add("active");
            break;
        case "4":
            one.classList.add("active");
            two.classList.add("active");
            three.classList.add("active");
            four.classList.add("active");
            break;
        case "5":
            one.classList.add("active");
            two.classList.add("active");
            three.classList.add("active");
            four.classList.add("active");
            five.classList.add("active");
            break;
        case "6":
            one.classList.add("active");
            two.classList.add("active");
            three.classList.add("active");
            four.classList.add("active");
            five.classList.add("active");
            six.classList.add("active");
            break;
        default:
            // Manejar el caso predeterminado si es necesario
            break;
    }
});
