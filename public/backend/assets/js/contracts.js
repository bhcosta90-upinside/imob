$(function(){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$('select[name="property_id"]').change(function(){const e=$(this),a=$(this).find(":selected");if(""!=e.val()){const e=a.data("sale_price"),t=a.data("rent_price"),n=a.data("tribute"),i=a.data("condominium");$('input[name="sale_price"]').val(e),$('input[name="rent_price"]').val(t),$('input[name="tribute"]').val(n),$('input[name="condominium"]').val(i)}}).trigger("change"),$('select[name="owner_id"], select[name="acquirer_id"]').change(function(){const e=$(this),a=$(e).prop("name"),t=$(e).find(":selected").data("spouse-name"),n=$(e).find(":selected").data("spouse-document"),i=$(e).parent().parent().find("select").eq(1),r=$(e).parent().parent().parent().find("select").eq(2),p=$("select[name='property_id']"),o=$(e).val();var s=[];s.push($("<option>",{html:"Não informado",value:""}));var c="";switch(t?(i.prop("disabled",!1),c=t,n&&(c=`${c} (${n})`),s.push($("<option>",{html:c,value:1}))):i.prop("disabled",!0),i.html(s),a){case"owner_id":$('input[name="owner_spouse_persist"]').val()>0&&i.val(1);break;case"acquirer_id":$('input[name="acquirer_spouse_persist"]').val()>0&&i.val(1)}if(o){const t=$(e).data("action");$.post(t,{user:o,name:a},function(e){var t=[$("<option>",{value:"",html:"Não informado"})];switch(e.companies.map(function(e){var a=e.social_name;e.document_company&&(a=`${a} (${e.document_company})`),t.push($("<option>",{value:e.id,html:a}))}),r.html(t),a){case"owner_id":r.val($('input[name="owner_company_persist"]').val()),$('input[name="owner_company_persist"]').val(""),$('input[name="owner_spouse_persist"]').val("");break;case"acquirer_id":r.val($('input[name="acquirer_company_persist"]').val()),$('input[name="acquirer_company_persist"]').val(""),$('input[name="acquirer_spouse_persist"]').val("")}if("owner_id"==a){t=[$("<option>",{value:"",html:"Não informado"})];"owner_id"==a&&e.properties.map(function(e){t.push($("<option>",{value:e.id,html:e.description,attr:{"data-tribute":e.tribute,"data-condominium":e.condominium,"data-sale_price":e.sale_price,"data-rent_price":e.rent_price}}))}),p.html(t).val($("input[name='property_persist']").val()).trigger("change"),$("input[name='property_persist']").val("")}})}}).trigger("change")});
