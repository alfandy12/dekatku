import { ExternalLink, MapPin, Navigation } from 'lucide-react';
import { useMemo } from 'react';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';
import icon from 'leaflet/dist/images/marker-icon.png';
import iconShadow from 'leaflet/dist/images/marker-shadow.png';
import { MapLocation } from '@/types/store';

const DefaultIcon = L.icon({
    iconUrl: icon,
    shadowUrl: iconShadow,
    iconSize: [25, 41],
    iconAnchor: [12, 41]
});

L.Marker.prototype.options.icon = DefaultIcon;

interface StoreMapProps {
    location: string;
    storeName: string;
}

export default function StoreMapLeaflet({ location, storeName }: StoreMapProps) {
    const mapLocation = useMemo<MapLocation | null>(() => {
        try {
            return JSON.parse(location);
        } catch {
            return null;
        }
    }, [location]);

    if (!mapLocation) {
        return (
            <div className="rounded-2xl border border-white/10 bg-white/5 p-8 text-center">
                <MapPin className="mx-auto mb-2 h-8 w-8 text-gray-500" />
                <p className="text-gray-400">Lokasi tidak tersedia</p>
            </div>
        );
    }

    const googleMapsUrl = `https://www.google.com/maps/search/?api=1&query=${mapLocation.lat},${mapLocation.lng}`;
    const wazeUrl = `https://waze.com/ul?ll=${mapLocation.lat},${mapLocation.lng}&navigate=yes`;

    return (
        <div className="space-y-4">
            <h2 className="text-xl font-semibold text-white">Lokasi Toko</h2>
            

            <div className="overflow-hidden rounded-2xl border border-white/10">
                <MapContainer
                    center={[mapLocation.lat, mapLocation.lng]}
                    zoom={15}
                    style={{ height: '400px', width: '100%' }}
                    scrollWheelZoom={false}
                >
                    <TileLayer
                        attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    />
                    <Marker position={[mapLocation.lat, mapLocation.lng]}>
                        <Popup>{storeName}</Popup>
                    </Marker>
                </MapContainer>
            </div>

      
            <div className="space-y-3 rounded-2xl border border-white/10 bg-white/5 p-4">
                <div className="flex items-center gap-2 text-sm text-gray-400">
                    <MapPin className="h-4 w-4" />
                    <span>Koordinat: {mapLocation.lat}, {mapLocation.lng}</span>
                </div>

                <div className="grid grid-cols-2 gap-3">
                    <a
                        href={googleMapsUrl}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="flex items-center justify-center gap-2 rounded-lg border border-white/20 bg-white/5 px-4 py-2.5 text-sm font-medium text-white transition-all hover:bg-white/10"
                    >
                        <Navigation className="h-4 w-4" />
                        Google Maps
                    </a>

                    <a
                        href={wazeUrl}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="flex items-center justify-center gap-2 rounded-lg border border-sky-500/20 bg-sky-500/10 px-4 py-2.5 text-sm font-medium text-sky-400 transition-all hover:bg-sky-500/20"
                    >
                        <ExternalLink className="h-4 w-4" />
                        Waze
                    </a>
                </div>
            </div>
        </div>
    );
}