$(document).ready(() => {
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
    });

    var map;
    var marker;
    var circle;

    if ($('#geolocation_bussiness').val() != null || $('#geolocation_bussiness').val() != "") {
        var latlngArr = JSON.parse($('#geolocation_bussiness').val());

        map = L.map('map', {
            center: [latlngArr.lat, latlngArr.lng],
            zoom: 18
        });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        var lc = L.control.locate({
            locateOptions: {
                enableHighAccuracy: true
            },
            strings: {
                title: "Klik untuk melihat lokasi anda saat ini!"
            },
            icon: "fa-solid fa-location"
        }).addTo(map);

        var radius = 25;
        marker = new L.Marker(latlngArr, {
            draggable: true
        }).on('dragend', onDragEnd);
        circle = new L.circle(latlngArr, radius);
        map.addLayer(marker);
        map.addLayer(circle);

        $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latlngArr.lat}&lon=${latlngArr.lng}`,
            function (data) {
                marker.bindPopup(`${data.display_name}`).openPopup();
                $('#pic_address').val(data.display_name);
                $('#geolocation_bussiness').val(JSON.stringify(e.latlng));
            });
    } else {
        map = L.map('map');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        var lc = L.control.locate({
            locateOptions: {
                enableHighAccuracy: true
            },
            strings: {
                title: "Klik untuk melihat lokasi anda saat ini!"
            },
            icon: "fa-solid fa-location"
        }).addTo(map);
        lc.start();
    }

    map.on('locationfound', onLocationFound);
    map.on('click', onClick);

    var idxOnLoc = 0;

    function onLocationFound(e) {
        idxOnLoc += 1;
        if (marker || idxOnLoc > 1) {
            map.removeLayer(marker);
            map.removeLayer(circle);
        } else if (marker && idxOnLoc > 1) {
            map.removeLayer(marker);
            map.removeLayer(circle);
            lc.stopFollowing();
        }
        var radius = e.accuracy;
        marker = new L.marker(e.latlng, {
            draggable: true
        }).on('dragend', onDragEnd);
        circle = new L.circle(e.latlng, radius);
        map.addLayer(marker);
        map.addLayer(circle);

        // Ajax to search address by lat and lang
        var latitude = e.latlng.lat;
        var langitude = e.latlng.lng;
        $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${langitude}`,
            function (data) {
                marker.bindPopup(`${data.display_name}`).openPopup();
                $('#pic_address').val(data.display_name);
                $('#geolocation_bussiness').val(JSON.stringify(e.latlng));
            });

        map.locate({
            setView: true,
            watch: true
        });
    }

    function onClick(e) {
        if (marker) {
            map.removeLayer(marker);
            map.removeLayer(circle);
            if (lc._active) {
                lc.stopFollowing();
                lc.stop();
            }
        }
        var radius = 25;
        marker = new L.Marker(e.latlng, {
            draggable: true
        }).on('dragend', onDragEnd);
        circle = new L.circle(e.latlng, radius);
        map.addLayer(marker);
        map.addLayer(circle);

        // Ajax to search address by lat and lang
        var latitude = e.latlng.lat;
        var langitude = e.latlng.lng;
        $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${langitude}`,
            function (data) {
                marker.bindPopup(`${data.display_name}`).openPopup();
                $('#pic_address').val(data.display_name);
                $('#geolocation_bussiness').val(JSON.stringify(e.latlng));
            });
    }

    var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false
    })
        .on('markgeocode', function (e) {
            if (marker) {
                map.removeLayer(marker);
                map.removeLayer(circle);
                if (lc._active) {
                    lc.stopFollowing();
                    lc.stop();
                }
            }

            var radius = 25;
            var latLang = e.geocode.center;

            marker = new L.marker(latLang, {
                draggable: true
            }).on('dragend', onDragEnd);
            circle = new L.circle(latLang, radius);
            map.addLayer(marker);
            map.addLayer(circle);
            // Ajax to search address by lat and lang
            var latitude = latLang.lat;
            var langitude = latLang.lng;
            $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${langitude}`,
                function (data) {
                    marker.bindPopup(`${data.display_name}`).openPopup();
                    $('#pic_address').val(data.display_name);
                    $('#geolocation_bussiness').val(JSON.stringify(latLang));
                });
        })
        .addTo(map);

    function onDragEnd(e) {
        if (marker) {
            map.removeLayer(marker);
            map.removeLayer(circle);
            if (lc._active) {
                lc.stopFollowing();
                lc.stop();
            }
        }

        var latlng = e.target.getLatLng();
        var radius = 25;
        marker = new L.Marker(latlng, {
            draggable: true
        }).on('dragend', onDragEnd);
        circle = new L.circle(latlng, radius);
        map.addLayer(marker);
        map.addLayer(circle);

        // Ajax to search address by lat and lang
        var latitude = latlng.lat;
        var langitude = latlng.lng;
        $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${langitude}`,
            function (data) {
                marker.bindPopup(`${data.display_name}`).openPopup();
                $('#pic_address').val(data.display_name);
                $('#geolocation_bussiness').val(JSON.stringify(latlng));
            });
    }
});
