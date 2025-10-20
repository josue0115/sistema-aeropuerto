document.addEventListener('DOMContentLoaded', function() {
    const tipoServicioSelect = document.getElementById('idTipoServicio');
    const cantidadInput = document.getElementById('Cantidad');
    const costoTotalInput = document.getElementById('CostoTotal');

    function calcularCostoTotal() {
        const selectedOption = tipoServicioSelect.options[tipoServicioSelect.selectedIndex];
        const costoUnitario = parseFloat(selectedOption.getAttribute('data-costo')) || 0;
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const costoTotal = costoUnitario * cantidad;

        costoTotalInput.value = costoTotal.toFixed(2);
    }

    tipoServicioSelect.addEventListener('change', calcularCostoTotal);
    cantidadInput.addEventListener('input', calcularCostoTotal);

    // Calcular inicialmente si hay valores
    calcularCostoTotal();
});
