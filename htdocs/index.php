<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rondetijden</title>
    <!-- <link rel="stylesheet" href="rondetijden.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <form id="distance">
      <div class="container">
        <div class="row">
          <div class="col">
            <label for="width">Width</label><input type="text" name="width" id="width"><br/>
            <label for="height">Height</label><input type="text" name="height" id="height"><br/>
            <label for="skipFirstSplit">&gt; 400m</label><input type="checkbox" name="skipFirstSplit" id="skipFirstSplit"><br/>
          </div>
          <div class="col">
            <input type="radio" name="distance" id="m500" value="Mannen 500m" disabled><label for="m500">Mannen 500m</label><br/>
            <input type="radio" name="distance" id="m1000" value="Mannen 1000m" disabled><label for="m1000">Mannen 1000m</label><br/>
            <input type="radio" name="distance" id="m1500" value="Mannen 1500m"><label for="m1500">Mannen 1500m</label><br/>
            <input type="radio" name="distance" id="m5000" value="Mannen 5km" disabled><label for="m5000">Mannen 5km</label><br/>
            <input type="radio" name="distance" id="m10000" value="Mannen 10km" checked><label for="m10000">Mannen 10km</label><br/>
          </div>
          <div class="col">
            <input type="radio" name="distance" id="v500" value="Vrouwen 500m" disabled><label for="v500">Vrouwen 500m</label><br/>
            <input type="radio" name="distance" id="v1000" value="Vrouwen 1000m" disabled><label for="v1000">Vrouwen 1000m</label><br/>
            <input type="radio" name="distance" id="v1500" value="Vrouwen 1500m" disabled><label for="v1500">Vrouwen 1500m</label><br/>
            <input type="radio" name="distance" id="v3000" value="Vrouwen 3km" disabled><label for="v3000">Vrouwen 3km</label><br/>
            <input type="radio" name="distance" id="v5000" value="Vrouwen 5km" disabled><label for="v5000">Vrouwen 5km</label><br/>
          </div>
        </div>
      </div>
    </form>

    <div id="graph"></div>
    <div id="contestants"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script> -->

    <!-- <script type="text/javascript" src="http://www.google.com/jsapi"></script> -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="rondetijden.js"></script>
  </body>
</html>

