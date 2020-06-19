import React, { Component } from 'react';
import NavLink from '../globals/NavLink.js'
import '../../style/homeExplore.css';
import { getExplore } from '../../handlers/homeHandler.js'
var image = require.context('../../images', true);

/**
 * Element with information to tease the user about the content of the website
*/
export default class HomeExplore extends Component {
    constructor(props) {
        super(props);
        this.state = {
            'error': null,
            'isLoaded': false,
            'eventObj': [],
            'historyObj': []
        }
    }
    componentDidMount() {
        getExplore().then((data) => {
            this.setState({
                isLoaded: true,
                eventObj: data[0],
                historyObj: data[1]
            });
        },(error) => {
            this.setState({
                isLoaded: true,
                error
            }); 
        }); 
        }
    render () {
        const { error, isLoaded } = this.state;
        if (error) { return  (<div className="exploreHome">
            <div>Error: { error.message }</div>
            </div> )}
        else if (!isLoaded) { return (
            <div className="exploreHome">
            <div>Laster inn...</div>
            </div> ) } else {
            const { eventObj, historyObj } = this.state;
            
            return (
                <div className="exploreHome">
                    <h1 className="main_header exploreHeader">Se hva vi har å by på:</h1>
                    <div className="exploreIntro">
                        <div className="exploreFrame" id="one"><img src={ image(`./${eventObj[0].picture_url}`) } alt={ eventObj[0].picture_alt }/></div>
                        <div className="text">
                            <h3 className="sub_header"><NavLink to={{ "pathname": '/event/' + eventObj[0].eventId}}>{ eventObj[0].title }</NavLink></h3>
                            <div className="eventTitle"></div>
                            <p>{ eventObj[0].description }</p>
                            <NavLink className="btn_main exploreBtn" to='/events'>Finn flere arrangementer</NavLink> 
                        </div>
                    </div>
                    <div className="exploreHistory">
                        <div className="exploreFrame" id="two"><img src={ image(`./${ historyObj[0].pictures[0].picture_url }`) } alt={ historyObj[0].pictures[0].picture_url }/></div>
                        <div className="text">
                            <h3 className="sub_header">Innblikk i historien vår</h3>
                            <p><b>{ historyObj[0].year }</b>: { historyObj[0].description }</p> 
                            <NavLink className="btn_main exploreBtn" to="/historie">Les mer om historien vår her</NavLink>
                        </div>
                    </div>
                    <div className="exploreLocation">
                        <div className="exploreFrame" id="three">
                            <img src={ image('./vektorkart.png' ) } alt="kart"/>
                        </div>
                        <div className="text">
                            <h3 className="sub_header"><a href="https://www.google.com/maps/place/Seeg%C3%A5rdsvegen+130,+2838+Snertingdal/@60.8825257,10.462574,17z/data=!3m1!4b1!4m5!3m4!1s0x4641d5a8d7444d09:0x90e3ad1d47f656a1!8m2!3d60.8825257!4d10.4647627" rel="noopener noreferrer" target="_blank">Besøk oss</a></h3>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam a et modi alias? Ducimus praesentium in voluptates. Sit amet consectetur adipisicing elit. Nam a et modi alias? Ducimus praesentium in voluptates.</p>
                            <a href="https://www.google.com/maps/place/Seeg%C3%A5rdsvegen+130,+2838+Snertingdal/@60.8825257,10.462574,17z/data=!3m1!4b1!4m5!3m4!1s0x4641d5a8d7444d09:0x90e3ad1d47f656a1!8m2!3d60.8825257!4d10.4647627" rel="noopener noreferrer" target="_blank" 
                                className="btn_main exploreBtn" >Finn oss her...</a>
                        </div>
                    </div>
                </div>
            );
        }
    }
}