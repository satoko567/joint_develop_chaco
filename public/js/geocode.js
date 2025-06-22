function geocodeAddress() {
    const address = document.getElementById('address').value;
    const geocoder = new google.maps.Geocoder();

    geocoder.geocode({ address: address }, function(results, status) {
        if (status === 'OK') {
            const location = results[0].geometry.location;
            document.getElementById('lat').value = location.lat();
            document.getElementById('lng').value = location.lng();
        } else {
            alert('住所の位置情報が取得できませんでした: ' + status);
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const addressInput = document.getElementById('address');
    if (addressInput) {
        addressInput.addEventListener('blur', geocodeAddress);
    }
});