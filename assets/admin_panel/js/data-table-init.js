/**
 * Created by mosaddek on 3/4/15.
 */

function format(d) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
        '<tr>' +
        '<td>Full name:</td>' +
        '<td>' + d.name + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Extension number:</td>' +
        '<td>' + d.extn + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Extra info:</td>' +
        '<td>And any further details here (images etc)...</td>' +
        '</tr>' +
        '</table>';
}

//DOM positioning
// l - Length changing
// f - Filtering input
// t - The Table!
// i - Information
// p - Pagination
// r - Processing
// < and > - div elements
// <"#id" and > - div with an id
// <"class" and > - div with a class
// <"#id.class" and > - div with an id and class

$('.common_table').DataTable({
    'PaginationType': 'bootstrap',
    responsive: true,
    dom: '<"tbl-top clearfix row"<"col-sm-3"l><"col-sm-6 text-center"B><"col-sm-3"f>>,t,<"tbl-footer clearfix"<"tbl-info pull-left"i><"tbl-pagin pull-right"p>>',
    // dom: 'Bfrtip',
    buttons: ['excel', 'pdf', 'print'],
});
