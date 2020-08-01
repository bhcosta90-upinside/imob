$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('select[name="property"]').change(function(){
        const el = $(this);
        const option = $(this).find(':selected'); 

        if(el.val() != ""){
            const sale_price = option.data("sale_price");
            const rent_price = option.data("rent_price");
            const tribute = option.data("tribute");
            const condominium = option.data("condominium");

            $('input[name="sale_price"]').val(sale_price);
            $('input[name="rent_price"]').val(rent_price);
            $('input[name="tribute"]').val(tribute);
            $('input[name="condominium"]').val(condominium);
        }
    }).trigger('change');

    $('select[name="owner"], select[name="acquirer"]').change(function(){
        const el = $(this);
        const nameSelect = $(el).prop('name') ;
        const spouseName = $(el).find(':selected').data("spouse-name");
        const spouseDocument = $(el).find(':selected').data("spouse-document");
        const optSpouser = $(el).parent().parent().find("select").eq(1);
        const optCompany = $(el).parent().parent().parent().find("select").eq(2);
        const optProperty = $("select[name='property']");
        const user = $(el).val();

        var select = [];
        select.push($("<option>", {html: "Não informado", value: ""}))
        
        var str = "";
        if(spouseName) {
            optSpouser.prop('disabled', false);
            str = spouseName;
            if(spouseDocument) {
                str = `${str} (${spouseDocument})`
            }
            select.push($("<option>", {html: str, value: 1}))
        } else{
            optSpouser.prop('disabled', true);
        }
        
        optSpouser.html(select);

        switch(nameSelect){
            case 'owner':
            optSpouser.val($('input[name="owner_spouse_persist"]').val());
            break;
            case 'acquirer':
            optSpouser.val($('input[name="acquirer_spouse_persist"]').val());
            break;
        }

        if(user) {
            const action = $(el).data('action');

            $.post(action, {"user": user, "name": nameSelect}, function(response) {
                var options = [
                    $("<option>", {value: "", html: "Não informado"})
                ]

                response.companies.map(function(item){
                    var str = item.social_name;
                    if (item.document_company) {
                        str = `${str} (${item.document_company})`
                    }
                    options.push($("<option>", {value: item.id, html: str}))
                })

                optCompany.html(options);

                switch(nameSelect){
                    case 'owner':
                    optCompany.val($('input[name="owner_company_persist"]').val());
                    break;
                    case 'acquirer':
                    optCompany.val($('input[name="acquirer_company_persist"]').val());
                    break;
                }

                if(nameSelect == "owner") {

                    var options = [
                        $("<option>", {value: "", html: "Não informado"})
                    ];

                    if (nameSelect == 'owner') {
                        response.properties.map(function(item){
                            options.push($("<option>", {
                                value: item.id, 
                                html: item.description,
                                attr: {
                                    "data-tribute": item.tribute,
                                    "data-condominium": item.condominium,
                                    "data-sale_price" : item.sale_price,
                                    "data-rent_price" : item.rent_price,
                                }
                            }))
                        })
                    }
                    optProperty.html(options).val($("input[name='property_persist']").val()).trigger("change");
                }
            })
        }
    }).trigger('change');
});