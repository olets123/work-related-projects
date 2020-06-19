/**
 * This file are for display playlists for students. 
 * We didnt manage to finish this file other than displaying playlist name and video name.
 */
import { LitElement, html, css } from "lit-element";

class Playlist extends LitElement {
    static get properties() {
        return {
            playlist: {
                type: Array
            }
        }
    }
    static get styles() {
        return css`
            h3 {
                margin-left: 3%;
                margin-bottom: 1%;
            }
            ul {
                margin-left: 3%;
                margin-bottom: 1%;
                list-style-type: none;
            }
        `;
    }
    render() {
        return html`
        <h3>Playlists for Students</h3>
        <ul>
            <li><h4>Playlist - ${this.playlist.playlist_navn}<h4></li>
            <li><p>${this.playlist.video_navn}</p></li>
        </ul>
        `;
    }

    constructor() {
        super();
        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/playlist-view.php`, {
            method: 'GET',
            credentials: "include"
        }).then(res => {
            return res.json();
        }).then(res => {
            this.playlist = res;
        })
    }

<<<<<<< HEAD
    // First when the page load do we fetch the information we need from playlist-view
=======
/**
 * firstUpdated() calls function when loading the page
 * fetch gets all playlists
 */
    
>>>>>>> 26c46d40b7732921990a4fb835f8dd28016112ef
    firstUpdated() {
        document.addEventListener('click', e=> {
            if(e.path.filter(i=>i.tagName=="STUDENT-PLAYLIST").length!=1) {  
                }
            })
        // Get all playlists
        fetch('http://localhost/prosjekt-ii-polymer/app/api/php/playlist-view.php', {
            method: 'GET',
            credentials: "include"
        }).then(res => {
            return res.json();
        }).then(res => {
            console.log(res);
            this.playlist = res;

        })
       }
     }

customElements.define('student-playlist', Playlist);