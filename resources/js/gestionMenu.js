// Centrar y mostrar el modal sobre los demás elementos
const modal = document.getElementById('agregarPlatilloModal');
modal.classList.add('fixed', 'inset-0', 'flex', 'items-center', 'justify-center', 'z-50', 'bg-black', 'bg-opacity-50');
modal.addEventListener('click', function(e) {
    if (e.target === modal) {
        modal.classList.add('hidden');
    }
});

//Lógica para editar platillo
var btns_edit = document.getElementsByClassName('BTN_EDIT');
const editModal = document.getElementById('editarPlatilloModal');
editModal.classList.add('fixed', 'inset-0', 'flex', 'items-center', 'justify-center', 'z-50', 'bg-black', 'bg-opacity-50');
editModal.addEventListener('click', function(e) {
    if (e.target === editModal) {
        editModal.classList.add('hidden');
    }
});

Array.from(btns_edit).forEach(function(button) {
    button.addEventListener('click', function() {
        var platilloId = this.value;
        fetch(`/negocio/admin/gestion/menu/editar/${platilloId}`)
            .then(response => response.json())
            .then(data => {
                // Manejando la respuesta JSON habilitando el formulario de edición
                console.log(data);
                editModal.classList.remove('hidden');
                // Rellenando campos del formulario de editar platillo
                const platilloIdEdit = document.getElementById('platilloIdEdit');
                platilloIdEdit.value = data.platillo_edit.id;
                const nombrePlatilloEdit = document.getElementById('nombrePlatilloEdit');
                nombrePlatilloEdit.value = data.platillo_edit.nombre;
                const descripcionPlatilloEdit = document.getElementById('descripcionPlatilloEdit');
                descripcionPlatilloEdit.value = data.platillo_edit.descripcion;
                const precioPlatilloEdit = document.getElementById('precioPlatilloEdit');
                precioPlatilloEdit.value = data.platillo_edit.precio;
                const cantidadPlatilloEdit = document.getElementById('cantidadPlatilloEdit');
                cantidadPlatilloEdit.value = data.platillo_edit.cantidad;
                const disponiblePlatilloEdit = document.getElementById('disponiblePlatilloEdit');
                disponiblePlatilloEdit.checked = data.platillo_edit.disponible ==1 ? true : false;
                
            })
            .catch(error => {
                console.error('Error al obtener los datos del platillo:', error);
            });
    });
});

//Lógica para alternar entre platillos disponibles y no disponibles
const btnCategoriaDisp = document.getElementById('categoriaDisponibles');
const btnCategoriaNoDisp = document.getElementById('categoriaNoDisponibles');
var filaPlatillosDisp = Array.from(document.getElementsByClassName('platillosDisp'));
var filaPlatillosNoDisp = Array.from(document.getElementsByClassName('platillosNoDisp'));

btnCategoriaDisp.addEventListener('click', function() {
    filaPlatillosDisp.forEach(
        (element) => element.classList.remove('hidden')
    );
    filaPlatillosNoDisp.forEach(
        (element) => element.classList.add('hidden')
    );
    btnCategoriaDisp.classList.add('border','border-b-0', 'border-slate-400');
    btnCategoriaNoDisp.classList.remove('border','border-b-0', 'border-slate-400');
});

btnCategoriaNoDisp.addEventListener('click', function() {
    filaPlatillosNoDisp.forEach(
        (element) => element.classList.remove('hidden')
    );
    filaPlatillosDisp.forEach(
        (element) => element.classList.add('hidden')
    );
    btnCategoriaNoDisp.classList.add('border','border-b-0', 'border-slate-400');
    btnCategoriaDisp.classList.remove('border','border-b-0', 'border-slate-400');
});