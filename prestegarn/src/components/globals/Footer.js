import React from 'react';
import '../../style/Footer.css';
import NavLink from './NavLink.js';
const icons = require.context('../../icons', true);
const logo_src = icons ('./logo3.svg');

/**
 * footer element for the website
*/
const Footer = () => (
  <footer>
    <div className="footerWrapper">
        <div className="footerLogo">
          <img src={ logo_src } alt="prestegarn i snertingdal logo"/>
        </div>
        <div className="hr"></div>
        <div className="info">
            <div className="socialMedia">
              <a href="https://www.facebook.com/snertingdalprestegaard/" rel="noopener noreferrer" target="_blank">
                <i className="fab fa-facebook-f"></i></a>
              <a href="https://www.instagram.com/praestgarden/" rel="noopener noreferrer" target="_blank">
                <i className="fab fa-instagram"></i></a>
              <a href="mailto: prestgarn@gmail.com">
                <i className="fas fa-envelope"></i></a>
              <a href="https://goo.gl/maps/m9joyxTUGYGEvsBb8" rel="noopener noreferrer" target="_blank">
                <i className="fas fa-map-marker"></i></a>
            </div>
        </div>
        <div className="copyright">
          <p><i className="fas fa-copyright"></i> <NavLink to="/info"> Group F </NavLink></p>
        </div>
  </div>    
</footer>
);

export default Footer;