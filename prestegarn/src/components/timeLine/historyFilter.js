import React, { Component } from 'react';

/**
 * buttons that act as radio buttons, filtering the timeline elements with values. 
*/
class HistoryFilter extends Component  {
    render () {
        return (
            <div className="radio">
                <button className={ this.props.cName[0] } 
                    onClick={ () => this.props.click(1800) }>1800-tallet</button>
                <button className={ this.props.cName[1] }
                    onClick={ () => this.props.click(1850) }>1850-tallet</button>
                <button className={ this.props.cName[2] } 
                    onClick={ () => this.props.click(1900) }>1900-tallet</button>
            </div>
        )
    }
}

export default HistoryFilter;