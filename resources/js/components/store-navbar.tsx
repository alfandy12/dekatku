import NavbarLayout from './layouts/navbar-layout';
import SearchBar from './ui/search';

const StoreNavbar = () => {
    return (
        <NavbarLayout>
            <SearchBar inputStyle="py-2" className="w-1/2 md:w-full" />
        </NavbarLayout>
    );
};

export default StoreNavbar;
