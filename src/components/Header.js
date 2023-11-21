import React from 'react';
import Logo from './Logo';

const Header = (props) => {
    return (
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <Logo logo={props.logo} />
                <form class="d-flex" role="search">
                    <input type="search" className='form-control me-2' placeholder='Search' aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
    );
};

export default Header;