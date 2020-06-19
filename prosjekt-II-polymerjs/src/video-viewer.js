// This code are from lecture 
// https://github.com/carlosvicient/polymer-project-series/blob/master/lecture6/videoVTT-refactored/core-components/video-viewer.js

import { LitElement, html, css } from 'lit-element';

class VideoViewer extends LitElement {

  static get properties() {
    return {
      videofile: { type: String },
      vttfile: { type: String },
      cues: { type: Array }
    };
  }

  static get styles() {
    return [
      css`
        :host {
          display: block;
        }
        video, p {
          width: 100%;
        }
    `];
  }

  constructor() {
    super();
    this.videofile = '';
    this.vttfile = '';
    this.cues = [];
  }

  render() {
    return html`
      <video id="videoPlayer" controls>
        <source src="${this.videofile}" type="video/mp4">
        <track kind="subtitles" label="English subtitles" src="${this.vttfile}" srclang="en" default></track>
      </video>
      <label>Set speed</label><input type="text" @change="${this.setSpeed}" id="btnSetSpeed" value="1"> </br>
    `;
  }


  setTime(time) {
    this.shadowRoot.querySelector('video').currentTime = time;
  }

 
  firstUpdated() {
    const track = this.shadowRoot.querySelector('video track');
    track.addEventListener('load',e=>{                       
      this.cues = [];
      const trackCues = e.path[0].track.cues;
      for (let i=0; i<trackCues.length; i++) {              
        this.cues.push({text: trackCues[i].text, id: trackCues[i].id, startTime: trackCues[i].startTime});
      };
      this.dispatchEvent(new CustomEvent("cuesUpdated", {
        bubbles: true,
        composed: true,
        detail:{
          cues:this.cues
        }
      }));
    });
    this.shadowRoot.querySelector('video').textTracks[0].mode='hidden';
    this.shadowRoot.querySelector('video').textTracks[0].addEventListener('cuechange', e=>{   
      const startTimes = [];
      for (let i=0; i<e.target.activeCues.length; i++) {
        startTimes.push(e.target.activeCues[i].startTime);
      }
      this.dispatchEvent(new CustomEvent('cuechange', {
        bubbles: true,
        composed: true,
        detail: {
          activeCues: startTimes
        }
      }));
    });
  }

  setSpeed(e) {
    const currentval = e.target.value;
    let videoplayer = this.shadowRoot.getElementById('videoPlayer');
    videoplayer.playbackRate = currentval;
}
}

customElements.define('video-viewer', VideoViewer);