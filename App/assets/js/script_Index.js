document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('load', function(){
        //##################################################################################################
        //PETICION PARA TRAER LOS INMUEBLES
        //##################################################################################################
        $.ajax({
            url: "App/Modules/Inmueble/inmueble_Negocios.php",
            type: "POST",
           
            success: function(response) 
            {

                const portfolioContainer = document.getElementById('portfolioContainer');

                var respuestaJSON = JSON.parse(response);


                respuestaJSON.forEach(function(item) {
                    // var portfolioItem = document.createElement("div");
                    // portfolioItem.className = "col-lg-4 col-md-6 portfolio-item filter-app";

                    // // Contenido del div
                    // portfolioItem.innerHTML = `
                    // <div class="portfolio-img"><img src="./App/assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt=""></div>
                    // <div class="portfolio-info">
                    //     <h4>App 1</h4>
                    //     <p>App</p>
                    //     <a href="./App/assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
                    //     <a href="./App/Views/InmuebleDetalle_View.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                    // </div>
                    // `;
                    //portfolioContainer.appendChild(portfolioItem);
                });


            },
            error: function(textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });


        function obtenerImagenesInmuebles(idInmueble) { 
            $.ajax({
                url: "App/Modules/Inmueble/imagenesInmueble_Negocios.php",
                type: "POST",
                data: {
                    idInmueble: idInmueble,
                },
                success: function(response) {
                    var x = JSON.parse(response);

                }
            });


         }

    });//FIN LOAD 
});