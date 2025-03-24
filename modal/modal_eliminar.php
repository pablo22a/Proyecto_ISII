<!-- Modal de Confirmación de Eliminación -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <h2>Eliminar Producto</h2>
        <p>¿Estás seguro de que deseas eliminar el producto <strong id="deleteProductName"></strong>?</p>
        <form id="deleteForm" action="../config/eliminar_producto.php" method="POST">
            <input type="hidden" name="id" id="deleteProductId">
            <button type="submit">Eliminar</button>
            <button type="button" onclick="closeDeleteModal()">Cancelar</button>
        </form>
    </div>
</div>