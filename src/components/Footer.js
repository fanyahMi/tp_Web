import React from 'react';
import '../assets/styles/Footer.css'
import SocialMedia from './FooterComponent/SocialMedia';

const Footer = () => {
    const style = {
        marginTop: "5%",
        marginBottom: "5%"
    };
    return (
        <>
            <div className="row">
                <nav class="navbar bg-body-tertiary" style={style}>
                    <div class="container-fluid ">
                        <h3 className='title'>Social Media</h3>
                        <SocialMedia />
                    </div>
                </nav>
            </div>
        </>
    );
};

export default Footer;