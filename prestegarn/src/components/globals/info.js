import React, { Component } from 'react';
import '../../style/info.css';

/**
 * Info component is mounted when url: /info
*/
export default class Info extends Component {
    render() {
        return (
            <div>
                <div className="infoWrapper">
                    <h1 className="header">Teamet</h1>
                    <div className="introWrapper"><p className="intro">Her er skolegruppen fra NTNU i gjøvik som har laget denne nettsiden</p></div>
                    <div className="info">
                        <h3 className="sub_header">Simon Sandvoll</h3>
                        <p>Programmeringsleder</p>
                        <a href="mailto:sandvoll.simon@gmail.com"><i className="fas fa-envelope"></i> sandvoll.simon@gmail.com </a>
                    </div>
                    <div className="info">
                        <h3 className="sub_header">Vetle Kruse Gundersen</h3>
                        <p>Leder</p>
                        <a href="mailto:Vetle-98@hotmail.com"><i className="fas fa-envelope"></i> Vetle-98@hotmail.com </a>
                    </div>
                    <div className="info">
                        <h3 className="sub_header">Vilde Pedersen</h3>
                        <p>Design leder</p>
                        <a href="mailto:vildeepedersen@hotmail.com"><i className="fas fa-envelope"></i> vildeepedersen@hotmail.com </a>
                    </div>
                    <div className="info">
                        <h3 className="sub_header">Henrik Helsem Eikeland</h3>
                        <p>Programmerer</p>
                        <a href="mailto:Henrik.h.eik@gmail.com"><i className="fas fa-envelope"></i> Henrik.h.eik@gmail.com </a>
                    </div>
                    <div className="info">
                        <h3 className="sub_header">Ole Thomas Skogli</h3>
                        <p>Designer</p>
                        <a href="mailto:skogliiii@gmail.com"><i className="fas fa-envelope"></i> skogliiii@gmail.com </a>
                    </div>
                </div>
            </div>
        )
    }
}
