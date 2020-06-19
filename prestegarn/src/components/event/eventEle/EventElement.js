import React, { Component } from 'react';
import NavLink from '../../globals/NavLink';
import { dateConvert, displayDate } from '../../functions/parseDate';
var images = require.context('../../../images', true);

/**
 * event div with all info about that event
 */
class EventElement extends Component  {

    /** 
     * create tag buttons for each tag on the selected event
    */
    showTags = () => {
        let dispTags = [];
        let tags = this.props.tags.slice();
        tags.forEach((tag, j) => {
            dispTags.push(
                <button key={ j } className="tagBtn" onClick={ () => this.props.click(tag.tagContent) }>#{ tag.tagContent }</button>
            )
        });
        return dispTags;
    }

    render(){
        let date = dateConvert(this.props.date);
        let dispDate = displayDate(this.props.date);
        return(
            <div className={ this.props.cName }>

                <div className="eDate"><h2 className="eDay">{ dispDate.day }</h2><h3 className="eMonth">{ dispDate.month }</h3></div>
                <div id="imageFrame">
                    <img src={ images ('./' + this.props.pictureUrl)} alt={ this.props.pictureAlt }/>
                </div> 
                <div className="detail">
                    <div className="eventTitle"><h3 className="sub_header"><NavLink to={{ "pathname": '/event/' + this.props.id}}>{ this.props.title }</NavLink></h3></div>

                    <div className="eventInfo">
                        <p className="eventDate"><i id="calendar" className="fas fa-calendar-week"></i>{ date }</p>
                        <p>{ this.props.description }</p>
                    </div>
                    
                    <div className="eventTags">
                        <a href={ "https://www.instagram.com/explore/tags/" + this.props.hashtag.slice(1, this.props.hashtag.length) +  "?hl=nb" } className="eventHash" rel="noopener noreferrer" target="_blank">{ this.props.hashtag }</a>
                        <div className="eventTags">{ this.showTags() }</div>
                    </div>
                    <NavLink className="btn_main" to={{ "pathname": '/event/' + this.props.id}}>Les mer...</NavLink> 
                </div>
            </div>
        )
    }
}

export default EventElement;