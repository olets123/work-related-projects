/**
 * This file are the main file besides my-app.js. This file contains all the information and functionallity for login/register and logout. 
 * This file does also provide the user with information about the login and register result. 
 */

import { LitElement, html, css } from "lit-element";
import store from './redux/store/index';
import {logIn, logOut} from './redux/actions/index';

class Handler extends LitElement {

    // get properties
    static get properties() {
        return {
            showLogin: {
              type: Boolean,
              value: false
            },
            showLogout: {
              type: Boolean,
              value: false
            },
            showRegister: {
              type: Boolean,
              value: false
            },
            loggedIn: {
              type: Boolean,
              value: false
            },
            username: {
              type: String
            },
            switchLogin: {
              type: Boolean,
              value: false
            },
            student: {
              type: Boolean,
              value: false
            },
            teacher: {
              type: Boolean,
              value: false
            },
            admin: {
              type: Boolean,
              value: false
            }
        }
    }

    static get styles() {
        return css`
        :host {
          display: block;
          height: 100%;
        }

        .status {
          position: absolute;
          top: 90px;
          right: 0px;
          height: 150px;
          width: 20em;
          padding: 20px;
          background-color: #008ECC;
        }

        .regstatus {
          position: absolute;
          top: 90px;
          right: 0px;
          height: 250px;
          width: 20em;
          padding: 20px;
          background-color: #008ECC;
        }

        label {
          display: inline-block;
          width: 6em;
          font-size: 20px;
          margin: 2px;
        }
    
        input {
          padding: 2px;
          margin: 2px;
          display: inline-block;
          font-size: 20px;
          width: 12em;
          border-radius: 2px;
          border: 1px solid black;
          cursor: pointer;
        }

        button {
          background-color: white;
          border-radius: 2px;
          border: 3px solid black;
          display: inline-block;
          text-align: center;
          margin: 2px;
          padding-bottom: 5px;
          padding: 5px;
          width: 155px;
          font-family: Georgia;
          font-weight: bold;
          font-size: 20px;
        }

        button:hover {
          cursor: pointer;
        }
        `;
    }
    
    render() {

        return html`
        <div class="user" @click="${this.loginWindow}">
            <button id="btn" type="button">${this.switchLogin?html`Logout`:html`Login`}</button>
            ${this.showLogin?
                html`

                <div class="status">
                  <form class="login" onsubmit="javascript: return false;">
                  <label for="username">Email</label><input type="text" id="username" name="username" required><br/>
                  <label for="password">Password</label><input type="password" id="pwd" name="password" required><br/>
                  <button @click="${this.login}">Login</button>
                  </form>
                  <p id="loginError"></p>
                </div>`:
                
                html``
              }

              ${this.showLogout?
                html`
                <div class="status">
                  <p>Signed in as ${this.username}</p>
                  <button @click="${this.logout}">Logout</button>
                </div>
                `:
                html``
              }
        </div>
        <div class="register" @click="${this.registerWindow}">
        <button type="button">Register</button>

         ${this.showRegister?
          html`<div class="regstatus">
          <form class="login" onsubmit="javascript: return false;">
                <label for="firstname">Firstname:</label><input type="text" name="firstname" required><br />
                <label for="lastname">Lastname:</label><input type="text" name="lastname" required><br />
                <label for="email">Email:</label><input type="email" name="email" required><br />
                <label for="password">Password:</label><input type="password" name="password" required><br /><br />
                <label for="teacher">Teacher</label><input type="checkbox" name="checkbox">
                <button type="button" @click="${this.registrer}">Register</button>
            </form>
          </div>
          `:
          html``
        }      
        </div>
        `;
    }

    /**
     * @function firstUpdated() calls to check
     * user status when logged in or not logged in. 
     */

    firstUpdated() {
      document.addEventListener('click', e=>{
        if(e.path.filter(i=>i.tagName=='USER-HANDLER').length!=1) {  // Clicked outside the user icon/status display
          this.showLogin = false;
          this.showLogout = false;
          this.showRegister = false;
        }
      })
      // Check login status for user
      fetch (`http://localhost/prosjekt-ii-polymer/app/api/php/loginStatus.php`, {
        credentials: 'include'
        })
        .then(res=>res.json())
        .then(res=>{
         console.log(res);
          if (res.loggedIn) {       
            this.setState(res); 
            this.switchLogin = true;
            store.dispatch(logIn({uid: res.uid, username: res.username, isStudent: this.student, isTeacher: this.teacher, isAdmin: this.admin}));
            console.log(res); 
          }
        })
      }


