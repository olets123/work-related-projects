import React, { Component } from 'react'
import './style/App.css';
import Header from './components/globals/Header.js';
import Main from './components/Main.js';
import Footer from './components/globals/Footer.js';

/**
 * Component with all website components
*/
export default class App extends Component {

  render() { 
      return (
        <div className="App">
          <Header />
          <Main />
          <Footer />
        </div>
      ) 
  }
}