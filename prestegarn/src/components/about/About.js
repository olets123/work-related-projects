import React, { Component } from 'react';
import { getDisplayAbout } from '../../handlers/aboutHandler.js';
import { lineBreaker } from '../functions/textChanger.js';
import '../../style/About.css';
var images = require.context('../../images', true);

/**
 * About component is mounted when url: /about
 */
export default class About extends Component {
  constructor(props) {
    super(props);
    this.state = {
      'error': null,
      'isLoaded': false,
      'aboutObj': []
    }
  }
  /**
   * on component mount fetch information from the about table in the database
   */
  componentDidMount() {
    getDisplayAbout().then((data) => {
      this.setState({
        isLoaded: true,
        aboutObj: data
      });
    },(error) => {
      this.setState({
        isLoaded: true,
        error
      });
    });
  }

  /**
   * make a paragraph for each element of the array of strings, and push it into the strDiv array
   * Then display it into the render funtion
   * @param {array} arr array of strings
   * @returns {array} array of paragraph html elements
   */
  formatText = (arr) => {
    let strDiv = [];
    arr.forEach((string, k) => {
      strDiv.push(
        <p key={ k }>{ string }</p>
      )
    }) 
    return strDiv;
  }

  render() {
    const { error, isLoaded, aboutObj } = this.state;
    if (error) { return (<div className="aboutWrapper"><h1 className="header">Om øss</h1><div>Error: { error.message }</div></div>)}
    else if (!isLoaded) { return (<div className="aboutWrapper"><h1 className="header">Om øss</h1><div>Laster inn...</div></div> ) } else {
      console.log(aboutObj);
      let strings = lineBreaker(aboutObj[0].mainContent, 500);
      let mainContent = this.formatText(strings);
      return (
        <div className="aboutWrapper">
          <h1 className="header">Om øss</h1>
          <div className="aboutDiv">
              <div className="titleBox">
              <div className="anitaDiv">
                <h2 className="sub_header anita1"> Anita Krohn Traaseth</h2>
                <p className="anitaDesc">{ aboutObj[0].anitaContent }</p>
              </div>
              <div className="mainImgFrame"><img src={ images ('./' +  aboutObj[0].mainPicture_url )} alt={ aboutObj[0].mainPicture_alt }/></div>
              <div className="hansDiv">
                <h2 className="sub_header hans1"> Hans Olav Brenner</h2>
                <p className="hansDesc">{ aboutObj[0].hansContent }</p>
              </div>
            </div>
            <div className="mainDesc">
              <div className="anitaFrame"><img className="anitaimg" src={ images ('./' +  aboutObj[0].anitaPicture_url )} alt={ aboutObj[0].anitaPicture_alt }/></div>
              <div className="mainText">{ mainContent }</div>
              <div className="hansFrame"><img className="hansimg" src={ images ('./' +  aboutObj[0].hansPicture_url )} alt={ aboutObj[0].hansPicture_alt }/></div>
            </div>
          </div>
        </div>
      )
    }
  }
}
