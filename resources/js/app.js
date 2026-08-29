import './bootstrap';
import 'bootstrap'; // Mengimpor JS Bootstrap dari node_modules

window.initLeafletMap = function (wire) {
    return {
        latitude: wire.entangle('latitude'),
        longitude: wire.entangle('longitude'),
        map: null,
        marker: null,

        init() {
            this.$nextTick(() => {
                const defaultLat = parseFloat(this.latitude) ||  -8.5653;
                const defaultLng = parseFloat(this.longitude) || 116.0766;

                this.map = L.map(this.$refs.map).setView([defaultLat, defaultLng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                }).addTo(this.map);

                this.marker = L.marker([defaultLat, defaultLng], {
                    draggable: true,
                }).addTo(this.map);

                const updateCoordinates = (latitude, longitude) => {
                    this.latitude = latitude.toFixed(7);
                    this.longitude = longitude.toFixed(7);
                };

                if (!this.latitude || !this.longitude) {
                    updateCoordinates(defaultLat, defaultLng);
                }

                this.marker.on('dragend', () => {
                    const position = this.marker.getLatLng();
                    updateCoordinates(position.lat, position.lng);
                });

                this.map.on('click', (event) => {
                    this.marker.setLatLng(event.latlng);
                    updateCoordinates(event.latlng.lat, event.latlng.lng);
                });

                setTimeout(() => this.map.invalidateSize(), 250);
            });
        },
    };
};
