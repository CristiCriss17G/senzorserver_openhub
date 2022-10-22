// add apikey to form
const apikey =
  "3bbec1ff4d460ba783e4861ce6e0993d2a9fec762f59cebd437a49b9a7fbc3d5";
const apiInput = document.querySelector("#apikey");
apiInput.value = apikey;

// prefill gps coordinates
const gpsLat = document.getElementById("GPS_lat");
const gpsLon = document.getElementById("GPS_lon");

// get gps coordinates
const getLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
      gpsLat.value = position.coords.latitude;
      gpsLon.value = position.coords.longitude;
    });
  } else {
    gpsLat.value = "Geolocation is not supported by this browser.";
  }
}
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

// get content from show_update.php every 10 seconds and put it in the table with the id data-entries without jquery
const tableBody = document
  .getElementById("data-entries")
  .getElementsByTagName("tbody")[0];
// curent date in seconds
const now = Math.floor(Date.now() / 1000);
const refreshAndGetData = () => {
  fetch("./show_update.php")
    .then((response) => response.text())
    .then((data) => {
      if (tableBody.innerHTML !== data) {
        tableBody.innerHTML = data;
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
refreshAndGetData();
let refreshInterval = setInterval(refreshAndGetData, 10000);
