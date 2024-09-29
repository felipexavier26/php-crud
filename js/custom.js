function searchUser() {
    var query = $("#searchInput").val();
    if (query === "") {
        alert("Por favor, digite algo para buscar."); 
        return; 
    }

    $.ajax({
        url: 'resultuser.php',
        type: 'GET',
        data: {
            search: query
        },
        success: function(response) {
            $("#resultContainer").html(response);
            $("#myModal").show();
        },
        error: function() {
            alert("Erro ao buscar usuários.");
        }
    });
}

$(document).ready(function() {
    $(".close").click(function() {
        $("#myModal").hide();
    });

    $(window).click(function(event) {
        if (event.target.id == "myModal") {
            $("#myModal").hide();
        }
    });
});