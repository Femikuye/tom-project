$( function() {
    $( "#sortable" ).sortable({
      axis: "y",
      opacity: 0.6,
      placeholder: "rowlist rowplaceholder",
      cursor: "move",
        forceHelperSize: true,
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('#sortable>li').each(function() {
                selectedData.push($(this).attr("id"));
            });
            $.ajax({
                data: {lists:selectedData},
                type: 'POST',
                url: base_url+'api/arrang_view',
                success: function(data){
                }
            });
        },
    });
    $( "#sortable" ).disableSelection();
  } );
