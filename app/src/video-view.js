/** 
 * This file are the one that shows the video and the vtt text. 
 * It displays information about the video first with a little picture.
 * The video appears on click
 */

import { LitElement, html, css } from 'lit-element';

import './texted-video';

class VideoView extends LitElement {

    static get properties() {
        return {
            showVideo: {
                type: Boolean,
                value: false
            }, 

            videoid: {
                type: Number
            },

            videolist: {
                type: Array
            },
            videolistFilter: {
                type: Array
            },

            description: {
                type: String
            },

            title: {
                type: String
            },

            filename: {
                type: String
            },

            vtt: {
                type: String
            }

        }
    }

    static get styles() {
        return css`
            :host {
            display: block;
            }
            input {
                padding: 2px;
                margin: 2px;
                display: inline-block;
                font-size: 20px;
                width: 12em;
                cursor: pointer;
            }

            li {
                list-style-type: none;
                margin-right: 5%;
                margin-bottom: 40px;
                border-bottom: 1px solid lightgrey;
                cursor: pointer;
            }
            span {
                padding: 7px 25px 7px 25px;
                font-size: 1.2em;
            }
            ul li span:first-of-type {
            display: inline-block;
            width: 23em;
            }
        
            ul li span:nth-of-type(2) {
            display: inline-block;
            width: 23em;
            }
            #video {
                width: 1000px;
                height: auto;
            }
            h3 {
                margin-left: 3%;
                margin-bottom: 3%;
            }
            #btnSearch {
                margin-left: 3%;
            }
        
    
        `;
      }

    render() {
        return html`
        ${this.showVideo? html`
        <texted-video  id="video" videofile="../videos/${this.filename}" vttfile="../vtt/${this.vtt}" videotype="video/mp4"></texted-video>
        ` : html`
            <h3>Video</h3>
            <input type="text" @change="${this.searchbar}"id="btnSearch" placeholder="search" name="searchVideo">
            <ul>
            ${this.videolistFilter.map((video, index) =>{
                return html`
                  <li @click="${this.handler}"><input type="hidden" value="${index}"><span class="videoTitle">${video.video_tittel}</span><span>${video.video_beskrivelse}</span><image width="80px" height="80px" src="../pictures/${video.image_filnavn}"></image></li>
                `;
              })}
            </ul>
        `}
        `;
    }

    
    /**
     * @param {Object} constructor super() checks if there is no reference error
     */

    constructor() {
        super();

        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/video.php`, {
            method: 'GET',
            credentials: 'include'
        }).then(res => {
            return res.json();
        }).then(res => {
            this.videolist = res.result;
            this.videolistFilter = res.result;
        })
    }
    
    /**
     * get all videos 
     */

    firstUpdated() {
        document.addEventListener('click', e=> {
            if(e.path.filter(i=>i.tagName=="VIDEO-VIEW").length!=1) {
                this.showVideo = false;
            }

            fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/video.php`, {
                method: 'GET',
                credentials: 'include'
            }).then(res => {

                return res.json();
            }).then(res => {
                this.videolist = res.result;
                this.videolistFilter = res.result;
            })
        })

    }

    /**
     * handler() calls the video when clicked
     * @param {object} e, event target called when user clicks on li-element
     */

    handler(e) {
        const target = e.currentTarget.childNodes[0].value;
        console.log(e.currentTarget.childNodes[0].value);
        this.showVideo = true;
        
        this.declareValues(target);
    }

    // declare target values

    declareValues(target) {
        if(this.showVideo) {
            this.title = this.videolistFilter[target].video_tittel;
            this.description = this.videolistFilter[target].video_beskrivelse;
            this.filename = this.videolistFilter[target].video_filnavn;
            this.videoid = this.videolistFilter[target].video_id;
            this.vtt = this.videolistFilter[target].video_text;
        } else {
            this.title = "";
            this.description = "";
            this.filename = "";
            this.videoid = -1;
            this.videotag = "";
            this.vtt = "";
        }
    }

    // funuction for searching after title

    searchbar(e) {
        this.videolistFilter = this.videolist.filter(el=> {
            if(el.video_tittel.includes(e.target.value)) {
                return el;
            }
        })

    }
}
customElements.define('video-view', VideoView);



/*import { LitElement, html, css } from "lit-element";

class View extends LitElement {
    constructor() {
        super();
        this.videoliste = [];
        
        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/video.php`, {
            method: "GET"
        }).then(res => {
            return res.json()
        }).then(res => {
            this.videoliste = res.result;
        })
    }
    static get properties() {
        return {
            videoliste: {
                type: Array
            }
        }
    }
    static get styles() {
        return css`
            p {
                margin-left: 1%;
            }
            video {
                width: 400px;
                height: auto;
            }
        `;
    }
    render() {
        return html`
            <p>Videos that all can see</p>
            <ul>
            ${this.videoliste.map((test, index) =>{
                return html`
                <video controls>
                    <source src="../videos/${test.video_filnavn}">
                    <track kind="subtitles" label="English subtitles" src="../vtt/${test.video_text}" srclang="en" default></track>
                </video>
                <li><input type="hidden" value="${index}"><span class="videoTitle">${test.video_text}</span><span>${test.video_tittel}</span></li>
                `;
            })}
            </ul>
        `;
    }

    firstUpdated() {
        document.addEventListener('click', e=> {
            if(e.path.filter(i=>i.tagName=="VIDEO-VIEW").length!=1) {
                
            }
        })

        fetch('http://localhost/prosjekt-ii-polymer/app/api/php/video.php', {
            method: 'GET'
        }).then(res => {
            return res.json();
        }).then(res => {
            this.videoliste = res.result;
            console.log(res);
        })
    }
    
}

customElements.define('video-view', View); */