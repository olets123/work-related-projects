import React, { Component } from 'react'
import NavLink from './NavLink';
import { scrollFunction } from '../functions/scrollHandler.js';
import '../../style/Header.css';

/**
 * navigation element
*/
export default class Header extends Component {
  constructor(props) {
    super(props);
    this.state = {
      "navShow": false
    }
  }

  componentDidMount() {
    window.addEventListener("scroll", scrollFunction);
  }
  componentWillUnmount() {
    window.removeEventListener("scroll", scrollFunction);
  }

  /**
   * when the mobile navigation bar is visible the user can toggle to hide and show it.
  */
  burgerToggle = () => {
    this.setState(prevState => ({
      navShow: !prevState.navShow
    }));
  }

  render() {
    let mobileCName = 'nav';
    let iconClass = 'fas fa-bars';
    if (this.state.navShow === false) {
      mobileCName = 'nav hidden'
      iconClass = 'fas fa-bars';
    } else { 
      mobileCName = 'nav show';
      iconClass = "fas fa-times";
    }

    this.state.navShow === false ? mobileCName = 'nav hidden' : mobileCName = 'nav show';
    return (
      <div id="headerDiv">
        {/* NORMAL NAV */}
        <header id="header">
          <div>
            <div className="navWrapper">
              <div className="navigation">
                <nav>
                  <ul>
                    <li><NavLink to='/'>Hematt</NavLink></li>
                    <li><NavLink to='/events'>Fæstligheter</NavLink></li>
                    <li><NavLink to='/historie'>Historie</NavLink></li>
                    <li><NavLink to='/venner'>Våre bestevenner</NavLink></li>
                    <li><NavLink to='/reservering'>Reserver øss</NavLink></li>
                    <li><NavLink to='/omoss'>Om øss</NavLink></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </header> 
        {/* MOBILE NAV */}
        <div className="mobileNav">
          <button id="burger" className="burger" onClick={ this.burgerToggle }><i className={ iconClass }></i></button>
          <div className={ mobileCName }>
            <div className="mobileNavWrapper">
              <ul>
                <li><NavLink onClick={ this.burgerToggle } to='/'>Hematt</NavLink></li>
                <li><NavLink onClick={ this.burgerToggle } to='/events'>Fæstligheter</NavLink></li>
                <li><NavLink onClick={ this.burgerToggle } to='/historie'>Historie</NavLink></li>
                <li><NavLink onClick={ this.burgerToggle } to='/venner'>Våre bestevenner</NavLink></li>
                <li><NavLink onClick={ this.burgerToggle } to='/reservering'>Reserver øss</NavLink></li>
                <li><NavLink onClick={ this.burgerToggle } to='/omoss'>Om Øss</NavLink></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    )
  }
}
