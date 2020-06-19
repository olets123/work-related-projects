import React, { Component } from 'react';
import '../../style/History.css';
import HistoryFilter from './historyFilter.js';
import { getDisplayHistory } from '../../handlers/historyHandler.js';
import { getSearchHistory } from '../../handlers/searchHandler.js';
import TimeElement from './TimeElement.js';

/**
 * History element with all timeline information
*/
class History extends Component {
  constructor(props) {
      super(props);
      this.state = {
        'error': null,
        'isLoaded': false,
        'historyObj': [],
        'yearFilterValue': '',
        'searchObj': [],
        'search': false,
      }
    }
    componentDidMount() {
      getDisplayHistory().then((data) => {
        this.setState({
          isLoaded: true,
          historyObj: data
        });
      },(error) => {
        this.setState({
          isLoaded: true,
          error
        });
      });
    }

    /**
     * yearSearch to filter the history with given search parameter
     * @param {string} search year to filter history by
    */
    yearSearch = (search) => {
      getSearchHistory(search).then((data) => {
        this.setState({ searchObj: data, search: true });
      },(error) => {
        this.setState({
          isLoaded: true,
          error
        });
      });
    }
    /**
     * handle when the user uses the search bar to filter timeline elements
     * @param {string} search parameter to filter history by
    */
    handleSubmit = (event) => {
      let s = '';
      s = event.target.search.value;
      getSearchHistory(s).then((data) => {
        this.setState({searchObj: data, search: true });
      },(error) => {
        this.setState({
          isLoaded: true,
          error,
          'yearFilterValue': 0
        });
      });
      event.preventDefault();
    }
    
    /**
     * revert search, to show all timeline elements
    */
    backToNormal = () => {
      this.setState(() => ({
        search: false,
        'yearFilterValue': 0,
        'error': null
      }));
    }

    /**
     * filter timeline elements with either 1800 to 1850, 1850 to 1900, or 1900 and beyond
     * run the year search function with the value of button clicked
     * @param {integer} value of button to filter history by
    */
    handleClick = (value) => {
      if (value === this.state.yearFilterValue) {       
        this.setState({
        'yearFilterValue': 0
      }); 
      this.backToNormal();
      } else {
        this.setState({
          'yearFilterValue': value
        });
        this.yearSearch(value);
      }
    }
    
    render() {
        const { error, isLoaded, historyObj, searchObj } = this.state;
        if (error) { return (
        <div className="timeWrapper"><h1 className="header">Det var en gong en Præstgard...</h1>
          <div className="error">Error: { error.message }<div className="backDiv eventBtn"><button onClick={ this.backToNormal }>Vis hele historien</button></div></div></div> )} 
        else if (!isLoaded) { return <div className="timeWrapper"><h1 className="header">Det var en gong en Præstgard...</h1><div>Laster inn...</div></div> } else {
          let hObj = this.state.search === false ? historyObj : searchObj;  
          var historyList = hObj.map((time)=> {
              return (
              <TimeElement id={ time.timeId } key={ time.timeId } title={ time.title } 
                  year={ time.year } description={ time.description }
                  pictures = { time.pictures }/>
              );
          });
          let radioCName = ['radioButton', 'radioButton', 'radioButton'];
          if (this.state.yearFilterValue === 1800) {
            radioCName = ['radioButton active', 'radioButton', 'radioButton'];
          } else if (this.state.yearFilterValue === 1850) {
            radioCName = ['radioButton', 'radioButton active', 'radioButton'];
          } else if (this.state.yearFilterValue === 1900) {
            radioCName = ['radioButton', 'radioButton', 'radioButton active'];
          }
          return(
              <div className="timeWrapper">
                <h1 className="header">Det var en gong en Præstgard...</h1>
                <div className="historyFilter">
                  <div className="search">
                    <form onSubmit={ this.handleSubmit } id="searchForm">
                      <label htmlFor="search">Filtrer historien </label>
                      <input type="search" name="search" id="search" 
                        placeholder="søk historien..."/>
                      <input type="submit" name="searchSubmit" value="Gå"/>
                    </form>
                  </div>
                  <HistoryFilter cName={ radioCName } click={ this.handleClick }/>
                </div>
                <div className="timeline">{ historyList }</div>
                { this.state.search === true ? 
                <div className="backDiv eventBtn"><button onClick={ this.backToNormal }>Vis hele historien</button></div>: <div></div>
                }
              </div>
            );
        }
    }
}

export default History;