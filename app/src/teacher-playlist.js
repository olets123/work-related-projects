/**
 * This file contains two forms. One so the teacher can create a playlist, and one so the teacher could add a video to the playlist.
 */

import { LitElement, html, css } from "lit-element";

class TeacherPlaylist extends LitElement {


    static get styles() {
        return css`
            h3 {
                margin-left: 3%;
                margin-bottom: 1%;
            }
            form {
                margin-left: 3%;
            }
            label {
                display: inline-block;
                width: 8em;
                font-size: 1.2em;
                margin: 2px;
            }
            input {
                padding: 2px;
                margin: 2px;
                display: inline-block;
                font-size: 20px;
                width: 12em;
                cursor: pointer;
            }
            button {
                margin-top: 1%;
                background-color: green;
                color: white;
                margin-right: 20px;
                padding: 7px 25px 7px 25px;
                font-size: 1.2em;
              }
        `;
    }

    render() {

        return html`
            <h3>Create playlist</h3>

            <form id="form1" onsubmit="javascript: return false;">
                <label for="name">Playlistname</label>
                <input type="text" name="navn"><br />
                <button type="button" @click="${this.createPlaylist}">Create playlist</button>
            </form>
            <br />

            <h3>Add video to playlist</h3>
            <form id="form2" onsubmit="javascript: return false;">
                <label for="spilleliste">Name for playlist </label>
                <input type="text" name="spilleliste"><br />
                <label for="video">Name for video</label>
                <input type="text" name="video"><br />
                <button type="button" @click="${this.updatePlaylist}">Update playlist</button>
            </form>
        `;
    }

    /**
     * 
     * @param {object} e event target called when user clicks on button for createPlaylist()
     * updatePlaylist() when button clicked, it updates the playlist
     */

    createPlaylist(e) {
        const data = new FormData(e.target.form);
        // reset form
        this.shadowRoot.getElementById("form1").reset();
        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/playlist.php`, {
            method: "POST",
            credentials: "include",
            body: data 
        }).then(res => {
            return res.json()
        }).then(res => {
            console.log(res);
        })
      }

    
    // This function let the user update the playlist with the video the teacher wants to add
    updatePlaylist(e) {
        const data = new FormData(e.target.form);
        // reset form
        this.shadowRoot.getElementById("form2").reset();
        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/spilleliste.php`, {
            method: "POST",
            credentials: "include",
            body: data 
        }).then(res => {
            return res.json()
        }).then(res => {
            console.log(res);
        })
       }   
      }

customElements.define('teacher-playlist', TeacherPlaylist);