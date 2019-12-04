function calculateRoute(from, to) {
  // Iniciar o mapa, a posição inicial é do Centro de Barueri.
  var myOptions = {
      zoom: 21,
      center: new google.maps.LatLng(-23.5114, -46.8729),
      mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  // Criar o mapa
  var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);

  var directionsService = new google.maps.DirectionsService();

  var directionsRequest = {
      origin: from,
      destination: to,
      travelMode: google.maps.DirectionsTravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC
  };

  directionsService.route(
    directionsRequest,
    function(response, status){
      if (status == google.maps.DirectionsStatus.OK){
        new google.maps.DirectionsRenderer({
            map: mapObject,
            directions: response
        });
      }
      else
        $("#info").append("Impossível de traçar a rota<br/>");
    }
  );
}

$(document).ready(function() {
  // Verificar se o navegador suporta geolocalização
  if (typeof navigator.geolocation == "undefined") {
    $("#info").text("Seu navegador não suporta geolocalização");
    return;
}

/*
const getCurrentPosition = ({ onSuccess, onError = () => { } }) => {
if ('geolocation' in navigator === false) {
  return onError(new Error('Seu navegador não suporta geolocalização.'));
  }
  return navigator.geolocation.getCurrentPosition(onSuccess, onError);
}

// Mensagens de erro.
const getPositionErrorMessage = code => {
  switch (code) {
    case 1:
      return 'Seu feioso. :(';
    case 2:
      return 'Posição indisponível. :(';
    case 3:
      return 'Sem tempo, irmão.';
    default:
      return null;
  }
}*/

$("#from-link, #to-link").click(function(event) {
  event.preventDefault();

  var addressId = this.id.substring(0, this.id.indexOf("-"));

  navigator.geolocation.getCurrentPosition(function(position) {
    var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
        "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
    },
      
  function(results, status) {
    if (status == google.maps.GeocoderStatus.OK)
      $("#" + addressId).val(results[0].formatted_address);
    else
      $("#info").append("Impossível obter sua localização<br/>");
    });
  },
  
  function(positionError){
    $("#info").append("Erro: " + positionError.message + "<br />");
  },
  {
    enableHighAccuracy: true,
    timeout: 10 * 1000 // 10 seconds
  });
  });

  $("#calculate-route").submit(function(event) {
    event.preventDefault();
    calculateRoute($("#from").val(), $("#to").val());
  });
});
