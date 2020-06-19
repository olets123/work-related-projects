import React, { Component } from 'react';
import { getSingularEvent } from '../../handlers/eventHandler.js';
import { dateConvert } from '../functions/parseDate.js';
import NavLink from '../globals/NavLink';
import '../../style/__eventDetail.css';
var images = require.context('../../images', true);
var logo = require.context('../../images/logo', true);

/**
 * Page for the detailed view of one event, event is fetched based on the number in the url
 */
class EventDetailPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
          'error': null,
          'isLoaded': false,
          'eventObj': [],
          'showAllEvents': true,
        }
      }
      componentDidMount() {
        getSingularEvent(this.props.match.params.id).then((eventObj) => {
           this.setState({
            isLoaded: true,
            eventObj
          });
        },(error) => {
          this.setState({
            isLoaded: true,
            error
          }); 
        }); 
      }
    
    /**
     * create buttons for each tag
    */
    showTags = () => {
        let dispTags = [];
        let tags = this.state.eventObj.tags.slice();
        tags.forEach((tag, j) => {
            dispTags.push(
                <button key={ j } className="tagBtn" onClick={ () => this.props.tagSearch(tag.tagContent) }>#{ tag.tagContent }</button>
            )
        });
        return dispTags;
    }

    render () {
       const { error, isLoaded, eventObj } = this.state;
        if (error) { return (
            <div><h1 className="header">{eventObj.title}</h1><div className="eDiv"><div>Error: { error.message }</div></div></div>)}
        else if (!isLoaded) { return (<div><h1 className="header">{eventObj.title}</h1><div className="eDiv"><div>Laster inn...</div></div></div>) } else {  
        let img_src = images(`./` + eventObj.picture_url);
            let alt_text = eventObj.picture_alt;
            let friendsObj = [];
            friendsObj = eventObj.friends.slice();
            let friendDisplay = [];
            friendsObj.forEach((friend, j) => {
                friendDisplay.push(
                <div key={ j } className="fBox">
                <div className="cover">
                    <h4>{ friend.name }</h4>
                    <span>{ friend.type }</span>
                    <div className="socialMedia">
                    <a href={ friend.facebookLink }>
                        <i className="fab fa-facebook-f"></i></a>
                    <a href={ friend.instagramLink }>
                        <i className="fab fa-instagram"></i></a>
                    <a href={ "mailto: " + friend.email }>
                        <i className="fas fa-envelope"></i></a>
                    </div>
                </div>
                <div className="friendFrame">
                    <img src={ logo(`./` + friend.picture_url) } alt={ friend.picture_alt }/>
                </div>
            </div>);
            });                
            let displayProgram = [];
            let programObj = [];
            programObj = eventObj.program.slice();
            programObj.forEach((prog, k) => {
                displayProgram.push(
                    <li key={ k }>{ prog.time } - { prog.content }</li>
                );
            });  
            return(
                <div>
                <h1 className="header">{eventObj.title}</h1>
                    <div className="eDiv">
                        <div className='eventDiv smallerDiv'>
                            <div id="imageFrame">
                                <img src={ img_src } alt={ alt_text }/>
                            </div>
                            <div className="detail centered">
                                <div className="eventTags">{ this.showTags() }</div>
                                <div className="eventInfo">
                                    <p className="eventDate"><i id="calendar" className="fas fa-calendar-week"></i>{ dateConvert(eventObj.date) }</p>
                                    <a href={ "https://www.instagram.com/explore/tags/" + eventObj.hashtag.slice(1, eventObj.hashtag.length) +  "?hl=nb" } className="eventHash">{ eventObj.hashtag }</a>
                                </div>
                                <p>{ eventObj.description }</p>
                                <NavLink className="btn_main" to={ '/events' }>Se andre hendelser</NavLink> 
                                <a className="eBuy btn_main" href="https://tikkio.com/" rel="noopener noreferrer" target="_blank">Kjøp billett ({ eventObj.price },-)</a>
                            </div>
                        </div>
                        <div className="program">
                            <h2>Program</h2>
                            <ul>{ displayProgram }</ul>
                        </div>
                        <div className="sponsors">
                            <h2>Hendelsens hjelpere</h2>
                            <div className="sponsorWrapper">
                                { friendDisplay } 
                                <NavLink className="btn_main detailBtn" to={ '/venner' }>Se flere av våre venner</NavLink>
                            </div>
                        </div>
                    </div>
                </div>
            )
        }
    }
}

export default EventDetailPage;