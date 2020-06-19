/**
 * This file are for the teachers so they could upload video, image and vtt name to database. And the files itself would be redirected throug php to right files. 
 */

import { LitElement, html, css } from "lit-element";

class Upload extends LitElement {
  
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
        width: 6em;
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
    return html`<div class="upload">

      <h3>Teacher video Upload</h3>
      <form id="upload" onsubmit="javascript: return false;">
        <label for="tittel">Title:</label>
        <input type="text" name="tittel" required><br />
        <label for="beskrivelse">Description:</label>
        <input type="text" name="beskrivelse" required><br />
        <label for="kategori">Subject:</label>
        <input type="text" name="kategori" required><br />
        <label for="video">Videofil</label>
        <input type="file" name="video" accept="videos/*"><br />
        <label for="vtt">VTTfile:</label>
        <input type="file" name="vtt"><br />
        <label for="video">Thumbnail:</label>
        <input type="file" name="image" accept="images/*"><br />
        <button type="button" @click="${this.videoUpload}">Last opp</button>
      </form>
    </div> `;
  }

  /**
    * Called button when user clicks on button
    * @param {Object} e event will trigger button for upload
    */

  videoUpload(e) {
    const data = new FormData(e.target.form);
    this.shadowRoot.getElementById("upload").reset();
    fetch("http://localhost/prosjekt-ii-polymer/app/api/php/upload.php", {
      method: "POST",
      credentials: "include",
      body: data
    }).then(res => {
        return res.json()
    }).then(res => {
      console.log(res);
    });
  }

}

customElements.define("video-upload", Upload);
