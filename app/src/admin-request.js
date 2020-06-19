/**
 *  This file are for admin. When a student wants to get teacher premission.  
 */ 

import { LitElement, html, css } from "lit-element";

class Request extends LitElement {
    static get properties() {
        return {
            userlist: {
                type: Array
            }
        }
    }
    static get styles() {
        return css`
            h3 {
                margin-left: 3%;
                margin-bottom: 3%;
            }
            li {
                list-style-type: none;
                margin-right: 5%;
                margin-bottom: 40px;
                border-bottom: 1px solid lightgrey;
            }
            span {
                padding: 7px 25px 7px 25px;
                font-size: 1.2em;
            }
            button {
                background-color: green;
                color: white;
                margin-right: 20px;
                padding: 7px 25px 7px 25px;
                font-size: 1.2em;
            }
        `;
    }

    render() 
    {
        return html`
            <h3>Request for Students who wants to become Teacher Status</h3>
            <ul>
            ${this.userlist.map((users, index) =>{
                return html`
                <li><button @click="${this.userHandler}">Give access</button><input type="hidden" value="${index}"><span>Userid ( ${users.user_id} )</span><span>Name ( ${users.user_firstname}, ${users.user_lastname} )</span><span>Email ( ${users.user_email} )</span></li>
                `;
            })}
            </ul>
        `;
    }

    /*
     * function firstUpdated()
     * called when user clicks on the page
     * the fetch checks if admin has requests
     */

    firstUpdated() {

        document.addEventListener('click', e=>{
            if(e.path.filter(i=>i.tagName=='ADMIN-REQUEST').length!=1) { 
                
            }
          })
          // Get all requests
        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/request.php`, {
            method: "GET",
            credentials: "include"
        }).then(res => {
            return res.json()
        }).then(res => {
            this.userlist = res['result'];
        })
     }

     /**
     * 
     *  @param {}
     *  Constructor, sets value 
     * for userlist
     */

    constructor() {
        super();
        this.userlist = [];

        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/request.php`, {
            method: "GET",
            credentials: "include"
        }).then(res => {
            return res.json()
        }).then(res => {
            this.userlist = res['result'];
        })
    }

    /**
     * userHandler() when button is clicked, admin can give access to students
     * who wants to become status teacher
     * @param {object} e - event target called when user clikcs on button
     * splices index to separate the list
     */

     userHandler(e) {
        // handle event when click on li-element
        const index = e.currentTarget.parentNode.childNodes[1].value;
        const data = new FormData();
        // add id to userlist
        data.append("id", this.userlist[index].user_id);

        if(this.userlist.length != 1) {
            this.userlist.splice(index, 1);
            for(let i = index; i < this.userlist.length; i++) {
            	 this.userlist[i] = this.userlist[i++];
            }
        } else {
            this.userlist = [];
        }

        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/updatePremission.php`, {
            method: 'POST',
            credentials: "include",
            body: data
        }).then(res => {
            return res.json();
        }).then(res => {
            if(res['status'] == "SUCCESS") {
                console.log("updated");
            }
        })

        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/request.php`, {
            method: "GET",
            credentials: "include"
        }).then(res => {
            return res.json();
        }).then(res => {
            if(res['status'] == "SUCCESS") {
                this.userlist = res['result'];
            }
        })
       }
      }

customElements.define('admin-request', Request);