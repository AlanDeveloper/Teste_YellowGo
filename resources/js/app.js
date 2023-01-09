function mascCPF(value) {
    return value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3\-\$4");
}

$(".mascCPF").on("focus", function () {
    $(this).val($(this).val().replace(/(\.|\/|\-)/g, ""));
});

$(".mascCPF").on("blur", function () {
    $(this).val(mascCPF($(this).val()));
});

$(".mascTelefone").on("focus", function () {
    $(this).val($(this).val().replace(/(\(|\)|\ |\-)/g, ""));
});

$(".mascTelefone").on("blur", function () {
    $(this).val($(this).val().replace(/[^\d]/g, ""));
    $(this).val($(this).val().replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3"));
});

$(".mascCEP").on("blur", function () {
    let cep = $(this).val().replace(/\D/g, '');
    let validacep = /^[0-9]{8}$/;

    if (cep == "") return;
    if (!validacep.test(cep)) {
        $(this).get(0).setCustomValidity("Formato de CEP inválido");
        $(this).css("border", "1px solid red");
    } else {
        $(this).get(0).setCustomValidity("");
        $(this).css("border", "1px solid var(--color-input-background)");
    }

    let btn = $(this);

    $("#rua").val("...");
    $("#bairro").val("...");
    $("#cidade").val("...");

    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
        if (!("erro" in dados)) {
            if (dados.logradouro) {
                $("#rua").val(dados.logradouro);
            } else {
                $("#rua").attr('readonly', false);
            }

            if (dados.bairro) {
                $("#bairro").val(dados.bairro);
            } else {
                $("#bairro").attr('readonly', false);
            }
            $("#cidade").val(dados.localidade);
            $("#uf").val(dados.uf);

            btn.get(0).setCustomValidity("");
            btn.css("border", "1px solid black");
        } else {
            btn.get(0).setCustomValidity("CEP não encontrado");
            btn.css("border", "1px solid red");
        }
    });
});
