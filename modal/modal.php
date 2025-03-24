<!-- Modal de Agregar Producto -->
<div id="addModal" class="modal modal-edit-add">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Agregar Producto</h2>
        <form id="addForm" action="../config/agregar_producto.php" method="POST">
            <label for="addProductName">Nombre:</label>
            <input type="text" name="nombre" id="addProductName" required>
            
            <label for="addProductPrice">Precio:</label>
            <input type="number" name="precio" id="addProductPrice" required>
            
            <label for="addProductDesc">Descripción:</label>
            <input type="text" name="descripcion" id="addProductDesc" required>
            
            <label for="addProductStock">Cantidad:</label>
            <input type="number" name="stock" id="addProductStock" required>

            <button type="submit">Agregar</button>
            <button type="button" onclick="closeModal()">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal de Modificación de Producto -->
<div id="editModal" class="modal modal-edit-add">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Modificar Producto</h2>
        <form id="editForm" action="../config/modificar_producto.php" method="POST">
            <input type="hidden" name="id" id="editProductId">
            <label for="editProductName">Nombre:</label>
            <input type="text" name="nombre" id="editProductName" required>
            
            <label for="editProductPrice">Precio:</label>
            <input type="number" name="precio" id="editProductPrice" required>
            
            <label for="editProductDesc">Descripción:</label>
            <input type="text" name="descripcion" id="editProductDesc" required>
            
            <label for="editProductStock">Cantidad:</label>
            <input type="number" name="stock" id="editProductStock" required>

            <button type="submit">Guardar Cambios</button>
            <button type="button" onclick="closeModal()">Cancelar</button>
        </form>
    </div>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div id="deleteModal" class="modal modal-delete">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Eliminar Producto</h2>
        <p>¿Estás seguro de que deseas eliminar el producto <strong id="deleteProductName"></strong>?</p>
        <form id="deleteForm" action="../config/eliminar_producto.php" method="POST">
            <input type="hidden" name="id" id="deleteProductId">
            <button type="submit">Eliminar</button>
            <button type="button" onclick="closeModal()">Cancelar</button>
        </form>
    </div>
</div>

