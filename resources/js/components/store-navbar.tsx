import NavbarLayout from './layouts/navbar-layout';
import SearchBar from './ui/search';

const StoreNavbar = () => {
    return (
        <NavbarLayout>
            <SearchBar inputStyle="py-2" />
        </NavbarLayout>
    );
};

export default StoreNavbar;
