import React, { Component } from 'react';
import DateRangePicker from '@wojtekmaj/react-daterange-picker';

/**
 * Inputfields for inputing the information about reservation period (to, from)
*/
export default class DatePicker extends Component {
  constructor(props) {
    super(props);
    this.state = {
      date: [new Date(), new Date()],
      error: null
    }
  }
  
  /**
   * when the input field gets values check if the date is available
  */
  onChange = (date) => {
    if (date !== null) {
      let tempDate = [Date.parse(new Date(date[0])), Date.parse(new Date (date[1]))];
      let valid = this.validateDate(tempDate);
      if (valid.length <= 0) {
        this.setState({ error: 'Dato er ledig!'})
        this.setState({ date })
      } else {
        this.setState({ error: 'Dato er ikke ledig!'})
        this.setState({ date })
      }
    } else {
      this.eraseDate();
    }
  } 

  /**
   * Makes the date in the datepicker today's date, resetting the picker
  */
  eraseDate = () => {
    this.setState({ date: [new Date(), new Date()] });
    this.setState({ error: null});
  }

  /**
   * get date from onchange function to check if available
   * if not available push false into array
  */
  validateDate = (date) => {
    const { dateObj } = this.props;
    let tempArr = [];
    dateObj.forEach((d) => {
      if (d.date >= date[0] && d.date <= date[1]) {
        tempArr.push(false);
      }
    });
    return tempArr; 
  }

  render() {
    const { error } = this.state;    
    let today = new Date();
    let message = '';
    if (error === null) { message = ''; }
    else { message = error } 
    return (
      <div>
      <div className="DatePicker">
        <DateRangePicker
          onChange={ this.onChange }
          value={ this.state.date }
          minDate = { today }
        />
        </div>
        <p className="calendarFeedback">{ message }</p>
      </div>
    );
  }
}