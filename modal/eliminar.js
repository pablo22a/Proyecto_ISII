function openDeleteModal(id, nombre) {
    document.getElementById("deleteProductId").value = id;
    document.getElementById("deleteProductName").textContent = nombre;
    document.getElementById("deleteModal").style.display = "block";
}

function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}

// Cierra la modal si se hace clic fuera de ella
window.onclick = function(event) {
    var modal = document.getElementById("deleteModal");
    if (event.target === modal) {
        closeDeleteModal();
    }
}
