mapboxgl.accessToken = 'pk.eyJ1IjoiaGFyaWNhbmUiLCJhIjoiY2x5NGlqODRvMDJ3NDJqcTNoaWc0cWJxaCJ9.HVFoICBbwGVSUy59cytw0Q';

// Create Map
const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [96.15611, 16.80528],  // initial center [lng, lat]
    zoom: 11
});
map.addControl(new mapboxgl.NavigationControl(), 'bottom-right');

// fetch data for busStop info
let busStopsInfo = [];
fetch('FetchBusStopsInfo.php')
    .then(res => res.json())
    .then(data => {
        data.forEach(busStops => {
            busStopsInfo.push(busStops)
        })
    })
// fetch data for busStop info

let currentLocation = null;

navigator.geolocation.getCurrentPosition(successLocation);

function successLocation(position) {
    // displayMap([position.coords.longitude, position.coords.latitude]);
    // displayMap([96.17426998948122, 16.781064836272378]);
    // displayMap([96.13546698963569,16.855756616394558]);
    displayMap([96.13634634476136, 16.807713036195594]);

}

function displayMap(position) {
    currentLocation = position;
    getLocationName(currentLocation)

    // const geolocateControl = new mapboxgl.GeolocateControl({
    //     positionOptions: {
    //         enableHighAccuracy: true
    //     },
    //     trackUserLocation: false,
    //     showUserHeading: false
    // });


    // map.addControl(geolocateControl);



    //  --------------------- Map onload (currentlocation) ---------------------   // Start


    map.on('load', () => {

        // geolocateControl.trigger();

        // geolocateControl.on('geolocate', function () {
        //     map.flyTo({
        //         center: currentLocation,
        //         zoom: 14.5,
        //         essential: true // Smooth animation
        //     });
        // })

        const markerElement = document.createElement('div');
        markerElement.className = 'geolocate-marker'; // Apply the custom CSS class

        // Create and add the marker to the map
        const marker = new mapboxgl.Marker(markerElement)
            .setLngLat(currentLocation)
            .addTo(map);
        map.flyTo({
            center: currentLocation,
            zoom: 14.5,
            essential: true // Smooth animation
        });

        document.querySelector('.current_location').onclick = () => {
            map.flyTo({
                center: currentLocation,
                zoom: 14.5,
                essential: true // Smooth animation
            });
            add_BusStop_Marker(busStopsInfo, currentLocation);
            bufferCircle(map, currentLocation, 700);
            removeRoute(map, "routeId2")
        }
        bufferCircle(map, currentLocation, 700);

        // For bus-Stop location within the range of Current location (start)
        var customLocations = [];
        var busStop_markers = [];

        busStopsInfo.map(busStop => {
            customLocations.push({
                "type": "Feature",
                "place_name": busStop.name_en,
                "geometry": {
                    "type": "Point",
                    "coordinates": [busStop.longitude, busStop.latitude]
                }
            })
        });
        add_BusStop_Marker(busStopsInfo, currentLocation);


        function createMarker(busStop) {
            // to add icon
            const busStop_icon = document.createElement('div');
            busStop_icon.id = 'busStop_marker';

            const marker = new mapboxgl.Marker(busStop_icon)
                .setLngLat([busStop.longitude, busStop.latitude])
                .addTo(map);

            return marker;
        }

        // add busStop markers within the range (start)
        function add_BusStop_Marker(busStops, location) {
            let bus__stops_lists = document.querySelector('.track-bus__stops-lists');

            busStop_markers.forEach(m => m.remove()) // -- to clear the stored markers
            busStops.map(busStop => {

                if (filter_BusStop(busStop, location)) {

                    const marker = createMarker(busStop);

                    busStop_markers.push(marker) // -- to stored markers 
                    // fetch(`nearestBusStop.php?name__en=${encodeURIComponent(busStop.name_en)}&name__mn=${encodeURIComponent(busStop.name_mm)}`)
                    //     .then(response =>{
                    //         return response.text();
                    //     })

                    let lists = add_detail_trackbusLine(busStop.name_en, busStop.name_mm, [busStop.longitude, busStop.latitude])
                    bus__stops_lists.appendChild(lists);
                }
            });
        }

        // add busStop markers within the range (end)



        // Focus BusStop by clicking on text (start)
        let busStopRow = document.querySelectorAll('a.bus__stop');
        busStopRow.forEach(b => {
            b.onclick = () => {
                busStop_markers.forEach(m => m.remove()) // -- to clear the stored markers
                let att_lng = Number(b.getAttribute('busStop-lng'));
                let att_lat = Number(b.getAttribute('busStop-lat'));
                let busStop_position = {
                    longitude: att_lng,
                    latitude: att_lat
                };
                const marker = createMarker(busStop_position);

                busStop_markers.push(marker) // -- to stored markers 
                map.flyTo({
                    center: [busStop_position.longitude, busStop_position.latitude],
                    zoom: 16,
                    speed: 2
                })
            }
        })
        document.body.addEventListener('click', (e) => {
            const busStopElement = e.target.closest('.nearest-bus__stop');
            if (busStopElement) {
                // Clear existing markers
                busStop_markers.forEach(marker => marker.remove());
                busStop_markers.length = 0; // Clear the array

                // Get bus stop coordinates
                const lng = Number(busStopElement.querySelector('.lng').textContent);
                const lat = Number(busStopElement.querySelector('.lat').textContent);
                const busStop_position = {
                    longitude: lng,
                    latitude: lat
                };
                if (popup) {
                    popup.remove();
                }
                drawWalkingRoute(map, currentLocation, [busStop_position.longitude, busStop_position.latitude])

                // Create and store the new marker
                const marker = createMarker(busStop_position);
                busStop_markers.push(marker);

                // First, fly to the marker's position
                map.flyTo({
                    center: [busStop_position.longitude, busStop_position.latitude],
                    zoom: 15,
                    speed: 2,
                    essential: true // Ensures the animation completes even if user interacts with the map
                });

                // Calculate the pixel position of the bus stop
                const originalPixelPosition = map.project([busStop_position.longitude, busStop_position.latitude]);

                // Define your offset in pixels (e.g., move to the right by 200 pixels)
                const offsetX = -200; // Pixels to move right
                const offsetY = 0;   // No vertical offset

                const newPixelPosition = [originalPixelPosition.x + offsetX, originalPixelPosition.y + offsetY];

                const newCenter = map.unproject(newPixelPosition);

                map.flyTo({
                    center: newCenter,
                    zoom: 15,
                    speed: 1, // Optional: Adjust speed for the second animation
                    essential: true // Ensures the animation completes even if user interacts with the map
                });
                // Adjust the timeout duration based on the duration of your initial flyTo animation
            }
        });





        const geocoderOptions = {
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker: {
                element: document.createElement('div'),
                anchor: 'bottom', // Adjust the anchor based on the marker's shape
            },

            placeholder: 'Choose starting BusStop',
            bbox: [96.014603, 16.739952, 96.321533, 17.109695], // Set boundary
            proximity: {
                longitude: 96.1951,
                latitude: 16.8661
            },
            localGeocoder: function (query) {
                const queryLower = query.toLowerCase();
                const matchingFeatures = customLocations.filter(feature =>
                    feature.place_name.toLowerCase().includes(queryLower)
                );
                return matchingFeatures;
            },
            filter: function (result) {
                // Ensure only custom data is shown
                return customLocations.find(location =>
                    location.place_name === result.place_name
                );
            }
        };

        // for direction (Draw Route) 
        const startPoint = new MapboxGeocoder({
            ...geocoderOptions,
            placeholder: 'Choose starting BusStop'
        });
        const Start_Marker = startPoint.options.marker.element;
        Start_Marker.id = 'Start_busStop_marker';


        const endPoint = new MapboxGeocoder({
            ...geocoderOptions,
            placeholder: 'Choose destination BusStop'
        });

        const End_Marker = endPoint.options.marker.element;
        End_Marker.id = 'End_busStop_marker';

        // Add geocoders to the page
        document.getElementById('start-point').appendChild(startPoint.onAdd(map));
        document.getElementById('end-point').appendChild(endPoint.onAdd(map));

        let start = null;
        let end = null;

        // Handle the result for the start point
        startPoint.on('result', function (e) {
            start = e.result.geometry.coordinates;
            const LocationName = e.result.place_name;
            fetch('DrawRoute.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ start: LocationName })
            })
                .then(res => res.json())
                .then(data => {
                    data.forEach(busStops => {
                        busLineRoute.push([busStops.longitude, busStops.latitude]);
                        new mapboxgl.Marker()
                            .setLngLat([busStops.longitude, busStops.latitude])
                            .setPopup(new mapboxgl.Popup().setHTML(busStops.name_mm))
                            .addTo(map);
                    });
                })
        });


        // Handle the result for the end point
        endPoint.on('result', function (e) {
            end = e.result.geometry.coordinates;
            const LocationName = e.result.place_name;

            fetch('DrawRoute.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ stop: LocationName })
            })
                .then(res => res.json())
                .then(data => {
                    data.forEach(busStops => {
                        busLineRoute.push([busStops.longitude, busStops.latitude]);
                        new mapboxgl.Marker()
                            .setLngLat([busStops.longitude, busStops.latitude])
                            .setPopup(new mapboxgl.Popup().setHTML(busStops.name_mm))
                            .addTo(map);
                    });
                })
        });



        let chosenBuslineRoute = [];
        let busLineRoute = [];
        let displayBusline = new Set();

        // Handle the search button click
        document.getElementById('search-btn').addEventListener('click', function () {
            let nearest_bus_stops_lists = document.querySelector('.routes-lists');

            while (nearest_bus_stops_lists.firstChild) {
                nearest_bus_stops_lists.removeChild(nearest_bus_stops_lists.firstChild)
              }
            Start_Marker.style.display = "none";
            End_Marker.style.display = "none";
            chosenBuslineRoute.length = 0;
            busLineRoute.length = 0;
            displayBusline.clear();
            removeRoute(map, "routeId")


            // Access the input values directly
            const startInput = document.querySelector('#start-point input');
            const endInput = document.querySelector('#end-point input');

            const start = startInput.value;
            const end = endInput.value;

            // Create a query string
            const queryString = `start=${encodeURIComponent(start)}&end=${encodeURIComponent(end)}`;

            // Send the query to the PHP script
            fetch(`DrawRoute.php?${queryString}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    busStop_markers.forEach(m => m.remove()) // -- to clear the stored markers


                    data.forEach(busStop => {
                        displayBusline.add(busStop.bus_line_id)
                    });

                    displayBusline.forEach(busLine => {
                        let listItem = add_route_List(busLine);
                        nearest_bus_stops_lists.appendChild(listItem);
                    });
                    let chosen_busline_routes_lists = document.querySelector('.chosen_busline-routes-lists');

                    document.body.addEventListener('click', (e) => {
                        if (e.target.closest('.route')) {

                            chosenBuslineRoute.length = 0;
                            busLineRoute.length = 0;
                            removeRoute(map, "routeId2")

                            let route = e.target.closest('.route');
                            let busNo = Number(route.querySelector('#busLine_No').innerHTML);
                            chosenBuslineRoute = data.filter(d => d.bus_line_id == busNo)
                            chosenBuslineRoute.forEach(c => {
                                busLineRoute.push([c.longitude, c.latitude]);
                                const marker = createMarker(c);
                                busStop_markers.push(marker) // -- to stored markers    

                                let lists = add_chosenbus_route(c.name_en,c.name_mm);
                                chosen_busline_routes_lists.appendChild(lists); 
                            })


                            const dataToSend = JSON.stringify(chosenBuslineRoute);


                            // For History 
                            const history_list = document.querySelector('.history-lists');
                            const list = add_history_List(start, end, dataToSend);
                            history_list.appendChild(list);

                            fetch(`http://localhost/Blip%20final%201.4%20(bus%20tracking%20website)/MapboxController/historyStored.php?routes=${encodeURIComponent(dataToSend)}&from=${encodeURIComponent(start)}&to=${encodeURIComponent(end)}`)
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.text(); // Parse the response as text
                                })
                            drawRoute(map, busLineRoute);
                        }

                    })
                    if (chosen_busline_routes_lists.children.length == 0) {
                        document.querySelector('.available').innerHTML = "No available"
                    }

                })
                .catch(error => console.error('Error:', error));
        });

       // -----------------  Draw the saved route ----------------//

        document.body.addEventListener('click', (e) => {

            if (e.target.closest('.save__route')) {
                Start_Marker.style.display = "none";
                End_Marker.style.display = "none";
                chosenBuslineRoute.length = 0;
                busLineRoute.length = 0;
                displayBusline.clear();
                removeRoute(map, "routeId");
                busStop_markers.forEach(m => m.remove()) // -- to clear the stored markers

                const saved_routed = e.target.closest('.save__route');
                let route = saved_routed.querySelector('.route-to-draw').innerHTML;
                route = JSON.parse(route);
                route.forEach(c => {
                    busLineRoute.push([c.longitude, c.latitude]);
                    const marker = createMarker(c);
                    busStop_markers.push(marker) // -- to stored markers
                })
                drawRoute(map, busLineRoute);

            }
        })

        // Helper function to fetch route data for a chunk of waypoints
        function fetchRoute(waypoints) {
            // Convert the waypoints array to a string format for the URL
            const coordinatesString = waypoints.map(coord => `${coord[0]},${coord[1]}`).join(';');

            const url = `https://api.mapbox.com/directions/v5/mapbox/driving/${coordinatesString}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`;

            return fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data.routes || data.routes.length === 0) {
                        console.error('No routes found in the API response.');
                        return [];
                    }
                    return data.routes[0].geometry.coordinates;
                });
        }

        // Function to draw a route on the map using multiple waypoints
        function drawRoute(map, waypoints) {

            if (waypoints.length === 0) {
                console.error('No waypoints provided.');
                return;
            }

            // Split waypoints into chunks of 25
            const chunkSize = 25;
            const waypointChunks = [];
            for (let i = 0; i < waypoints.length; i += chunkSize) {
                waypointChunks.push(waypoints.slice(i, i + chunkSize));
            }

            // Process each chunk separately
            Promise.all(waypointChunks.map(chunk => fetchRoute(chunk)))
                .then(results => {
                    // Combine all route coordinates
                    const allRouteCoordinates = results.flat();
                    const geojson = {
                        type: 'Feature',
                        properties: {},
                        geometry: {
                            type: 'LineString',
                            coordinates: allRouteCoordinates
                        }
                    };


                    // Add or update the route layer on the map
                    if (map.getLayer("routeId2")) {
                        map.getSource("routeId2").setData(geojson);
                    } else {
                        map.addLayer({
                            id: "routeId2",
                            type: 'line',
                            source: {
                                type: 'geojson',
                                data: geojson
                            },
                            layout: {
                                'line-join': 'round',
                                'line-cap': 'round'
                            },
                            'paint': {
                                'line-color': '#e01616',
                                'line-width': 5,
                                'line-opacity': 0.75
                            }
                        });
                    }

                    // Calculate the bounding box of the route
                    const bounds = new mapboxgl.LngLatBounds();
                    allRouteCoordinates.forEach(coord => bounds.extend(coord));

                    // Fit the map to the bounding box with custom padding
                    map.fitBounds(bounds, {
                        padding: { top: 100, bottom: 100, left: 100, right: 100 },
                        duration: 1000 // Duration of the zoom animation in milliseconds
                    });
                })
                .catch(error => console.error('Error fetching routes:', error));
        }

        //  --------------------- Part of geocoder search box and draw route between start and end point ---------------------   // End

        nearestBusStopsBoxCloseBtn.addEventListener('click', () => {
            removeRoute(map,'route-1')
        });

    })
}
function removeRoute(map, id) {
    if (map.getLayer(id)) {
        map.removeLayer(id);
    }
    if (map.getSource(id)) {
        map.removeSource(id);
    }
}

