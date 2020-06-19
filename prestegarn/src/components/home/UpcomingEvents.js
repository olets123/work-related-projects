import React, { Component } from 'react';
import { getDisplayEvents } from '../../handlers/eventHandler.js';
import { displayDate } from '../functions/parseDate.js';
import { snipText } from '../functions/textChanger.js';
import NavLink from '../globals/NavLink.js';
var images = require.context('../../images', true);

/**
 * The two upcoming events to be displayed on the homepage
*/
class UpcomingEvents extends Component {
    constructor(props) {
        super(props);
        this.state = {
          'error': null,
          'isLoaded': false,
          'eventObj': []
        }
      }
      componentDidMount() {
        getDisplayEvents(2).then((eventObj) => {
           this.setState({
            isLoaded: true,
            eventObj: eventObj[0]
          });
        },(error) => {
          this.setState({
            isLoaded: true,
            error
          }); 
        }); 
      }
    render () {
       const { error, isLoaded, eventObj } = this.state;
        if (error) { return  (<div className="uEvents">
        <div>Error: { error.message }</div>
        </div> )}
        else if (!isLoaded) { return (
          <div className="uEvents">
            <div>Laster inn...</div>
            </div> ) } else {
            const eventArr = eventObj;
            const eventItems = []
            eventArr.forEach(event => {
              let date = displayDate(event.date);
              let text = event.description;
              if (text.length >= 50) {
                text = snipText(text, 50);
              }
              eventItems.push (
              <div className="uEvent" key={ event.eventId }>
                <div className="uFrame"><img  src={ images('./' + event.picture_url) } alt={ event.picture_alt }/></div>
                  <div className="eDate small">
                    <h3 className="eDay">{ date.day }</h3>
                    <h3 className="eMonth">{ date.month }</h3>
                  </div>
                  <div className="uText">
                    <h4 className="uTitle">{ event.title }</h4>
                    <div className="uDesc"><p>{ text }</p></div>
                  </div>
                  <NavLink className="btn_main btn-small" to={{ "pathname": '/event/' + event.eventId }}>Bli med</NavLink>
              </div>
              )
            });
            return (
                <div className="uEvents">
                    { eventItems }
                </div>
            );
        }
    }
}

export default UpcomingEvents;