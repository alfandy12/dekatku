import { UserPlus, MapPin, MessageSquare } from 'lucide-react';

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
    icon: MessageSquare,
    description: 'Dapatkan rekomendasi UMKM terbaik dengan bantuan AI. Tanyakan apapun tentang produk, lokasi, atau kategori bisnis yang Anda cari, dan AI akan membantu menemukan yang paling sesuai.',
  }
];

export default function FeatureCards() {
  return (
    <div className="w-full max-w-7xl mx-auto px-4 py-10">
      <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        {features.map((feature, index) => {
          const Icon = feature.icon;
          return (
            <div
              key={index}
              className="group relative rounded-2xl border border-white/20 border-t border-l bg-white/10 p-6 backdrop-blur-lg transition-all duration-300 hover:bg-white/10 hover:border-white/30 hover:shadow-xl"
            >
            
              <div className="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/5 to-white/0 opacity-0 transition-opacity duration-300 group-hover:opacity-100" />
              
              <div className="relative">

                <div className="mb-4 flex items-center justify-between">
                  <h3 className="text-xl font-semibold text-gray-200">
                    {feature.title}
                  </h3>
           
                  <div className="inline-flex rounded-xl bg-gradient-to-br from-sky-500 via-purple-400 to-pink-400 p-3 shadow-lg">
                    <Icon className="h-6 w-6 text-white" />
                  </div>
                </div>

         
                <p className="text-sm leading-relaxed text-gray-300">
                  {feature.description}
                </p>
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
}