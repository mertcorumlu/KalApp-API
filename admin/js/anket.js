/**
 * Created by MERT on 19/01/2018.
 */
var soru_sayac=0;

$("button#soru_ekle").bind("click",function () {
    soru_sayac++;
    var soru_group=document.createElement("div");
        $(soru_group).addClass("soru_group");
        $(soru_group).attr("data-index",soru_sayac);

    var form_group=document.createElement("div");
    $(form_group).addClass("item").addClass("form-group");

    var label=document.createElement("label");
        $(label).addClass("control-label").addClass("col-md-1").addClass("col-sm-1").addClass("col-xs-12");
        $(label).attr("for","");
        $(label).text((soru_sayac+1)+".Soru");

    var input_div=document.createElement("div");
    $(input_div).addClass("col-md-5").addClass("col-sm-5").addClass("col-xs-12");

    var input=document.createElement("input");
    $(input).addClass("col-md-3").addClass("form-control").addClass("col-xs-12");
    $(input).attr("type","text");
    $(input).attr("placeholder","Soru");
    $(input).attr("name","soru[]");

    var select_div=document.createElement("div");
    $(select_div).addClass("col-md-3").addClass("col-sm-3").addClass("col-xs-12");

    var select=document.createElement("select");
    $(select).addClass("col-md-3").addClass("form-control").addClass("col-xs-12").addClass("selector");
    $(select).attr("data-index",soru_sayac);
    $(select).attr("name","secenek[]");
    $(select).attr("required","");
    $(select).css("float","left");

    var option1=document.createElement("option");
        $(option1).attr("value","");
        $(option1).text("Lütfen Seçin");

    var option2=document.createElement("option");
    $(option2).attr("value","0");
    $(option2).text("Text-Radio");

    var option3=document.createElement("option");
    $(option3).attr("value","1");
    $(option3).text("Image-Radio");

    var option4=document.createElement("option");
    $(option4).attr("value","2");
    $(option4).text("Text-Checkbox");

    var option5=document.createElement("option");
    $(option5).attr("value","3");
    $(option5).text("Image-Checkbox");

    var divider=document.createElement("div");
        $(divider).addClass("divider");

    var ln_solid=document.createElement("div");
    $(ln_solid).addClass("ln_solid");

        input_div.appendChild(input);

        select.appendChild(option1);
        select.appendChild(option2);
        select.appendChild(option3);
        select.appendChild(option4);
        select.appendChild(option5);

        select_div.appendChild(select);

        form_group.appendChild(label);
        form_group.appendChild(input_div);
        form_group.appendChild(select_div);



    soru_group.appendChild(form_group);
    soru_group.appendChild(divider);

    $("#button-holder").before(soru_group).before(ln_solid);


return false;
});

$("button#soru_sil").bind("click",function () {

    if($("#myForm div.soru_group[data-index]").length <=1){
        return false;
        alert("küçük");
    }

    console.log($("#myForm div.soru_group").length);

    $("#myForm div.soru_group[data-index="+(soru_sayac)+"] + .ln_solid").remove();
    $("#myForm div.soru_group[data-index="+(soru_sayac)+"]").remove();
    soru_sayac--;
    return false;
});




$(document).on("change",".selector",function () {
    $(this).attr("data-placeholder",this.value);
    var delete_index=$(this).attr("data-index");
    if(this.value==""){
        alert("Lütfen Seçim Yapın");
        return;
    }
    var soru_group=$("div.soru_group[data-index="+$(this).attr("data-index")+"]");
    //Sıfırla

    $("div.sık[data-index="+$(this).attr("data-index")+"]").remove();
    soru_group.find(".item.form-group:first-child div.buton_div").remove();




    if(this.value!=""){


        /*ŞIK EKELEME BUTONU*/
        var button_div=document.createElement("div");
        $(button_div).addClass("col-md-1").addClass("col-sm-1").addClass("col-xs-12").addClass("buton_div");

        var soru_add_button=document.createElement("button");
        $(soru_add_button).addClass("btn").addClass("btn-success");
        $(soru_add_button).attr("id","sık_ekle");
        soru_add_button.setAttribute("type","submit");
        soru_add_button.setAttribute("data-index",delete_index);
        $(soru_add_button).text("Şık Ekle");

        button_div.appendChild(soru_add_button);

        soru_group.find(".item.form-group:first-child").append(button_div);



        /*ŞIK SİLME BUTONU*/
         button_div=document.createElement("div");
        $(button_div).addClass("col-md-1").addClass("col-sm-1").addClass("col-xs-12").addClass("buton_div");

         soru_add_button=document.createElement("button");
        $(soru_add_button).addClass("btn").addClass("btn-danger");
        $(soru_add_button).attr("id","sık_sil");
        soru_add_button.setAttribute("type","submit");
        soru_add_button.setAttribute("data-index",delete_index);

        $(soru_add_button).text("Şık Sil");

        button_div.appendChild(soru_add_button);

        soru_group.find(".item.form-group:first-child").append(button_div);









        sık_ekle(soru_group,delete_index);

    }

});

$(document).on("click","button#sık_ekle",function () {

    sık_ekle($("div.soru_group[data-index="+$(this).attr("data-index")+"]"),$(this).attr("data-index"));


    return false;
});

$(document).on("click","button#sık_sil",function (e) {
    sık_sil($("div.soru_group[data-index="+$(this).attr("data-index")+"]"),$(this).attr("data-index"));

    return false;
});

function sık_ekle(soru_group,delete_index){
    console.log(soru_sayac);
    var form_group=document.createElement("div");
    $(form_group).addClass("item").addClass("form-group").addClass("sık");
    form_group.setAttribute("data-index",delete_index);



        var placeholder;
    switch (soru_group.find(".selector").attr("data-placeholder")){
        case "0":
            placeholder="Text";
            break;

        case "1":
            placeholder="Url";

            break;

        case "2":
            placeholder="Text";
            break;

        case "3":
            placeholder="Url";
            break;
    }

    var label=document.createElement("label");
    $(label).addClass("control-label").addClass("col-md-2").addClass("col-md-2").addClass("col-xs-12");
    label.setAttribute("for","name");
    $(label).text("Şık");

    var input_div=document.createElement("div");
    $(input_div).addClass("col-md-4").addClass("col-sm-4").addClass("col-xs-12");

    var input=document.createElement("input");
    $(input).addClass("form-control").addClass("col-md-3").addClass("col-xs-12");
    input.setAttribute("type","text");
    input.setAttribute("name",soru_sayac+"[]");
    input.setAttribute("required","");
    input.setAttribute("placeholder",placeholder);




    input_div.appendChild(input);

    form_group.appendChild(label);
    form_group.appendChild(input_div);



    soru_group.append(form_group);
}

function sık_sil(soru_group,delete_index){
    if(soru_group.find("div.sık[data-index="+delete_index+"]").length <= 1){

       return;

    }

    soru_group.find("div.sık[data-index="+delete_index+"]:last-child").remove();

}

