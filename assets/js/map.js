// Galati location
const galati = { lat: 45.4377134, lng: 28.0124756 };
// map variable to be populated with the map
let map;

/**
 * Function to initialize and add the map in Galati, Romania
 */
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 12,
    center: galati,
  });
}

// object to store current markers
let markers = {};

/**
 * Function to add a marker to the map
 * @param {Object} location - The location of the marker
 * @param {String} title - The title of the marker
 * @param {String} content - The content of the marker
 * @param {String|number} key - The key of the marker
 */
function addMarker(location, title, content, key) {
  if (location !== null) {
    markers[key] = {};
    markers[key]["marker"] = new google.maps.Marker({
      position: location,
      map,
      title,
    });

    markers[key]["infoWindow"] = new google.maps.InfoWindow({
      content,
    });

    markers[key]["marker"].addListener("click", () => {
      markers[key]["infoWindow"].open(map, markers[key]["marker"]);
    });
  } else {
    markers[key] = {};
    markers[key]["marker"] = new google.maps.Marker({
      position: galati,
      map,
      title,
    });

    markers[key]["infoWindow"] = new google.maps.InfoWindow({
      content,
    });

    markers[key]["marker"].addListener("click", () => {
      markers[key]["infoWindow"].open(map, markers[key]["marker"]);
    });
  }
}

/**
 * Function to update a marker on the map
 * @param {String|number} key - The key of the marker
 * @param {Object} location - The location of the marker
 * @param {String} content - The content of the marker
 */
function updateMarker(key, location, content) {
  // if location is not null, update the marker
  if (location !== null) {
    markers[key]["marker"].setPosition(location);
  }

  // update the content if it is changed
  if (markers[key]["infoWindow"].getContent() !== content) {
    markers[key]["infoWindow"].setContent(content);
  }
}

/**
 * Function to receive data from the update function and add markers to the map
 * @param {Object} data - The data received from the update function
 */
function updateMarkers(data) {
  for (const key in data) {
    const entry = data[key];
    // check if the entry has a GPS location
    let location;
    if (entry.GPS_lat && entry.GPS_lon) {
      location = {
        lat: parseFloat(entry.GPS_lat),
        lng: parseFloat(entry.GPS_lon),
      };
    } else {
      location = null;
    }
    const title = entry.sensor_name;
    const content = `
            <div>
                <h3>${entry.sensor_name}</h3>
                <p>Temperature: ${entry.temperature_c} °C</p>
                <p>Humidity: ${entry.humidity} %</p>
                <p>PM2.5: ${entry.pm2_5} μg/m3</p>
                <p>PM10: ${entry.pm10} μg/m3</p>
            </div>
        `;

    // check if the marker exists
    if (markers[key]) {
      updateMarker(key, location, content);
    } else {
      addMarker(location, title, content, key);
    }
  }
}

window.updateMarkers = updateMarkers;
window.initMap = initMap;
