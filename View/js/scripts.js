$(document).ready(() => {
    $('#dataTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
        }
    });
});