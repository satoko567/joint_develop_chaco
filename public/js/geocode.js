function geocodeAddress() {
    const address = document.getElementById('address').value.trim();
    if (!address) return;
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ address: address }, function(results, status) {
        if (status !== 'OK' || !results[0]) return;
        const location = results[0].geometry.location;
        document.getElementById('lat').value = location.lat();
        document.getElementById('lng').value = location.lng();
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const addressInput = document.getElementById('address');
    if (addressInput) {
        addressInput.addEventListener('blur', geocodeAddress);

        const latField = document.getElementById('lat');
        const lngField = document.getElementById('lng');

        if ((latField && latField.value === '') ||
            (lngField && lngField.value === '')) 
        {
            geocodeAddress();
        }
    }
});