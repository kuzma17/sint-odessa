// Google Map

let map;
let markers = [];
let bounds;

export function initMapModule() {

    const mapBlock = document.getElementById("mapdiv");
    if (!mapBlock) return;

    loadGoogleMaps().then(() => {
        initMap();
    });
}

/* загрузка API */

function loadGoogleMaps() {
    return new Promise((resolve) => {

        if (window.google && window.google.maps) {
            resolve();
            return;
        }

        const script = document.createElement("script");

        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCBVVcWv1BhicBJlD8xidprjt39Z_ZO2pU";
        script.async = true;

        script.onload = () => {
            resolve();
        };

        document.head.appendChild(script);
    });
}

function initMap() {
    map = new google.maps.Map(document.getElementById("mapdiv"), {
        center: { lat: 46.48, lng: 30.73 },
        zoom: 11
    });

    bounds = new google.maps.LatLngBounds();

    // add offices
    document.querySelectorAll(".btn-office").forEach(card => {
        const lat = parseFloat(card.dataset.lat);
        const lng = parseFloat(card.dataset.lng);
        const title = card.querySelector("h5")?.innerText || '';

        addMarker(lat, lng, title);
    });

    map.fitBounds(bounds);
}

function addMarker(lat, lng, title) {
    const position = { lat: lat, lng: lng };

    const marker = new google.maps.Marker({
        position: position,
        map: map,
        title: title,
        icon: {
            url: '/images/marker.svg',
            scaledSize: new google.maps.Size(40, 40)
        }
    });

    const infowindow = new google.maps.InfoWindow({
        content: `<strong>${title}</strong>`
    });

    marker.addListener('mouseover', () => infowindow.open(map, marker));
    marker.addListener('mouseout', () => infowindow.close());

    marker.addListener('click', () => focusOffice(lat, lng));

    markers.push(marker);
    bounds.extend(position);
}

function focusOffice(lat, lng) {

    // перемещаем карту
    map.panTo({ lat: lat, lng: lng });
    map.setZoom(15);

    // прокрутка страницы к карте
    const mapBlock = document.getElementById("mapdiv");
    mapBlock.scrollIntoView({
        behavior: "smooth",
        block: "center"
    });

    // подсветка карточки
    document.querySelectorAll(".btn-office").forEach(card => {
        card.classList.remove("active");

        if (
            parseFloat(card.dataset.lat) === lat &&
            parseFloat(card.dataset.lng) === lng
        ) {
            card.classList.add("active");
        }
    });
}

// Клик на карточку → карта фокус
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".btn-office").forEach(card => {
        card.addEventListener("click", function () {
            const lat = parseFloat(this.dataset.lat);
            const lng = parseFloat(this.dataset.lng);
            focusOffice(lat, lng);
        });
    });
});

initMapModule();
