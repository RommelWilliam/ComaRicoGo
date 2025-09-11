// Centrar y mostrar el modal sobre los demás elementos
const modal = document.getElementById('agregarUsuarioModal');
modal.classList.add('fixed', 'inset-0', 'flex', 'items-center', 'justify-center', 'z-50', 'bg-black', 'bg-opacity-50');
modal.addEventListener('click', function(e) {
    if (e.target === modal) {
        modal.classList.add('hidden');
    }
});

//Lógica para editar usuario
var btns_edit = document.getElementsByClassName('BTN_EDIT');
const editModal = document.getElementById('editarUsuarioModal');
editModal.classList.add('fixed', 'inset-0', 'flex', 'items-center', 'justify-center', 'z-50', 'bg-black', 'bg-opacity-50');
editModal.addEventListener('click', function(e) {
    if (e.target === editModal) {
        editModal.classList.add('hidden');
    }
});

Array.from(btns_edit).forEach(function(button) {
    button.addEventListener('click', function() {
        var usuarioId = this.value;
        fetch(`/negocio/admin/gestion/usuarios/${usuarioId}`)
            .then(response => response.json())
            .then(data => {
                // Manejando la respuesta JSON habilitando el formulario de edición
                console.log(data);
                editModal.classList.remove('hidden');
                // Rellenando campos del formulario de editar platillo
                const usuarioIdEdit = document.getElementById('usuarioIdEdit');
                usuarioIdEdit.value = data.usuario.id;
                const usuarioNombreEdit = document.getElementById('usuarioNombreEdit');
                usuarioNombreEdit.value = data.usuario.nombre;
                const usuarioCorreoEdit = document.getElementById('usuarioCorreoEdit');
                usuarioCorreoEdit.value = data.usuario.correo;
                
            })
            .catch(error => {
                console.error('Error al obtener los datos del usuario:', error);
            });
    });
});


// Centrar y mostrar el  ROL modal sobre los demás elementos
const agregarRolmodal = document.getElementById('agregarRolModal');
agregarRolmodal.classList.add('fixed', 'inset-0', 'flex', 'items-center', 'justify-center', 'z-50', 'bg-black', 'bg-opacity-50');
agregarRolmodal.addEventListener('click', function(e) {
    if (e.target === agregarRolmodal) {
        agregarRolmodal.classList.add('hidden');
    }
});
const editarRolmodal = document.getElementById('editarRolModal');
editarRolmodal.classList.add('fixed', 'inset-0', 'flex', 'items-center', 'justify-center', 'z-50', 'bg-black', 'bg-opacity-50');
editarRolmodal.addEventListener('click', function(e) {
    if (e.target === editarRolmodal) {
        editarRolmodal.classList.add('hidden');
    }
});

var btns_edit_rol = document.getElementsByClassName('BTN_EDIT_ROL');
Array.from(btns_edit_rol).forEach(function(button) {
    button.addEventListener('click', function() {
        var rolId = this.value;
        fetch(`/negocio/admin/gestion/rol/${rolId}`)
            .then(response => response.json())
            .then(data => {
                // Manejando la respuesta JSON habilitando el formulario de edición
                console.log(data);
                editarRolmodal.classList.remove('hidden');
                // Rellenando campos del formulario de editar platillo
                const rolIdEdit = document.getElementById('rolIdEdit');
                rolIdEdit.value = data.rol.id;
                const rolNombreEdit = document.getElementById('rolNombreEdit');
                rolNombreEdit.value = data.rol.nombre;
                const rolPermisosEdit = document.getElementById('rolNivelPermsisosEdit');
                rolPermisosEdit.value = data.rol.nivel_permisos;
            })
            .catch(error => {
                console.error('Error al obtener los datos del rol:', error);
            });
    });
});