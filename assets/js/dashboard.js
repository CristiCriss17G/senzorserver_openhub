"use strict";

// add apikey to form
const apikey =
  "288dd638918871ab52fc06ff285ad968aa97dbde27b96cb2f08241e8b5b877f5";
const apiInput = document.querySelector("#apikey");
apiInput.value = apikey;

// prefill gps coordinates
const gpsLat = document.getElementById("GPS_lat");
const gpsLon = document.getElementById("GPS_lon");

// get gps coordinates
const getLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition((position) => {
      gpsLat.value = position.coords.latitude;
      gpsLon.value = position.coords.longitude;
    });
  } else {
    gpsLat.value = "Geolocation is not supported by this browser.";
  }
};
document.addEventListener("DOMContentLoaded", getLocation);

// toggle names button
const toggleNames = document.getElementById("toggle-names");
toggleNames.addEventListener("click", () => {
  document.getElementById("data-entries").classList.toggle("no-name");
  if (toggleNames.innerHTML === "Hide Names") {
    toggleNames.innerHTML = "Show Names";
  } else {
    toggleNames.innerHTML = "Hide Names";
  }
});

// toggle map button
const toggleMap = document.getElementById("toggle-map");
if (toggleMap) {
  toggleMap.addEventListener("click", () => {
    document.querySelectorAll(".map-el").forEach((el) => {
      el.classList.toggle("no-map");
    });

    if (toggleMap.innerHTML === "Hide Names") {
      toggleMap.innerHTML = "Show Map";
    } else {
      toggleMap.innerHTML = "Hide Map";
    }
  });
}

// empty database button
const emptyDatabase = document.getElementById("empty-database");
emptyDatabase.addEventListener("click", () => {
  const confirm = window.confirm(
    "Are you sure you want to empty the database?"
  );
  if (confirm) {
    fetch("./empty-database.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ apikey }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          window.location.reload();
        } else {
          alert("Error: " + data.error);
        }
      });
  }
});

let sensorsLastRecording = {};

// get content from show_update.php every 10 seconds and put it in the table with the id data-entries without jquery
const tableBody = document
  .getElementById("data-entries")
  .getElementsByTagName("tbody")[0];
// curent date in seconds
const now = Math.floor(Date.now() / 1000);
let lastUpdate = 0;
const refreshAndGetData = () => {
  fetch("./show_update.php") // receive data as json
    .then((res) => res.json())
    .then((data) => {
      // if data is newer than last update
      if (data[0].reg_ID > lastUpdate) {
        // clear table
        tableBody.innerHTML = "";
        // loop through data
        data.forEach((entry) => {
          // create new row
          const row = document.createElement("tr");
          // create new cells
          const reg_ID = document.createElement("th");
          const sensor_name = document.createElement("td");
          const date_time = document.createElement("td");
          const temperature_c = document.createElement("td");
          const humidity = document.createElement("td");
          const pm2_5 = document.createElement("td");
          const pm10 = document.createElement("td");
          const GPS_lat = document.createElement("td");
          const GPS_lon = document.createElement("td");
          const GPS_vit = document.createElement("td");

          // add data to cells
          reg_ID.innerHTML = entry.reg_ID;
          sensor_name.innerHTML = entry.sensor_name;
          date_time.innerHTML = entry.date_time;
          temperature_c.innerHTML = entry.temperature_c ?? "";
          humidity.innerHTML = entry.humidity ?? "";
          pm2_5.innerHTML = entry.pm2_5 ?? "";
          pm10.innerHTML = entry.pm10 ?? "";
          GPS_lat.innerHTML = entry.GPS_lat ?? "";
          GPS_lon.innerHTML = entry.GPS_lon ?? "";
          GPS_vit.innerHTML = entry.GPS_vit ?? "";

          // add cells to row
          row.appendChild(reg_ID);
          row.appendChild(sensor_name);
          row.appendChild(date_time);
          row.appendChild(temperature_c);
          row.appendChild(humidity);
          row.appendChild(pm2_5);
          row.appendChild(pm10);
          row.appendChild(GPS_lat);
          row.appendChild(GPS_lon);
          row.appendChild(GPS_vit);
          // add row to table
          tableBody.appendChild(row);
        });

        // store just the latest data for every sensor, considering that the data is sorted from newest to oldest
        // check if the data has location, if not, take it from the newest data that has location
        sensorsLastRecording = {};
        data.forEach((entry) => {
          if (!sensorsLastRecording[entry.ID]) {
            sensorsLastRecording[entry.ID] = entry;
          }
          if (
            (!sensorsLastRecording[entry.ID].GPS_lat ||
              !sensorsLastRecording[entry.ID].GPS_lon) &&
            entry.GPS_lat &&
            entry.GPS_lon
          ) {
            sensorsLastRecording[entry.ID].GPS_lat = entry.GPS_lat;
            sensorsLastRecording[entry.ID].GPS_lon = entry.GPS_lon;
            sensorsLastRecording[entry.ID].GPS_vit = entry.GPS_vit;
          }
        });

        // send data to map and generate markers
        window.updateMarkers(sensorsLastRecording);

        lastUpdate = data[0].reg_ID;
        clearInterval(refreshInterval);
        // console.log(
        //   `fast update since ${Math.floor(Date.now() / 1000) - now} seconds`
        // );
        refreshInterval = setInterval(refreshAndGetData, 2000);
      } else {
        clearInterval(refreshInterval);
        // console.log(
        //   `slow update since ${Math.floor(Date.now() / 1000) - now} seconds`
        // );
        refreshInterval = setInterval(refreshAndGetData, 10000);
      }
    });
};

let refreshInterval;

document.addEventListener("DOMContentLoaded", () => {
  refreshAndGetData();
  refreshInterval = setInterval(refreshAndGetData, 10000);
});
