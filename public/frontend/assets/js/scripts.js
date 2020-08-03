$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    $('.open_filter').on('click', function (event) {
        event.preventDefault();

        box = $(".form_advanced");
        button = $(this);

        if (box.css("display") !== "none") {
            button.text("Filtro Avançado ↓");
        } else {
            button.text("✗ Fechar");
        }

        box.slideToggle();
    });

    $('body').on('change', 'select[name*="filter_"]', function(){
        const search = $(this);
        const nextIndex = $(this).data('index') + 1

        $.post(search.data('action'), {
            'search': search.val()
        }, function (response){
            if(response.status === true){
                $('select[data-index="' + nextIndex +'"]').empty();

                response.data.map(function (item){
                    $('select[data-index="' + nextIndex +'"]').append(
                        $("<option>", {
                            value: item,
                            text: item
                        })
                    )
                });

                $.each($('select[name*="filter_"]'), function(index, element) {
                    if($(element).data("index") > index + 1){
                        $('select[data-index="' + index +'"]').empty().append(
                            $("<option>", {
                                value: "",
                                text: "Escolha..."
                            })
                        )
                    }
                })
            } else {
                $.each($('select[name*="filter_"]'), function (index, element) {
                    if ($(element).data('index') >= nextIndex) {
                        $(element).empty().append(
                            $('<option>', {
                                text: 'Selecione uma opção no filtro anterior.'
                            })
                        );
                    }
                });
            }

            $('select[name*="filter_"].selectpicker').selectpicker('refresh');

        }, 'json')
    });
});
