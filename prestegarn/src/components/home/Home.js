import React, { Component } from 'react';
import '../../style/home.css';
import UpcomingEvents from './UpcomingEvents.js';
import HomeExplore from './homeExplore.js';
import { getNews } from '../../handlers/newsHandler.js';

var logo = require.context('../../icons', true);
var image = require.context('../../images', true);
var logo_src = logo(`./logo2.svg`);
var img_src = image (`./prestegarn01.jpg`);

/**
 * the home/landing page for the website
*/
export default class Home extends Component {
  constructor(props) {
    super(props);
    this.state = {
      'error': null,
      'isLoaded': false,
      'newsObj': []
    }
  }
  /**
   * get data from the database to populate the homepage
  */
  componentDidMount() {
    getNews().then((data) => {
      this.setState({
        isLoaded: true,
        newsObj: data
      });
    },(error) => {
      this.setState({
        isLoaded: true,
        error
      });
    });
  }
render() {
    const { error, isLoaded, newsObj } = this.state;
    if (error) { return (<div><div className="logo"><img src={logo_src} alt="præstgarn logo"/></div><div>Error: { error.message }</div></div>) }
    else if (!isLoaded) { return (<div><div className="logo"><img src={logo_src} alt="præstgarn logo"/></div><div>Laster inn...</div></div> ) } else {
    let mainNews = newsObj[0].content;
    return (  
      <div>
          <div className="logo">
          <img src={logo_src} alt="præstgarn logo"/>
          </div>
          <div className="introWrapper news">
              <h1 className="sub_header">Velkommen til Snertingdals nye møtested</h1>
              <p className="intro">{ mainNews }</p>
          </div>
          <div className="homeBackground"><img className="cover" src={ img_src } alt="prestgarn fra utsiden"/>
          </div>
          <div className="upcomingEvents">
            <UpcomingEvents />
          </div>

          <HomeExplore />
      </div>
      )
    }
  }
}

