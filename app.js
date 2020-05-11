//document.getElementById('data-categoria').addEventListener("mouseout", getCategorias);

function getCategorias() {
    var url = "Controllers/categoriasController.php"
    //crear la peticion
    var req = new XMLHttpRequest();
    req.open("GET", url, true);

    req.onload = function() { 
        if(req.status == 200) { 
            var jsonResponse = req.responseText; 
            var json = JSON.parse(jsonResponse);

            var options = "";
            json.forEach(categoria => {
                var option = `
                <option value="${categoria._id}">${categoria._nombre}</option>
                `;
                options+=option;
            })

            document.getElementById('data-categoria').innerHTML += options;
            //getByCategoria(document.getElementById('data-categoria'));
        } 
    } 
    req.send(); 
}

function getByCategoria(option) {
    let typeFilter = JSON.parse(option.selectedOptions[0].value);
    if(typeFilter == 0){
        var url = `Controllers/tareasController.php`;
    }
    else{
        var url = `Controllers/tareasController.php?categoria_id=${typeFilter}`;
    }
    

    //crear la peticion
    var req = new XMLHttpRequest();
    req.open("GET", url, true);

    req.onload = function() { 
        if(req.status == 200) { 
            var jsonResponse = req.responseText; 
            var json = JSON.parse(jsonResponse);

            console.log(json);

            var tareas = "";
            json.forEach(tarea => {
                var tareaInList = `
                <div class="categoria">
                    <label for="" class="data-categoria-fecha">Categoria ${tarea._categoria_id} - ${tarea._fechaLimite}</label>
                    <h1>${tarea._titulo}</h1>
                    <p>${tarea._descripcion}</p>
                </div>
                `;
                tareas+=tareaInList;
            });

            document.getElementById('lista-tareas').innerHTML = tareas;
            
        } 
    } 
    req.send(); 
}