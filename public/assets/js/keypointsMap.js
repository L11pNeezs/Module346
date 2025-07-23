const map = new ol.Map({
    target: 'keypoints-map',
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],
    view: new ol.View({
        center: ol.proj.fromLonLat([6.638235092163086, 46.51926803588867]), // lausanne
        zoom: 16
    })
});

const vectorSource = new ol.source.Vector(); // garde les points (temporairement)
const vectorLayer = new ol.layer.Vector({
    source: vectorSource
});

const liipOffice = new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.fromLonLat([6.638235092163086, 46.51926803588867]))
});
liipOffice.setStyle(new ol.style.Style({
    image: new ol.style.Circle({
        radius: 10,
        fill: new ol.style.Fill({ color: 'green' }),
        stroke: new ol.style.Stroke({ color: 'black', width: 3 })
    })
}));
vectorSource.addFeature(liipOffice);

const raw = document.querySelector('#keypoints-map').dataset.restaurants;
const restaurant = JSON.parse(raw);
const coordinates = [restaurant.lon, restaurant.lat];

const point = new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.fromLonLat(coordinates))
});
point.setStyle(new ol.style.Style({
    image: new ol.style.Circle({
        radius: 8,
        fill: new ol.style.Fill({ color: 'red' }),
        stroke: new ol.style.Stroke({ color: 'black', width: 2 })
    })
}));
vectorSource.addFeature(point);

map.addLayer(vectorLayer);
