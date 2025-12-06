import { UserPlus, MapPin,  Sparkles } from 'lucide-react';
import { Marquee } from './marquee';
import FeatureCard from './feature-card';


const features = [
  {
    title: 'Pendaftaran Gratis',
    icon: UserPlus,
    description: 'Dekatku menyediakan pendaftaran gratis bagi pelaku UMKM untuk memulai bisnis online tanpa biaya apapun. Daftarkan toko Anda dan jangkau lebih banyak pelanggan di sekitar.',
  },
  {
    title: 'Temukan UMKM Terdekat',
    icon: MapPin,
    description: 'Sistem deteksi lokasi otomatis menampilkan UMKM terdekat dari posisi Anda. Temukan produk dan jasa lokal dengan mudah berdasarkan jarak dan kategori yang Anda butuhkan.',
  },
  {
    title: 'Chat with AI Assistant',
    icon: Sparkles,
    description: 'Dapatkan rekomendasi UMKM terbaik dengan bantuan AI. Tanyakan apapun tentang produk, lokasi, atau kategori bisnis yang Anda cari, dan AI akan membantu menemukan yang paling sesuai.',
  }
];



export default function FeatureCards() {
  return (
    <div className="w-full md:max-w-7xl mx-auto px-0 md:px-4 py-10">
    
      <div className="hidden md:grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        {features.map((feature, index) => (
          <FeatureCard key={index} title={feature.title} Icon={feature.icon} description={feature.description} />
        ))}
      </div>


      <div className="md:hidden relative flex w-full flex-col items-center justify-center overflow-hidden">
        <Marquee pauseOnHover className="[--duration:20s]">
          {features.map((feature, index) => (
            <div key={index} className="mx-3 w-[85vw] flex-shrink-0">
              <FeatureCard title={feature.title} Icon={feature.icon} description={feature.description} />
            </div>
          ))}
        </Marquee>
        <div
          className="pointer-events-none absolute inset-y-0 left-0 w-1/3 z-10"
          style={{
            background:
              "linear-gradient(to right, rgb(3 7 18) 0%, rgba(3, 7, 18, 0.8) 10%, transparent 50%)",
            willChange: "auto",
          }}
        />
        <div
          className="pointer-events-none absolute inset-y-0 right-0 w-1/3 z-10"
          style={{
            background:
              "linear-gradient(to left, rgb(3 7 18) 0%, rgba(3, 7, 18, 0.8) 10%, transparent 50%)",
            willChange: "auto",
          }}
        />
      </div>
      
    </div>
  );
}