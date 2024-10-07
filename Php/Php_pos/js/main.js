


function addStock(id) {
    let quantity = prompt('Eklenecek stok adedi?');

    if (quantity == null) return;

    quantity = parseInt(quantity)

    if (isNaN(quantity)) {
        alert('Geçersiz değer')
        return
    }

    window.location.href = `api/product.php?action=add_stock&id=${id}&quantity=${quantity}`;
}