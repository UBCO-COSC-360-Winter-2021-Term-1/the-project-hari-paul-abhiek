<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okanagan Bike Trails</title>
    <script type="text/javascript" src="src/client/js/main.js"></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./../client/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php include 'header.php';?>

    <div class="container">
        <div class="row align-items-start">


            <div class="col">
                
                <!-- Carousel -->
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" ></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/andhika-soreng-US06QF_sxu8-unsplash.jpg" class="img-responsive d-block w-100"
                                alt="..." style= "max-height: 800px">
                        </div>
                        <div class="carousel-item">
                            <img src="img/sterlinglanier-lanier-4pUVVbpCAD8-unsplash.jpg" class="img-responsive d-block w-100"
                                alt="..." style= "max-height: 800px">
                        </div>
                        <div class="carousel-item">
                            <img src="img/tobias-bjerknes-pu40LpUjv5I-unsplash.jpg" class="img-responsive d-block w-100"
                                alt="..." style= "max-height: 800px">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel"
                        data-bs-slide="prev">
                        <span class="visually-hidden">Previous</span>
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel"
                        data-bs-slide="next">
                        <span class="visually-hidden">Next</span>
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>

                    </button>
                </div>
            </div>
        </div>
    </div>



    <div class="row my-custom-row justify-content-center align-items-center">
        <div class="col-sm-4">
            <div class="p-3 border bg-light">
                <div id='map'></div>
                <script>
                    mapboxgl.accessToken = 'pk.eyJ1IjoiZHVkZWltcG9zc2libGU0MiIsImEiOiJja3Zpc2djOHVjbm1rMzBtYXl3dHoydzhxIn0.ezKpjS_pvpMhCRox399k6g';
                    const map = new mapboxgl.Map({
                        container: 'map', // container ID
                        style: 'mapbox://styles/mapbox/outdoors-v11', // style URL
                        center: [-96, 50], // starting position [lng, lat]
                        zoom: 3 // starting zoom
                    });
                    map.addControl(
                        new mapboxgl.GeolocateControl({
                            positionOptions: {
                                enableHighAccuracy: true
                            },
                            // When active the map will receive updates to the device's location as it changes.
                            trackUserLocation: true,
                            // Draw an arrow next to the location dot to indicate which direction the device is heading.
                            showUserHeading: true
                        })
                    );
                </script>

            </div>
        </div>
        
    </div>

    <?php include 'footer.php';?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>