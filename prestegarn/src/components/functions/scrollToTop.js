import { Component } from 'react';

/**
 * when clicking on a navigation element scroll the page to the top
*/
export default class ScrollToTop extends Component {
    componentDidUpdate(prevProps) {
      if (this.props.location.pathname !== prevProps.location.pathname) {
        window.scrollTo(0, 0);
      }
    }
    render() {
      return this.props.children;
    }
  }