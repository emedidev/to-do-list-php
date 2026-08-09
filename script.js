/* SE DEFINE LA FUNCION HANDLECLICK PARA MANEJAR LA SELECCION DE ELEMENTOS QUE SERAN MODIFICADOS */

function handleClick(id) {
    const elemento = document.getElementById(id);
    elemento.removeAttribute('readonly');
    elemento.focus();

    elemento.addEventListener('blur', () => {
        elemento.setAttribute('readonly', true);
    })
};

/* SE DEFINE LA FUNCION SENDCHANGE PARA ENVIAR CAMBIOS REALIZADOS EN EL DOM */
async function sendChange(id, idProd, idCant, idPric){

    /* ESTAS VARIABLES RECIBEN LOS ID DE CADA ELEMENTO DEL DOM DEL REGISTRO A MODIFICAR */
    const elmPrd = document.getElementById(idProd);
    const elmCnt = document.getElementById(idCant);
    const elmPrc = document.getElementById(idPric);
    
    if(elmPrd.value === "" || elmCnt.value === ""  || elmPrc.value === ""){
        return alert("Hay un campo vacio, favor completar antes de guardar.")
    }

    /* SE ALMACENA EN UNA VARIABLE DE TIPO OBJETO LOS DATOS */
    const registro = {
                action: "edit-task",
                id: id,
                producto: elmPrd.value,
                cantidad: parseInt(elmCnt.value),
                precio: parseInt(elmPrc.value)
            };
    /* SE CREA UNA PROMESA PARA ENVIAR LOS DAOS EN FORMATO JSON AL BACKEND */
    try {
        const promise = await fetch('db/crud.php',{
            method: 'post',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(registro)
        })
        
        /* ALMACENAMOS LA PROMESA EN UNA VARIABLE, LA EVALUAMOS Y SI ESTA ok ENTONCES SE ACTUALIZA EL DOM Y SE ENVIA ALERTA */
        const result = await promise.json()
        
        if(result.estatus === 'ok'){
            location.reload()
            alert("Tareas actualizadas.")
        }
        
    } catch(error){
        alert("Error al guardar los datos: " + error)
    }
}
