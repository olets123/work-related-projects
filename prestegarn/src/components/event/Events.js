import React, { Component } from 'react';
import { getDisplayEvents } from '../../handlers/eventHandler.js';
import { getSearchEvents } from '../../handlers/searchHandler.js';
import EventElement from './eventEle/EventElement.js';
import '../../style/Events.css';

/**  
 * Event of type react class
 * componentDidMount -> when mounted fetch events from api
 * -> site will not render until events are fetched (isLoaded)
*/
class Events extends Component {
  constructor(props) {
    super(props);
    this.state = {
      'error': null,
      'isLoaded': false,
      'eventObj': [],
      'pastEventObj': [],
      'searchObj': [],
      'tagObj': [],
      'showAllEvents': true,
      'search': false
    } 
  }

  componentDidMount() {
    getDisplayEvents().then((data) => {
      this.setState({
        isLoaded: true,
        eventObj: data[0],
        pastEventObj: data[1],
        tagObj: data[2]
      });
    },(error) => {
      this.setState({
        isLoaded: true,
        error
      });
    });
  }

  /**
   * tagSearch will run when tag option is selected
   * @param search is of type string -> will fetch new events that match the search tag 
  */

  tagSearch = (search) => {
    getSearchEvents(search).then((data) => {
      this.setState({ searchObj: data, search: true });
    },(error) => {
      this.setState({
        isLoaded: true,
        error
      });
    });
  }
  
  /**
   * handleSubmit will run when search form submitted 
   * @param event when form submitted -> search events with the content inside search input of the form
  */

  handleSubmit = (event) => {
    let search = '';
    search = event.target.search.value;
    getSearchEvents(search).then((data) => {
      this.setState({searchObj: data, search: true });
    },(error) => {
      this.setState({
        isLoaded: true,
        error
      });
    });
    event.preventDefault();
  }

  /**
   * backToNormal reverts the search and returns the view to show all events
  */

  backToNormal = () => {
    this.setState(() => ({
      search: false,
      error: null
    }));
  }

  /** 
   * changeEventsToShow changes the event view from "all events" to "previous events" or the other way around
  */
  changeEventsToShow = () => {
    this.setState((prevState) => ({
      showAllEvents: !prevState.showAllEvents
    }));
    this.backToNormal();
  }

  /** 
   * createTagOptions is run when the site is rendered and shows all tags available from the database
   * @returns a list of html tags of type option to be show in a select field on the website
  */
  createTagOptions = () => {
    const { tagObj } = this.state;
    let displayTags = [];
    tagObj.forEach((tag) => {
      displayTags.push(
        <option key={ tag.tagId } value={ tag.content }>{ tag.content }</option>
      )
    })
    return displayTags;
  }

  /**
   * checkOptionSelected is run when the user changes the option selected in the dropdown
   * @param e is an event triggered on a change
   */
  checkOptionSelected = (e) => {
    if (e.target.value !== '' && e.target.value !== null && e.target.value !== 'default') {
      this.tagSearch(e.target.value)
    } else if (e.target.value === 'default') {
      this.backToNormal();
    }
  }

  /**
   * createEvents is run when the site renders and creates multiple EventElements (imported from EventElements.js)
   * @returns list of div tags with event information inside each tag (can be either all events or previous events).
  */
  createEvents = () => {
    let eventArr = [];
    if (this.state.showAllEvents === true) {
      let eventObj = this.state.search === false ? this.state.eventObj : this.state.searchObj;
      let cName = 'eventDiv';
      for(let i = 0; i < eventObj.length; i++) {
        eventArr.push(
          <EventElement cName={ cName } key={ eventObj[i].eventId } 
          id={ eventObj[i].eventId } title={ eventObj[i].title } 
          date={ eventObj[i].date } description={ eventObj[i].description }
          numTickets = { eventObj[i].numTickets } 
          numTicketsSold = { eventObj[i].ticketsSold }
          price = { eventObj[i].price }
          pictureUrl = { eventObj[i].picture_url } 
          pictureAlt={ eventObj[i].picture_alt }
          tags={ eventObj[i].tags } click={ this.tagSearch } 
          hashtag={ eventObj[i].hashtag } tagSearch={ this.tagSearch }
          />
        );
      }
      return eventArr;
    } else {
      let eventObj = this.state.pastEventObj;
      let cName = 'eventDiv past';
      for(let i = 0; i < eventObj.length; i++) {
        eventArr.push(
          <EventElement cName={ cName } key={ eventObj[i].eventId } 
          id={ eventObj[i].eventId } title={ eventObj[i].title } 
          date={ eventObj[i].date } description={ eventObj[i].description }
          numTickets = { eventObj[i].numTickets } 
          numTicketsSold = { eventObj[i].numTicketsSold}
          price = { eventObj[i].price }
          pictureUrl = { eventObj[i].picture_url } 
          pictureAlt={ eventObj[i].picture_alt }
          sponsorId = { eventObj[i].sponsor_id }
          tags={ eventObj[i].tags } hashtag={ eventObj[i].hashtag }
          />
        );
      }
      return eventArr;
    }
  }
  
  render (){
    const { error, isLoaded } = this.state;
    if (error) { return (
      <div><h1 className="header">Fæstligheter</h1><div className="eventCtrlDiv"><div>Error: {error.message}<div className="events"><button onClick={ this.backToNormal }>Vis all arrangement</button></div></div></div></div>)  } 
      else if (!isLoaded) { return (
          <div>
            <div><h1 className="header">Fæstligheter</h1><div className="eventCtrlDiv">Laster inn...</div></div></div> ) } else { 
      return (
        <div>
          <h1 className="header">Fæstligheter</h1>
          <div className="wrapperHandlerDiv">
            <div className="eventHandlers">
            <div className="filterEvents">
              <form onSubmit={ this.handleSubmit } id="searchForm">
                <label htmlFor="search">Søk: </label><input type="search" name="search" id="search" placeholder="finn ditt arrangement..."/>
                <input type="submit" name="searchSubmit" value="Gå"/>
              </form>
            </div>
            <div className="selectDiv">
                <label htmlFor="tagSelect">Filtrer arrangement med </label>
                <select name="tagSelect" id="tagSelect" onChange={ this.checkOptionSelected }>
                  <option id="0" className="default" value="default">#tag</option>
                  { this.createTagOptions() }
                </select>
              </div>
            { this.state.showAllEvents === true ?
              <div className="radio">
                <button className="radioButton active" onClick={ this.backToNormal }>Alle hendelser</button>
                <button className="radioButton" onClick={ this.changeEventsToShow }>Tidligere hendelser</button>
              </div> :
              <div className="radio">
                <button className="radioButton" onClick={ this.changeEventsToShow }>Alle hendelser</button>
                <button className="radioButton active" onClick={ this.backToNormal }>Tidligere hendelser</button>
              </div> 
            }
            </div>
          </div>
          <div className="events">
            <div className="eventCtrlDiv">
              { this.createEvents() }
              { this.state.search === true ? 
              <div className="backDiv eventBtn"><button onClick={ this.backToNormal }>Vis alle arrangement</button></div>: <div></div>
              }
            </div>
          </div>
        </div>
      )
    };
  }
}
export default Events;