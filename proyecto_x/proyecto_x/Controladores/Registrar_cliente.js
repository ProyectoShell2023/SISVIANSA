class dataUser {
    constructor(_cel, _email, _contra, _direccion) {
        this.cel = _cel ;
        this.email = _email ;
        this.contra = _contra ;
        this.direccion = _direccion ;
    }

    /* Métodos del CEL */
    get newCel() {
        return this.cel ;
    }

    set newCel(_cel) {
        this.cel = _cel ;
    }

    /* Métodos del EMAIL */
    get newEmail() {
        return this.email ;
    }

    set newEmail(_email) {
        this.email = _email ;
    }

    /* Métodos de la CONTRASEÑA */
    get newContra() {
        return this.contra ;
    }

    set newContra(_contra) {
        this.contra = _contra ;
    }

    /* Métodos de la DIRECCIÓN */
    get newDireccion() {
        return this.direccion ;
    }

    set newDireccion(_direccion) {
        this.direccion = _direccion ; 
    }
}

export default dataUser ;
