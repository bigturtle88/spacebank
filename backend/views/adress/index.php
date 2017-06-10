<?php
use nevermnd\places\PlacesAutocomplete;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Adress');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adress-form">
	<h1><?= Html::encode($this->title) ?></h1>
        

    <input id="autocomplete" placeholder="Введите ваш адрес" onFocus="geolocate()" type="text" style="width:600px;"></input>

    <table id="address">
      <tr celpadding="5">
        <td>Адрес</td>
        <td class="slimField" style="padding:5px;"><input class="field" id="route" disabled="true" style="width:300px;"></input></td>
        <td class="wideField"><input class="field" id="street_number" disabled="true" style="width:50px;"></input></td>
      </tr>
      <tr>
        <td>Город</td>
        <td class="wideField" colspan="2" style="padding:5px;"><input class="field" id="locality" disabled="true" style="width:300px;"></input></td>
      </tr>
      <tr>
        <td>Область</td>
        <td class="slimField" colspan="2" style="padding:5px;"><input class="field" id="administrative_area_level_1" disabled="true" style="width:300px;"></input></td>
      </tr>
      <tr>
        <td>Индекс</td>
        <td class="wideField" colspan="2" style="padding:5px;"><input class="field" id="postal_code" disabled="true" style="width:50px;"></input></td>
      </tr>
      <tr>
        <td>Страна</td>
        <td class="wideField" colspan="2" style="padding:5px;"><input class="field" id="country" disabled="true" style="width:300px;"></input></td>
      </tr>
    </table>
    <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFIxYnQ9pDT7SmO2et6-_JCZ71O04HbuA&signed_in=true&libraries=places&callback=initAutocomplete&language=ru"
        async defer></script>

        <b>Google Maps JavaScript API</b>
        <br><br>
        STANDARD plane:<br>
        Free up to 25,000 map loads per day.<br>
        $0.50 USD / 1,000 additional map loads, up to 100,000 daily, if billing is enabled.
        <br><br>
        PREMIUM plane:<br> <a href="https://developers.google.com/maps/premium/usage-limits?hl=ru">see here</a>
</div>
