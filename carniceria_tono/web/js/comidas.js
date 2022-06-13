
e
function hidden() {
    $(".cont-hidden").addClass('d-none');
}
 
function cargaListaComidas() {

    $.get("https://www.themealdb.com/api/json/v1/1/categories.php", function(data) {
       
        $.each(data.categories, function(i, item) { 

            if (item.idCategory < 13) {
                
                
                $("#pool-img").append("<div class='col-lg-4'>" +
                    "<h5>" + item.strCategory + "</h5>" +
                    "<img class='img-fluid' onclick=detalles(" + item.idCategory + ") src='" + item.strCategoryThumb + "' />" +
                    "</div>");
                
                $("#data_description").append("<div class='row cont-hidden' id='data-" + item.idCategory + "' ><div class='col-lg-4'>" +
                    "<h5>" + item.strCategory + "</h5>" +
                    "<img class='img-fluid'  src='" + item.strCategoryThumb + "' />" +
                    "</div>" +
                    "<div class='col-lg-6'>" + item.strCategoryDescription + "</div><br>" +
                    "<button class='btn btn-danger' onclick='volver()'>Volver</button><br><br><br>" +
                    "</div>"
                );
            }
            hidden();
        });

    });
}


function detalles(id) {

    $("#pool-img").slideUp("slow");
    $("#data-" + id).fadeIn("slow");
    $("#data-" + id).removeClass("d-none");
}

 
function volver() {
    
    $("#pool-img").slideDown("slow");
    hidden();
}