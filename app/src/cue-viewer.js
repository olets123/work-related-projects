// This code are from lecture 
// https://github.com/carlosvicient/polymer-project-series/blob/master/lecture6/videoVTT-refactored/core-components/cue-viewer.js

import { LitElement, html, css } from 'lit-element';

class CueViewer extends LitElement {
  static get properties() {
    return {
      cues: { type: Array },
      activecues: { type: Array }
    };
  }

  static get styles() {
    return [
      css`
        :host {
          display: block;
        }
        ul {
          list-style-type: none;
          width: 300px;
          height: 90vh;
          padding: 0;
          margin: 0;
          overflow-y: auto;
          padding: 10px;
        }
        li {
          padding: 3px 6px;
        }
        li.active {
          background: #fff;
          color: black;
        }
      `
    ];
  }

  constructor() {
    super();
    this.cues = [];
  }

  render () {
    return html`
      <ul>
        ${this.cues.map(cue=>{
          return html`<li data-id="${cue.id}" data-starttime="${cue.startTime}">
            ${cue.text}
          </li>`;
        })}
      </ul>
    `;
  }

  firstUpdated() {
    this.shadowRoot.querySelector('ul').addEventListener('click', e=>{
      if (e.path[0].tagName=='LI') { 
        this.dispatchEvent(new CustomEvent("jumpToTimecode", {
          bubbles: true,
          composed: true,
          detail:{
            timeCode:e.path[0].dataset.starttime
          }
        }));
      }
    });
  }

  updated(changedProperties) {
    changedProperties.forEach((oldValue, propName) => {
      if (propName=='activecues') {
        this.shadowRoot.querySelectorAll('li').forEach(li=>{  
          li.classList.remove('active');
        });
        this.activecues.forEach(startTime=>{  
          this.shadowRoot.querySelector(`[data-starttime="${startTime}"]`).classList.add('active');
          const node = this.shadowRoot.querySelector(`[data-starttime="${startTime}"]`);
          const parent = node.parentElement;
          const height = parent.clientHeight;
          const top = node.offsetTop - parent.offsetTop;
          if (top<height/2) {
            parent.scrollTop = 0;
          } else {                
            parent.scrollTop = top- height/2;
          }
        });
      }
    });
  }

}

customElements.define('cue-viewer', CueViewer);