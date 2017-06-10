

/*$.fn.ajaxCheckbox = function () {
 var url = $(this).data('href') + '/status';
 
 $(this).on('change', 'input[type="checkbox"]', function () {
 
 var value = $(this).is(':checked') ? 1 : 0,
 id = $(this).data('id'),
 param = $(this).attr('name');
 
 if ( id !== undefined && id && param !== undefined && param )
 {
 $.ajax({
 method: 'post',
 url: url,
 data: {param: param, id: id ,value: value},
 });
 }
 })
 }*/


$.fn.sortableTable = function () {

    var $rowsList = $(this).find(' > tbody'),
            url = $(this).data('href') + '/position';

    $rowsList.sortable({
        stop: function () {
            $items = getListItems();
            $.ajax({
                method: 'post',
                url: url,
                data: {itemsList: JSON.stringify($items)},
            });
        }
    });

    $rowsList.sortable({cancel: '[class*=treegrid-parent-]'});


    function getListItems() {
        $items = new Array();
        $rowsList.find(' > tr').each(function () {
            $items.push($(this).data('key'));
        })

        return $items;
    }
    ;
}

