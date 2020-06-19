// This code are from lecture 
// https://github.com/carlosvicient/polymer-project-series/blob/master/lecture6/videoVTT-refactored/core-components/texted-video.js

import { LitElement, html, css } from 'lit-element';
import './video-viewer';
import './cue-viewer';

class TextedVideo extends LitElement {
  static get properties() {
    return {
      videofile: { type: String },
      videotype: { type: String },
      vttfile: { type: String },
      cues: { type: String },
      activecues: { type: Array }
    }
  }

  static get styles() {
    return [
      css`
        :host {
          display: block;
          height: 100%;
        }
        div {
          display: grid;
          height: 100%;
          grid-template-columns: 1fr 300px;
          grid-template-rows: 100%;
          grid-template-areas: "video cues";
        }
        video-viewer {
          grid-area: video;
        }
        cue-viewer {
          grid-area: cues;
        }`];
  }

  constructor() {
    super();
    this.videofile = '';
    this.videotype = '';
    this.vttfile = '';
    this.cues = '[]';
    this.activecues ='[]';
    this.addEventListener('cuesUpdated', e=> this.cues = JSON.stringify(e.detail.cues));
    this.addEventListener('cuechange', e=> this.activecues = JSON.stringify(e.detail.activeCues));
    this.addEventListener('jumpToTimecode', e=> this.shadowRoot.querySelector('video-viewer').setTime(e.detail.timeCode));
  }

  render() {
    return html`
      <div>
        <video-viewer videofile="${this.videofile}" videotype="video/mp4" vttfile="${this.vttfile}"></video-viewer>
        <cue-viewer cues="${this.cues}" activecues="${this.activecues}"></cue-viewer>
      </div>`;
  }
}

customElements.define('texted-video', TextedVideo);