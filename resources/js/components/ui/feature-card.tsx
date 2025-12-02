
interface FeatureCardProps {
    title: string,
    Icon: React.ComponentType<{ className?: string }>
    description: string
}

const FeatureCard = ({ title, description,  Icon}: FeatureCardProps) => {

  return (
    <div className="group relative w-full rounded-2xl border border-white/20 border-t border-l bg-white/10 p-6 backdrop-blur-lg transition-all duration-300 hover:bg-white/10 hover:border-white/30 hover:shadow-xl md:w-auto">
      <div className="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/5 to-white/0 opacity-0 transition-opacity duration-300 group-hover:opacity-100" />
      
      <div className="relative">
        <div className="mb-4 flex items-center justify-between">
          <h3 className="text-xl font-semibold text-gray-200">
            {title}
          </h3>
          <div className="inline-flex rounded-xl bg-gradient-to-br from-sky-500 via-purple-400 to-pink-400 p-3 shadow-lg">
            <Icon className="h-6 w-6 text-white" />
          </div>
        </div>
        <p className="text-sm leading-relaxed text-gray-300">
          {description}
        </p>
      </div>
    </div>
  );
}


export default FeatureCard