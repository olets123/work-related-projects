import React, { Component } from 'react';
import { withRouter } from 'react-router';
import { Switch, Route } from 'react-router-dom';
import Home from './home/Home';
import About from './about/About';
import History from './timeLine/History';
import Reservation from './reservation/Reservation';
import Events from './event/Events';
import Explore from './explore/Explore';
import EventDetail from './event/EventDetailPage.js';
import Info from './globals/info.js';
import ScrollToTop from './functions/scrollToTop.js';
import '../style/Main.css';

const Scroll = withRouter(ScrollToTop);

/**
 * Component to change between other components
*/
export default class Main extends Component {
    render() {
        return (
            <main>
                <div className="mainWrapper">
                    <Scroll>
                        <Switch>
                            <Route exact path='/' component={ Home }/>
                            <Route path='/omoss' component={ About }/>
                            <Route path='/historie' component={ History }/>
                            <Route path='/reservering' component={ Reservation }/>
                            <Route path='/events' component={ Events }/>
                            <Route path='/venner' component={ Explore }/>
                            <Route path='/event/:id'  component={ EventDetail }/>
                            <Route path='/info'  component={ Info }/>
                        </Switch>
                    </Scroll>
                </div>
            </main>
        );
    }
}
