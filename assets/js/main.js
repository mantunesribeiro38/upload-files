$ (document).ready(function() {

    $( ".delete-attachment" ).click(function() {
        var id_attachment = $(this).closest("div.action").find("input[name='id_attachment']").val();

        var options   = {
            url : ajaxurl,
            method: "POST",
            data: {
                "action": "attachment_delete",
                "id_attachment": id_attachment
            }
        };

        $.ajax(options).done(function(success) {
            if( $('#attachment_item_'+id_attachment+'').length !== 0) {
                $('#attachment_item_'+id_attachment+'').remove();
            }

            console.log($('.container_attachment').children().length);
            if($('.container_attachment').children().length === 0){

                $('.lista-anexos').hide();
                $('.title-attachment').append('<h3 class="lista-sem-anexos">Nenhum anexo foi submetido</h3>');
            }
        }).fail(function(err) {
            console.log(arguments);
        });
    });

    $( '.inputfile' ).each( function()
	{
		var $input	 = $( this ),
			$label	 = $input.next( 'label' ),
			labelVal = $label.html();

		$input.on( 'change', function( e )
		{
			var fileName = '';

			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else if( e.target.value )
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				$label.find( 'span' ).html( fileName );
			else
				$label.html( labelVal );
		});
d
		$input
		.on( 'focus', function(){ $input.addClass( 'has-focus' ); })
		.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
	});
});



