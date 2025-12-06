import { useStoreDetail } from '@/hooks/stores/use-nearby-stores';
import StoreLayout from '@/layouts/store-layout';
import { usePage } from '@inertiajs/react';

export default function Detail() {
    const { props } = usePage();
    console.log('props', props);
    const { data, isLoading, isError, error } = useStoreDetail(
        props.slug as string,
    );

    console.log('data', data);

    return (
        <StoreLayout className="mt-32 max-w-6xl" title={data?.nama_toko}>
            <p className="text-white">Hello Word</p>
        </StoreLayout>
    );
}
