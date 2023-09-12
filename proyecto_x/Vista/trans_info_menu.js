//Btn flechas para cantidad

const inputQuantity = document.querySelector('.input-quantity') ;

const btmIncrement = document.querySelector('#increment') ;
const btnDecrement = document.querySelector('#decrement') ;

var valueByDefault = parseInt(inputQuantity.value) ;

btmIncrement.addEventListener('click' , () => {
    valueByDefault += 1 ;
    inputQuantity.value = valueByDefault ; 
});

btnDecrement.addEventListener('click' , () => {
    if(valueByDefault === -1)
    {
        return
    }

    valueByDefault -= 1 ;
    inputQuantity.value = valueByDefault ; 
});

//Toggle

const togg1eDescription = document.querySelector('.title-description') ;
const toggleIngredients = document.querySelector('.title-ingredients') ;
const togg1eAdditionalInformation = document.querySelector( '.title-additional-information') ;

const contentDescription = document.querySelector('.text-description') ;  
const contentIngredients = document.querySelector('.text-ingredients') ;
const contentAdditionalInformation = document.querySelector( '.text-additional-information') ;

togg1eDescription.addEventListener('click' , () =>{
    contentDescription.classList.toggle('hidden') ; 
})

toggleIngredients.addEventListener('click' , () =>{
    contentIngredients.classList.toggle('hidden') ; 
})

togg1eAdditionalInformation.addEventListener('click' , () => {
    contentAdditionalInformation.classList.toggle('hidden') ; 
})