    /**
     * @param {event} 
     * loginWindow()
     * Display login window when user click on button, 
     *  if status not logged inn
     * and display logout button window if status logged inn.
     * registerWindow() show register window whenn click on button
     * show always if not logged in
     */

    loginWindow(e) {
        if(e.path.filter(tag=>tag.className=='status').length<1) {
         if (!this.loggedIn) {
           this.showLogin = !this.showLogin;   // Show login window if not logged in
           this.showRegister = false;
         } else {
           this.showLogout = !this.showLogout; // Show logout window if logged in
         }
       }
     }

     registerWindow(e) {
        if(e.path.filter(tag=>tag.className=='regstatus').length<1) {
          if (!this.loggedIn) {
            this.showRegister = !this.showRegister; // Display register window if not logged in   
            this.showLogin = false;
          } else {
            this.showRegister = !this.showRegister;
          }
        }
      }

      /*
      *Function called when user press the logout button 
      */

      logout() {
        // fetch logout
        fetch(`http://localhost/prosjekt-ii-polymer/app/api/php/logout.php`, {
          credentials: "include"
        }).then(res => res.json())
        .then(res => {
          if(res.status == "SUCCESS") {
             this.setState(res);
             store.dispatch(logOut());
          }
        })
      }

      /**
       * 
       * @param {object} e takes event object when click on login.php
       * takes the form and do a call into login.php.
       */

      login(e){
        //create new form data
        const data = new FormData(e.target.form);
        fetch('http://localhost/prosjekt-ii-polymer/app/api/php/login.php', {
          method: "POST",
          credentials: "include",
          body: data
        }).then(res => {
            return res.json()
        }).then(res => {
            if(res.status == "SUCCESS") {
              this.setState(res);
              this.switchLogin = !this.switchLogin;
              store.dispatch(logIn({uid: res.uid, username: res.username, isStudent: this.student, isTeacher: this.teacher, isAdmin: this.admin}));
              console.log(res);
            } else {
              console.log(res);
              const err = this.shadowRoot.getElementById('loginError');
              const inp = this.shadowRoot.getElementById('username');
              const pwd = this.shadowRoot.getElementById('pwd');
              if(inp.value <= 0) {
                err.innerHTML = "Fyll inn brukernavn";
              } else if(pwd.value <= 0){
                err.innerHTML = "Fyll inn passord";
              } else if(res.status == "Wrong password") {
                err.innerHTML = "Brukernavn eller passord er feil";
              } else if(res.status == "The user doesnt exist") {
                err.innerHTML = "Brukernavn eller passord er feil";
              } else {
                err.innerHTML = "Noe gikk galt. Prøv igjen.";
              }  
            }
        });
      }

      /**
       * 
       * @param {object} e takes event object when click on register buttom
       * takes the form and do a call into register.php.
       * creates a new user into the database
       */

    registrer(e){
        // create new form data 
        const data = new FormData(e.target.form);
        fetch('http://localhost/prosjekt-ii-polymer/app/api/php/register.php', {
          method: "POST",
          credentials: "include",
          body: data
        }).then(res => {
            return res.json()
        }).then(res => {
            if(res.status == 'SUCCESS') {
              this.showRegister = !this.showRegister;
              this.showLogin = !this.showLogin;
              console.log("Successfully registered");
            } else {
              console.log("Something went wrong..")
            }
        });
    }

     /**
     * Function called and uses data given
     * @param {Object} res 
     * setState() set all values of properties
     */

    setState(res) {
        this.showLogin = false;
        this.showLogout = false;
        this.showRegister = false;
        this.loggedIn = res.uid!=null;
        this.username = res.firstname + " " + res.lastname;
        this.switchLogin = false;
        this.student = false;
        this.teacher = false;
        this.admin = false;

        if(res['premission'] == 'Student'){     // if logged in as student, show student pages
            this.student = true;
        } else if(res['premission'] == 'Teacher'){    // if logged in as Teacher, show all teacher pages
            this.student = true;
            this.teacher = true;
        } else if(res['premission'] == 'Admin'){    // if logged in as admin, give access to all pages for admin
            this.student = true;
            this.teacher = true;
            this.admin = true;
        }
    }
  }

customElements.define("user-handler", Handler);


