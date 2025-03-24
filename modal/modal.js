function openModal(action, id = null, nombre = '', precio = '', descripcion = '', stock = '') {
    switch(action) {
        case 'add':
            document.getElementById('addModal').style.display = 'block';
            break;
        case 'edit':
            // Llenar los campos con los datos del producto
            document.getElementById('editProductId').value = id;
            document.getElementById('editProductName').value = nombre;
            document.getElementById('editProductPrice').value = precio;
            document.getElementById('editProductDesc').value = descripcion;
            document.getElementById('editProductStock').value = stock;
            document.getElementById('editModal').style.display = 'block';
            break;
        case 'delete':
            // Llenar el campo de confirmación con el nombre del producto
            document.getElementById('deleteProductId').value = id;
            document.getElementById('deleteProductName').textContent = nombre;
            document.getElementById('deleteModal').style.display = 'block';
            break;
        default:
            console.log('Acción no reconocida');
    }
}

function closeModal() {
    // Cerrar todos los modales
    document.getElementById('addModal').style.display = "none";
    document.getElementById('editModal').style.display = "none";
    document.getElementById('deleteModal').style.display = "none";
}