// ----------- change coordinate to location Name ------------- //
function getLocationName(coordinates) {
    const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${coordinates[0]},${coordinates[1]}.json?access_token=${mapboxgl.accessToken}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const locationName = data.features[0].place_name;
            document.querySelector('.current-location').textContent = locationName;
        })
}


// ----------- Show the Range with buffer Circle ------------- //
function bufferCircle(map, coordinates, radius) {
    if (radius <= 0) {
        // If the radius is zero or less, remove the buffer layer if it exists
        if (map.getLayer('buffer-layer')) {
            map.removeLayer('buffer-layer');
        }
        if (map.getSource('buffer')) {
            map.removeSource('buffer');
        }
        return;
    }
    const buffered = turf.buffer(turf.point(coordinates), radius, { units: 'meters' });
    // Add the buffer as a layer on the map
    if (map.getSource('buffer')) {
        map.getSource('buffer').setData(buffered);
    } else {
        map.addSource('buffer', {
            type: 'geojson',
            data: buffered
        });
        map.addLayer({
            id: 'buffer-layer',
            type: 'fill',
            source: 'buffer',
            paint: {
                'fill-color': '#888888',
                'fill-opacity': 0.3
            }
        });
    }
}

// ----------- Show busStop within the range ------------- //
function filter_BusStop(busStop, Location) {
    const range = 700;    // Range in meters 
    const distance = turf.distance(Location, [busStop.longitude, busStop.latitude], { units: 'meters' });
    if (distance <= range) {
        return true;
    } else {
        return false;
    }
}



