  
var placeholderTexts = {
    "p1": ["Магомед (клиент)", "Видеограф Абдулла", "22.06.1941"],
    "p2": ["22.06.1941", "Махачкала", "на весь день", "квадрокоптер", "$2500"],
    "p3": ["Магомед (клиент)", "(телефон клиента)", "Видеограф Абдулла", "22.06.1941", "Махачкала", "на весь день", "квадрокоптер", "$2500"],
    "p4": ["Видеограф Абдулла", "22.06.1941", "$2500", "$25"],
    "p5": ["Видеограф Абдулла", "(телефон исполнителя)", "22.06.1941", "Махачкала", "$2500", "$25"],
    "p6": ["Магомед", "(телефон клиента)", "22.06.1941", "Махачкала", "$2500", "$25"],
    "p7": ["Видеограф Абдулла", "(телефон исполнителя)", "Магомед", "(телефон клиента)", "22.06.1941", "Махачкала", "$2500", "$25"]
};


$(document).ready(function () {
    $("textarea").on("keyup", function () {
        var pid = $(this).parent().attr("id");
        interpolateStrings(placeholderTexts[pid], "#" + pid);
    });

    $("textarea").keyup();
});

function interpolateStrings(items, id) {
    var value = $(id + " textarea").val();
    var textArea = value.split('%');
    var result = "";

    textArea.forEach(function (item, index) {
        if (textArea.length > 1 && textArea.length - index > 1) result += item + items[index];
        else result += item;
    });

    $(id + " div").html(result);
}

   $(".submit").click (function (){
        event.preventDefault();
       var dataText=[];
        elements=document.getElementsByTagName("textarea");
  
        for (var i = 0; i < elements.length; i++) {

            if ($(elements[i]).val().length>0) 
                dataText[i]=$(elements[i]).val();
            else break;
              
        }
        if (dataText.length==7){
            $.ajax({
            url: "/api/smsTextupdate",
            type: "POST",
            data: {dataText},
            complete: function (data) {
                  alert ("Сохранено!") ;
              }
                });
        } 
        else  alert("Пустая форма №"+ (dataText.length+1) + " Нельзя оставлять пустые формы!");
    
});