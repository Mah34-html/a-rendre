import L from 'leaflet'
import 'leaflet/dist/leaflet.css'


export default class Map {

    static init() {
        let map = document.querySelector('#map')
        if (map === null) {
            return
        }

        let icon = L.icon({
            iconUrl: '/images/marker-icon.png',
        })

        let center = [map.dataset.lat, map.dataset.lng]

        map = L.map('map').setView(center, 13)

        let token = 'pk.eyJ1IjoibWFyMTNvdWFuIiwiYSI6ImNqdjltaDhyazBpMXE0NW1tZ2VmbWs0MGcifQ.jGBkXWIp50CFfN8LvkKusA'

        L.tileLayer(`https://api.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=${token}`, {
            maxZoom: 18,
            minZoom: 12
        }).addTo(map)
        L.marker(center, {icon:icon}).addTo(map)
    }
} 