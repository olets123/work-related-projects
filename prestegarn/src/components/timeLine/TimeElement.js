import React, { Component } from 'react';
import { lineBreaker } from '../functions/textChanger.js';
var images = require.context('../../images', true);

/**
 * element with single timeline element information
*/
class TimeElement extends Component  {
    /**
     * create gallery of all pictures from the gallery table for each timeline element
     * @param {array} arr is array of objects with picture urls and picture alternative texts
    */
    createGallery = (arr) => {
        let imageArr = [];
        arr.forEach((pic, j) => {
            imageArr.push(
            <div key={j} className="imageWrapper">
                <div className="imgFrame"><img className="timeImage" src={ images(`./` + pic.picture_url) } alt={ pic.picture_alt } /><p className="copyright"><i className="far fa-copyright"></i> { pic.copyright }</p></div>
            </div>);
        })
        return imageArr;
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

    render () {
        let cName = 'timeElement';
        let pictureArray = this.props.pictures;
        let descArr = lineBreaker(this.props.description, 200);
        let description = this.formatText(descArr);
        return (
            <div id={ this.props.id } className={ cName } >
                <div className="timeImages">
                        { this.createGallery(pictureArray) }
                </div>

                <div className="timeText">
                    <div className="timeContent">
                        <div className="tContent" key={ this.props.id }>
                            <h1 className="main_header timeTitle">{ this.props.title }</h1>
                            <div><b>{ this.props.year }:</b> { description }</div>
                        </div>
                    </div>
                    <div className="yearBox">
                        <div className="year">
                            <h2 className="yearText">{ this.props.year }</h2>
                        </div>
                    </div>
                </div>

                
            </div>
        )
    }
}

export default TimeElement;