var countQuestion = 0;

function validateEmail(email){
    let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

$(document).ready(function (e) {
    $('#buy_ticket').click(function (e) {

        var fio = $.trim($('input#fio').val());
        var phone_number = $.trim($('input#phone_number').val());
        var email = $.trim($('input#email').val());
        var promo_kod = $.trim($('input#promo_kod').val());

        if (fio === '') {
            alert("Заполните фамилию");
            return false;
        }

        if (phone_number === '') {
            alert("Заполните номер телефона");
            return false;
        }

        if (email === '') {
            alert("Заполните номер электронную почту");
            return false;
        }

        if (!validateEmail(email)) {
            alert("Не верный формат электронной почты");
            return false;
        }

        $.ajax({
            type: "POST",
            url: 'buy_ticket/index.php',
            data: {
                fio,
                email,
                phone_number,
                promo_kod
            },
            success: function (data) {
                data = JSON.parse(data);
                alert(data.text);
                $(input).val('');
            }
        });
    });

    $.ajax({
        type: "POST",
        url: 'players/index.php',
        success: function (data) {
            data = JSON.parse(data);
            var russia = [];
            var brazil = [];
            $.each(data, function (key, val) {
                if(val.nameCommand === "Russia")
                    russia.push("<div class='image'> <img src='"+ val.Avatar +"' alt=''> <span class='name_player'>"+ val.lastName + " " + val.firstName +"</span> </div>");
                else
                    brazil.push("<div class='image'> <img src='"+ val.Avatar +"' alt=''> <span class='name_player'>"+ val.lastName + " " + val.firstName +"</span> </div>")
            });

            $("#russia-command").append(russia.join(""));
            $("#brazil-command").append(brazil.join(""));
        }
    });

    $.ajax({
        type: 'POST',
        url: 'questions/get.php',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            var old = "0";
            $.each(data, function (key, val) {
                if(val.idQuestion !== old){
                    $("#list_questions").append("<li id='"+ val.idQuestion +"'><h3>"+ val.nameQuestion +"</h3></li>");
                    $("#"+val.idQuestion).append("<label><input type='radio' id='"+ val.idQuestion + val.idAnswer +"' value='"+ val.nameAnswer +"' name='"+val.idQuestion+"' checked='checked'>"+ val.nameAnswer +"</label><br>");
                    old = val.idQuestion;
                }
                else if(val.idQuestion === old){
                    $("#"+val.idQuestion).append("<label><input type='radio' id='"+ val.idQuestion + val.idAnswer +"' value='"+ val.nameAnswer +"' name='"+val.idQuestion+"' checked='checked'>"+ val.nameAnswer +"</label><br>");
                }
            })

            countQuestion = parseInt(old);
        }
    });

    $('#button_answer').click(function (e) {
        e.preventDefault();
        var answers = [];

        $('#list_questions').each(function (key, val) {
            for(var i = 1; i <= countQuestion; i++)
                answers.push($('li#'+i+' label input[type="radio"]:checked').val());
        });

        answers = JSON.stringify(answers);
        $.ajax({
            type: 'POST',
            url: 'questions/index.php',
            data: {
                answers: answers
            },
            success: function (data) {
                data = JSON.parse(data);
                if(data.Error)
                    alert(data.Error);
                else{

                    console.log(data.text);
                }

            }
        })
    });

});