function initMap() {
   var styledMapType = new google.maps.StyledMapType([
    {
     "featureType": "all",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "simplified"
      }
     ]
    },
    {
     "featureType": "administrative",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "on"
      }
     ]
    },
    {
     "featureType": "administrative",
     "elementType": "labels.text.fill",
     "stylers": [
      {
       "color": "#e94397"
      }
     ]
    },
    {
     "featureType": "administrative.country",
     "elementType": "geometry.stroke",
     "stylers": [
      {
       "weight": "1.2"
      }
     ]
    },
    {
     "featureType": "administrative.province",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "on"
      }
     ]
    },
    {
     "featureType": "administrative.province",
     "elementType": "geometry.stroke",
     "stylers": [
      {
       "weight": "1"
      },
      {
       "visibility": "off"
      }
     ]
    },
    {
     "featureType": "administrative.neighborhood",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "off"
      }
     ]
    },
    {
     "featureType": "landscape",
     "elementType": "all",
     "stylers": [
      {
       "color": "#f2f2f2"
      }
     ]
    },
    {
     "featureType": "poi",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "off"
      }
     ]
    },
    {
     "featureType": "poi.business",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "off"
      }
     ]
    },
    {
     "featureType": "poi.park",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "on"
      }
     ]
    },
    {
     "featureType": "road",
     "elementType": "all",
     "stylers": [
      {
       "saturation": -100
      },
      {
       "lightness": 45
      },
      {
       "visibility": "on"
      }
     ]
    },
    {
     "featureType": "road.highway",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "simplified"
      }
     ]
    },
    {
     "featureType": "road.arterial",
     "elementType": "labels.icon",
     "stylers": [
      {
       "visibility": "off"
      }
     ]
    },
    {
     "featureType": "transit",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "off"
      }
     ]
    },
    {
     "featureType": "transit.station",
     "elementType": "all",
     "stylers": [
      {
       "visibility": "on"
      }
     ]
    },
    {
     "featureType": "water",
     "elementType": "all",
     "stylers": [
      {
       "color": "#94caf9"
      }
     ]
    }
   ])

   var patisserieChollet = {lat: 45.985997, lng: 4.718026};
   var patisserieNicolas = {lat: 45.984747, lng: 4.718166};
   var patisserieLaPetiteBoulangerie = {lat: 45.982681, lng: 4.718168};
   var patisserieRoche = {lat: 45.984623, lng: 4.720088};
   var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: patisserieNicolas
   });

   var optionsCercle = {
    map: map,
    center: map.getCenter(),
    radius: 300,
    strokeColor: "pink",
    strokeWeight: 2,
    fillOpacity: .2
   }
   var monCercle = new google.maps.Circle(optionsCercle);

   var image = {
    url: '../images/logo/logomap.svg'
   };
   var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
   };


   var marker = new google.maps.Marker({
    position: patisserieChollet,
    map: map,
    icon: image
   });
   var marker2 = new google.maps.Marker({
    position: patisserieNicolas,
    map: map,
    icon: image
   });
   var marker3 = new google.maps.Marker({
    position: patisserieLaPetiteBoulangerie,
    map: map,
    icon: image
   });
   var marker4 = new google.maps.Marker({
    position: patisserieRoche,
    map: map,
    icon: image
   });
   map.mapTypes.set('styled_map', styledMapType);
   map.setMapTypeId('styled_map');


  }



