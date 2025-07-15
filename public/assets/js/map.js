const map = new ol.Map({
    target: 'map',
    layers: [
        new ol.layer.Tile({
            source: new ol.source.XYZ({
                url: 'https://wmts.geo.admin.ch/1.0.0/ch.swisstopo.pixelkarte-farbe/default/current/3857/{z}/{x}/{y}.jpeg',
                attributions: '© Swisstopo'
            })
        })
    ],
    view: new ol.View({
        center: ol.proj.fromLonLat([6.638235092163086, 46.51926803588867]), // lausanne
        zoom: 16
    })
});

const raw = document.querySelector('#map').dataset.restaurants;
const restaurants = JSON.parse(raw);
const allCoordinates = [];

restaurants.forEach((restaurant) => {
    allCoordinates.push(ol.proj.fromLonLat([
        restaurant.coords.lon,
        restaurant.coords.lat
    ]))
});

const vectorSource = new ol.source.Vector(); // garde les points (temporairement)
const vectorLayer = new ol.layer.Vector({
    source: vectorSource
});

// Liip Office
const point = new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.fromLonLat([6.638235092163086, 46.51926803588867]))
});

point.setStyle(new ol.style.Style({
    image: new ol.style.Circle({
        radius: 10,
        fill: new ol.style.Fill({ color: 'green' }),
        stroke: new ol.style.Stroke({ color: 'white', width: 3 })
    })
}));
vectorSource.addFeature(point);

allCoordinates.forEach((coordinates) => {
    const point = new ol.Feature({
        geometry: new ol.geom.Point(coordinates)
    });

    point.setStyle(new ol.style.Style({
        image: new ol.style.Circle({
            radius: 8,
            fill: new ol.style.Fill({ color: 'blue' }),
            stroke: new ol.style.Stroke({ color: 'white', width: 2 })
        })
    }));
    vectorSource.addFeature(point);
});
map.addLayer(vectorLayer);