// ----------- ETA and distance from current location to chosen busStop------------- //
let popup;
function drawWalkingRoute(map, start, end) {
    var url = `https://api.mapbox.com/directions/v5/mapbox/walking/${start[0]},${start[1]};${end[0]},${end[1]}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {

            var routeCoordinates = data.routes[0].geometry.coordinates;
            var route = data.routes[0];

            const duration = route.duration / 60; // duration in minutes
            const distance = route.distance / 1000; // distance in km

            var estimateTime = duration.toFixed(2);
            var distanceinkm = distance.toFixed(2);


            estimateTime = parseInt(estimateTime);

            if (estimateTime == 0) {
                estimateTime = 1;
            }

            if (estimateTime < 40) {
                var geojson = {
                    type: 'Feature',
                    properties: {},
                    geometry: {
                        type: 'LineString',
                        coordinates: routeCoordinates
                    }
                };

                if (map.getLayer("routeId")) {
                    map.getSource("routeId").setData(geojson);
                } else {
                    map.addLayer({
                        id: "routeId",
                        type: 'line',
                        source: {
                            type: 'geojson',
                            data: geojson
                        },
                        layout: {
                            'line-join': 'round',
                            'line-cap': 'round'
                        },
                        paint: {
                            'line-color': '#34cceb',
                            'line-width': 5,
                            'line-dasharray': [1, 3] // Dotted line pattern: [dash length, gap length]
                        }
                    });
                }

                // Automatically display a popup at the midpoint of the route
                var midpointIndex = Math.floor(routeCoordinates.length / 2);
                var midpoint = routeCoordinates[midpointIndex];

                popup = new mapboxgl.Popup({ offset: 25 })
                    .setLngLat(midpoint)
                    .setHTML(`<p id="walking_Popup"><img src="./Ui kits/images/walking.png" width="20px" height="20px"> ${estimateTime} min
                              ${distanceinkm} km</p>`)
                    .addTo(map);

                // Calculate the bounding box of the route
                var bounds = new mapboxgl.LngLatBounds();
                routeCoordinates.forEach(coord => bounds.extend(coord));

                // Fit the map to the bounding box with custom padding
                map.fitBounds(bounds, {
                    padding: 250,
                    duration: 1000 // Duration of the zoom animation in milliseconds
                });
            }


        })
        .catch(error => console.error('Error fetching route:', error));
}


// ---------------  for history ---------------- //
function add_history_List(start, end, saved_route) {
    let a = document.createElement('a');
    a.classList.add('bus__content', 'history');
    a.setAttribute('href', '#');
    a.innerHTML = `  <div>
        <button href="" class="btn">
            <p class="saved_route" hidden>${saved_route}</p>
            <div class="overlay btn-shadow"></div>
            <div class="flex-center btn-content btn-icon btn-secondary">
            <div class="flex-center btn-text">
                <span
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="icon"
                >
                    <path
                    d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z"
                    /></svg
                ></span>
                <span class="duplicate"
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="icon"
                >
                    <path
                    d="M227.7 11.7c15.6-15.6 40.9-15.6 56.6 0l216 216c15.6 15.6 15.6 40.9 0 56.6l-216 216c-15.6 15.6-40.9 15.6-56.6 0l-216-216c-15.6-15.6-15.6-40.9 0-56.6l216-216zm87.6 137c-4.6-4.6-11.5-5.9-17.4-3.5s-9.9 8.3-9.9 14.8l0 56-64 0c-35.3 0-64 28.7-64 64l0 48c0 13.3 10.7 24 24 24s24-10.7 24-24l0-48c0-8.8 7.2-16 16-16l64 0 0 56c0 6.5 3.9 12.3 9.9 14.8s12.9 1.1 17.4-3.5l80-80c6.2-6.2 6.2-16.4 0-22.6l-80-80z"
                    /></svg
                ></span>
            </div>
            </div>
        </button>
        </div>
        <div class="bus__line-info">
        <p class="from">
            from <span class="myanmar-text">${start}</span>
        </p>
        <p class="to">to <span class="myanmar-text">${end}</span></p>
        </div>`;

    return a;
}

// ---------------  for route ---------------- //
function add_route_List(busNo, from, to) {
    let a = document.createElement('a');
    a.classList.add('bus__content', 'route');
    a.setAttribute('href', '#');
    a.innerHTML = `  <div class="bus__line-info">
              <p class="to">Busline : </p>
            </div>
            <div>
              <button class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span id="busLine_No">${busNo}</span>
                    <span class="duplicate">${busNo}</span>
                  </div>
                </div>
              </button>
            </div>
            `;

    return a;
}

function add_chosenbus_route(name_en, name_mm) {
    let a = document.createElement('a');
    a.classList.add('bus__content', 'routeInfo');
    a.setAttribute('href', '#');
    a.innerHTML = ` <div>
              <button href="" class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-icon btn-secondary">
                  <div class="flex-center btn-text">
                    <span><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        class="icon">
                        <path
                          d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                      </svg></span>
                    <span class="duplicate"><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        class="icon">
                        <path
                          d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                      </svg></span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="name__en">${name_en}</p>
              <p class="name__mm myanmar-text">${name_mm}</p>
            </div>`
    return a;
  }


// ---------------  for tracking ---------------- //


const tracking_lists = document.querySelector('.chosen_bustracking-lists');

function add_detail_trackbusLine(name_en, name_mm, lnglat) {
    let a = document.createElement('a');
    a.classList.add('bus__content', 'nearest-bus__stop');
    a.setAttribute('href', '#');
    a.innerHTML = ` <div>
              <button href="" class="btn">
                <p class="lng" hidden>${lnglat[0]}</p>
                <p class="lat" hidden>${lnglat[1]}</p>
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-icon btn-secondary">
                  <div class="flex-center btn-text">
                    <span><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        class="icon">
                        <path
                          d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                      </svg></span>
                    <span class="duplicate"><svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                        class="icon">
                        <path
                          d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                      </svg></span>
                  </div>
                </div>
              </button>
            </div>
            <div class="bus__line-info">
              <p class="name__en">${name_en}</p>
              <p class="name__mm myanmar-text">${name_mm}</p>
            </div>`
    return a;
}

document.body.addEventListener('click', function (e) {
    if (e.target.closest('.track-bus__line')) {
        e.preventDefault();
        let busLine = e.target.closest('.track-bus__line');

        let busNo = busLine.querySelector('.bus_number').innerHTML;
        let busName = busLine.querySelector('#busStop_name-track').innerHTML;

        document.querySelector('#bustrack-No').innerHTML = busNo;
        document.querySelector('#bustrack-busStop').innerHTML = busName;
        trackBusLineInfoBox.classList.add('popup-box-show');
        trackBusLineBox.classList.remove('popup-box-show');
        tracking_busLine_onRoute(map)
        if (tracking_lists.children.length - 1 == 0) {
            document.querySelector('.no__content-box').style.display = "block";
        }
    }
})

function chosen_track_busStop(busNo, eta) {
    let a = document.createElement('a');
    a.classList.add('bus__content', 'track-bus__line-info');
    a.setAttribute('href', '#');
    a.innerHTML = ` <div>
              <button class="btn">
                <div class="overlay btn-shadow"></div>
                <div class="flex-center btn-content btn-number btn-secondary">
                  <div class="flex-center btn-text">
                    <span>${busNo}</span>
                    <span class="duplicate">${busNo}</span>
                  </div>
                </div>
              </button>
            </div>
            <div class="route-info">
              <p class="estimated-time">
                <span class="theme-100" id="estimate-time">${eta}</span> mins
              </p>
            </div>`;
    return a;
}


function tracking_busLine_onRoute(map) {
    // sendNotification('Tracking Busline . . .', `Bus line 35 will arrive in 2 minutes.`);

    {
        const routes = [
            //{ start: [96.1358770462025,16.856111124565203], end: [96.13083139357832,16.826386025140096], id: 1 },
            // { start: [96.17451320243572, 16.78117506936364], end: [96.1679859336108, 16.788940480719432], id: 2 },
            { start: [96.14413473090701, 16.78190887721722], end: [96.13655793334078, 16.80667733467959], id: 1 }

        ];

        let busTrackMarkers = {};
        let previousLocations = {};
        let failCount = 0;
        const maxFails = 4;
        const fetchIntervalTime = 500;
        const distanceThreshold = 0.05; // 50 meters

        let userIsInteracting = false;
        let drivingPerspective = false;
        const end = [96.13655793334078, 16.80667733467959];

        routes.forEach(route => {
            addRoute(route.start, route.end, route.id);
        });

        async function addRoute(start, end, id) {
            try {
                const response = await fetch(`https://api.mapbox.com/directions/v5/mapbox/driving/${start.join(',')};${end.join(',')}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`);
                const data = await response.json();
                const route = data.routes[0].geometry;
                const routeCoordinates = route.coordinates;
                const routeDuration = data.routes[0].duration / 60; // convert to minutes
                const routeDistance = data.routes[0].distance / 1000; // convert to kilometers

                // Store route data in the map source
                if (map.getSource(`route-${id}`)) {
                    map.removeLayer(`route-${id}`);
                    map.removeSource(`route-${id}`);
                }

                map.addSource(`route-${id}`, {
                    type: 'geojson',
                    data: {
                        type: 'Feature',
                        properties: {
                            duration: routeDuration,
                            distance: routeDistance
                        },
                        geometry: route
                    }
                });

                map.addLayer({
                    id: `route-${id}`,
                    type: 'line',
                    source: `route-${id}`,
                    layout: {
                        'line-join': 'round',
                        'line-cap': 'round'
                    },
                    paint: {
                        'line-color': '#4a86ed',
                        'line-width': 8
                    }
                });
                // Calculate the bounding box of the route
                var bounds = new mapboxgl.LngLatBounds();
                routeCoordinates.forEach(coord => bounds.extend(coord));

                // Fit the map to the bounding box with custom padding
                map.fitBounds(bounds, {
                    padding: 150,
                    duration: 1000 // Duration of the zoom animation in milliseconds
                });
            } catch (error) {
                console.error('Error adding route:', error);
            }
        }

        function snapToRoute(lnglat, routeId) {
            const point = turf.point(lnglat);
            const route = map.getSource(`route-${routeId}`)._data;
            const line = turf.lineString(route.geometry.coordinates);
            const snapped = turf.nearestPointOnLine(line, point);
            return snapped.geometry.coordinates;
        }

        function moveMarkerSmoothly(marker, startLngLat, endLngLat, duration) {
            let startTime = null;

            function animateMarker(timestamp) {
                if (!startTime) startTime = timestamp;
                const elapsedTime = timestamp - startTime;

                const t = Math.min(elapsedTime / duration, 1);
                const interpolatedLngLat = [
                    startLngLat[0] + (endLngLat[0] - startLngLat[0]) * t,
                    startLngLat[1] + (endLngLat[1] - startLngLat[1]) * t
                ];

                marker.setLngLat(interpolatedLngLat);

                if (t < 1) {
                    requestAnimationFrame(animateMarker);
                }
            }

            requestAnimationFrame(animateMarker);
        }

        function findNearestRoute(lnglat) {
            let nearestRouteId = null;
            let minDistance = Infinity;

            routes.forEach(route => {
                const routeId = route.id;
                const routeData = map.getSource(`route-${routeId}`);

                // Ensure the source exists before proceeding
                if (routeData) {
                    const line = turf.lineString(routeData._data.geometry.coordinates);
                    const snapped = turf.nearestPointOnLine(line, turf.point(lnglat));
                    const distance = snapped.properties.dist;

                    if (distance < minDistance) {
                        minDistance = distance;
                        nearestRouteId = routeId;
                    }
                }
            });

            return minDistance <= distanceThreshold ? nearestRouteId : null;
        }

        function fetchLocation() {
            fetch('http://localhost:3000/location')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    failCount = 0;

                    if (data && typeof data.latitude === 'number' && typeof data.longitude === 'number') {
                        const lnglat = [data.longitude, data.latitude];
                        const nearestRouteId = findNearestRoute(lnglat);

                        // Check if the marker is within range
                        if (nearestRouteId !== null) {
                            const snappedLngLat = snapToRoute(lnglat, nearestRouteId);

                            if (busTrackMarkers[nearestRouteId]) {
                                const existingMarker = busTrackMarkers[nearestRouteId];
                                const previousLngLat = previousLocations[nearestRouteId] || snappedLngLat;

                                moveMarkerSmoothly(existingMarker, previousLngLat, snappedLngLat, fetchIntervalTime);
                                updatePopupWithETA(existingMarker, snappedLngLat, end);

                                if (!userIsInteracting && drivingPerspective) {
                                    map.easeTo({
                                        center: snappedLngLat,
                                        bearing: calculateBearing(existingMarker.getLngLat().toArray(), snappedLngLat),
                                        pitch: 60,
                                        duration: fetchIntervalTime * 2
                                    });
                                }

                                previousLocations[nearestRouteId] = snappedLngLat;
                            } else {
                                const busline_icon = document.createElement('div');
                                busline_icon.id = 'busline_marker';
                                const marker = new mapboxgl.Marker(busline_icon)
                                    .setLngLat(snappedLngLat)
                                    .setPopup(new mapboxgl.Popup())
                                    .addTo(map);


                                busTrackMarkers[nearestRouteId] = marker;
                                previousLocations[nearestRouteId] = snappedLngLat;

                                updatePopupWithETA(marker, snappedLngLat, end);
                            }
                        } else {
                            // Remove marker if it's not near any route
                            for (const id in busTrackMarkers) {
                                if (busTrackMarkers.hasOwnProperty(id)) {
                                    const marker = busTrackMarkers[id];
                                    marker.remove(); // Remove marker from map
                                    delete busTrackMarkers[id]; // Remove marker from the data structure
                                    delete previousLocations[id]; // Remove location from previousLocations
                                }
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching location:', error);
                    failCount++;
                    if (failCount < maxFails) {
                        setTimeout(fetchLocation, fetchIntervalTime);
                    }
                });
        }


        function calculateBearing(start, end) {
            const [startLng, startLat] = start;
            const [endLng, endLat] = end;
            const startLatRad = startLat * Math.PI / 180;
            const endLatRad = endLat * Math.PI / 180;
            const dLng = (endLng - startLng) * Math.PI / 180;

            const y = Math.sin(dLng) * Math.cos(endLatRad);
            const x = Math.cos(startLatRad) * Math.sin(endLatRad) -
                Math.sin(startLatRad) * Math.cos(endLatRad) * Math.cos(dLng);

            return Math.atan2(y, x) * 180 / Math.PI;
        }

        function updatePopupWithETA(marker, start, end) {
            const url = `https://api.mapbox.com/directions/v5/mapbox/driving/${start.join(',')};${end.join(',')}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const route = data.routes[0];
                    const duration = (route.duration / 60).toFixed(2); // in minutes
                    const distance = (route.distance / 1000).toFixed(2); // in km


                    const popupHTML = `
            <strong>Busline:</strong> 35 <br>
            <strong>ETA:</strong> ${duration} min<br>
            <strong>Distance:</strong> ${distance} km
          `;

                    document.querySelector('.no__content-box').style.display = "none";

                    const lists = chosen_track_busStop(35, duration);

                    // Check if there is already a first child in tracking_lists
                    if (tracking_lists.firstChild) {
                        tracking_lists.replaceChild(lists, tracking_lists.firstChild);
                    } else {
                        tracking_lists.appendChild(lists);
                    }


                    marker.getPopup().setHTML(popupHTML).addTo(map);
                })
                .catch(error => {
                    console.error('Error fetching ETA:', error);
                });
        }


        fetchLocation(); // Initial fetch
        setInterval(fetchLocation, fetchIntervalTime); // Keep fetching every 500ms
    }
}

function sendNotification(title, message) {
    fetch('https://api.pushover.net/1/messages.json', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            token: 'aqbuhjxoyvpibcbvij5852jrzbzxb6',
            user: 'u71x8ohdhge3ufw8jebncxodkcep6v',
            title: title,
            message: message
        })
    })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
}

