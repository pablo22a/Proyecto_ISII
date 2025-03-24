<!-- Modal para Agregar, Editar y Eliminar Pedidos -->
<div id="pedidoModal" class="modal modal-edit-add">
    <div class="modal-content">
        <span class="close" onclick="closeModal1()">&times;</span>
        <h2 id="modal-title">Agregar Pedido</h2>
        <form id="pedidoForm" action="../config/procesar_pedido.php" method="POST">
            <input type="hidden" id="pedido-id" name="pedido-id" value="">
            <input type="hidden" id="action" name="action" value="">
            
            <label for="id_cliente">ID Cliente:</label>
            <input type="number" id="id_cliente" name="id_cliente" required>

            <label for="nombre_producto">Nombre del Producto:</label>
            <input type="text" id="nombre_producto" name="nombre_producto" required>

            <label for="cantidad_producto">Cantidad:</label>
            <input type="number" id="cantidad_producto" name="cantidad_producto" required>

            <label for="precio_producto">Precio:</label>
            <input type="number" id="precio_producto" name="precio_producto" required>

            <label for="fecha_pedido">Fecha del Pedido:</label>
            <input type="date" id="fecha_pedido" name="fecha_pedido" required>

            <label for="total_pedido">Total:</label>
            <input type="number" id="total_pedido" name="total_pedido" required>

            <div class="modal-footer">
                <button type="submit" id="submit-btn">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
// Función para abrir el modal
function openModal1(action, id_pedido = '', id_cliente = '', nombre_producto = '', cantidad_producto = '', precio_producto = '', fecha_pedido = '', total_pedido = '') {
    // Mostrar el modal
    document.getElementById('pedidoModal').style.display = 'block';

    // Configurar el formulario dependiendo de la acción (Agregar/Editar)
    document.getElementById('action').value = action; // Aquí se establece el valor de action
    if (action === 'edit') {
        document.getElementById('modal-title').textContent = 'Editar Pedido';
        document.getElementById('pedido-id').value = id_pedido;
        document.getElementById('id_cliente').value = id_cliente;
        document.getElementById('nombre_producto').value = nombre_producto;
        document.getElementById('cantidad_producto').value = cantidad_producto;
        document.getElementById('precio_producto').value = precio_producto;
        document.getElementById('fecha_pedido').value = fecha_pedido;
        document.getElementById('total_pedido').value = total_pedido;
        document.getElementById('submit-btn').textContent = 'Actualizar';
    } else if (action === 'add') {
        document.getElementById('modal-title').textContent = 'Agregar Pedido';
        document.getElementById('pedido-id').value = '';
        document.getElementById('id_cliente').value = '';
        document.getElementById('nombre_producto').value = '';
        document.getElementById('cantidad_producto').value = '';
        document.getElementById('precio_producto').value = '';
        document.getElementById('fecha_pedido').value = '';
        document.getElementById('total_pedido').value = '';
        document.getElementById('submit-btn').textContent = 'Guardar';
    } else if (action === 'delete') {
        // Confirmar eliminación de pedido
        if (confirm('¿Estás seguro de que deseas eliminar este pedido?')) {
            window.location.href = '../config/procesar_pedido.php?action=delete&id=' + id_pedido;
        }
    }
}

// Función para cerrar el modal
function closeModal1() {
    document.getElementById('pedidoModal').style.display = 'none';
}
</script>
