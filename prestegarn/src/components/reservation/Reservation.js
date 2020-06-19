import React, { Component } from 'react';
import '../../style/Reservation.css';
import DatePicker from './datepicker.js';
import { getDisplayEvents } from '../../handlers/eventHandler.js';
import { createReservation } from '../../handlers/reservationHandler.js'

/**
 * Reservation element with form for user input
*/
class Reservation extends Component {
  constructor(props) {
    super(props);
    this.state = {
      eventObj: [],
      dateObj: [],
      isLoaded: false,
      error: null,
      message: '',
      formError: false
    }
  }
  componentDidMount() {
    getDisplayEvents().then((data) => {
      this.setState({
        isLoaded: true,
        eventObj: data[0]
      });
    },(error) => {
      this.setState({
        isLoaded: true,
        error
      });
    });
  }

  /**
   * when the submit button is pressed send data a fetch request with data
   * @param {event} e click-event with form information
  */
  sendForm = (e) => {
    e.preventDefault();
    let form = e.target.form;
    let valid = this.validateForm(form);
    console.log(valid);
    if (valid[0] === true) {
      var data = {
        'name': form.name.value,
        'email': form.email.value,
        'mobile': form.mobile.value,
        'quantity': form.quantity.value,
        'eventType': form.eventType.value,
        'toDate': form.daterange_to.value,
        'fromDate': form.daterange_from.value,
        'accepted': 0
      }
      createReservation(data).then(data => { this.setState({ message: valid[1].message, formError: false }) }).catch(err => { this.setState({'error': err })});
    } else {
      this.setState({ message: valid[1].message, formError: true });
    }
  }


  validateForm = (form) => {
    var emailReg = /^(([^<>(,;:\s@"]+(\.[^<>(,;:\s@"]+)*)|(".+"))@(([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (form.name.value.length <= 3) {
      return [false, { message: 'Navn er obligatorisk og må være lengre enn 5 karakterer' }];
    } else if (form.email.value.length <= 3) {
      return [false, { message: 'E-post er obligatorisk og må være lengre enn 5 karakterer' }];
    } else if (!emailReg.test(String(form.email.value).toLowerCase())) {
      return [false, { message: 'E-post er ikke riktig formatert' }];
    } else if (form.mobile.value.length <= 8) {
      return [false, { message: 'Telefonnummer er obligatorisk og må være lengre enn 8 karakterer' }];
    } else if (form.quantity.value <= 0 || form.quantity.value >= 30 || form.quantity.value === '') {
      return [false, { message: 'Antall gjester er obligatorisk og mellom 1 og 30' }];
    } else if (form.eventType.value.length <= 4) {
      return [false, { message: 'Arrangement type er obligatorisk og må være lengre enn 4 karakterer' }];
    }
    return [true, { message: 'Suksess, Forespørsel sendt!' }];
  }

  render() {
    const { error, isLoaded, message, formError } = this.state;
    if (error) { return (<div><div>Error: { error.message }</div></div>) }
    else if (!isLoaded) { return (<div><div>Laster inn...</div></div> ) } else {
    const { eventObj, dateObj } = this.state;
    eventObj.forEach((e) => {
      dateObj.push({ date: Date.parse(new Date(e.date)) });
    });
    let messageClass = 'feedback';
    let iconclass = 'fas fa-check';
    if (formError === false && message.length === 0) {
      messageClass = 'feedback hidden';
    } else if (formError === false && message.length !== 0) {
      messageClass = 'feedback success';
      iconclass = 'fas fa-check';
    } else if (formError === true && message.length !== 0) {
      messageClass = 'feedback error';
      iconclass = 'fas fa-times';
    }
    return ( 
      <div>
        <h1 className="header">Reserver øss</h1>
        <div className="introWrapper">
          <p className="intro">Er du på jakt etter et selskapslokale utenom det vanlige, eller kanskje overnatte i unike omgivelser? 
          Præstgarn i Snertingdal tilbyr utleie til en rekke selskap som jubileum, konfirmasjon, bryllup – hva enn du måtte ønske! 
          Fyll ut et skjema nedenfor eller møt opp på Præstgarn for bestilling.</p>  
        </div>
        <h2 className="sub_header request">Forespørsel om utleie</h2>
        <form className="forms" method="POST">
       
        <input className="inputs" type="text" placeholder="Fullt navn*" name="name"/>

        <input className="inputs" type="email" placeholder="E-post*" name="email" />

        <input className="inputs" type="tel" placeholder="Mobilnummer*" name="mobile" />

        <input className="inputs" type="number" name="quantity" min="1" max="50" placeholder="Antall gjester*"/>

        <textarea className="inputs textbox" placeholder="Type arrangement*" name="eventType" />
        <div className="datePickerWrapper">
          <DatePicker dateObj={ dateObj }/>
        </div>
          <input className="btn_main send inputs" type="submit" value="Send forespørsel" onClick={ this.sendForm }/>
          <p className={ messageClass }><i className={ iconclass }></i> { message }</p>
        </form>

      </div>
    );
    }
  }
}


export default Reservation;
